<?php

declare(strict_types=1);

/**
 * This file is part of the IpexB2B package
 *
 * https://github.com/Spoje-NET/ipex-b2b
 *
 * (c) Spoje.Net <https://spoje.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IPEXB2B;

use DateTime;
use Ease\Brick;
use Ease\Functions;
use Ease\Logger\Logging;

/**
 * Base class for reading from IPEX.
 *
 * @url https://restapi.ipex.cz/documentation#/
 */
class ApiClient extends Brick
{
    use Logging;

    /**
     * Version of IPEXB2B library.
     */
    public static string $libVersion = '0.1.2';

    /**
     * Communication protocol version used.
     *
     * @var string Version of the API used
     */
    public string $protoVersion = 'v1';

    /**
     * URL of object data in IPEX.
     *
     * @var string url
     */
    public string $apiURL;

    /**
    * Data block in response field.
     */
    public string $resultField = 'results';

    /**
     * Evidence used by object.
     *
     * @see https://restapi.ipex.cz/documentation#/
     */
    public string $section = '';

    /**
     * Default communication format.
     * @var string json
     */
    public string $format = 'json';

    /**
     * response format.
     *
     * @var string json
     */
    public string $responseMimeType = 'json';

    /**
     * Curl Handle.
     *
     * @var \CurlHandle
     */
    public $curl;

    /**
     * Server[:port].
     */
    public string $url = '';

    /**
     * REST API Username.
     */
    public string $user = '';

    /**
     * REST API Password.
     */
    public string $password = '';

    /**
     * @var array Array of HTTP headers sent with every request.
     */
    public array $defaultHttpHeaders = ['User-Agent' => 'IPEXB2B'];

    /**
     * Default additional request url parameters after question mark.
     */
    public array $defaultUrlParams = [];

    /**
     * Identification string.
     */
    public string $init = '';

    /**
     * Column with name.
     */
    public string $nameColumn = 'nazev';

    /**
     * The column containing the date the record was inserted into the e-shop.
     */
    public string $myCreateColumn = 'false';

    /**
     * The column containing the date of the last modification of the record to the e-shop.
     */
    public string $myLastModifiedColumn = 'lastUpdate';

    /**
     * Key record identifier.
     */
    public string $fbKeyColumn = 'id';

    /**
     * Information about the last HTTP request.
     */
    public ?array $curlInfo = null;

    /**
     * Information about the last HTTP error.
     */
    public string $lastCurlError = '';

    /**
     * Used codes storage.
     */
    public array $codes = [];

    /**
     * Last Inserted ID.
     */
    public ?int $lastInsertedID = null;

    /**
     * Raw Content of last curl response.
     */
    public string $lastCurlResponse;

    /**
     * HTTP Response code of last request.
     */
    public int $lastResponseCode = 0;

    /**
     * Last operation result data or message(s).
     */
    public array $lastResult = [];

    /**
     * Number from  @rowCount.
     */
    public ?int $rowCount = null;

    /**
     * @see https://www.ipex.eu/api/dokumentace/ref/zamykani-odemykani/
     *
     * @var string filter query
     */
    public string $filter;

    /**
     * An array of actions supported by that section.
     *
     * @see https://demo.ipex.eu/c/demo/faktura-vydana/actions.json E.g. Invoice actions
     */
    public array $actionsAvailable = [];

    /**
     * Parameters for URL.
     *
     * @see https://www.ipex.eu/api/dokumentace/ref/urls/ All supported parameters
     */
    public array $urlParams = [
    ];

    /**
     * Body data  for next curl POST operation.
     */
    protected string $postFields = '';

    /**
     * @see https://demo.ipex.eu/devdoc/actions Performing actions
     */
    protected string $action;

    /**
     * Save 404 results to log ?
     */
    protected bool $ignoreNotFound = false;

    /**
     * Token handling object live here.
     */
    protected Token $tokener;

    /**
     * Class for read only interaction with IPEX.
     *
     * @param mixed $init    default record id or initial data
     * @param array<string,string> $options Connection settings override
     */
    public function __construct(string $init = '', array $options = [])
    {
        $this->init = $init;

        $this->setUp($options);
        $this->curlInit();

        if (\get_class($this) !== 'IPEXB2B\Token') {
            $this->tokener = Token::instanced();
        }

        if (!empty($init)) {
            $this->processInit($init);
        }
    }

    /**
     * Disconnect CURL befere pass away.
     */
    public function __destruct()
    {
        $this->disconnect();
    }

    /**
     * Reconnect After unserialization.
     */
    public function __wakeup(): void
    {
        $this->curlInit();
    }

    /**
     * SetUp Object to be ready for connect.
     *
     * @param array $options Object Options (company,url,user,password,section,
     *                       defaultUrlParams,debug)
     */
    public function setUp(array $options = []): void
    {
        $this->setupProperty($options, 'url', 'IPEX_URL');
        $this->setupProperty($options, 'user', 'IPEX_LOGIN');
        $this->setupProperty($options, 'password', 'IPEX_PASSWORD');

        if (isset($options['section'])) {
            $this->setSection($options['section']);
        }

        $this->setupProperty($options, 'defaultUrlParams');
        $this->setupProperty($options, 'debug');
        $this->updateApiURL();
    }

    /**
     * Add Info about used user, server and libraries.
     *
     * @param string $prefix banner prefix text
     * @param string $suffix banner suffix text
     */
    public function logBanner(/*string*/ $prefix = '',/*string*/ $suffix = ''): void
    {
        parent::logBanner(
            $prefix,
            ' IPEX '.str_replace(
                '://',
                '://'.$this->user.'@',
                $this->getApiUrl(),
            ).' IpexB2B v'.self::$libVersion.$suffix,
        );
    }

    /**
     * Return URL of used API.
     *
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->url;
    }

    /**
     * CURL initialization.
     */
    public function curlInit(): void
    {
        $this->curl = \curl_init(); // create curl resource
        curl_setopt($this->curl, \CURLOPT_RETURNTRANSFER, true); // return content as a string from curl_exec
        curl_setopt($this->curl, \CURLOPT_FOLLOWLOCATION, true); // follow redirects (compatibility for future changes in IPEX)
        curl_setopt($this->curl, \CURLOPT_HTTPAUTH, true);       // HTTP authentication
        curl_setopt($this->curl, \CURLOPT_SSL_VERIFYPEER, false); // IPEX by default uses Self-Signed certificates
        curl_setopt($this->curl, \CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->curl, \CURLOPT_VERBOSE, $this->debug === true); // For debugging
    }

    /**
     * Initializes the object according to the given data. Possible values:
     *
     *  * 234                              - internal record number to be loaded
     *  * code:LOPATA                      - record code
     *  * BAGR                             - record code to load
     *  * ['id'=>24,'nazev'=>'hoblík']     - array of values to pre-fill
     *  * 743.json?relations=adresa,vazby  - part of the url with the parameters to be loaded
     *
     * @param mixed $init number/"(code:)code"/(part)URI of the record to be loaded | array of values to pre-fill
     */
    public function processInit($init): void
    {
        if (empty($init) === false) {
            $this->loadFromIPEX($init);
        }
    }

    /**
     * Set section for communication.
     *
     * @param string $section section pathName to use
     *
     * @return bool section switching status
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this->updateApiURL();
    }

    /**
     * Obtain current used section.
     *
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Prepare data for sending to FlexiBee.
     *
     * @param string $data
     *
     * @return string Data strored
     */
    public function setPostFields($data)
    {
        return $this->postFields = $data;
    }

    /**
     * Return basic URL for used Evidence.
     *
     * @return string Evidence URL
     */
    public function getSectionURL()
    {
        $sectionUrl = $this->url.'/'.$this->protoVersion.'/';
        $section = $this->getSection();

        if (!empty($section)) {
            $sectionUrl .= $section;
        }

        return $sectionUrl;
    }

    /**
     * Add suffix to Evidence URL.
     *
     * @param string $urlSuffix
     *
     * @return string
     */
    public function sectionUrlWithSuffix($urlSuffix)
    {
        $sectionUrl = $this->getSectionURL();

        if (!empty($urlSuffix) & !\is_int($urlSuffix)) {
            if ($urlSuffix[0] !== '?') {
                $sectionUrl .= '/';
            }

            $sectionUrl .= $urlSuffix;
        }

        return $sectionUrl;
    }

    /**
     * Add UrlParams to Requests URL.
     *
     * @param array $urlParams
     *
     * @return array all urlParams
     */
    public function setUrlParams($urlParams)
    {
        if (\is_array($this->urlParams)) {
            $this->urlParams = array_merge($this->urlParams, $urlParams);
        } else {
            $this->urlParams = $urlParams;
        }

        return $this->urlParams;
    }

    /**
     * Update $this->apiURL.
     */
    public function updateApiURL(): void
    {
        $this->apiURL = $this->getSectionURL();
    }

    /**
     * A function that performs an I/O operation and evaluates the result.
     *
     * @param string $urlSuffix URL part after the company identifier
     * @param string $method    HTTP/REST method
     * @param string $format    Requested format
     *
     * @return array|bool Operation result
     */
    public function requestData(
        $urlSuffix = '',
        $method = 'GET',
        $format = null
    ) {
        $this->rowCount = null;

        if (preg_match('/^http/', $urlSuffix)) {
            $url = $urlSuffix;
        } elseif (!\is_int($urlSuffix) && \strlen($urlSuffix) && ($urlSuffix[0] === '/')) {
            $url = $this->url.$urlSuffix;
        } else {
            $url = $this->sectionUrlWithSuffix($urlSuffix);
        }

        $responseCode = $this->doCurlRequest(Functions::addUrlParams(
            $url,
            $this->urlParams,
        ), $method, $format);

        return \strlen($this->lastCurlResponse) ? $this->parseResponse($this->rawResponseToArray(
            $this->lastCurlResponse,
        ), $responseCode) : null;
    }

    /**
     * Parse Raw IPEX response in several formats.
     *
     * @param string $responseRaw raw response body
     *
     * @return array
     */
    public function rawResponseToArray($responseRaw)
    {
        $responseDecoded = json_decode($responseRaw, true, 10);
        $decodeError = json_last_error_msg();

        if ($decodeError !== 'No error') {
            $this->addStatusMessage('JSON Decoder: '.$decodeError, 'error');
            $this->addStatusMessage($responseRaw, 'debug');
        }

        return $responseDecoded;
    }

    /**
     * Parse Response array.
     *
     * @param array $responseDecoded
     * @param int   $responseCode    Request Response Code
     *
     * @return array main data part of response
     */
    public function parseResponse($responseDecoded, $responseCode)
    {
        $response = null;

        switch ($responseCode) {
            case 201: // Success Write
                if (isset($responseDecoded[$this->resultField][0]['id'])) {
                    $this->lastInsertedID = $responseDecoded[$this->resultField][0]['id'];
                    $this->setMyKey($this->lastInsertedID);
                    $this->apiURL = $this->getSectionURL().'/'.$this->lastInsertedID;
                } else {
                    $this->lastInsertedID = null;
                }

                // no break
            case 200: // Success Read
                $response = $this->lastResult = $responseDecoded;

                break;
            case 500: // Internal Server Error
            case 404: // Page not found
                if ($this->ignoreNotFound === true) {
                    break;
                }

                // no break
            case 400: // Bad Request parameters
            default: // Something goes wrong
                $this->addStatusMessage(
                    $responseCode.': '.$this->curlInfo['url'],
                    'warning',
                );

                if (\is_array($responseDecoded)) {
                    $this->parseError($responseDecoded);
                }

                $this->logResult($responseDecoded, $this->curlInfo['url']);

                break;
        }

        return $response;
    }

    /**
     * Parse error message response.
     *
     * @return int number of errors processed
     */
    public function parseError(array $responseDecoded)
    {
        $message = $responseDecoded['statusCode'].': ';

        if (\array_key_exists('error', $responseDecoded)) {
            $message .= $responseDecoded['error'];
        }

        if (\array_key_exists('message', $responseDecoded)) {
            $message .= ' '.$responseDecoded['message'];
        }

        $this->addStatusMessage($message, 'error');

        return 1;
    }

    /**
     * Execute an HTTP request.
     *
     * @param string $url    Request URL
     * @param string $method HTTP Method GET|POST|PUT|OPTIONS|DELETE
     * @param string $format required communication format
     *
     * @return int HTTP Response CODE
     */
    public function doCurlRequest($url, $method, $format = null)
    {
        if (null === $format) {
            $format = $this->format;
        }

        curl_setopt($this->curl, \CURLOPT_URL, $url);
        // Setting up the operation itself
        curl_setopt($this->curl, \CURLOPT_CUSTOMREQUEST, strtoupper($method));
        // We always set even empty postdata as a protection against error 411
        curl_setopt($this->curl, \CURLOPT_POSTFIELDS, $this->postFields);

        $httpHeaders = $this->defaultHttpHeaders;

        if (isset($this->tokener)) {
            $httpHeaders['Authorization'] = $this->getTokenString();
        }

        $formats = ['json' => ['content-type' => 'application/json']];

        if (!isset($httpHeaders['Accept'])) {
            $httpHeaders['Accept'] = $formats[$format]['content-type'];
        }

        if (!isset($httpHeaders['Content-Type'])) {
            $httpHeaders['Content-Type'] = $formats[$format]['content-type'];
        }

        $httpHeadersFinal = [];

        foreach ($httpHeaders as $key => $value) {
            if (($key === 'User-Agent') && ($value === 'IPEXB2B')) {
                $value .= ' v'.self::$libVersion;
            }

            $httpHeadersFinal[] = $key.': '.$value;
        }

        curl_setopt($this->curl, \CURLOPT_HTTPHEADER, $httpHeadersFinal);

        // Perform the operation itself
        $this->lastCurlResponse = curl_exec($this->curl);
        $this->curlInfo = curl_getinfo($this->curl);
        $this->curlInfo['when'] = microtime();
        $this->curlInfo['request_headers'] = $httpHeadersFinal;
        $this->responseMimeType = $this->curlInfo['content_type'];
        $this->lastResponseCode = $this->curlInfo['http_code'];
        $this->lastCurlError = curl_error($this->curl);

        if (\strlen($this->lastCurlError)) {
            $this->addStatusMessage(sprintf(
                'Curl Error (HTTP %d): %s',
                $this->lastResponseCode,
                $this->lastCurlError,
            ), 'error');
        }

        return $this->lastResponseCode;
    }

    /**
     * Load Data Row from IPEX.
     *
     * @param string $key what we want to get
     *
     * @return int loaded columns count
     */
    public function loadFromIPEX($key)
    {
        return $this->takeData($this->requestData(\is_array($key) ? Functions::addUrlParams('', $key) : $key));
    }

    /**
     * Write Operation Result.
     *
     .
     * @param array  $resultData
     * @param string $url        URL
     *
     * @return bool Log save success
     */
    public function logResult($resultData = null, $url = null)
    {
        $logResult = false;

        if (null === $resultData) {
            $resultData = $this->lastResult;
        }

        if (isset($url)) {
            $this->addStatusMessage(urldecode($url));
        }

        if (\array_key_exists('message', $resultData)) {
            $this->addStatusMessage(
                $resultData['statusCode'].': '.$resultData['message'],
                'warning',
            );
        }

        return $logResult;
    }

    /**
     * IpexAPI dateTime to PHP DateTime.
     *
     * @param string $ipexdatetime ( 2017-09-21T18:02:44.120Z )
     *
     * @return DateTime|false
     */
    public static function ipexDateTimeToDateTime($ipexdatetime)
    {
        return DateTime::createFromFormat(
            '!Y-m-d H:i:s.u',
            str_replace('Z', '', str_replace('T', ' ', $ipexdatetime)),
        );
    }

    /**
     * Return Day in IpexAPI format.
     *
     * @param DateTime $dateTime
     *
     * @return string
     */
    public static function dateTimeToIpexDate($dateTime)
    {
        return $dateTime->format('Y-m-d');
    }

    /**
     * Current Token String.
     *
     * @return string
     */
    public function getTokenString()
    {
        return $this->tokener->getTokenString();
    }

    /**
     * Set or get ignore not found pages flag.
     *
     * @param bool $ignore set flag to
     *
     * @return bool get flag state
     */
    public function ignore404($ignore = null)
    {
        if (null !== $ignore) {
            $this->ignoreNotFound = $ignore;
        }

        return $this->ignoreNotFound;
    }

    /**
     * Disconnecting from IPEX.
     */
    public function disconnect(): void
    {
        if (\is_resource($this->curl)) {
            curl_close($this->curl);
        }

        $this->curl = null;
    }
}

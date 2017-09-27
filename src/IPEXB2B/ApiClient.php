<?php
/**
 * IPEXB2B - Client for Access to IPEX class.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  (C) 2017 Spoje.Net
 */

namespace IPEXB2B;

/**
 * Základní třída pro čtení z IPEX
 *
 * @url https://restapi.ipex.cz/documentation#/
 */
class ApiClient extends \Ease\Brick
{
    /**
     * Version of IPEXB2B library
     *
     * @var string
     */
    public static $libVersion = '0.1.3';

    /**
     * Verze protokolu použitého pro komunikaci.
     * Communication protocol version used.
     *
     * @var string Verze použitého API
     */
    public $protoVersion = 'v1';

    /**
     * URL of object data in IPEX
     * @var string url
     */
    public $apiURL = null;

    /**
     * Datový blok v poli odpovědi.
     * Data block in response field.
     *
     * @var string
     */
    public $resultField = 'results';

    /**
     * Evidence užitá objektem.
     * Evidence used by object
     *
     * @link https://demo.ipex.eu/c/demo/section-list Přehled evidencí
     * @var string
     */
    public $section = null;

    /**
     * Výchozí formát pro komunikaci.
     * Default communication format.
     *
     * @link https://www.ipex.eu/api/dokumentace/ref/format-types Přehled možných formátů
     *
     * @var string json|xml|...
     */
    public $format = 'json';

    /**
     * formát příchozí odpovědi
     * response format
     *
     * @link https://www.ipex.eu/api/dokumentace/ref/format-types Přehled možných formátů
     *
     * @var string json|xml|...
     */
    public $responseMimeType = 'json';

    /**
     * Curl Handle.
     *
     * @var resource
     */
    public $curl = null;

    /**
     * @link https://demo.ipex.eu/devdoc/company-identifier Identifikátor firmy
     * @var string
     */
    public $company = null;

    /**
     * Server[:port]
     * @var string
     */
    public $url = null;

    /**
     * REST API Username
     * @var string
     */
    public $user = null;

    /**
     * REST API Password
     * @var string
     */
    public $password = null;

    /**
     * @var array Pole HTTP hlaviček odesílaných s každým požadavkem
     */
    public $defaultHttpHeaders = ['User-Agent' => 'IPEXB2B'];

    /**
     * Default additional request url parameters after question mark
     *
     * @link https://www.ipex.eu/api/dokumentace/ref/urls   Common params
     * @link https://www.ipex.eu/api/dokumentace/ref/paging Paging params
     * @var array
     */
    public $defaultUrlParams = ['limit' => 0];

    /**
     * Identifikační řetězec.
     *
     * @var string
     */
    public $init = null;

    /**
     * Sloupeček s názvem.
     *
     * @var string
     */
    public $nameColumn = 'nazev';

    /**
     * Sloupeček obsahující datum vložení záznamu do shopu.
     *
     * @var string
     */
    public $myCreateColumn = 'false';

    /**
     * Slopecek obsahujici datum poslení modifikace záznamu do shopu.
     *
     * @var string
     */
    public $myLastModifiedColumn = 'lastUpdate';

    /**
     * Klíčový idendifikátor záznamu.
     *
     * @var string
     */
    public $fbKeyColumn = 'id';

    /**
     * Informace o posledním HTTP requestu.
     *
     * @var *
     */
    public $curlInfo;

    /**
     * Informace o poslední HTTP chybě.
     *
     * @var string
     */
    public $lastCurlError = null;

    /**
     * Used codes storage.
     *
     * @var array
     */
    public $codes = null;

    /**
     * Last Inserted ID.
     *
     * @var int
     */
    public $lastInsertedID = null;

    /**
     * Raw Content of last curl response
     *
     * @var string
     */
    public $lastCurlResponse;

    /**
     * HTTP Response code of last request
     *
     * @var int
     */
    public $lastResponseCode = null;

    /**
     * Body data  for next curl POST operation
     *
     * @var string
     */
    protected $postFields = null;

    /**
     * Last operation result data or message(s)
     *
     * @var array
     */
    public $lastResult = null;

    /**
     * Nuber from  @rowCount
     * @var int
     */
    public $rowCount = null;

    /**
     * @link https://www.ipex.eu/api/dokumentace/ref/zamykani-odemykani/
     * @var string filter query
     */
    public $filter;

    /**
     * @link https://demo.ipex.eu/devdoc/actions Provádění akcí
     * @var string
     */
    protected $action;

    /**
     * Pole akcí které podporuje ta která section
     * @link https://demo.ipex.eu/c/demo/faktura-vydana/actions.json Např. Akce faktury
     * @var array
     */
    public $actionsAvailable = null;

    /**
     * Parmetry pro URL
     * @link https://www.ipex.eu/api/dokumentace/ref/urls/ Všechny podporované parametry
     * @var array
     */
    public $urlParams = [
    ];

    /**
     * Save 404 results to log ?
     * @var boolean
     */
    protected $ignoreNotFound = false;

    /**
     * Array of errors caused by last request
     * @var array
     */
    private $errors    = [];
    protected $tokener = null;

    /**
     * Class for read only interaction with IPEX.
     *
     * @param mixed $init default record id or initial data
     * @param array $options Connection settings override
     */
    public function __construct($init = null, $options = [])
    {
        $this->init = $init;

        parent::__construct();
        $this->setUp($options);
        $this->curlInit();

        if (get_class($this) != 'IPEXB2B\Token') {
            $this->tokener = Token::instanced();
        }

        if (!empty($init)) {
            $this->processInit($init);
        }
    }

    /**
     * SetUp Object to be ready for connect
     *
     * @param array $options Object Options (company,url,user,password,section,
     *                                       defaultUrlParams,debug)
     */
    public function setUp($options = [])
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
     * Set up one of properties
     *
     * @param array  $options  array of given properties
     * @param string $name     name of property to process
     * @param string $constant load default property value from constant
     */
    public function setupProperty($options, $name, $constant = null)
    {
        if (isset($options[$name])) {
            $this->$name = $options[$name];
        } else {
            if (is_null($this->$name) && !empty($constant) && defined($constant)) {
                $this->$name = constant($constant);
            }
        }
    }

    /**
     * Inicializace CURL
     */
    public function curlInit()
    {
        $this->curl = \curl_init(); // create curl resource
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true); // return content as a string from curl_exec
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true); // follow redirects (compatibility for future changes in IPEX)
        curl_setopt($this->curl, CURLOPT_HTTPAUTH, true);       // HTTP authentication
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false); // IPEX by default uses Self-Signed certificates
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->curl, CURLOPT_VERBOSE, ($this->debug === true)); // For debugging
        curl_setopt($this->curl, CURLOPT_USERPWD,
            $this->user.':'.$this->password); // set username and password
    }

    /**
     * Zinicializuje objekt dle daných dat. Možné hodnoty:
     *
     *  * 234                              - interní číslo záznamu k načtení
     *  * code:LOPATA                      - kód záznamu
     *  * BAGR                             - kód záznamu ka načtení
     *  * ['id'=>24,'nazev'=>'hoblík']     - pole hodnot k předvyplnění
     *  * 743.json?relations=adresa,vazby  - část url s parametry k načtení
     *
     * @param mixed $init číslo/"(code:)kód"/(část)URI záznamu k načtení | pole hodnot k předvyplnění
     */
    public function processInit($init)
    {
        if (empty($init) == false) {
            $this->loadFromIPEX($init);
        }
    }

    /**
     * Nastaví Sekci pro Komunikaci.
     * Set section for communication
     *
     * @param string $section section pathName to use
     * @return boolean section switching status
     */
    public function setSection($section)
    {
        $this->section = $section;
        return $this->updateApiURL();
    }

    /**
     * Vrací právě používanou evidenci pro komunikaci
     * Obtain current used section
     *
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Převede rekurzivně Objekt na pole.
     *
     * @param object|array $object
     *
     * @return array
     */
    public static function object2array($object)
    {
        $result = null;
        if (is_object($object)) {
            $objectData = get_object_vars($object);
            if (is_array($objectData) && count($objectData)) {
                $result = array_map('self::object2array', $objectData);
            }
        } else {
            if (is_array($object)) {
                foreach ($object as $item => $value) {
                    $result[$item] = self::object2array($value);
                }
            } else {
                $result = $object;
            }
        }

        return $result;
    }

    /**
     * Převede rekurzivně v poli všechny objekty na jejich identifikátory.
     *
     * @param object|array $object
     *
     * @return array
     */
    public static function objectToID($object)
    {
        $resultID = null;
        if (is_object($object)) {
            $resultID = $object->__toString();
        } else {
            if (is_array($object)) {
                foreach ($object as $item => $value) {
                    $resultID[$item] = self::objectToID($value);
                }
            } else { //String
                $resultID = $object;
            }
        }

        return $resultID;
    }

    /**
     * Připraví data pro odeslání do FlexiBee
     *
     * @param string $data
     */
    public function setPostFields($data)
    {
        $this->postFields = $data;
    }

    /**
     * Return basic URL for used Evidence
     *
     * @return string Evidence URL
     */
    public function getSectionURL()
    {
        $sectionUrl = $this->url.'/'.$this->protoVersion.'/';
        $section    = $this->getSection();
        if (!empty($section)) {
            $sectionUrl .= $section;
        }
        return $sectionUrl;
    }

    /**
     * Add suffix to Evidence URL
     *
     * @param string $urlSuffix
     *
     * @return string
     */
    public function sectionUrlWithSuffix($urlSuffix)
    {
        $sectionUrl = $this->getSectionURL();
        if (!empty($urlSuffix)) {
            $sectionUrl .= '/';
            $sectionUrl .= $urlSuffix;
        }
        return $sectionUrl;
    }

    /**
     * Update $this->apiURL
     */
    public function updateApiURL()
    {
        $this->apiURL = $this->getSectionURL();
    }

    /**
     * Funkce, která provede I/O operaci a vyhodnotí výsledek.
     *
     * @param string $urlSuffix část URL za identifikátorem firmy.
     * @param string $method    HTTP/REST metoda
     * @param string $format    Requested format
     * 
     * @return array|boolean Výsledek operace
     */
    public function requestData($urlSuffix = null, $method = 'GET',
                                $format = null)
    {
        $this->rowCount = null;

        if (preg_match('/^http/', $urlSuffix)) {
            $url = $urlSuffix;
        } elseif ($urlSuffix[0] == '/') {
            $url = $this->url.$urlSuffix;
        } else {
            $url = $this->sectionUrlWithSuffix($urlSuffix);
        }

        $responseCode = $this->doCurlRequest($url, $method, $format);

        return strlen($this->lastCurlResponse) ? $this->parseResponse($this->rawResponseToArray($this->lastCurlResponse,
                    $this->responseMimeType), $responseCode) : null;
    }

    /**
     * Parse Raw IPEX response in several formats
     *
     * @param string $responseRaw raw response body
     * @param string $format      Raw Response format json|xml|etc
     *
     * @return array
     */
    public function rawResponseToArray($responseRaw)
    {
        $responseDecoded = json_decode($responseRaw, true, 10);
        $decodeError     = json_last_error_msg();
        if ($decodeError != 'No error') {
            $this->addStatusMessage('JSON Decoder: '.$decodeError, 'error');
            $this->addStatusMessage($responseRaw, 'debug');
        }
        return $responseDecoded;
    }

    /**
     * Parse Response array
     *
     * @param array $responseDecoded
     * @param int $responseCode Request Response Code
     *
     * @return array main data part of response
     */
    public function parseResponse($responseDecoded, $responseCode)
    {
        $response = null;
        switch ($responseCode) {
            case 201: //Success Write
                if (isset($responseDecoded[$this->resultField][0]['id'])) {
                    $this->lastInsertedID = $responseDecoded[$this->resultField][0]['id'];
                    $this->setMyKey($this->lastInsertedID);
                    $this->apiURL         = $this->getSectionURL().'/'.$this->lastInsertedID;
                } else {
                    $this->lastInsertedID = null;
                }
            case 200: //Success Read
                $response         = $this->lastResult = $responseDecoded;
                break;

            case 500: // Internal Server Error
            case 404: // Page not found
                if ($this->ignoreNotFound === true) {
                    break;
                }
            case 400: //Bad Request parameters
            default: //Something goes wrong
                $this->addStatusMessage($this->curlInfo['url'], 'warning');
                if (is_array($responseDecoded)) {
                    $this->parseError($responseDecoded);
                }
                $this->logResult($responseDecoded, $this->curlInfo['url']);
                break;
        }
        return $response;
    }

    /**
     * Parse error message response
     *
     * @param array $responseDecoded
     * @return int number of errors processed
     */
    public function parseError(array $responseDecoded)
    {
        if (array_key_exists('error', $responseDecoded)) {
            $this->errors = $responseDecoded['error'];
        }
        if (array_key_exists('message', $responseDecoded)) {
            $this->errors = [['message' => $responseDecoded['message']]];
        }

        return count($this->errors);
    }

    /**
     * Vykonej HTTP požadavek
     *
     * @link https://www.ipex.eu/api/dokumentace/ref/urls/ Sestavování URL
     * @param string $url    URL požadavku
     * @param string $method HTTP Method GET|POST|PUT|OPTIONS|DELETE
     * @param string $format požadovaný formát komunikace
     * @return int HTTP Response CODE
     */
    public function doCurlRequest($url, $method, $format = null)
    {
        if (is_null($format)) {
            $format = $this->format;
        }
        curl_setopt($this->curl, CURLOPT_URL, $url);
// Nastavení samotné operace
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, strtoupper($method));
//Vždy nastavíme byť i prázná postdata jako ochranu před chybou 411
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $this->postFields);

        $httpHeaders = $this->defaultHttpHeaders;
        if (!is_null($this->tokener)) {
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
            if (($key == 'User-Agent') && ($value == 'IPEXB2B')) {
                $value .= ' v'.self::$libVersion;
            }
            $httpHeadersFinal[] = $key.': '.$value;
        }

        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $httpHeadersFinal);

// Proveď samotnou operaci
        $this->lastCurlResponse            = curl_exec($this->curl);
        $this->curlInfo                    = curl_getinfo($this->curl);
        $this->curlInfo['when']            = microtime();
        $this->curlInfo['request_headers'] = $httpHeadersFinal;
        $this->responseMimeType            = $this->curlInfo['content_type'];
        $this->lastResponseCode            = $this->curlInfo['http_code'];
        $this->lastCurlError               = curl_error($this->curl);
        if (strlen($this->lastCurlError)) {
            $this->addStatusMessage(sprintf('Curl Error (HTTP %d): %s',
                    $this->lastResponseCode, $this->lastCurlError), 'error');
        }

        if ($this->debug === true) {
            $this->saveDebugFiles();
        }

        return $this->lastResponseCode;
    }

    /**
     * Convert XML to array.
     *
     * @param string $xml
     *
     * @return array
     */
    public static function xml2array($xml)
    {
        $arr = [];

        if (is_string($xml)) {
            $xml = simplexml_load_string($xml);
        }

        foreach ($xml->children() as $r) {
            if (count($r->children()) == 0) {
                $arr[$r->getName()] = strval($r);
            } else {
                $arr[$r->getName()][] = self::xml2array($r);
            }
        }

        return $arr;
    }

    public function loadFromIPEX($key)
    {
        return $this->takeData($this->requestData($key));
    }

    /**
     * Write Operation Result.
     *
     * @param array  $resultData
     * @param string $url        URL
     * @return boolean Log save success
     */
    public function logResult($resultData = null, $url = null)
    {
        $logResult = false;
        if (is_null($resultData)) {
            $resultData = $this->lastResult;
        }
        if (isset($url)) {
            $this->logger->addStatusMessage(urldecode($url));
        }
        if (array_key_exists('message', $resultData)) {
            $this->logger->addStatusMessage($resultData['statusCode'].': '.$resultData['message'],
                'warning');
        }

        return $logResult;
    }

    /**
     * IpexAPI dateTime to PHP DateTime
     *
     * @param string $ipexdatetime ( 2017-09-21T18:02:44.120Z )
     *
     * @return \DateTime | false
     */
    public static function ipexDateTimeToDateTime($ipexdatetime)
    {
        return \DateTime::createFromFormat('Y-m-d H:i:s.u',
                str_replace('Z', '', str_replace('T', ' ', $ipexdatetime)));
        \DateTime::getLastErrors();
    }

    /**
     * Current Token String
     *
     * @return string
     */
    public function getTokenString()
    {
        return $this->tokener->getTokenString();
    }

    /**
     * Set or get ignore not found pages flag
     *
     * @param boolean $ignore set flag to
     *
     * @return boolean get flag state
     */
    public function ignore404($ignore = null)
    {
        if (!is_null($ignore)) {
            $this->ignoreNotFound = $ignore;
        }
        return $this->ignoreNotFound;
    }

    /**
     * Odpojení od IPEX.
     */
    public function disconnect()
    {
        if (is_resource($this->curl)) {
            curl_close($this->curl);
        }
        $this->curl = null;
    }

    /**
     * Reconnect After unserialization
     */
    public function __wakeup()
    {
        parent::__wakeup();
        $this->curlInit();
    }

    /**
     * Disconnect CURL befere pass away
     */
    public function __destruct()
    {
        $this->disconnect();
    }
}

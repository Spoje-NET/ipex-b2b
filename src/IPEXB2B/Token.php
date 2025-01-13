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

/**
 * Základní třída pro čtení z IPEX.
 *
 * @url https://restapi.ipex.cz/documentation#/
 */
class Token extends ApiClient
{
    /**
     * Sekce užitá objektem.
     * Section used by object.
     */
    public string $section = 'token';

    /**
     * Saves object instance (singleton...).
     */
    private static self $_instance;

    /**
     * Token.
     *
     * @param mixed $init
     * @param array<string,string> $options
     */
    public function __construct($init = '', $options = [])
    {
        parent::__construct($init, $options);
        $this->refreshToken();
    }

    /**
     * Refresh Access Token.
     *
     * @return bool refresh
     */
    public function refreshToken()
    {
        return $this->setData($this->getToken()) === 2;
    }

    /**
     * Always fresh Access token string.
     *
     * @return string
     */
    public function getTokenString()
    {
        if ($this->isExpired()) {
            $this->refreshToken();
        }

        return $this->getDataValue('accessToken');
    }

    /**
     * Check Access Token expiration state.
     *
     * @return bool
     */
    public function isExpired()
    {
        $expire = $this->ipexDateTimeToDateTime($this->getDataValue('expire'));

        if (\is_object($expire)) {
            $tdiff = $expire->getTimestamp() - time();
        } else {
            $tdiff = 0;
        }

        return $tdiff < 5;
    }

    public function getToken(): array|bool
    {
        if (empty($this->user)) {
            throw new \Ease\Exception(_('Username not set!'));
        }

        if (empty($this->password)) {
            throw new \Ease\Exception(_('Password not set!'));
        }

        $this->setPostFields(json_encode(['username' => $this->user, 'password' => $this->password]));

        return $this->requestData('', 'POST');
    }

    /**
     * Pri vytvareni objektu pomoci funkce singleton (ma stejne parametry, jako konstruktor)
     * se bude v ramci behu programu pouzivat pouze jedna jeho Instance (ta prvni).
     *
     * @see   http://docs.php.net/en/language.oop5.patterns.html Dokumentace a priklad
     *
     * @return self
     */
    public static function singleton()
    {
        if (!isset(self::$_instance)) {
            $class = __CLASS__;
            self::$_instance = new $class();
        }

        return self::$_instance;
    }

    /**
     * Vrací se.
     *
     * @return Shared
     */
    public static function &instanced()
    {
        $tokener = self::singleton();

        return $tokener;
    }
}

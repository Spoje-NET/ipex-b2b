<?php

/**
 * IPEXB2B - Client for Access to IPEX Rights class.
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
class Token extends ApiClient
{
    /**
     * Saves obejct instace (singleton...).
     *
     * @var Shared
     */
    private static $_instance = null;

    /**
     * Sekce užitá objektem.
     * Section used by object
     *
     * @var string
     */
    public $section = 'token';

    /**
     * Token
     *
     * @param mixed $init
     * @param array $options
     */
    public function __construct($init = null, $options = array())
    {
        parent::__construct($init, $options);
        $this->refreshToken();
    }

    /**
     * Refresh Access Token
     *
     * @return boolean refresh
     */
    public function refreshToken()
    {
        return $this->setData($this->getToken()) == 2;
    }

    /**
     * Always fresh Access token string
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
     * Check Access Token expiration state
     *
     * @return boolean
     */
    public function isExpired()
    {
        $expire = $this->ipexDateTimeToDateTime($this->getDataValue('expire'));
        if (is_object($expire)) {
            $tdiff  = $expire->getTimestamp() - time();
        } else {
            $tdiff = 0;
        }
        return $tdiff < 5;
    }

    public function getToken()
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
     * @param string $class název třídy jenž má být zinstancována
     *
     * @link   http://docs.php.net/en/language.oop5.patterns.html Dokumentace a priklad
     *
     * @return self
     */
    public static function singleton()
    {
        if (!isset(self::$_instance)) {
            $class           = __CLASS__;
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

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
 * Class for obtaining and managing API access tokens.
 *
 * @url https://restapi.ipex.cz/documentation#/
 */
class Token extends ApiClient
{
    /**
     * The API section used by this object.
     */
    public string $section = 'token';

    /**
     * Saves the object instance for the singleton pattern.
     */
    private static ?self $_instance = null;

    /**
     * Token constructor.
     *
     * @param mixed $init
     * @param array<string,string> $options
     */
    public function __construct($init = '', array $options = [])
    {
        parent::__construct($init, $options);
        $this->refreshToken();
    }

    /**
     * Refresh the access token.
     *
     * @return bool Returns true on success.
     */
    public function refreshToken(): bool
    {
        $tokenData = $this->getToken();
        if ($tokenData) {
            return $this->setData($tokenData);
        }
        return false;
    }

    /**
     * Provides a always valid access token string.
     *
     * @return string|null
     */
    public function getTokenString(): ?string
    {
        if ($this->isExpired()) {
            $this->refreshToken();
        }

        return $this->getDataValue('accessToken');
    }

    /**
     * Check the access token's expiration state.
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        $expireValue = $this->getDataValue('expiresAt');
        if (empty($expireValue)) {
            return true;
        }

        $expire = $this->ipexDateTimeToDateTime($expireValue);

        if ($expire instanceof \DateTime) {
            $tdiff = $expire->getTimestamp() - time();
        } else {
            $tdiff = 0;
        }

        return $tdiff < 5;
    }

    /**
     * Obtain a new token from the API.
     *
     * @return array|bool
     * @throws \Ease\Exception
     */
    public function getToken(): array|bool
    {
        if (empty($this->user)) {
            throw new \Ease\Exception('Username not set!');
        }

        if (empty($this->password)) {
            throw new \Ease\Exception('Password not set!');
        }

        $this->setPostFields(json_encode(['username' => $this->user, 'password' => $this->password]));

        return $this->requestData('', 'POST');
    }

    /**
     * Implements the singleton pattern. When creating an object using this function,
     * only one instance of it (the first one) will be used throughout the program's execution.
     *
     * @see http://docs.php.net/en/language.oop5.patterns.html
     *
     * @return self
     */
    public static function singleton(): self
    {
        if (!isset(self::$_instance)) {
            $class = __CLASS__;
            self::$_instance = new $class();
        }

        return self::$_instance;
    }

    /**
     * Returns the singleton instance of the Token class.
     *
     * @return self
     */
    public static function &instanced(): self
    {
        if (!isset(self::$_instance)) {
            self::$_instance = self::singleton();
        }
        return self::$_instance;
    }
}

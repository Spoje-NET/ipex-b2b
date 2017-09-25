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
class Customers extends ApiClient
{
    /**
     * Sekce užitá objektem.
     * Section used by object
     *
     * @var string
     */
    public $section = 'customers';

}

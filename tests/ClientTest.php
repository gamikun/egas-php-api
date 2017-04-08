<?php

namespace edesarrollos\egas\Tests;

use \edesarrollos\egas;

class ClientTest extends \PHPUnit_Framework_TestCase {

    private $config;

    public function setUp() {
        $this->config = require(__DIR__ . '/config.php');
    }

    public function testLoadVariables() {
        $client = new egas\Client();
        $client->baseURL = $this->config['baseURL'];
        $variables = $client->loadVariables();
        $this->assertNotEmpty($variables);
    }

    public function testLoadPrices() {
    	$client = new egas\Client;
    	$client->baseURL = $this->config['baseURL'];
    	$prices = $client->loadPricing();
    	$this->assertGreaterThan(0, $prices->perKilogram);
    	$this->assertGreaterThan(0, $prices->perLitter);
    }
}
<?php

namespace egas\client;

class Client {

    private static $sharedInstance = null;

    public $baseURL = "http://dummy.epedido.com/v1";

    public function loadVariables() {
        $url = "{$this->baseURL}/variable";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'cache-control: no-cache'
        ]);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl,CURLOPT_ENCODING, "");
        curl_setopt($curl,CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl,CURLOPT_TIMEOUT, 5);
        curl_setopt($curl,CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        $content = curl_exec($curl);
        curl_close($curl);

        if (is_string($content)) {
            $variables = [];
            $list = json_decode($content);

            foreach($list as $item) {
                $variables[$item->codigo] = $item->valor;
            }

            return $variables;
        }

        return null;
    }

    public function loadPricing() {
        $variables = $this->loadVariables();
        $prices = Pricing::fromVariablesList($variables);
        return $prices;
    }

    public static function getInstance() {
        if (self::$sharedInstance === null) {
            self::$sharedInstance = new Client;
        }
    }
}
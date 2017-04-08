<?php

namespace edesarrollos\egas;

class Client {

    private static $sharedInstance = null;

    public $baseURL = "http://app.hermogas.com/v1";

    public function loadVariables() {
        $url = "{$this->baseURL}/variable";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
        ]);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $content = curl_exec($curl);

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
<?php

namespace esms\http;

use GuzzleHttp\Client;

class Http {

  private $_asArray = false;
  private $_client = null;
  private $_formParams = [];
  private $_headers = [];
  private $_method = "GET";
  private $_query = [];
  private $_timeout = 10;
  private $_uri = null;
  private $_url;

  /**
   * @return Http
   */
  public function getRequest() {
    if($this->_client === null) {
      $this->_client = new Client([
        "base_uri" => $this->_url,
        "timeout"  => $this->_timeout,
      ]);
    }
    return $this->_client;
  }

  /**
   * @param $url
   * @return Http
   */
  public function setUrl($url) {
    $this->_url = $url;
    return $this;
  }

  /**
   * @return Http
   */
  public function get() {
    return $this->setMethod("GET");
  }

  /**
   * @return Http
   */
  public function post() {
    return $this->setMethod("POST");
  }

  /**
   * @param string $type
   * @return Http
   */
  public function setMethod($type = "") {
    $this->_method = $type;
    return $this;
  }

  /**
   * @param string $uri
   * @return Http
   */
  public function setUri($uri) {
    $this->_uri = $uri;
    return $this;
  }

  /**
   * @param string $name
   * @param string $value
   * @return Http
   */
  public function addParam($name = "", $value = "") {
    $this->_formParams[$name] = $value;
    return $this;
  }

  /**
   * @param array $params
   * @return Http
   */
  public function addParams($params = []) {
    if(!empty($params)) {
      foreach($params as $n => $v) {
        $this->addParam($n, $v);
      }
    }
    return $this;
  }

  /**
   * @param string $name
   * @param string $value
   * @return Http
   */
  public function addQuery($name = "", $value = "") {
    $this->_query[$name] = $value;
    return $this;
  }

  /**
   * @param array $params
   * @return Http
   */
  public function addQuerys($params = []) {
    if(!empty($params)) {
      foreach($params as $n => $v) {
        $this->addQuery($n, $v);
      }
    }
    return $this;
  }

  /**
   * @param string $name
   * @param string $value
   * @return Http
   */
  public function addHeader($name = "", $value = "") {
    $this->_headers[$name] = $value;
    return $this;
  }

  /**
   * @param array $params
   * @return Http
   */
  public function addHeaders($params = []) {
    if(!empty($params)) {
      foreach($params as $n => $v) {
        $this->addHeader($n, $v);
      }
    }
    return $this;
  }

  /**
   * @param bool $asArray
   * @return Http
   */
  public function asArray($asArray = true) {
    $this->_asArray = $asArray;
    return $this;
  }

  /**
   * @return array|\Psr\Http\Message\ResponseInterface
   */
  public function send() {
    $options = [
      "headers" => $this->_headers,
      "query" => $this->_query,
      "form_params" => $this->_formParams,
    ];
    $resp = $this->getRequest()->request($this->_method, $this->_uri, $options);
    if($this->_asArray) {
      return json_decode($resp->getBody());
    }
    return $resp;
  }
}
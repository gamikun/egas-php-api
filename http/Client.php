<?php

namespace esms\http;

class Client extends Http {

  const API_URL = "http://esms.edesarrollos.info";

  private $esms_uri_crear = "v1/mensajes/crear-mensaje";
  private $esms_uri_obtener = "v1/mensajes/obtener";

  private $_apiKey = null;
  private $_apiSecret = null;

  private $client = null;

  /**
   * eSms constructor.
   * @param string $apiKey Apikey
   * @param string $apiSecret
   */
  public function __construct($apiKey, $apiSecret) {
    $this->_apiKey = $apiKey;
    $this->_apiSecret = $apiSecret;
  }

  /**
   * @return Client
   */
  public function getApi() {
    if($this->client === null) {
      $this->client = $this->setUrl(self::API_URL)
          ->addHeader("api-key", $this->_apiKey)
          ->addHeader("api-secret", $this->_apiSecret)
          ->addHeader("accept", "application/json");
    }
    return $this->client;
  }

  /**
   * Enviar un mensaje
   * @param string $numero El número destino
   * @param string $mensaje Texto del mensaje
   * @return array
   */
  public function enviarMensaje($numero, $mensaje) {
    return $this->getApi()
      ->setUri($this->esms_uri_crear)
      ->post()
      ->addParam("numeroDestino", $numero)
      ->addParam("mensaje", $mensaje)
      ->asArray(true)
      ->send();
  }

  public function obtener() {
    return $this->getApi()
      ->setUri($this->esms_uri_obtener)
      ->post()
      ->asArray()
      ->send();
  }
}
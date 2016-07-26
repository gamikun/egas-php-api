<?php

namespace esms\Tests;

use esms\http\Client;

class ClientTest extends \PHPUnit_Framework_TestCase {

    const TOKEN = "c-vfp3hudNNrF0ecPYTp8QgCYElSm9qU0QlGJHklWruV4TBcB1FmVnRMiUpZN4CF";
    const SECRET = "XnQs-fZUu_X-aVAFR8UVYWNW0VQNcFeh_YKXD0ZMsrWXdax-S-1Ur8pN0prVBkPr";
    const TARGET = "6621207135";

    public function testSendMessage() {
        $client = new Client(self::TOKEN, self::SECRET);
        $response = $client->enviarMensaje(self::TARGET, 'El fin del mundose acerca!');
        $this->objectHasAttribute('success', $response);
        $this->assertTrue($response->success);
        $this->objectHasAttribute('mensaje', $response);
        $this->objectHasAttribute('id', $response->mensaje);
        $this->assertGreaterThan(0, $response->mensaje->id);
    }

    public function testObtain() {
        $client = new Client(self::TOKEN, self::SECRET);
        $response = $client->obtener();
        $this->assertObjectHasAttribute('success', $response);
        $this->assertTrue($response->success);
        $this->assertObjectHasAttribute('mensajes', $response);
        $this->assertTrue(is_array($response->mensajes));
    }

}
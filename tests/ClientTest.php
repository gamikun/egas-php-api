<?php

namespace esms\Tests;

use esms\http\Client;

class ClientTest extends \PHPUnit_Framework_TestCase {

    const TOKEN = "KTzGLtJa_94rzI2dahQ96qIGaiRBODEV-rNPIbHNgi6tQUY_jC-05PP6SpqDLN8W";
    const SECRET = "Rv-iE9mBt31CQimHs1K53W9kYohSaSbICmOa7T7Qj8B2Hmq3lPLmz8SVhEdinwA6";
    const TARGET = "6621207135";

    public function testSendMessage() {
        $client = new Client(self::TOKEN, self::SECRET);
        $client->enviarMensaje(self::TARGET, 'Hola Mundo!');
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
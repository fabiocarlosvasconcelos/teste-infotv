<?php

namespace App\Auth;

abstract class AbstractJwt {

    protected $header;
    
    protected $payload;

    protected $password;

    public function __construct()
    {
        $this->init();
    }

    private function init ():void {

        $this->header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];

        $this->payload = [
            "exp" => time()+3600, //data de expiração
            "iat" => time() // data de criação
        ];

        $this->password = 'your-256-bit-secret';

    }

    public function setPassword(string $password):void {
        $this->passwod = $password;
    }

    protected function base64urlEncode($data):string {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

} 
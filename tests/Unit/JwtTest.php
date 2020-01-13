<?php

namespace Tests\Unit;

use App\Auth\Jwt;
use PHPUnit\Framework\TestCase;

class JwtTest extends TestCase
{
    

    /**
     * Teste do método para gerar token JWT
     *
     * @return void
     */
    public function testGetToken()
    {

        $jwt = new Jwt();
        
        $token = $jwt->getToken();

        $parts = explode(".", $token);

        $headerBase64 = $parts[0];
        $payloadBase64 = $parts[1];
        $signatureBase64 = $parts[2];
  
        $hashHmac = hash_hmac('sha256',$headerBase64.'.'.$payloadBase64, env('JWT_PASSWORD'), true);
        
        $signatureTest = rtrim(strtr(base64_encode($hashHmac), '+/', '-_'), '=');

        $json = base64_decode($payloadBase64);

        $payload = json_decode($json);

        //pega o tempo de expiração
        $exp = intval($payload->exp);

        if($exp >= time()){
            $t = true;
        }

        $this->assertEquals($signatureTest, $signatureBase64, 'A assinatura do token não confere');

        $this->assertTrue($t, "A data de expiração deve ser maior que a data atual");

    }
    
    /**
     * Teste do método check faltando uma parte do token
     *
     * @return void
     */
    public function testCheckTokenWithoutOnePart()
    {

        $jwt = new Jwt();

        $valid = $jwt->check("FeyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1Nzg5NTg2MTMsImlhdCI6MTU3ODk1NTAxM30");

        $this->assertFalse($valid, "Token imcompleto não pode ser válido");

    }

    /**
     * Teste do método check passando um token válido mas expirado
     *
     * @return void
     */
    public function testCheckTokenValidButExpired()
    {

        $jwt = new Jwt();

        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE1Nzg5NTkyNTksImlhdCI6MTU3ODk1NTY1OX0.KciYX5QwlEhfOwhiERdrKGbAR_s2FXAoxXeR6lCWkz8";

        $valid = $jwt->check($token);

        $this->assertFalse($valid, "Token exirado não pode ser válido");

    }

    /**
     * Teste do método check passando um token recém criado
     *
     * @return void
     */
    public function testCheckTokenValid()
    {

        $jwt = new Jwt();

        $token = $jwt->getToken();

        $valid = $jwt->check($token);

        $this->assertTrue($valid, "Um token recém criado deve ser válido");

    }

}
<?php

namespace App\Auth;


class Jwt extends AbstractJwt
{

    public function __construct()
    {
        $this->init();
    }

    /**
     * Inicializa os atributos configurações padrão e 
     * configuradas no env
     * @return void
     */
    private function init(): void
    {

        $this->password = env('JWT_PASSWORD'); //senha
        $this->expiresAt = env('JWT_EXPIRES_AT', 3600); //default 3600 segundos

        $this->payload = [
            "exp" => time() + $this->expiresAt, //data de expiração
            "iat" => time() // data de criação
        ];
    }

    /**
     * Codifica o atributo header para json e posteriormente para base64
     * 
     * @return string
     */
    private function encodeHeader(): string
    {

        $headerJson = json_encode($this->header);
        $headerBase64 = $this->base64urlEncode($headerJson);

        return $headerBase64;
    }

    /**
     * Codifica o atributo payload para json e posteriormente para base64
     *
     *  @return string
     */
    private function encodePayload(): string
    {

        $headerJson = json_encode($this->payload);
        $headerBase64 = $this->base64urlEncode($headerJson);
        return $headerBase64;
    }

    /**
     * Cria a assinatura para o header e o payload e aplica base64
     * 
     * @return string 
     */
    private function sign(): string
    {

        $signature =  $this->authenticate($this->joinString($this->encodeHeader(), $this->encodePayload()));
        return $signature;

    }

    /**
     * Cria token o JWT. Retorna um token no formato header.payload.signature
     * 
     * @return string
     */
    private function createToken(): string
    {

        $first = $this->joinString($this->encodeHeader(), $this->encodePayload());

        return $this->joinString($first, $this->sign());
    }

    /**
     * Retorna um token JWT no formato header.payload.signature
     * 
     * @return string
     */
    public function getToken(): string
    {

        return $this->createToken();
    }

    /**
     * Vefirica a autenticidade do token
     * 
     * @param string token JWT
     * @return bool
     */
    public function check(string $token): bool
    {

        //insere as partes do token em uma array 
        $parts = explode(".", $token);

        if(count($parts) == 3) {

            $headerBase64 = $parts[0];
            $payloadBase64 = $parts[1];
            $signatureBase64 = $parts[2];

            //varifica a autenticidade do header e payload
            $valid = $this->authenticate($this->joinString($headerBase64, $payloadBase64));

            if ($signatureBase64 == $valid) {//se for autentico

                $json = base64_decode($payloadBase64);

                $payload = json_decode($json);

                //pega o tempo de expiração
                $exp = $payload->exp ?? 0;

                //verifica se ainda é válido
                if($exp >= time()) {
                    return true;
                }
                
                return false;
            }

        }

        return false;
    }
}

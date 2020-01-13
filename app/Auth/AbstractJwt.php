<?php

namespace App\Auth;

abstract class AbstractJwt
{

    /**
     * Header do token com a configuração padrão
     * 
     * @var array
     */
    protected $header = [
        'typ' => 'JWT',
        'alg' => 'HS256'
    ];

    /**
     * payload do token
     * 
     * @var array
     */
    protected $payload;

    /**
     * Senha para criptografar o token
     * 
     * @var string
     */
    protected $password;

    /**
     * Tempo em segundos para expirar o token
     * 
     * @var int
     */
    protected $expiresAt;


    /**
     * Altera o valor do atributo password
     * 
     * @param string $password senha
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->passwod = $password;
    }

    /**
     * Altera o valor valor do atributo payload
     * 
     * @param array $payload payload
     * @return void
     */
    public function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }

    /**
     * Codificar em base 64 sem pending
     * @param string data string a ser codificada
     * @return string retorna um string em base64 sem pending
     */
    protected function base64urlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Aplica a autenticação sobre uma string
     * 
     * @param string $data string a ser autenticada
     * @return string retirn uma autenticada em base64
     */
    protected function authenticate(string $data): string
    {

        $hashHmac = hash_hmac('sha256', $data, $this->password, true);
        return $this->base64urlEncode($hashHmac);

    }

    /**
     * Une duas strings por ponto (.)
     * 
     * @param string $a
     * @param string $b
     */
    protected function joinString (string $a, string $b):string {
        return $a.'.'.$b;
    }
}

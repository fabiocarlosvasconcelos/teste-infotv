<?php

namespace App\Auth;

class Jwt extends AbstractJwt {
 
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * get toekn
     */
    private function encodeHeader():string {

       $headerJson = json_encode($this->header);
       $headerBase64 = $this->base64urlEncode($headerJson);

       return $headerBase64;
    }

     /**
     * get toekn
     */
    private function encodePayload():string {

        $headerJson = json_encode($this->payload);
        $headerBase64 = $this->base64urlEncode($headerJson);
        return $headerBase64;

    }

    private function sign():string {

        $signature = hash_hmac('sha256', $this->encodeHeader().".".$this->encodePayload(), $this->password, true);
        $signature = $this->base64urlEncode($signature);

        return $signature;

    }

    private function createToken():string {
        return $this->encodeHeader().'.'.$this->encodePayload().'.'.$this->sign();
    }

    public function getToken():string {

        return $this->createToken();

    }

    public function isValid(string $token):bool {

        $parts = explode(".", $token);

        $header = $parts[0];
        $payload = $parts[1];
        $signature = $parts[2];

        $valid = hash_hmac( 'sha256', $header.'.'.$payload, $this->password, true);

        $valid =  $this->base64urlEncode($valid);
       
        if($signature == $valid) {
            return true;
        } 
        
        return false;

    }
    
}

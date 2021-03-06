<?php


namespace App\Http\Controllers;
use Firebase\JWT\JWT;


class TestAPI
{
    const API_KEY = "Ee3BE4VH9azp7iiLDsAoyT4s3LUqUcbL";
    const API_SECRET = "UwnthJEpyvPDYakbjtz99rKUJkanD67v";
    const TOKEN_EXPIRE = 60; //token expire time in seconds
    const ENCODE_ALG = 'HS256';

    private static $_jwt = null;

    public static function refreshToken(){

        $tokenId    = base64_encode(random_bytes(32));
        $issuedAt   = time();
        $notBefore  = $issuedAt;
        $expire     = $notBefore + self::TOKEN_EXPIRE;

        /*
         * Payload data of the token
         */
        $data = [
            'iat'  => $issuedAt,         // Issued at: time when the token was generated
            'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
            'iss'  => self::API_KEY,     // Issuer
            'nbf'  => $notBefore,        // Not before
            'exp'  => $expire,           // Expire
        ];

        /*
         * Encode the array to a JWT string.
         * Second parameter is the key to encode the token.
         *
         * The output string can be validated at http://jwt.io/
         */
        self::$_jwt = JWT::encode(
            $data,      //Data to be encoded in the JWT
            self::API_SECRET, // The signing key
            'HS256'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        );

        return self::$_jwt;
    }

    /**
     * Get JWT
     */
    public static function getToken(){
        if(!self::$_jwt)
            self::refreshToken();

        try {
            JWT::decode(self::$_jwt, self::API_SECRET, array('HS256'));
        }catch(Exception $e){
            self::refreshToken();
        }

        return self::$_jwt;
    }
}

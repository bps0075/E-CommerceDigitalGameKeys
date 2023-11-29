<?php

function base64url_encode($str) {
    return rtrim(strtr(base64_encode($str), '+/,', '-_'), '=');
}

function generate_jwt($headers, $payload, $secret) {
    $headers_encoded = base64url_encode(json_encode($payload));

    $payload_encoded = base64url_encode(json_encode($payload));

    $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
    $signature_encoded = base64url_encode($signature);

    $jwt = "$headers_encoded.$payload_encoded.$signature_encoded";

    return $jwt;
}

function validate_jwt($jwt, $secret) {
    // split jwt
    $tokenParts = explode('.', $jwt);
    $header = base64_decode($tokenParts[0]);
    $payload = base64_decode($tokenParts[1]);
    $signature_provided = $tokenParts[2];

    // expiration checking
    $expiration = json_decode($payload)->exp;
    $token_expired = ($expiration - time()) < 0;

    // signature using header, payload, and secret key
    $base64_url_header = base64url_encode($header);
    $base64_url_payload = base64url_encode($payload);
    $signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
    $base64_url_signature = base64url_encode($signature);

    // does the signature match
    $signature_valid = ($base64_url_signature === $signature_provided);

    if ($token_expired || !$signature_valid) {
        return false;
    } else {
        return true;
    }
}




?>
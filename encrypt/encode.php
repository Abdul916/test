<?php
function secure_encrypt($code, $key) {
    $iv = random_bytes(16); // Random IV
    $cipher = "aes-256-cbc";
    $encrypted = openssl_encrypt($code, $cipher, $key, 0, $iv);
    return base64_encode($iv . $encrypted);
}

function secure_decrypt($encrypted_code, $key) {
    $cipher = "aes-256-cbc";
    $decoded = base64_decode($encrypted_code);
    $iv = substr($decoded, 0, 16); // Extract IV
    $encrypted = substr($decoded, 16); // Extract Encrypted Code
    return openssl_decrypt($encrypted, $cipher, $key, 0, $iv);
}

// Secure key (use environment variable in production for better security)
$key = "xl_developers";

// Original code
$original_code = 'echo "This is secure PHP code.";';

// Encrypt the code
$encrypted_code = secure_encrypt($original_code, $key);

// Write encrypted code to a file, including the decryption function
$encoded_file_content = "<?php
function secure_decrypt(\$encrypted_code, \$key) {
    \$cipher = 'aes-256-cbc';
    \$decoded = base64_decode(\$encrypted_code);
    \$iv = substr(\$decoded, 0, 16);
    \$encrypted = substr(\$decoded, 16);
    return openssl_decrypt(\$encrypted, \$cipher, \$key, 0, \$iv);
}
eval(secure_decrypt('$encrypted_code', '$key'));
?>";

file_put_contents('secure_encoded.php', $encoded_file_content);

echo "Encrypted code has been written to 'secure_encoded.php'.";
?>

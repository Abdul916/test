<?php
function obfuscate1212($file) {
    $code = file_get_contents($file);
    $php_code = substr($code, strpos($code, '<?php') + 5);
    $php_code = rtrim($php_code, '?>');
    $encoded_php = base64_encode($php_code);
    return "<?php eval(base64_decode('$encoded_php')); ?>";
}
$source = 'add.php';
file_put_contents('example_obfuscated.php', obfuscate1212($source));


function obfuscate($file) {
    $code = file_get_contents($file);
    if (strpos($code, '<?php') !== false) {
        $php_code = substr($code, strpos($code, '<?php') + 5);
        $php_code = rtrim($php_code, '?>');
        $encoded_php = base64_encode($php_code);
        $mask = "MASK123";
        $masked_php = $mask . $encoded_php . strrev($mask);
        return "<?php
        \$mask = 'MASK123';
        \$code = substr('$masked_php', strlen(\$mask), -strlen(\$mask));
        eval(base64_decode(\$code));
        ?>";
    }
    return $code;
}
// $source = 'add.php';
// file_put_contents('example_obfuscated.php', obfuscate($source));


function encrypt_code($file, $key) {
    $code = file_get_contents($file);
    $code = str_replace(["<?php", "?>"], "", $code);
    $iv = random_bytes(16);
    $cipher = "aes-256-cbc";
    $encrypted_code = openssl_encrypt($code, $cipher, $key, 0, $iv);
    return "<?php
    \$iv = base64_decode('" . base64_encode($iv) . "');
    \$encrypted_code = base64_decode('" . base64_encode($encrypted_code) . "');
    \$cipher = 'aes-256-cbc';
    \$key = '" . $key . "';
    eval(openssl_decrypt(\$encrypted_code, \$cipher, \$key, 0, \$iv));
    ?>";
}
// $key = "xl_developers";
// $source = 'add.php';
// $encrypted_code = encrypt_code($source, $key);
// file_put_contents('example_encrypted.php', $encrypted_code);
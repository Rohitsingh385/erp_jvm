<?php

	$key = base64_decode('JoYPd+qso9s7T+Ebj8pi4Wl8i+AHLv+5UNJxA3JkDgY=');
        $iv = base64_decode('hlnuyA9b4YxDq6oJSZFl8g');

	$result = $_POST['response'];
        $ciphertext_raw = hex2bin($result);
        $original_plaintext = openssl_decrypt($ciphertext_raw,  "AES-256-CBC", $key, $options=OPENSSL_RAW_DATA, $iv);
        $json = json_decode($original_plaintext);
        
        // print_r($json);exit;
?>

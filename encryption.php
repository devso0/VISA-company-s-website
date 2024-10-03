<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital@1&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <!--NavBar Section-->
        <div class="navbar">
            <nav class="navigation hide" id="navigation">
                <span class="close-icon" id="close-icon" onclick="showIconBar()"><i class="fa fa-close"></i></span>
                <ul class="nav-list">
                    <li class="nav-item"><a href="Homepage.html">Homepage</a></li>
                    <li class="nav-item"><a href="docs.php">Document Notepad</a></li>
                    <li class="nav-item"><a href="encryption.php">Encryption</a></li>
                </ul>
            </nav>
            <a class="bar-icon" id="iconBar" onclick="hideIconBar()"><i class="fa fa-bars"></i></a>
            <div class="brand">VISA Company's internal file encryption</div>
        </div>
       
    </header>
    <div class="container">
        <!--Navigation-->
        <div class="navigate">
            <span><a href="">FILES</a> >> <a href="">PDFS</a></span>
        </div>
        
        <p>Click on the "Choose File" button to upload a file:</p>
        
        <form action="/action_page.php">
          <input type="file" id="myFile" name="filename">
          <input type="submit">
        </form>


<?php

function encrypt($content, $key)
{
    $cipher = 'aes-256-cbc';
    $ivLenght = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivLenght);

    return openssl_encrypt($content, $cipher, $key, $options=0, $iv);
}

$content = file_get_contents('myFile');
$encrypted = encrypt($content, 'my-secret-key');
file_put_contents('encrypted_file.mp4', $encrypted);

echo "File encrypted!\n";
echo 'Memory usage: ' . round(memory_get_usage() / 1048576, 2) . "M\n";
?>

<?php


define('FILE_ENCRYPTION_BLOCKS', 10000);

/**
 * @param  $source  Path of the unencrypted file
 * @param  $dest  Path of the encrypted file to created
 * @param  $key  Encryption key
 */
function encryptFile($source, $dest, $key)
{
    $cipher = 'aes-256-cbc';
    $ivLenght = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivLenght);

    $fpSource = fopen($source, 'rb');
    $fpDest = fopen($dest, 'w');

    fwrite($fpDest, $iv);

    while (! feof($fpSource)) {
        $plaintext = fread($fpSource, $ivLenght * FILE_ENCRYPTION_BLOCKS);
        $ciphertext = openssl_encrypt($plaintext, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $iv = substr($ciphertext, 0, $ivLenght);

        fwrite($fpDest, $ciphertext);
    }

    fclose($fpSource);
    fclose($fpDest);
}


encryptFile('file.mp4', 'encrypted_file.mp4', 'my-secret-key');
?>
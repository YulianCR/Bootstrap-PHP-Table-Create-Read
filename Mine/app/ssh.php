<?php
require 'vendor/autoload.php';

use phpseclib3\Net\SSH2;

$ssh = new SSH2('10.62.165.21'); // Ganti dengan IP perangkat Anda
if (!$ssh->login('gm19870101', 'Akses135')) {
    exit('Login SSH gagal.');
}

echo $ssh->exec('show version'); // Ganti dengan command yang valid untuk perangkat Anda

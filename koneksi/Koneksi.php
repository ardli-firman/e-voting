<?php

$db = mysqli_connect('localhost', 'root', 'F', 'evoting_uas');

if (!$db) {
    die('Ada kesalahan di database');
}

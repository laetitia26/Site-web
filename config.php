<?php

$authTableData = [
    'table' => 'users',
    'idfield' => 'login',
    'cfield' => 'mdp',
    'uidfield' => 'userid',
    'rfield' => 'role',
];

$pathFor = [
    "login"  => "/pizza/login.php",
    "logout" => "/pizza/admin/logout.php",
    "adduser" => "/pizza/identification.php",
    "root"   => "/pizza",
];

const SKEY = '_Redirect';

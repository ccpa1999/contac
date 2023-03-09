<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
header("Content-Type: *");
header("Access-Control-Max-Age: 3600");
header('Access-Control-Allow-Credentials: true');
session_start();
session_unset();
session_destroy();

header("Location: http://172.16.10.192/cliente/#/accesos");
<?php
session_start();
ini_set('display_errors', 1);
require_once 'DB.config.php';
require_once 'App/autoload.php';
use core\Route;

Route::start();
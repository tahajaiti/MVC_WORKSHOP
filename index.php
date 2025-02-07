<?php
require_once 'vendor/autoload.php';
use App\Core\Database;
$db = Database::getConnection();

require_once 'App/Routes/Routes.php';
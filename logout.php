<?php
require_once 'core/ini.php';
$user = new User();
$user->logout();
Redirect::to('./');
?>
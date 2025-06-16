<?php
require_once __DIR__ . '/models/Usuario.php';

Usuario::logout();
header('Location: index.php');
exit;
?>

<?php

$_SESSION = [];
session_destroy();
header('Location: login.php', true, 303);
exit();
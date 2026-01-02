<?php

if (!function_exists('requireRole')) {
  function requireRole($allowedRoles) {
    if (!issets($_SESSION['user']['role']) || !in_array($_SESSION['user']['role'], $allowedRoles, true)) {
      header('Location: ../dashboard.php', true, 303);
      exit();
    }
  }
}
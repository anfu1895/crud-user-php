<?php

if (!function_exists('requireRole')) {
  function requireRole(array $allowedRoles): void {
    if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $allowedRoles, true)) {
      header('Location: ../dashboard.php', true, 303);
      exit();
    }
  }
}
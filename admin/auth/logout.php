<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

unset($_SESSION["user"]);
unset($_SESSION["role"]);
unset($_SESSION['admin_logged_in']);
header('Location: http://localhost/wbcts/admin/auth/login');
exit;

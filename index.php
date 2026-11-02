<?php
require_once 'config/session.php';
if (isLoggedIn()) redirect(isAdmin() ? 'admin/dashboard.php' : 'member/dashboard.php');
redirect('login.php');
?>
<?php
@session_start();
 
unset($_SESSION['login']);
unset($_SESSION['name']);
$r['message'] = 'success';

echo json_encode($r);
?>
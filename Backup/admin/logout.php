<?PHP
//session_save_path('/home/quickclass/tmp');
//ini_set('session.gc_probability', 1);
include("AMframe/config.php");
ob_start();
session_start();
session_destroy();

unset($_SESSION['admin_id']);

header('location: index.php');
?> 
<?PHP
//session_save_path('/home/binamlm/tmp');
//ini_set('session.gc_probability', 1);
include "admin/AMframe/config.php";
session_destroy();
unset($_SESSION['userid']);
unset($_SESSION['profileid']);
unset($_SESSION['user_fname']);
header('location: login.php');
echo "<script>window.location='login.php';</script>";
?> 
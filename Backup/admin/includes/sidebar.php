<?php
if((!isset($_SESSION['admin_id'])) && ($_SESSION['admin_id']==""))
{
header("location:index.php");
}

$live=$_SERVER['PHP_SELF'];
$live=basename($live);
$ll=basename($_SERVER["SCRIPT_FILENAME"], '.php');
$geturl=$_SERVER['REQUEST_URI'];
$l=basename($_SERVER['REQUEST_URI'], ".php");
$dirname=dirname($geturl)."/";
//echo $geturl;exit;
$hostlink=$_SERVER["SERVER_NAME"];
$SetUrl = "http://".$hostlink.$dirname;
$file_with_path = $hostlink.$geturl;

?>

<?php

if($_SESSION['admin_id']==0){

?>

<div class="sidebar" id="sidebar">


				<!--#sidebar-shortcuts-->

<ul class="nav nav-list">

<!--main menu-->
		<?php
		$getm=$db->get_all("select * from main_menu where active_status='1' and param='0' and sub_status!='1'");
		$Getmc=$db->numrows("select * from main_menu where active_status='1' and param='0' and sub_status!='1'");
		
		foreach($getm as $fet){
		$mid=$fet['menu_id'];
		$mname=$fet['menu_name'];
		$mfile=$fet['menu_file'];
		$param=$fet['param'];
		$m_param=$fet['m_param'];
		$sub_status=$fet['sub_status'];
			
		$menu_icon =$fet['menu_icon'];
		//$sbm_List .= "<li><i class='$menu_icon'></i><a href='$SetUrl$mfile'>$mname</a></li>"; 
			
		?>

	<li>

		<a href="<?php echo $SetUrl.$mfile; ?>">

			<i class="<?php echo $menu_icon; ?>"></i>

			<span class="menu-text"> <?php echo $mname; ?> </span>

		</a>

	</li>
	
	<?php
	
		}
	?>
	
	
	<!--submenu-->
	<?php
	$sub=$db->get_all("select * from main_menu where active_status='1' and sub_status='1'");
	$g_sub=$db->numrows("select * from main_menu where active_status='1' and sub_status='1'");

		foreach($sub as $row){
			$m_id=$row['menu_id'];
			$m_name=$row['menu_name'];
			$m_file=$row['menu_file'];
			$m_icon=$row['menu_icon'];
			$param=$row['param'];
			$m_param=$row['m_param'];
			$s_status=$row['sub_status'];
			if($s_status==1){
		?>
	
	<li>
		<a href="#" class="dropdown-toggle">
			<i class="icon-double-angle-right"></i>
			<span class="menu-text"> <?php echo $m_name; ?> </span>
		</a>
	
		 <ul class="submenu">
		 <?php 
		$q=$db->get_all("select * from main_menu where active_status='1' and m_param='$m_id'");
		foreach($q as $p) {  $s_n=$p['menu_file']; $mm=$p['menu_name']; { ?>
			 <li><a href="<?php echo $SetUrl.$s_n ?>">
				<i class="icon-double-angle-right"></i><?php echo $mm; ?></a>
			</li>
		<?php } } ?>
		</ul>
	
	</li>	
	<?php
		
			}
		
		}
					
	?>
				
				
</ul>

				
				


				<div class="sidebar-collapse" id="sidebar-collapse">

					<i class="icon-double-angle-left"></i>

				</div>

			</div>
<? } else{
	
	?>
	
	<!--Staff menu-->
	<div class="sidebar" id="sidebar">


				<!--#sidebar-shortcuts-->

<ul class="nav nav-list">

<!--main menu-->
		<?php
		$mai= $_SESSION['staff_email'];
		$s=$db->singlerec("select * from mlm_staff where staff_email='$mai'");
		$Getmc=$db->numrows("select * from mlm_staff where staff_email='$mai'");
		$un=$s['staff_username'];
		$mp=$s['menu_permission'];
		$array = explode(",",$mp);
		
		foreach($array as $val){
			$getm=$db->get_all("select * from main_menu where active_status='1' and menu_id='$val' and param='0' and sub_status!='1'");
		
		foreach($getm as $fet){
		$mid=$fet['menu_id'];
		$mname=$fet['menu_name'];
		$mfile=$fet['menu_file'];
		$param=$fet['param'];
		$m_param=$fet['m_param'];
		$sub_status=$fet['sub_status'];
			
		$menu_icon =$fet['menu_icon'];
		//$sbm_List .= "<li><i class='$menu_icon'></i><a href='$SetUrl$mfile'>$mname</a></li>"; 
			
		?>

	<li>

		<a href="<?php echo $SetUrl.$mfile; ?>">

			<i class="<?php echo $menu_icon; ?>"></i>

			<span class="menu-text"> <?php echo $mname; ?> </span>

		</a>

	</li>
	
	<?php
			}
		}
		
	?>
	
	
	<!--submenu-->
	<?php
	$s=$db->singlerec("select * from mlm_staff where staff_email='$mai'");
	$Getmc=$db->numrows("select * from mlm_staff where staff_email='$mai'");
		$un=$s['staff_username'];
		$mp=$s['menu_permission'];
		$array = explode(",",$mp);
		
		foreach($array as $val){
			$getm=$db->get_all("select * from main_menu where active_status='1' and menu_id='$val' and sub_status='1'");
			$g_sub=$db->numrows("select * from main_menu where active_status='1' and menu_id='$val' and sub_status='1'");
	
		foreach($getm as $row){
			$m_id=$row['menu_id'];
			$m_name=$row['menu_name'];
			$m_file=$row['menu_file'];
			$m_icon=$row['menu_icon'];
			$param=$row['param'];
			$m_param=$row['m_param'];
			$s_status=$row['sub_status'];
			if($s_status==1){
		?>
	
	<li>
		<a href="#" class="dropdown-toggle">
			<i class="icon-double-angle-right"></i>
			<span class="menu-text"> <?php echo $m_name; ?> </span>
		</a>
	
		 <ul class="submenu">
		 <?php 
		$q=$db->get_all("select * from main_menu where active_status='1' and m_param='$m_id'");
		foreach($q as $p) {  $s_n=$p['menu_file']; $mm=$p['menu_name']; { ?>
			 <li><a href="<?php echo $SetUrl.$s_n ?>">
				<i class="icon-double-angle-right"></i><?php echo $mm; ?></a>
			</li>
		<?php } } ?>
		</ul>
	
	</li>	
	<?php
		
			}
		}
		}
					
	?>
				
				
</ul>

				
				


				<div class="sidebar-collapse" id="sidebar-collapse">

					<i class="icon-double-angle-left"></i>

				</div>

			</div>
	<!--Staff menu end-->
	
<?php	
}		
?>
		
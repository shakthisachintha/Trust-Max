<?php 
include "includes-new/header.php";

if(isset($_REQUEST['id']) && $_REQUEST['id']!='') {
	$profileid=$_REQUEST['id'];
} else {
	echo "<script>location.href='index.php';</script>";
	header("Location:index.php");
	exit;
}
if(isset($_REQUEST['registrationfive']))
{    
	$profileid=addslashes($_REQUEST['profileid']);
	$memid=addslashes($_REQUEST['mem_id']);

	$memInfo=$db->singlerec("select * from mlm_membership where id='$memid'");

	$set="profileid='$profileid'";
	$set.=",pack='$memid'";
	$set.=",amount='$memInfo[act_amount]'";
	$set.=",paidamt='$memInfo[act_amount]'";
	$set.=",pay_type='Offline'";
	$set.=",ip_address='$ip_addr'";
	$set.=",status='Pending'";
	$set.=",created_at='$cur_date'";
	$set.=",modified_at='$cur_date'";
	
	if($_FILES['payslip']['name']!=''){
	$errors= "";
	$file_name=$_FILES['payslip']['name'];
	$file_size =$_FILES['payslip']['size'];
    $file_tmp =$_FILES['payslip']['tmp_name'];
    $file_type=$_FILES['payslip']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['payslip']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors="  <div class='alert alert-block alert-danger'><strong class='red'>Extension not allowed, please choose a JPEG or PNG file.</strong></div>";
      }
      
      if($file_size > 1048576){
         $errors="<div class='alert alert-block alert-danger'><strong class='red'>File size must be excately 1 MB.</strong></div>";
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"uploads/payslip/".$file_name);
         $userpayslip=",user_payslip='$file_name'";
      }
	}
	else
	{
	$userpayslip='';
	}
    

	$com_obj->insertrec("insert into mlm_mempayments set $set $userpayslip");

	header("Location:login.php?succ");
	echo '<script language="javascript"> window.location="login.php?succ"; </script>';
	exit;
}
?>
<!-- Breadcrumb -->
       
<div class="forny-container section-padding-sm">
        
    <div class="container forny-inner">
        
    <div class="row">
	<div class="col-sm-3"></div>
	<div class="col-sm-6">
        <div class="forny-form">
            <div class="forny-logo">
                <a href="#">
                    <?php if(!empty($sitelogo) && file_exists("uploads/logo/$sitelogo")){ ?>
							<img src="uploads/logo/<?=$sitelogo;?>" alt="<?=$website_title;?>" width="175" height="55"/>
						 <?}else {?>
						 <img src="uploads/no_image.jpg" alt="blog thumbnail" width="175" height="55">
						 <? } ?>
                </a>
            </div>
			
            <ul class="nav nav-tabs" role="tablist">
               <li class="nav-item">
                    <a class="nav-link bg-transparent active" href="#register" data-toggle="tab" role="tab" aria-selected="false">
                        <span>Step 5 * (Payment Details)</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
            <?  $bank_detail=$db->singlerec("select * from mlm_bank where id='1' "); ?>	
       <form class="register-form" method="post" action="" enctype="multipart/form-data">
	          
 		        <div class="form-group">
				   <label for="sponsorid" ><b>Account Name <span class="required">*</span></b> </label>
					<div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your full name" name="aname"  required="true" value="<? echo $bank_detail['acc_name']?>" readonly />
					</div>
				</div>
				<div class="form-group">
				<label for="sponsorid"><b>Account Number <span class="required">*</span></b> </label>
                    <div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter Id card number" name="anumber" required="true" value="<? echo $bank_detail['acc_no']?>" readonly />
					</div>
				</div>
				<div class="form-group">
				<label for="sponsorid"><b>Bank Name <span class="required">*</span></b> </label>
                    <div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your address #1" name="bname" required="true" value="<? echo $bank_detail['bank_name']?>" readonly />
					</div>
				</div>
				<div class="form-group">
				<label for="sponsorid"><b>IFSC Code <span class="required">*</span></b> </label>
                    <div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your Postal Code" name="ifsc" required="true" value="<? echo $bank_detail['ifsc_code']?>" readonly />
					</div>
				</div>
				<div class="form-group">
				<label for="sponsorid"><b>Branch Name <span class="required">*</span></b> </label>
                    <div class="input-group">
					   <input class="form-control" type="text" placeholder="Enter your phone" name="brname" value="<? echo $bank_detail['branch_name']?>" required="true" readonly />
					</div>
				</div>
				<div class="form-group">
				<label for="sponsorid"><b>Upload Payslip <span class="required">*</span></b> </label>
                    <div class="input-group">
					   <input class="form-control" type="file" name="payslip"  required="true" />
					</div>
				</div>
				<input type="hidden" name="profileid" value="<?php echo $profileid;?>" />

                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary btn-block" type="submit" name="registrationfive" >Submit</button>
                            </div>
                        </div>

                        
                            <div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		 </div>
		<div class="col-sm-3"></div>
		 </div>
    </div>

    </div>

<?php include "includes-new/footer.php" ?>
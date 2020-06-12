<?php include("admin/AMframe/config.php");
include("includes/head.php");
?>
</head>
    <body>
		<div class="container main">
			<!-- Start Header-->
			<?php include("includes/header.php"); ?>
			<!-- End Header-->
			
			<!-- Start Navigation -->
			<?php include("includes/menu.php");	?>
			<!-- End Navigation -->
			<hr />
            <div class="col-sm-12" style="margin-top:30px;">
            <div class="col-sm-12">
                        <div class="well">
						<h1>Download Document</h1>
                       
					   <?php
					   $docdown=$db->get_all("select * from mlm_document where doc_status='0'");
					   $i=1;
					   foreach($docdown as $row_doc)
					   {
					    ?>
					   
					   <div style="margin: 10px 0px 5px 0px; background-color:#FFFFFF; border:1px #FF6600 solid; height:36px; border-radius:5px;">
					   <div style="float:left; font-size:16px; text-align:center; padding-top:8px;">&nbsp;&nbsp;<?php echo $i; ?> .&nbsp;&nbsp;</div>
					   
					   <div style="float:left; font-size:16px; text-align:center; padding-top:8px;"><?php echo $row_doc['doc_heading']; ?></div>
					   
					   <div style="float:right;padding-top:2px;"><a href="uploads/document/<?php echo $row_doc['doc_name']; ?>"> <img src="images/download-button-orange.png" style=" width:90px; height:32px;" title="click here to download" alt="download"></a></div>
					   
					   <div style="clear:both;">&nbsp;</div>
					 </div>
					 
					   <?php $i++; } ?>
					                    
					</div>
    			</div></div>
            <div class="row">
                <div class="span3">

			</div>

            </div>
            <?php 
			
			include("includes/footer.php");
			
			?>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>
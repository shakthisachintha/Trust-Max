<?php 
include("admin/AMframe/config.php");
include("includes/function.php");
include("includes/head.php");

if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid']))) {
	header("location:index.php");
	echo "<script>window.location='index.php'</script>";
}
$profile = $_SESSION['profileid'];
$rankName = ['User', 'Executive Distrubutor', 'Distribution Manager', 'Distribution Area Manager', 'Distribution Director', 'Country Director', 'Vice Precedent', 'Presedent']
?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
<link href="css/B_red.css" rel="stylesheet" type="text/css" />

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
    <body>
	<div class="container main">
		<!-- Start Header-->
		<?php include("includes/header.php");?>
		<!-- End Header-->
		<hr />
		
		<!-- Profile info -->
		<?php include("includes/profileheader.php");?>
		
		<div class="row" style="margin-top:30px;">
		
		<!-- left div here -->
			
		<?php include("includes/profilemenu.php");?>
			
		<div class="col-sm-9">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default">
                        <div class="panel-heading"><h2>Your Current Rank & Target Rank</h2></div>
                        <div class="panel-body">
                            <div class="row">
                                <?php $rank = $com_obj->checkRank($profile); ?>
                                <div class="col-md-12">
                                    <h2 style="color: rebeccapurple;">Rank: <?php echo $rankName[$rank]; ?></h2>
                                    <br><br>
                                    
                                    <table class="table table-hover">
                                        <tr>
                                            <td colspan="2" style="background-color: #51257d;color: white;">
                                                <h4 style="color: white;">Next Rank: <?php echo $rankName[$rank + 1]; ?></h4>
                                                <p style="color: yellow;">Criterias to fill for next Rank</p>
                                            </td>
                                        </tr>
                                        <?php if($rank == 1){ ?>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Sponsor: </td>
                                            <td style="background-color: rebeccapurple;color: white;">2 direct sponsor</td>
                                        </tr>
                                        <?php } if($rank == 2){ ?>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Sponsor: </td>
                                            <td style="background-color: rebeccapurple;color: white;">4 direct sponsor</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Executive Distributor: </td>
                                            <td style="background-color: rebeccapurple;color: white;">2 Executive Distributor in your downline.</td>
                                        </tr>


                                        <?php } if($rank == 2){ ?>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Sponsor: </td>
                                            <td style="background-color: rebeccapurple;color: white;">5 direct sponsor</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Executive Distributor: </td>
                                            <td style="background-color: rebeccapurple;color: white;">4 Executive Distributor in your downline.</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Distribution Manager: </td>
                                            <td style="background-color: rebeccapurple;color: white;">2 Distribution Manager in your downline.</td>
                                        </tr>


                                        <?php } if($rank == 2){ ?>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Executive Distributor: </td>
                                            <td style="background-color: rebeccapurple;color: white;">8 Executive Distributor in your downline.</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Distribution Manager: </td>
                                            <td style="background-color: rebeccapurple;color: white;">5 Distribution Manager in your downline.</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Distribution Area Manager: </td>
                                            <td style="background-color: rebeccapurple;color: white;">2 Distribution Area Manager in your downline.</td>
                                        </tr>
                                        <?php } if($rank == 2){ ?>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Executive Distributor: </td>
                                            <td style="background-color: rebeccapurple;color: white;">12 Executive Distributor in your downline.</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Distribution Manager: </td>
                                            <td style="background-color: rebeccapurple;color: white;">8 Distribution Manager in your downline.</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Distribution Area Manager: </td>
                                            <td style="background-color: rebeccapurple;color: white;">5 Distribution Area Manager in your downline.</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Distribution Director: </td>
                                            <td style="background-color: rebeccapurple;color: white;">3 Distribution Director in your downline.</td>
                                        </tr>
                                        <?php } if($rank == 2){ ?>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Executive Distributor: </td>
                                            <td style="background-color: rebeccapurple;color: white;">20 Executive Distributor in your downline.</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Distribution Manager: </td>
                                            <td style="background-color: rebeccapurple;color: white;">15 Distribution Manager in your downline.</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Distribution Area Manager: </td>
                                            <td style="background-color: rebeccapurple;color: white;">12 Distribution Area Manager in your downline.</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Distribution Director: </td>
                                            <td style="background-color: rebeccapurple;color: white;">8 Distribution Director in your downline.</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Country Director: </td>
                                            <td style="background-color: rebeccapurple;color: white;">2 Country Director in your downline.</td>
                                        </tr>
                                        <?php } if($rank == 2){ ?>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Executive Distributor: </td>
                                            <td style="background-color: rebeccapurple;color: white;">30 Executive Distributor in your downline.</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Distribution Manager: </td>
                                            <td style="background-color: rebeccapurple;color: white;">25 Distribution Manager in your downline.</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Distribution Area Manager: </td>
                                            <td style="background-color: rebeccapurple;color: white;">20 Distribution Area Manager in your downline.</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Distribution Director: </td>
                                            <td style="background-color: rebeccapurple;color: white;">15 Distribution Director in your downline.</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Country Director: </td>
                                            <td style="background-color: rebeccapurple;color: white;">10 Country Director in your downline.</td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #7648a5;color: white;">Vice President: </td>
                                            <td style="background-color: rebeccapurple;color: white;">2 Vice President in your downline.</td>
                                        </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer" style="text-align:right">
                            Complite all tasks.
                        </div>
                    </div>
		        </div>	
            </div>
        <?php include "includes/login-access-ads.php";?>
        </div>			
</div>


<?php include("includes/footer.php"); ?>
</div>
		
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
		
<link href="c3/c3.css" rel="stylesheet" type="text/css">
<script src="d3/d3.v3.min.js"></script>
<script src="c3/c3.min.js"></script>		
	
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

	</body>
</html>
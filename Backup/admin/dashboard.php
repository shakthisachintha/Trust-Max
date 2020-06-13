<?php 
include("AMframe/config.php"); 
include("includes/header.php"); 
if((!isset($_SESSION['admin_id'])) && ($_SESSION[ 'admin_id']=="" ))
{
	header("location:index.php");
} 
$menu1='class="active"' ; 
?>


<div class="main-container container-fluid">
    <a class="menu-toggler" id="menu-toggler" href="#">
        <span class="menu-text"></span>
    </a>
    <?php include( "includes/sidebar.php"); ?>

    <div class="main-content">
        <div class="breadcrumbs" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="icon-home home-icon"></i>
                    <a href="#">Home</a>

                    <span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
                </li>
                <li class="active">Dashboard</li>
            </ul>
        </div>

        <div class="page-content">
            <div class="page-header position-relative">
                <h1>
							Dashboard
							<small>
								<i class="icon-double-angle-right"></i>
								overview &amp; stats
							</small>
						</h1>
            </div>
            <!--/.page-header-->

            <div class="row-fluid">
                <div class="span12">
                    <!--PAGE CONTENT BEGINS-->

                    <div class="alert alert-block alert-success">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="icon-remove"></i>
                        </button>

                        <i class="icon-ok green"></i> Welcome to
                        <strong class="green">
									administrator
									<small></small>
								</strong>
                    </div>

<?php 
// users
$numusers=$db->numrows("select user_fname from mlm_register where user_status != 5"); 
// products
$numproducts=$db->numrows("select pro_name from mlm_products"); 
// stocks
$numstocks=$db->numrows( "select stock_id from mlm_stocks");   
// trans request
$numtrans_requests=$db->numrows("select * from mlm_withdrawrequsets"); 
//TDS value
$trans=$db->singlerec("select SUM(req_cvamount*(tds_percent/100)) as tds_price from mlm_withdrawrequsets");
// trans cancel
$numtrans_cancel=$db->numrows("select * from mlm_withdrawrequsets where req_status=1"); 
// news
$numnews=$db->numrows("select * from mlm_news where news_status = 0"); 
// product sale
$numsales=$db->numrows("select pay_id from mlm_purchase where pay_payment=1");

$salesamount_sum=$db->extract_single("select SUM(pay_amount) as sum from mlm_purchase where pay_payment=1");
$pstock_sum=$db->extract_single("select SUM(stock_count) as sum from mlm_stocks where stock_status=0");				
$pstock_sum_a=$db->extract_single("select sum(mlm_stocks.stock_count * mlm_products.pro_cost) as sum from mlm_stocks,mlm_products where mlm_stocks.stock_proid = mlm_products.pro_id");

// product wastage
$pw_waste_sum=$db->extract_single("select SUM(waste_count) as sum from mlm_wastage where waste_status=0");
$pw_waste_sum_a=$db->extract_single("select sum(mlm_wastage.waste_count * mlm_products.pro_cost) as sum from mlm_wastage,mlm_products where mlm_wastage.waste_proid = mlm_products.pro_id");

// inbox
$newmail=$db->numrows("select * from mlm_outbox where outbox_toprofileid='Admin'");
// read mail
$readmail=$db->numrows("select * from mlm_outbox where (outbox_toprofileid='Admin' and outbox_status='0') and (outbox_fromstatus='0' and outbox_readstatus='1')");
// testimonial
$testimonial_num=$db->numrows("select * from mlm_testimonial where test_status = 0");
// country
$country_num=$db->numrows("select * from mlm_country where country_status = 0");
// ads
$ads_num=$db->numrows("select * from mlm_advertise where ad_status = 1");
// Commission
$commfetch=$db->singlerec("select * from mlm_basic_comission");

?>
<style type="text/css">
h2 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 13pt;
	color: navy;
	padding-top: 12px;
	padding-bottom: 3px;
	margin: 5px;
}
table tr td {
	padding: 7px;
}
</style>

		<table  width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td width="33%" valign="top">
						<table width="100%" cellpadding="0" cellspacing="0" border="1">
							<tr style="background-color:#438EB9;color:#fff;font-weight:700;">
								<td colspan="2" align="center">TDS MANAGEMENT</td>
							</tr>
							<tr>
								<td width="50%">TDS(%)</td>
								<td width="50%">
									<?php echo $commfetch['ref_tax']; ?>
								</td>
							</tr>
							<tr>
								<td width="50%">Total Commission</td>
								<td width="50%">
									<?php echo round($trans['tds_price'])." ".$sitecurrency; ?>
								</td>
							</tr>
						</table>
					</td>
					<td width="33%" valign="top">
						<table width="100%" cellpadding="0" cellspacing="0" border="1">
							<tr style="background-color:#438EB9;color:#fff;font-weight:700;">
								<td colspan="2" align="center">TRANSACTION SETTING</td>
							</tr>
							<tr>
								<td width="50%">Total Request</td>
								<td width="50%">
									<?php echo $numtrans_requests; ?>
								</td>
							</tr>
							<tr>
								<td width="50%">Cancel Request</td>
								<td width="50%">
									<?php echo $numtrans_cancel; ?>
								</td>
							</tr>
						</table>
					</td>
					<td width="33%" valign="top">
							<table width="100%" cellpadding="0" cellspacing="0" border="1">
								<tr style="background-color:#438EB9;color:#fff;font-weight:700;">
									<td colspan="2" align="center">MAILLING SYSTEM</td>
								</tr>
								<th>Type</th><th>Count</th>
								<tr>
									<td width="50%">Inbox</td>
									<td width="50%">
										<?php echo $newmail; ?>
									</td>
								</tr>
								<tr>
									<td width="50%">Read Mail</td>
									<td width="50%">
										<?php echo $readmail; ?>
									</td>
								</tr>
							</table>
					</td>
						
			</tr>
			<tr>								                    
				
				<td width="33%" valign="top">
						<table width="100%" cellpadding="0" cellspacing="0" border="1" >
							<tr style="background-color:#438EB9;color:#fff;font-weight:700;">
								<td colspan="2" align="center">STATISTICS</td>
							</tr>
							<tr>
								<td width="50%">Total Users</td>
								<td width="50%">
									<?php echo $numusers; ?>
								</td>
							</tr>
							<tr>
								<td width="50%">Total Products</td>
								<td width="50%">
									<?php echo $numproducts; ?>
								</td>
							</tr>
							<tr>
								<td width="50%">Total Stocks</td>
								<td width="50%">
									<?php echo $numstocks; ?>
								</td>
							</tr>
						</table>
				</td>
				<td width="33%" valign="top">
					<table width="100%" cellpadding="0" cellspacing="0" border="1">
						<tr style="background-color:#438EB9;color:#fff;font-weight:700;">
							<td colspan="3" align="center">PRODUCTS</td>
						</tr>
						<th>Type</th><th>Count</th><th>Cost</th>
						<tr>
							<td width="50%">Sales</td>
							<td width="50%">
								<?php echo $numsales; ?>
							</td>
							<td width="50%">
								<?php echo $salesamount_sum; ?>
							</td>
						</tr>
						<tr>
							<td width="50%">Stock</td>
							<td width="50%">
								<?php echo $pstock_sum; ?>
							</td>
							<td width="50%">
								<?php echo $pstock_sum_a; ?>
							</td>
						</tr>
						<tr>
							<td width="50%">Wastage</td>
							<td width="50%">
								<?php echo $pw_waste_sum; ?>
							</td>
							<td width="50%">
								<?php echo $pw_waste_sum_a; ?>
							</td>
						</tr>
					</table>
				</td>
				<td width="33%" valign="top">
							<table width="100%" cellpadding="0" cellspacing="0" border="1" >
								<tr style="background-color:#438EB9;color:#fff;font-weight:700;">
									<td colspan="2" align="center">SITE FEATURES</td>
								</tr>
								<th>Type</th><th>Count</th>
								<tr>
									<td width="50%">New Management</td>
									<td width="50%">
										<?php echo $numnews; ?>
									</td>
								</tr>
								<tr>
									<td width="50%">Country Management</td>
									<td width="50%">
										<?php echo $country_num; ?>
									</td>
								</tr>
								<tr>
									<td width="50%">Testimonial Management</td>
									<td width="50%">
										<?php echo $testimonial_num; ?>
									</td>
								</tr>
								<tr>
									<td width="50%">AD's Management</td>
									<td width="50%">
										<?php echo $ads_num; ?>
									</td>
								</tr>
								<tr>
									<td width="50%">Site Settings</td>
									<td width="50%">
										<a href="setting.php">click</a>
									</td>
								</tr>
							</table>
				</td>
			</tr>
		</table>
                    <!--/row-->
                    <!--/row-->
                    <!--PAGE CONTENT ENDS-->
                </div>
                <!--/.span-->
            </div>
            <!--/.row-fluid-->
        </div>
        <!--/.page-content-->
        <div class="ace-settings-container" id="ace-settings-container">
            <div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
                <i class="icon-cog bigger-150"></i>
            </div>

            <div class="ace-settings-box" id="ace-settings-box">
                <div>
                    <div class="pull-left">
                        <select id="skin-colorpicker" class="hide">
                            <option data-class="default" value="#438EB9" />#438EB9
                            <option data-class="skin-1" value="#222A2D" />#222A2D
                            <option data-class="skin-2" value="#C6487E" />#C6487E
                            <option data-class="skin-3" value="#D0D0D0" />#D0D0D0
                        </select>
                    </div>
                    <span>&nbsp; Choose Skin</span>
                </div>

                <div>
                    <input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
                    <label class="lbl" for="ace-settings-header"> Fixed Header</label>
                </div>

                <div>
                    <input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
                    <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                </div>

                <div>
                    <input type="checkbox" class="ace-checkbox-2" id="ace-settings-breadcrumbs" />
                    <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                </div>

                <div>
                    <input type="checkbox" class="ace-checkbox-2" id="ace-settings-rtl" />
                    <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                </div>
            </div>
        </div>
        <!--/#ace-settings-container-->
    </div>
    <!--/.main-content-->
</div>
<!--/.main-container-->

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>

<!--basic scripts-->

<!--[if !IE]>-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<!--<![endif]-->

<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

<!--[if !IE]>-->

<script type="text/javascript">
    window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
</script>

<!--<![endif]-->

<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

<script type="text/javascript">
    if ("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>

<!--page specific plugin scripts-->

<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->

<script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/jquery.easy-pie-chart.min.js"></script>
<script src="assets/js/jquery.sparkline.min.js"></script>
<script src="assets/js/flot/jquery.flot.min.js"></script>
<script src="assets/js/flot/jquery.flot.pie.min.js"></script>
<script src="assets/js/flot/jquery.flot.resize.min.js"></script>

<!--ace scripts-->

<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!--inline scripts related to this page-->

<script type="text/javascript">
    $(function() {
        $('.easy-pie-chart.percentage').each(function() {
            var $box = $(this).closest('.infobox');
            var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
            var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
            var size = parseInt($(this).data('size')) || 50;
            $(this).easyPieChart({
                barColor: barColor,
                trackColor: trackColor,
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: parseInt(size / 10),
                animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
                size: size
            });
        })

        $('.sparkline').each(function() {
            var $box = $(this).closest('.infobox');
            var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
            $(this).sparkline('html', {
                tagValuesAttribute: 'data-values',
                type: 'bar',
                barColor: barColor,
                chartRangeMin: $(this).data('min') || 0
            });
        });




        var placeholder = $('#piechart-placeholder').css({
            'width': '90%',
            'min-height': '150px'
        });
        var data = [{
            label: "social networks",
            data: 38.7,
            color: "#68BC31"
        }, {
            label: "search engines",
            data: 24.5,
            color: "#2091CF"
        }, {
            label: "ad campaings",
            data: 8.2,
            color: "#AF4E96"
        }, {
            label: "direct traffic",
            data: 18.6,
            color: "#DA5430"
        }, {
            label: "other",
            data: 10,
            color: "#FEE074"
        }]

        function drawPieChart(placeholder, data, position) {
            $.plot(placeholder, data, {
                series: {
                    pie: {
                        show: true,
                        tilt: 0.8,
                        highlight: {
                            opacity: 0.25
                        },
                        stroke: {
                            color: '#fff',
                            width: 2
                        },
                        startAngle: 2
                    }
                },
                legend: {
                    show: true,
                    position: position || "ne",
                    labelBoxBorderColor: null,
                    margin: [-30, 15]
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }
            })
        }
        drawPieChart(placeholder, data);

        /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
        placeholder.data('chart', data);
        placeholder.data('draw', drawPieChart);



        var $tooltip = $("<div class='tooltip top in hide'><div class='tooltip-inner'></div></div>").appendTo('body');
        var previousPoint = null;

        placeholder.on('plothover', function(event, pos, item) {
            if (item) {
                if (previousPoint != item.seriesIndex) {
                    previousPoint = item.seriesIndex;
                    var tip = item.series['label'] + " : " + item.series['percent'] + '%';
                    $tooltip.show().children(0).text(tip);
                }
                $tooltip.css({
                    top: pos.pageY + 10,
                    left: pos.pageX + 10
                });
            } else {
                $tooltip.hide();
                previousPoint = null;
            }

        });




        var d1 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
            d1.push([i, Math.sin(i)]);
        }

        var d2 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.5) {
            d2.push([i, Math.cos(i)]);
        }

        var d3 = [];
        for (var i = 0; i < Math.PI * 2; i += 0.2) {
            d3.push([i, Math.tan(i)]);
        }


        var sales_charts = $('#sales-charts').css({
            'width': '100%',
            'height': '220px'
        });
        $.plot("#sales-charts", [{
            label: "Domains",
            data: d1
        }, {
            label: "Hosting",
            data: d2
        }, {
            label: "Services",
            data: d3
        }], {
            hoverable: true,
            shadowSize: 0,
            series: {
                lines: {
                    show: true
                },
                points: {
                    show: true
                }
            },
            xaxis: {
                tickLength: 0
            },
            yaxis: {
                ticks: 10,
                min: -2,
                max: 2,
                tickDecimals: 3
            },
            grid: {
                backgroundColor: {
                    colors: ["#fff", "#fff"]
                },
                borderWidth: 1,
                borderColor: '#555'
            }
        });


        $('#recent-box [data-rel="tooltip"]').tooltip({
            placement: tooltip_placement
        });

        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('.tab-content')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
            return 'left';
        }


        $('.dialogs,.comments').slimScroll({
            height: '300px'
        });


        //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
        //so disable dragging when clicking on label
        var agent = navigator.userAgent.toLowerCase();
        if ("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
            $('#tasks').on('touchstart', function(e) {
                var li = $(e.target).closest('#tasks li');
                if (li.length == 0) return;
                var label = li.find('label.inline').get(0);
                if (label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation();
            });

        $('#tasks').sortable({
            opacity: 0.8,
            revert: true,
            forceHelperSize: true,
            placeholder: 'draggable-placeholder',
            forcePlaceholderSize: true,
            tolerance: 'pointer',
            stop: function(event, ui) { //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                $(ui.item).css('z-index', 'auto');
            }
        });
        $('#tasks').disableSelection();
        $('#tasks input:checkbox').removeAttr('checked').on('click', function() {
            if (this.checked) $(this).closest('li').addClass('selected');
            else $(this).closest('li').removeClass('selected');
        });


    })
</script>
</body>
</html>
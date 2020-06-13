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
                        DRL Requests
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


$status = 0;
$filter = 'p';
// DRL Income
if(isset($_GET['a'])){
    $status =  1;
    $filter = 'a';
}
if(isset($_GET['p'])){
    $status =  0;
    $filter = 'p';
}
if(isset($_GET['r'])){
    $status =  2;
    $filter = 'r';
}
$drlIncome=$db->get_all("select * from mlm_drl where status='$status'");


if(!isset($_GET['p']) && !isset($_GET['a']) && !isset($_GET['r'])){
    header("location:dashboard.php");
}

if(isset($_REQUEST['updateAmount']))
{    
    if(isset($_REQUEST['amountUpdate']) && !empty($_REQUEST['amountUpdate'])){
        $amount = $_REQUEST['amountUpdate'];
        $drlId = $_REQUEST['drlId'];

        $qry=$db->insertrec("update mlm_drl set amount = '$amount' where id='$drlId'");
		header("location:drlRequest.php?".$filter);
    }
	
}

if(isset($_GET['approve'])){
    $appV = $_GET['approve'];
    $qry=$db->insertrec("update mlm_drl set status = 1 where id='$appV'");
    header("location:drlRequest.php?".$filter);
}
if(isset($_GET['rejected'])){
    $appV = $_GET['rejected'];
    $qry=$db->insertrec("update mlm_drl set status = 2 where id='$appV'");
    header("location:drlRequest.php?".$filter);
}


?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><h2>Request</h2></div>
                        <?php if(isset($_GET['p'])){ ?>
                            <a href="drlRequest.php?a">Go To Approved</a> | 
                            <a href="drlRequest.php?r">Go To Rejected</a>
                        <?php } ?>
                        <?php if(isset($_GET['a'])){ ?>
                            <a href="drlRequest.php?p">Go To Pendings</a> | 
                            <a href="drlRequest.php?r">Go To Rejected</a>
                        <?php } ?>
                        <?php if(isset($_GET['r'])){ ?>
                            <a href="drlRequest.php?a">Go To Approved</a> | 
                            <a href="drlRequest.php?p">Go To Pendings</a>
                        <?php } ?>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover"> 
                                    <thead> 
                                        <tr> 
                                            <th><strong>User</strong></th> 
                                            <th><strong>Month</strong></th>
                                            <th>Amount</th>
                                            <th>Submitted At</th>
                                            <th>Status</th>
                                        </tr> 
                                    </thead> 
                                    <tbody> 
                                        <?php foreach ($drlIncome as $key => $rec) { ?>
                                        <tr> 
                                            <td><strong><?php echo $rec['user_id']?></strong></td>
                                            <td><strong><?php echo $rec['date']?></strong></td>
                                            <?php if(isset($_GET['p'])){ ?>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="text" name="amountUpdate" value="<?php echo $rec['amount']?>">
                                                    <input type="hidden" name="drlId" value="<?php echo $rec['id']?>">
                                                    <input class="btn btn-success btn-sm" type="submit" value="update" name="updateAmount" style="margin: 0px;padding: 0px;line-height: 15px;">
                                                </form>
                                            </td>
                                            <?php } ?>
                                            <?php if(isset($_GET['a']) || isset($_GET['r'])){ ?>
                                                <td><?php echo $rec['amount']?></td>
                                            <?php } ?>
                                            <td><?php echo $rec['submitted_at']?></td>
                                            <td>
                                                <?php 
                                                    $recId = $rec['id'];
                                                    if($rec['status'] == 0){
                                                        echo "<a href='drlRequest.php?approve=$recId'><span class='label label-success'>Approve</span></a>";
                                                        echo "<a href='drlRequest.php?rejected=$recId'><span class='label label-warning' style='margin-left:5px'>Reject</span></a>";
                                                    }
                                                    if($rec['status'] == 1){
                                                        echo "<span class='label label-success'>Approved</span>";
                                                    }
                                                    if($rec['status'] == 2){
                                                        echo "<span class='label label-warning'>Rejected</span>";
                                                    }
                                                ?>
                                            </td>
                                        </tr> 
                                        <?php } ?>
                                    </tbody> 
                                </table>
                            </div>
                        </div>
                    </div>

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
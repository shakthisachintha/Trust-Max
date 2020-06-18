<?php
include "admin/AMframe/config.php";
include("includes/function.php");
$currentpagename = getPageName();
$uid = isset($_GET['uid']) ? $_GET['uid'] : '';
if (!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid']))) {
    header("location:index.php");
    echo "<script>window.location='index.php'</script>";
    exit;
}
?>

<head>
    <title><?php echo $website_title; ?></title>
    <meta name="description" content="<?php //echo $website_desc;
                                        ?>" />
    <meta name="keywords" content="<?php echo $website_keywords; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="uploads/favicon/<?php echo $siteFavicon; ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/images/icon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/dash-main.css">
    <link href="css/dev.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Baloo 2', cursive;
        }
    </style>
    <style type="text/css">
        .numwraper {
            position: relative;
            width: 65px;
            height: 65px;
        }

        .numwraper img {
            width: 100%;
            height: 100%;
        }

        .numwraper span {
            position: absolute;
            right: 34%;
            top: 31%;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: 12px;
            background-color: #FFF;
            padding: 0px 2px 0px 2px;
            display: block;
        }

        a.tooltipp {
            outline: none;
            opacity: 1;
        }

        a.tooltipp strong {
            line-height: 30px;
        }

        a.tooltipp:hover {
            text-decoration: none;
        }

        a.tooltipp span {
            z-index: 10;
            display: none;
            padding: 14px 20px;
            margin-top: -30px;
            margin-left: 10px;
            width: 300px;
            line-height: 16px;
        }

        a.tooltipp:hover span {
            display: inline;
            position: absolute;
            color: #111;
            border: 1px solid #DCA;
            background: #fffAF0;
        }

        .callout {
            z-index: 20;
            position: absolute;
            top: 30px;
            border: 0;
            left: -12px;
        }

        a.tooltipp span {
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            -moz-box-shadow: 5px 5px 8px #CCC;
            -webkit-box-shadow: 5px 5px 8px #CCC;
            box-shadow: 5px 5px 8px #CCC;
        }
    </style>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
</head>
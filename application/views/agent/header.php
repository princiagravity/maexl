<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Affan - PWA Mobile HTML Template">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>MAEXL</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url()?>images/agent/core-img/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo base_url()?>images/agent/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url()?>images/agent/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="<?php echo base_url()?>images/agent/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url()?>images/agent/icons/icon-180x180.png">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo base_url()?>css/agent/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/agent/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/agent/tiny-slider.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/agent/baguetteBox.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/agent/rangeslider.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/agent/vanilla-dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/agent/apexcharts.css">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url()?>css/agent/style.css">
    <!-- Web App Manifest -->
   <!--  <link rel="manifest" href="<?php //echo base_url()?>manifest.json"> -->
  </head>
  <body>
    <!-- Preloader -->
    <div id="preloader">
      <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>
    <!-- Internet Connection Status -->
    <!-- # This code for showing internet connection status -->
    <div class="internet-connection-status" id="internetStatus"></div>
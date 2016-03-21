<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
<!--    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">-->
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Intelligent Money Invoice System">
    <meta name="author" content="IM">
  
    <?php echo link_tag(base_url('favicon.ico'), 'icon','image/ico');?>
    

    <title><?php echo(isset($page_title) ? $page_title : "IM SYSTEM")?> : IM System</title>

    <!-- Bootstrap core CSS -->
  
  
    <?php echo link_tag(base_url('third_party/bootstrap/css/bootstrap.min.css'), 'stylesheet') ?>
    <?php echo link_tag(base_url('third_party/jquery-ui-1-11-4/jquery-ui.min.css'), 'stylesheet') ?>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
     <?php echo link_tag(base_url('third_party/ie10/ie10-viewport-bug-workaround.css'),'stylesheet') ?>
  

    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    
    <!-- Custom styles for this template -->    
      <?php echo link_tag(base_url('css/style.css'),'stylesheet') ?>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
	var jsconfig = {baseurl: '<?php echo base_url() ?>'}
    </script>
  </head>

  <body>
      <div id="wrap">
	  <div id="main">



     



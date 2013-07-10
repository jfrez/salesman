<?php

/* 

 * To change this template, choose Tools | Templates

 * and open the template in the editor.

 */

$ci = get_instance();

$baseurl = $ci->config->item("base_url");



//$message = $this->session->flashdata('message');

//$messagetype = $this->session->flashdata('messagetype');

//$userrole = $this->session->userdata("role");

?>

<!DOCTYPE html  >

<html  lang="es-ES">





<head>



	<meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />



	<title>REPORTE VISITAS</title>

       <!-- <link href="<?=$baseurl?>static/css/style.css" rel="stylesheet" type="text/css" />-->
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400' rel='stylesheet" type="text/css">
<link href="<?=$baseurl?>static/metro/css/modern.css" rel="stylesheet">

        		<link href="<?=$baseurl?>static/metro/css/style.css" rel="stylesheet" />


        <link href="<?=$baseurl?>static/css/jquery.wysiwyg.css" rel="stylesheet" type="text/css" />

        <link href="<?=$baseurl?>static/css/facebox.css" rel="stylesheet" type="text/css" />

        <link href="<?=$baseurl?>static/css/visualize.css" rel="stylesheet" type="text/css" />

        <link href="<?=$baseurl?>static/css/date_input.css" rel="stylesheet" type="text/css" />

        <link href="<?=$baseurl?>static/css/jquery.jgrowl.css" rel="stylesheet" type="text/css" />

        <link href="<?=$baseurl?>static/css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />

        <link href="<?=$baseurl?>static/jquery/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css" />






	<!--[if lt IE 8]><style type="text/css" media="all">@import url("css/ie.css");</style><![endif]-->



    <script type="text/javascript" src="<?=$baseurl?>static/jquery/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?=$baseurl?>static/jquery/ui/jquery-ui.js"></script>

    <script type="text/javascript" src="<?=$baseurl?>static/js/jquery.img.preload.js"></script>

    <script type="text/javascript" src="<?=$baseurl?>static/js/jquery.filestyle.mini.js"></script>

    <script type="text/javascript" src="<?=$baseurl?>static/js/jquery.wysiwyg.js"></script>

    <script type="text/javascript" src="<?=$baseurl?>static/js/jquery.date_input.pack.js"></script>
        <script type="text/javascript" src="<?=$baseurl?>static/js/date_input.js"></script>

    <script type="text/javascript" src="<?=$baseurl?>static/js/facebox.js"></script>

    <script type="text/javascript" src="<?=$baseurl?>static/js/excanvas.js"></script>

    <script type="text/javascript" src="<?=$baseurl?>static/js/jquery.visualize.js"></script>

    <script type="text/javascript" src="<?=$baseurl?>static/js/jquery.select_skin.js"></script>

    <script type="text/javascript" src="<?=$baseurl?>static/js/jquery.pngfix.js"></script>

    <script type="text/javascript" src="<?=$baseurl?>static/js/jquery.cookie.js"></script>

    <script type="text/javascript" src="<?=$baseurl?>static/js/jquery.scrollTo-1.4.2-min.js"></script>


    <script type="text/javascript" src="<?=$baseurl?>static/js/jquery.jgrowl.js"></script>
         <script type="text/javascript" src="<?=$baseurl?>static/metro/js/modern/dropdown.js"></script>
    <script type="text/javascript" src="<?=$baseurl?>static/metro/js/modern/accordion.js"></script>
    <script type="text/javascript" src="<?=$baseurl?>static/metro/js/modern/buttonset.js"></script>
    <script type="text/javascript" src="<?=$baseurl?>static/metro/js/modern/carousel.js"></script>
    <script type="text/javascript" src="<?=$baseurl?>static/metro/js/modern/input-control.js"></script>
    <script type="text/javascript" src="<?=$baseurl?>static/metro/js/modern/pagecontrol.js"></script>
    <script type="text/javascript" src="<?=$baseurl?>static/metro/js/modern/rating.js"></script>
    <script type="text/javascript" src="<?=$baseurl?>static/metro/js/modern/slider.js"></script>
    <script type="text/javascript" src="<?=$baseurl?>static/metro/js/modern/tile-slider.js"></script>
    <script type="text/javascript" src="<?=$baseurl?>static/metro/js/modern/tile-drag.js"></script>
    <script type="text/javascript" src="<?=$baseurl?>static/metro/js/modern/dialog.js"></script>




    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>

<!--    <script type="text/javascript" src="--><?//=$baseurl?><!--static/js/jquery.validationEngine.js"></script>-->

<!--    <script type="text/javascript" src="--><?//=$baseurl?><!--static/js/jquery.validationEngine-en.js"></script>-->


    <script src="<?php echo $baseurl?>static/js/jquery.ui.addresspicker.js"></script>

        

        <script type="text/javascript">

             var baseurl = "<?php echo $baseurl;?>";

        </script>
<!--
<script src="js/meny.min.js"></script>
		<script>
		$(function(){
			// Create an instance of Meny
			var meny = Meny.create({
				// The element that will be animated in from off screen
				menuElement: document.querySelector( '.page-sidebar' ),

				// The contents that gets pushed aside while Meny is active
				contentsElement: document.querySelector( '.page-region' ),

				// [optional] The alignment of the menu (top/right/bottom/left)
				position: Meny.getQuery().p || 'left',

				// [optional] The height of the menu (when using top/bottom position)
				height: 200,

				// [optional] The width of the menu (when using left/right position)
				width: 260,

				// [optional] Distance from mouse (in pixels) when menu should open
				threshold: 70
			});
			});

			// API Methods:
			// meny.open();
			// meny.close();
			// meny.isOpen();

			// Events:
			// meny.addEventListener( 'open', function(){ console.log( 'open' ); } );
			// meny.addEventListener( 'close', function(){ console.log( 'close' ); } );

			// Embed an iframe if a URL is passed in
			if( Meny.getQuery().u && Meny.getQuery().u.match( /^http/gi ) ) {
				var contents = document.querySelector( '.page-region' );
				contents.style.padding = '0px';
				contents.innerHTML = '<div class="cover bg-color-blue"></div><iframe src="'+ Meny.getQuery().u +'" style="width: 100%; height: 100%; border: 0; position: absolute;"></iframe>';
			}
		</script>
-->
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
         

	<!-- AnythingSlider -->
	



</head>
    <body>
<div class="page">
        <div class="nav-bar">
            <div class="nav-bar-inner padding10 bg-color-green">
                <span class="element brand ">
            Salesman.cl <small>(beta)</small>
        </span>
            </div>
        </div>
    </div>
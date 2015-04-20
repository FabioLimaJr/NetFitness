<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Netfitness</title>
<meta charset="UTF-8">
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<link href='http://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="css/jsDatePick_ltr.min.css" />
    
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="css/ie7.css" media="all">
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/ie8.css" media="all">
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="css/ie9.css" media="all">
<![endif]-->

<?php date_default_timezone_set('America/Recife'); ?>

<script src="js/jquery-1.6.4.min.js"></script>
<script src="js/ddsmoothmenu.js"></script>
<script src="js/jquery.jcarousel.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/carousel.js"></script>
<script src="js/jquery.flexslider-min.js"></script>
<script src="js/jquery.masonry.min.js"></script>
<script src="js/jquery.slickforms.js"></script>


<script type="text/javascript" src="js/jsDatePick.full.1.3.js"></script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"dataPicked",
			dateFormat:"%d-%m-%Y",
			selectedDate:{				
				day:<?php echo date("d")?>,						
				month:<?php echo date("m")?>,
				year:<?php echo date("Y")?>
			},
			yearsRange:[1900,2050],
			limitToToday:false,
			cellColorScheme:"aqua",
			weekStartDay:0
		});
	};
</script>

</head>



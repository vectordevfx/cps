<?php
// Created by https://www.webdevtec.com/
// Github @ https://github.com/vectordevfx/

// calculate your website performance optimisation
// json created with the help @ https://www.json-generator.com/

// include our functions
include 'include/functions.php';

// get data 
$string = file_get_contents("include/data.json");

// decode to array
$json = json_decode($string, true);

// initate counters
$totalCounter = 0;
$totalValueCounter = 0;

// initiate array
// used to convert alphabet chars to their value
$arrayAlpha['A+'] = 100;
$arrayAlpha['A'] = 80;
$arrayAlpha['B'] = 60;
$arrayAlpha['C'] = 40;
$arrayAlpha['D'] = 20;
$arrayAlpha['E'] = 0;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CPS - Calculate Performance Score</title>
	<link rel="shortcut icon" href="favicon_light.ico" type="image/x-icon">	
	<link rel="icon" href="favicon_light.ico" type="image/x-icon">
    <!-- Bootstrap, Bloated -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <!-- -Custom stylesheet 
	<link rel="stylesheet" href="css/custom.css">-->
	<!-- -Custom stylesheet minified -->
	<link rel="stylesheet" href="css/custom.min.css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<!-- Place this tag in your head or just before your close body tag. -->
	<script async defer src="https://buttons.github.io/buttons.js"></script>
  </head>
  <body> 
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img alt="Brand" src="images/cps-logo.png" style="max-width:20px;max-height:20px;">
      </a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
		<li><a href="https://www.webdevtec.com/projects/cps" target="_blank">Documentation</a></li>
        <li><a href="https://github.com/vectordevfx/cps" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Open new tab" class="custom-tooltip"><span class=" glyphicon glyphicon-link " aria-hidden="true"></span> Github</a></li>
		<li><a href="https://www.webdevtec.com" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Open new tab" class="custom-tooltip"><span class=" glyphicon glyphicon-link " aria-hidden="true"></span> Webdevtec</a></li>
	  </ul>
      <ul class="nav navbar-nav navbar-right">
		<li><a href="#" id="themeSwitchLight" style="display:none;">Light Theme</a></li>
		<li><a href="#" id="themeSwitchDark">Dark Theme</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid">
	<div class="row">
		<img src="images/cps-logo.png" class="img-responsive center-block" alt="logo">
		<div class="col-md-12 text-center">
			<h1>Your Calculated Performance Score</h1>
		</div>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="progress" style="min-height:35px;">
							<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo calculateOverallScore($json,$arrayAlpha);?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo calculateOverallScore($json,$arrayAlpha);?>%">
							<span class="sr-only"><?php echo calculateOverallScore($json,$arrayAlpha);?>% Complete (success)</span>
							</div>
							</div>
							<h2 class="text-uppercase text-center">You Scored <?php echo calculateOverallScore($json,$arrayAlpha);?>%</h2>
						</div>
					</div>
					<div class="col-md-3 fix-mob">
							<h2>Rating Overview</h2>
							<hr>
							<div class="panel panel-default">
							<div class="panel-body">
							<ul class="list-group">
							<?php $arrayBarRating = nameTitles($json,$arrayAlpha); ?>
							</ul>
							<p class="progress-bar-caption">Take a look at your percentages*</p>
							<div class="progress">
							<div class="progress-bar progress-bar-success" style="width: <?php echo $arrayBarRating['success'];?>%" data-toggle="tooltip" data-placement="bottom" title="<?php echo $arrayBarRating['success'];?>%">
							<span class="sr-only"><?php echo $arrayBarRating['success'];?>% Complete (success)</span>
							</div>
							<div class="progress-bar progress-bar-primary" style="width: <?php echo $arrayBarRating['primary'];?>%" data-toggle="tooltip" data-placement="bottom" title="<?php echo $arrayBarRating['primary'];?>%">
							<span class="sr-only"><?php echo $arrayBarRating['primary'];?>% Complete (primary)</span>
							</div>
							<div class="progress-bar progress-bar-info" style="width: <?php echo $arrayBarRating['info'];?>%" data-toggle="tooltip" data-placement="bottom" title="<?php echo $arrayBarRating['info'];?>%">
							<span class="sr-only"><?php echo $arrayBarRating['info'];?>% Complete (info)</span>
							</div>
							<div class="progress-bar progress-bar-default" style="width: <?php echo $arrayBarRating['default'];?>%" data-toggle="tooltip" data-placement="bottom" title="<?php echo $arrayBarRating['default'];?>%">
							<span class="sr-only"><?php echo $arrayBarRating['default'];?>% Complete (warning)</span>
							</div>											
							<div class="progress-bar progress-bar-warning" style="width: <?php echo $arrayBarRating['warning'];?>%" data-toggle="tooltip" data-placement="bottom" title="<?php echo $arrayBarRating['warning'];?>%">
							<span class="sr-only"><?php echo $arrayBarRating['warning'];?>% Complete (warning)</span>
							</div>
							<div class="progress-bar progress-bar-danger" style="width: <?php echo $arrayBarRating['danger'];?>%" data-toggle="tooltip" data-placement="bottom" title="<?php echo $arrayBarRating['danger'];?>%">
							<span class="sr-only"><?php echo $arrayBarRating['danger'];?>% Complete (danger)</span>
							</div>
							</div>
							<span style="font-size:10px;">*Does not include deactivated service providers.</span>
							</div>
							</div>					
					</div>
					<div class="col-md-3">
						<h2>Active Status</h2>
						<hr>
						<div class="panel panel-default">
						<div class="panel-body">
						<ul class="list-group">
						<?php $result = checkActiveStatus($json); ?>
						</ul>	
						<p class="progress-bar-caption"><?php echo $result['resultText']; ?> Activated</p>
						<div class="progress">
						<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $result['progressBar'] ; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $result['progressBar'] ; ?>%;">
						<?php echo $result['progressBar'] ; ?>%
						</div>
						</div>
						</div>
						</div>						
					</div>
					<div class="col-md-3 fix-mob">
						<h2>Score Breakdown</h2>
						<hr>
						<div class="panel panel-default">
						<div class="panel-body">
						<ul class="list-group">
						<?php $result = fetchScores($json,$arrayAlpha); ?>
						</ul>	
						<p class="progress-bar-caption"><?php echo $result['resultText']; ?> Points*</p>
						<div class="progress">
						<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $result['progressBar'] ; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $result['progressBar'] ; ?>%;">
						<?php echo $result['progressBar'] ; ?>%
						</div>
						</div>
						<span style="font-size:10px;">*Does not include deactivated service providers.</span>
						</div>
						</div>
					</div>				
					<div class="col-md-3 fix-mob">
						<h2>Github</h2>
						<hr>						
						<!-- Place this tag where you want the button to render. -->
						<a class="github-button" href="https://github.com/vectordevfx" data-size="large" aria-label="Follow @vectordevfx on GitHub">Follow @vectordevfx</a>
						<!-- Place this tag where you want the button to render. -->
						<a class="github-button" href="https://github.com/vectordevfx/cps/subscription" data-icon="octicon-eye" data-size="large" aria-label="Watch vectordevfx/cps on GitHub">Watch</a>				
						<!-- Place this tag where you want the button to render. -->
						<a class="github-button" href="https://github.com/vectordevfx/cps" data-icon="octicon-star" data-size="large" aria-label="Star vectordevfx/cps on GitHub">Star</a>					
						<!-- Place this tag where you want the button to render. -->
						<a class="github-button" href="https://github.com/vectordevfx/cps/fork" data-icon="octicon-repo-forked" data-size="large" aria-label="Fork vectordevfx/cps on GitHub">Fork</a>					
						<!-- Place this tag where you want the button to render. -->
						<a class="github-button" href="https://github.com/vectordevfx/cps/issues" data-icon="octicon-issue-opened" data-size="large" aria-label="Issue vectordevfx/cps on GitHub">Issue</a>
						<!-- Place this tag where you want the button to render. -->
						<a class="github-button" href="https://github.com/vectordevfx/cps/archive/master.zip" data-icon="octicon-cloud-download" data-size="large" aria-label="Download vectordevfx/cps on GitHub">Download</a>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h2 class="text-center">Service Providers</h2>
			<hr>
			<div class="panel panel-default">
			<div class="panel-body">
			<?php overviewData($json); ?>
			</div>
			</div>
		</div>
	</div>	
	<div class="col-md-12 text-center" id="footer">
		<p>You can find this project on Github @ <a href="https://github.com/vectordevfx/" target="_blank">vectordevfx</a><br>Designed and built by <a href="https://www.webdevtec.com">Webdevtec</a><br>CPS (Calculate Performance Score) version 1.0. Released under the MIT License.<br></p><p class="text-muted small">W3C HTML Valid, W3C CSS Valid, Javascript JSHint Valid</p>
	</div><!-- /. col -->
</div> <!-- /. container-fluid -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins), Bloated -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed, Bloated -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script> 
<script>
// The following code provides a straightforward theme switch solution
// Validated @ jshint.com
$( document ).ready(function() {
	"use strict";
	// display console message when document is ready
    console.log( "ready!" );	
	// Dark Theme Switch
	// If the user pressed the id-button we make our adjustments 
	$( "#themeSwitchDark" ).click(function() {
		//here we set our css
		$("body").css("background-color", "black");
		$("body").css("color", "#636363");
		$("h1").css("color", "grey");
		$("h2").css("color", "grey");
		$("h3").css("color", "grey");
		$(".panel").css("background-color", "#212121");	
		$(".list-group-item").css("background-color", "black");	
		$(".progress-bar-caption").css("color", "grey");
		$(".glyphicon-ok").css("color", "lightgreen");
		$(".panel-default").css("border-color", "#484848");
		// here we add a class to our navbar (Bootstrap class)
		$(".navbar").addClass("navbar-inverse");
		// here hide our clicked button, and show our other theme button
		$("#themeSwitchDark").hide();
		$("#themeSwitchLight").show();
		// display console message after processing
		console.log( "Dark theme set!" );
	});		
	// Our Light Theme Switch
	// If the user pressed the id-button we make our adjustments 
	$( "#themeSwitchLight" ).click(function() {
		//here we set our css
		$("body").css("background-color", "white");
		$("body").css("color", "black");
		$("h1").css("color", "black");
		$("h2").css("color", "black");
		$("h3").css("color", "black");
		$(".panel").css("background-color", "white");	
		$(".list-group-item").css("background-color", "white");	
		$(".progress-bar-caption").css("color", "black");
		$(".glyphicon-ok").css("color", "green");
		$(".panel-default").css("border-color", "#ddd");
		// here we remove a class from our navbar (Bootstrap class)
		$(".navbar").removeClass("navbar-inverse");
		// here hide our clicked button, and show our other theme button
		$("#themeSwitchLight").hide();
		$("#themeSwitchDark").show();
		// display console message after processing
	  console.log( "Light theme set!" );
	});	
	// initialize all tooltips
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
});
</script>	
 </body>
</html>
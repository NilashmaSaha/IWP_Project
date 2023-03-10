<!DOCTYPE html>
<html>

<head>
    <title>IWP Project</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#f25e5e"/>
	<meta name="keywords" content="JavaScript,OCR,DBSCAN,Clustering,Image Processing,Text Recognition,Classification">
	<meta name="author" content="Barry Li">
	<meta name="description" content="Extract text regions in an image">
	<link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
	<link rel="manifest" href="manifest.webmanifest">

	<!-- Css -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
	
	
	<!-- Javascripts -->
	<script src="src/tether.min.js"></script>
    <script src="src/jquery.min.js"></script>
    <script src="src/jquery.mousewheel.min.js"></script>
	<script src="src/bootstrap.min.js"></script>
    <script src="src/path.min.js"></script>
    <script src="src/jquery.scrollto.min.js"></script>
	<script src="src/ITSegmenter.js"></script>
	<script src="src/dbscan.js"></script>
</head>

<body>
	<div id="layout">
		<a href="#sbar" id="sidebarTog" class="sidebar-tog">
			<span></span>
		</a>
		<!-- Side Bar -->
		<div id="sbar" class="sidebar">
			<a href="index.php" id="sidebar-title">
				<img src="img/logoInverted.png">
				<div>HomePage</div>
			</a>
			<p class="sidebar-headings">DOCUMENTATIONS</p>
			<a href="docs.html#/intro">Introduction</a>
			<a href="docs.html#/segImg">ITSegmenter</a>
			<a href="docs.html#/usm">Unsharp Masking</a>
			<a href="docs.html#/fast">FAST</a>
			<a href="docs.html#/kdTree">K-D Tree</a>
			<a href="docs.html#/dbscan">DBSCAN</a>
			<p class="sidebar-headings">Test</p>
			<a href="dbscan.php">DBSCAN</a>
			<a href="yourimage.php">Auto Crop</a>
			<a href="yourimage1.php">Your Image</a>
	
		</div>
	

		<!-- Content Container -->
		<div class="container" id="main-container">
			<div class="main-headings" id="intro">
				<h2>DBSCAN</h2>
				<div class="content"> </div>
			</div>
			
			<div class="main-content">
				This demo illustrates the DBSCAN function of ITSegmenter.js. It identifies and group clusters of points based on the parameters provided. <br> <br> <br>
				<div class="row">
					<div class="column">
						<div class="rowItem">
							<canvas class="canvasDisplay" id="demo-canvas1" onclick="canvasSelect('1');"></canvas>
						</div>
						<div id="demo1Param"></div> <br>
						<div id="demo11Param"></div>
						<input type="radio" name="canvasSelection" id="radioDemo1" value="1">
					</div>
					<div class="column">
						<div class="rowItem">
							<canvas class="canvasDisplay" id="demo-canvas2" onclick="canvasSelect('2');"></canvas>
						</div>
						<div id="demo2Param"></div> <br>
						<div id="demo22Param"></div>
						<input type="radio" name="canvasSelection" id="radioDemo2" value="2">
					</div>
					<div class="column">
						<div class="rowItem">
							<canvas class="canvasDisplay" id="demo-canvas3" onclick="canvasSelect('3');"></canvas>
						</div>
						<div id="demo3Param"></div> <br>
						<div id="demo33Param"></div>
						<input type="radio" name="canvasSelection" id="radioDemo3" value="3">
					</div>
				</div>
				 <br> <br>
				 
				<canvas id="dbscan-canvas" style="border:1px solid #000000;"></canvas> <br> <br>
				
				<form>
					<a class="btn btn-primary" id="paramBut" data-toggle="collapse" href="#formCollapse" role="button" aria-expanded="false" aria-controls="formCollapse">
						Parameters
					</a>
					
					<div class="collapse" id="formCollapse">
						<div class="form-group">
							<label for="thresh"><strong>Thresh:</strong></label>
							<input type="text" class="form-control" id="thresh" placeholder="60">
							<small class="form-text text-muted">Threshhold for FAST (Features from Accelerated Segment Test) corner detection</small>
						</div>
						<div class="form-group">
							<label for="eps"><strong>Episilon:</strong></label>
							<input type="text" class="form-control" id="eps" placeholder="15">
							<small class="form-text text-muted">Episilon is the maximum distance that 2 points can form a cluster</small>
						</div>
						<div class="form-group">
							<label for="minPts"><strong>Min Points:</strong></label>
							<input type="text" class="form-control" id="minPts" placeholder="5">
							<small class="form-text text-muted">Minimum # of points required to form a cluster</small>
						</div>					
						<div class="form-group">
							<label for="dia"><strong>Diameter(USM):</strong></label>
							<input type="text" class="form-control" id="dia" placeholder="10">
							<small class="form-text text-muted">Diameter parameter for Gaussian blur, must be greater than 1</small>
						</div>
						<div class="form-group">
							<label for="amt"><strong>Amount(USM):</strong></label>
							<input type="text" class="form-control" id="amt" placeholder="1">
							<small class="form-text text-muted">Scalar for unsharp masking, affects the strength of the USM filter</small>
						</div>	
					</div>
					<span class="button" id="submitButton" onclick="submitData();">Submit</span>
				</form>
						
			</div>
			
		</div>
	</div>
	
</body>

<footer>
	<script src="src\main.js"></script>
</footer>

</html>

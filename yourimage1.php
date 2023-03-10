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
	<link rel="stylesheet" type="text/css" href="css/yourimage.css">
	
	
	<!-- Javascripts -->
	<script src="src/tether.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="src/jquery.min.js"></script>
    <script src="src/jquery.mousewheel.min.js"></script>
	<script src="src/bootstrap.min.js"></script>
    <script src="src/path.min.js"></script>
    <script src="src/jquery.scrollto.min.js"></script>
	<script src="src/ITSegmenter.js"></script>
	<script type="text/javascript">
		function CheckDimension() {
			//e.preventDefault();
		var fileUpload = document.getElementById("customFile");

						
		var reader = new FileReader();
		reader.readAsDataURL(fileUpload.files[0]);
		reader.onload = function (e) {
			var image = new Image();
							
			image.src = e.target.result;

			image.onload = function () {
				var height = this.height;
				var width = this.width;
				if(height === 244 && width === 498){
				document.getElementById("validation").innerHTML = "<h1>correct</h1>";
				swal("Congrats!", "Your document is original!", "success");
				}else{
					document.getElementById("validation").innerHTML = "<h1>incorrect</h1>";
					swal("Oops!", "Your document is not original!", "error");
				}
												
				return true;
				}; 
			} 
		}
		</script>
</head>

<body>
	<div id="top"></div>
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
            <br>
			<p class="sidebar-headings">Documentation</p>
            <br>
			<a href="docs.html#/intro">Introduction</a>
			<a href="docs.html#/segImg">ITSegmenter</a>
			<a href="docs.html#/usm">Unsharp Masking</a>
			<a href="docs.html#/fast">FAST</a>
			<a href="docs.html#/kdTree">K-D Tree</a>
			<a href="docs.html#/dbscan">DBSCAN</a>
            <br>
            <br>
            <br>
			<p class="sidebar-headings">Test</p>
			<a href="dbscan.php">DBSCAN</a>
			<a href="yourimage.php">Auto Crop</a>
			<a href="yourimage1.php">Your Image</a>
			
		</div>
		
		<!-- Content Container -->
		<div class="container" id="main-container">
			<div class="main-headings" id="intro">
				<h2>Your Image</h2>
				<div class="content"> </div>
			</div>
			
			<div class="main-content">
				This demo allows you to upload your own image and experiment with the parameters. <br> <br>
				<canvas id="demo-canvas"></canvas>
				<p id="imgDim" style="text-align:center"><p><br> <br>
				
					<form>
						<div class="slider-container">
							<p style="display:none;" class="slider-text">Default parameters are tuned for images with 1000px by 1000px</p>
							<p style="display:none;" class="slider-text">Adjust slider to change image resolution </p>
							<input type="range" min="0.1" max="2.1" step="0.1" value="1.0" class="range-slider" id="scaleRangeSlider" style="display:none;"></input>
							<p id="sliderOutput"></p> <br> <br>
						</div>
					
						<a class="btn btn-primary" id="paramBut" data-toggle="collapse" href="#formCollapse" role="button" aria-expanded="false" aria-controls="formCollapse">
							Parameters
						</a>
					
						<div class="row">
							<div class="col">
								<div class="form-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="customFile" accept=".png,.jpg,.jpeg,.jfif,.exif,.tiff,.gif,.bmp,.exif,.bpg,.svg,.dwg,.img,.heif,.hdr,.ppm,.pgm,.pbm,.pnm" id="imagefile" class="form-control-file" onchange="encodeImageFileAsURL(this)"></input>
										<label class="custom-file-label" id="customFileLabel" for="customFile">Choose Image</label>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="cropCheck">
									<label class="form-check-label" for="cropCheck">
									
									</label>
								</div>
							</div>
						</div>
						
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
						<span class="button" id="submitButton" onclick="submitData(), CheckDimension()">Submit</span>
						
					</form>
				
			</div>
			
		</div>
	</div>
	<center><div id="validation"></div></center>

</body>

<footer>
	<script src="src/main.js"></script>
	<script src="src/yourimage.js"></script>
</footer>

</html>
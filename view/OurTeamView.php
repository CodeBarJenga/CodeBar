<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!--<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<meta name="description" content="">
		<meta name="author" content="LENOVO">-->

		<title>CodeBar Team</title>
		<?php
		include 'depend.php';
		?>
	</head>

	<body >
		<div  class="container-fluid">
			<div class="row"  >
				<?php
				include 'header.php';
				?>
			</div>

			<div class="row">
				<div class="col-md-4 col-md-offset-5">
					<div class="row">
						<img class ="img-circle" src="images/GanpatSir.jpg" height="200" width="200" >
						<h4> Mr.Ganpat Singh Chauhan, <small class="text-muted">Mentor and Visionary</small></h4>
					</div>
				</div>
				<div class="col-md-3">

				</div>
				
			</div>
			<div class="row">
				<div class="col-md-2 col-md-offset-1">
					<img class ="img-circle" src="images/nitin.jpg" height="200" width="200">
					<h4 align="center">Nitin Pamnani</h4>
				</div>
				<div class="col-md-2 ">
					<img class ="img-circle" src="images/prateek.jpg" height="200" width="200">
					<h4 align="center">Prateek Singh Chauhan</h4>
				</div>
				<div class="col-md-2 ">
					<img class ="img-circle" src="images/shiv.jpg" height="200" width="200">
					<h4 align="center">Shivesh Kumar Yadav</h4>
				</div>
				<div class="col-md-2 ">
					<img class ="img-circle" src="images/pratap.jpg" height="200" width="200">
					<h4 align="center">Pratap Singh Ranawat</h4>
				</div>
				<div class="col-md-2">
					<img class ="img-circle" src="images/sanjay.jpeg" height="200" width="200">
					<h4 align="center">Sanjay Sharma,  <small class="text-muted">On-site coordinator</small></h4>
				</div>
			</div>

			<div class="row">
				<div class="container-fluid">
					<?php
					include 'footer.php';
					?>
				</div>
			</div>

		</div>
		<!--fluid container div ends-->
	</body>
</html>
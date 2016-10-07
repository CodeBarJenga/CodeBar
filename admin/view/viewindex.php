<!DOCTYPE html>
<html lang="en">
	<head>
		<!--<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<meta name="description" content="">
		<meta name="author" content="LENOVO">-->
		<title>CodeBar-Home</title>
		<?php
		include 'depend.php';
		?>
	</head>

	<body >
		<!--GETTING STARTED modal || Removed tabindex="-1" to disable the escape key -->
		<div class="modal fade" id="myModal" tabindex=""  >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">

						<h1 class="modal-title text-center" id="myModalLabel">Welcome to CodeBar</h1>
					</div>
					<div class="modal-body">
						<img src="images/2.jpg" width=100% height=auto>
					</div>
					<div class="modal-footer">

						<button type="button" id="getstartedbtn" class=" btn btn-success btn-lg center-block" name="begin" data-dismiss="modal">
							Click here to Get Started !!!
						</button>

					</div>
				</div>
			</div>
		</div>
		<!--END MODAL-->

		<div  class="container-fluid">

			<div class="row"  >
				<?php
				include 'header.php';
				?>
			</div>

			<!--second div-->
			<div class="row">
				<div class="col-md-2">

				</div>
				<div class="col-md-8">
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
							<li data-target="#carousel-example-generic" data-slide-to="1"></li>
							<li data-target="#carousel-example-generic" data-slide-to="2"></li>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">
							<div class="item active">
								<img src="images/cc1.png" alt="..." >
								<div class="carousel-caption">

								</div>
							</div>

							<div class="item">
								<img src="images/cc2.jpg" alt="...">
								<div class="carousel-caption">

								</div>
							</div>
							<div class="item">
								<img src="images/cc3.png" alt="...">
								<div class="carousel-caption">

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-2">

				</div>
			</div>

			<div class="row">
				<div class="col-md-2">

				</div>
				<div class="col-mod-8 col-md-offset-2">
					<div class="quote-padding" style="padding:15px;">
						<blockquote class="blockquote-rverse">
							<p>
								Think twice, code once.
							</p>
							<footer>
								Someone famous in <cite title="Source Title">Computer Science</cite>
							</footer>
						</blockquote>
					</div>
				</div>
				<div class="col-mod-2">

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
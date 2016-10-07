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
		<!-- Modal for Invalidate user-->
		<?php if($err==1){?>
			<div class="modal fade bs-example-modal-sm " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" name="messages" id="invalidate">
			<div class="modal-dialog modal-sm alert alert-danger">
				Wrong username or password
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="modal" data-target="#invalidate">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
		<script>
				$('#invalidate').modal('show');
		</script>
		<!--Invalidate user modal ends-->
		<?php } else {?>
		<div class="modal fade" id="myModal" tabindex="-1" data-backdrop="static" data-keyboard="false" >
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
		<?php }?>
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
					<div class="container-fluid">
						<!-- present contest -->
						<div class="panel panel-info">
						<div class="panel-heading">
							Present Contests
						</div>
					
							<table class="table table-striped table-hover">
									<tbody>
										<?php for($i=0; $i<count($presentcontest); $i++)
											{?>
										<tr>
										<td align="center"><?php echo $presentcontest[$i]['contestname']; ?></td>
										</tr>
										<?php } ?>
			
									</tbody>
								</table>
					
					</div>
					<!-- future contest -->
					<div class="panel panel-warning">
						<div class="panel-heading">
							Future Contests
						</div>
					
								<table class="table table-striped table-hover">
									<tbody>
										<?php for($i=0; $i<count($futurecontest); $i++)
											{?>
										<tr>
										<td align="center"><?php echo $futurecontest[$i]['contestname']; ?></td>
										</tr>
										<?php } ?>
			
									</tbody>
								</table>
					
					</div>
					<!-- past contest -->
					<div class="panel panel-success">
						<div class="panel-heading">
							Past Contests
						</div>
						
											<table class="table table-striped table-hover">
									<tbody>
										<?php for($i=0; $i<count($pastcontest); $i++)
											{?>
										<tr>
										<td align="center"><?php echo $pastcontest[$i]['contestname']; ?></td>
										</tr>
										<?php } ?>
			
									</tbody>
								</table>
					
					</div>
					</div>
				</div>
				
				<div class="col-md-8">
					<div class="container-fluid">
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
								<img style="height:300px" src="images/cc1.png" alt="..." >
								<div class="carousel-caption">

								</div>
							</div>

							<div class="item">
								<img style="height:300px" src="images/cc2.jpg" alt="...">
								<div class="carousel-caption">

								</div>
							</div>
							<div class="item">
								<img style="height:300px" src="images/cc3.png" alt="...">
								<div class="carousel-caption">

								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				<div class="col-md-2">
					<div class="container-fluid">
                          <div> <!-- for timer fo UpComing Event-->
           				 <div align="center">
          			 	  <p><strong>UpComing Contest</strong></p>
          			 	  <p><?php echo $upComingTime['contestname']; ?></p>
        				  <div id="timer" style="height: 50px;background-color: white;border: 0px"></div>
    					 </div>
                    </div>
                    </div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-2">

				</div>
				<div class="col-mod-8 col-md-offset-2">
			      <div class="container-fluid">
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
		<!--script for timer-->
		<script>
	    	var sec = '<?php echo ( $upComingTime['stampst'] - time()-16200 );?>';
			$('#timer').countdown({until: +sec,padZeroes: true,format: 'dHMS'});
		</script>
	</body>
</html>
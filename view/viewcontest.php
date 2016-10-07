<?php
$page = $_SERVER['PHP_SELF'];
$sec="200";
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
		<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
		<title>CodeBar-Home</title>
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
            <!--creating new row for navigation map-->
            <div class="row">
            	<div class="container-fluid" style="padding-bottom:10px; margin-left: 10px;">
            	<a href="user.php">User Dashboard</a>&nbsp;>>&nbsp;<a href="contest.php"><?php echo $_SESSION['contest'];?></a>
            	</div>
            </div>
			

			<!--second div-->
			<div class="row">
				<div class="col-md-2">
					
						<div class="panel panel-info">
							<div class="panel-heading" align="center">
								Your Guide
							</div>

							<table class="table table-striped table-hover">
								<tr>
									<td align="center"><a href="#" data-toggle="modal" data-target="#rulesnreg">Rules and Regulations</a></td>
								</tr>
								<tr>
									<td align="center">Announcements</td>
								</tr>
							</table>

						</div>
					
				</div>
				<div class="col-md-8">
                         <div>
                         	<div>
                         		<table class="table table-striped table-hover">
  										<thead>
  											<tr bgcolor="DodgerBlue">
  												<th>#</th>
  												<th>Problem Code</th>
  												<th>Problem Name</th>
  												<th>Difficulty Level</th>
  											<!--	<th>Submitted/Tried</th> -->
  												<th>Point</th>
  											</tr>
  										</thead>
  										<tbody>
  										<?php for($i=0; $i<count($result); $i++)
										  {?>	
  											<tr>
  												<td><?php echo($i + 1); ?></td>
  												<td><a href="solve.php?problemCode=<?php echo $result[$i]['problemcode'] ?>"><?php echo $result[$i]['problemcode']; ?></a></td>
  												<td><a href="solve.php?problemCode=<?php echo $result[$i]['problemcode'] ?>"><?php echo $result[$i]['problemhead']; ?></a></td>
  												<td><?php echo $result[$i]['problemdiff']; ?></td>
  												<td><?php echo $result[$i]['points']; ?></td>
  												
												
  											</tr>
  											<?php } ?>
  										</tbody>
									</table>
								
                         	</div>                         	
                         </div> 
				</div>
				<div class="col-md-2">
					<div>
           				 <div align="center">
          			 	  <p><strong>Contest Ends In:</strong></p>
        				  <div id="timer" style="height: 50px;background-color: white;border: 0px"></div>
    					 </div>
                    </div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-2">

				</div>
				<div class="col-mod-8 col-md-offset-2">
					
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
		<!--script for count down-->	
	<script>
	    var sec = '<?php echo ( $getTime[0]['stampend'] - time()-16200 );?>';
		$('#timer').countdown({until: +sec,padZeroes: true,format: 'dHMS'});
	</script>
	</body>
</html>
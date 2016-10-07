<?php 
//session_start();

//echo $_SESSION['temp']; 
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>CodeBar-Evaluation</title>
		<?php include 'depend.php'
		?>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row"  >
				<?php
				include 'header.php';
				?>
			</div>
			
			<!--navigation map -->
			<div class="row">
            	<div class="container-fluid" style="padding-bottom:10px; margin-left: 10px;">
            	<a href="user.php">User Dashboard</a>&nbsp;>>&nbsp;<a href="contest.php"><?php echo $_SESSION['contest'];?></a>&nbsp;&nbsp;>>&nbsp;<a href="editor.php">Editor</a>
            	</div>
            </div>

			<!--second div-->
			<!--<?php echo $_SESSION['solpath'];?>-->
			<!-- Status Modal-->
			<div class="modal fade bs-example-modal-sm " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" name="messages" id="loginsuccessmsg">
				<div class="modal-dialog modal-sm alert <?php echo $_SESSION['class']; ?>">

					<?php echo $_SESSION['message']; ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="modal" data-target="#loginsuccessmsg">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
			<!-- Status Modal Ends -->
             
			<?php 
			$status=$_SESSION['status'];
			if($_SESSION['status']>=0){
				
			?>
			<script>
				$('#loginsuccessmsg').modal('show');
			</script>
			<?php 
			$_SESSION['status']=-1;
				
			} ?>

			<div class="row ">
				<div class="container-fluid">
					<div class="col-md-2"></div>

					<div class="col-md-8">
						<?php
							if($_SESSION['message'] == "Compile Time Error :("){ 
						?>
						<div class="form-group">
						<textarea class="form-control" rows="5" readonly>
							<?php echo "\r\n"; echo $_SESSION['contents']; ?>
						</textarea>
						</div>
						<?php } ?>
						<table class="table table-hover">
  							<thead>
								<tr bgcolor="DodgerBlue">
									<th>#</th>
									<th>Contest Name</th>
									<th>Problem Code</th>
									<th>Username</th>
									<th>Status</th>
								</tr>
							</thead>
  							<tbody>
							<?php for($i=0; $i<count($res); $i++)
							{?>	
  							<tr
  								<?php if($res[$i]['status']=='Wrong Answer'){?> 
  								bgcolor="Tomato"
  								<?php } else if($res[$i]['status']=='Compile Time Error') { ?> 
								bgcolor="PowderBlue"
								<?php }  else if($res[$i]['status']=='Time Limit Exceeded'){ ?>
							    bgcolor="Khaki" 
								<?php }  else if($res[$i]['status']=='Problem Solved'){ ?>
							 	 bgcolor="LightGreen"
								 <?php } ?> 
							 >
  							<td><a   data-toggle="modal" href="#myModal">
							<?php echo($i + 1); ?></a>
							</td>
  							<td><a href="contest.php"><?php echo $res[$i]['contestname']; ?></a></td>
  							<td><a href="solve.php?problemCode=<?php echo $res[$i]['probcode'] ?>"><?php echo $res[$i]['probcode']; ?></a></td>
  							<td><?php echo $res[$i]['username']; ?></td>					
  							<td><?php echo $res[$i]['status']; ?></td>															
  						</tr>
  						<?php } ?>
 							</tbody>
				</table>
					</div>
			
			<div class="row">
				<?php
				include 'footer.php';
				?>
			</div>
		</div>
	</body>
</html>
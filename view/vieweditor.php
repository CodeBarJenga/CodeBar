
<!DOCTYPE HTML>
<html>
	<head>
	
		<title>CodeBar</title>
		<?php
		include 'depend.php';
		?>
		<style>
			#hed{
				height:40px;
				border: 2px;
				border-color: white;
				background: white;
				border-style:solid;
				width: 104%; 
			}
		</style>
	</head>
	<body>
		<!-- <?php echo $_SESSION['problem'];?> -->
		<div class="container-fluid">
			<div class="row">
				<?php include 'header.php'
				?>
			</div>
		</div>
		
					<!-- Status Modal-->
			<div class="modal fade bs-example-modal-sm " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" name="messages" id="loginsuccessmsg" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog modal-sm alert <?php echo @$_SESSION['class']; ?>">

					<?php echo @$_SESSION['message']; ?>
					<button type="button" id="first" class="close" data-dismiss="alert" aria-label="Close" data-toggle="modal" data-target="#loginsuccessmsg">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
			<!-- Status Modal Ends -->
             
			<?php 
			$status=@$_SESSION['status'];
			if(@$_SESSION['status']>0){
				
			?>
			<script>
				$('#loginsuccessmsg').modal('show');
				$("#first").click(function() {
				    $('html,body').animate({	
       					 scrollTop: $("#second").offset().top},
        					'slow');
					});
			</script>
			<?php $_SESSION['status'] = -1;

				}
 ?>
 
		<div class="container-fluid">
			<!--navigation map -->
			<div class="row">
            	<div class="container-fluid" style="padding-bottom:10px; margin-left: 10px;">
            	<a href="user.php">User Dashboard</a>&nbsp;>>&nbsp;<a href="contest.php"><?php echo $_SESSION['contest'];?></a>
            	</div>
            </div>

			<!--second div-->
			<div class="row">
				<div class="col-sm-2">

				</div>
				<div class="col-sm-8">
					<div class="container-fluid">
						<form class="form-horizontal" name="form1" method="post" action="">
							<div class="form-group">
								<label for="inputDifficulty" class=" control-label">Select Language</label>
								<div class="col-sm-3">
									<select class="form-control" id="mode" name="lang" >
										<option value="c" id="c" <?php if(@$_SESSION['lang_code']=='c') echo'selected'; ?> >C</option>
										<option value="cpp" id="cpp" <?php if(@$_SESSION['lang_code']=='cpp') echo'selected'; ?>  >C++</option>
										<option value="java" id="Java" <?php if(@$_SESSION['lang_code']=='java') echo'selected'; ?> >Java</option>
										<!--<option value="py" id="Java">Python</option>-->
									</select>
								</div>
								
							</div>
							<div class="form-group">
								<textarea name="code" id="code" hidden></textarea>
							</div>
							<div class="form-group">
								<div class="panell panel-default">
									<div class="panel-heading">
										<h3 class="panel-title">Write your code here for <?php echo $_SESSION['problem']; ?></h3>
									</div>
									<div class="panel-body">

										<div id="editor" name="editor" style="height: 300px "><?php echo htmlspecialchars(@$_SESSION[$_SESSION['problem'].'code']); ?></div>

									</div>
								</div>
							</div>
							<div class="col-sm-offset-4">
								<button type="submit" class="btn btn-info"  id="compilecode" name="ctsubmit">
								Compile and test
							    </button>
														
								<button  type="submit" class="btn btn-info"  id="submitcode" name="csubmit">
									Submit your code here
								</button>
							
								
								
                            </div>
                        </form>    	
                        				         			
					</div>		
							<!-- html code for wrong answer START-->
							</br>
							
					<div class="container-fluid">
			<!-- new edit start-->
							<?php
							if(@$status>0 && @$status!=2){ 

							?>
						<div class="panel panel-default" style="border-top-color: white" id="second">
						<!--	<div class="row panel panel-default" style="border-color: black;"id="hed">
										<h5 style="float:left;color:black;font-weight: bold;">Result </h5>
										<?php if($status==4) { ?>
										<h5 style="float:right; color:black;font-weight: bold;" ><?php  echo "Wrong Answer"; ?></h5> 
										 <?php } elseif($status==3) { ?>
										<h5 style="float:right; color:black;font-weight: bold;" ><?php  echo "Correct Answer"; ?></h5> 
										<?php } else if($status==1) {?>
											<h5 style="float:right; color:black;font-weight: bold;" ><?php  echo "Compile Time Error"; ?></h5>
											<?php  }?>
									
							</div> -->
							<div class="panel-title" style="border-color: white;"><h4>Result</h4></div>
							<div class="row">
							     <?php if($status==1) { ?>
						      			<div class="panel panel-default">
						      				<h5 class="panel-title"></h5>
							     	<div class="panel-heading"><strong >Compile Error</strong></div>
  									<div class="panel-body">
  										<textarea class="form-control"  rows="5" readonly>
												<?php echo "\r\n";
											echo $_SESSION['contents'];
											$_SESSION['message'] = "error";
						    
											?>
										</textarea>
  									</div>
  									</div>
										</div>
							
							
							        <?php } else { ?>
							      <div class="panel panel-default">
  									<div class="panel-heading"><strong>Sample Input</strong></div>
  									<div class="panel-body">
    								        <?php echo nl2br($problemattr[0]['sample_input']);?>
  									</div></div></br><div class="panel panel-default">
							          
									<div class="panel-heading"><strong>Sample Output</strong></div>
  									<div class="panel-body">
    										<?php echo nl2br($problemattr[0]['sample_output']);?>
  									</div></div></br><div class="panel panel-default">
  									
  									<div class="panel-heading"><strong>Your Output:&nbsp;&nbsp;Standard Output</strong></div>
  									<div class="panel-body">
    								<?php echo "\r\n";
											echo nl2br($_SESSION['contents']);
											$_SESSION['message'] = "error";
						    
											?>
  									</div>
  									</br>
  									</div>
  									</div>
  									<?php } ?>
									
									
									 
								</div>
							<?php   } $_SESSION['contents']=""; ?>
			<!-- new edit end -->
						
						
					</div>
							
							<!-- html code for wrong answer END -->
 
					<!--yaha pe ths-->
					
					
				</div>
			<div class="col-sm-2">
				<div>
						<div align="center">
							<p>
								<strong>Contest Ends In:</strong>
							</p>
							<div id="timer" style="height: 50px;background-color: white;border: 0px"></div>
						</div>
					</div>
			</div>
			</div>
		</div>
		<div class="row">
			<div class="container-fluid">
				<?php include 'footer.php'
				?>
			</div>
		</div>
				<!--script for count down-->	
	<script>
	    var sec = '<?php echo ( $getTime[0]['stampend'] - time()-16200 );?>';
		$('#timer').countdown({until: +sec,padZeroes: true,format: 'dHMS'});
	</script>
	</body>
</html>
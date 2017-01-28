<?php
$page = $_SERVER['PHP_SELF'];
$sec="200";
/*
 * 
 * 
 */
/* if($_GET['error']=='invalidate')
 {
 	$_SESSION['class']="alert-danger";
	$_SESSION['messages']="Wrong username or password";
 }*/
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
		<title>CodeBar</title>
		<?php
		include 'depend.php';
		?>
	</head>
	<body>
	
		<div class="modal fade bs-example-modal-sm " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" name="messages" id="loginsuccessmsg">
			<div class="modal-dialog modal-sm alert <?php echo $_SESSION['class']; ?>">

				<?php echo $_SESSION['messages']; ?>
				<!--<?php echo $_SESSION['debug'];?>-->
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="modal" data-target="#loginsuccessmsg">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
        

        
        
        
		<?php if(@$_SESSION['flag'] == NULL){
		?>
		<script>
			$('#loginsuccessmsg').modal('show');
		</script>
		<?php
		$_SESSION['flag']="NOT";
		} ?>
		<div class="container-fluid">
			<div class="row"  >
				<?php
				include 'header.php';
				?>
			</div>
			<div class="row ">
				<div class="container-fluid">
					<div class="col-md-2">
						<!--RULES AND REGULATIONS PANEL-->
					  <div class="panel panel-info">
						<div class="panel-heading" align="center">
							Your Guide
						</div>
					    
							<table class="table table-striped table-hover">
								<tr><td align="center" ><a href="#" data-toggle="modal" data-target="#rulesnreg">Rules and Regulations</a></td></tr>
								<tr><td align="center">Announcements</td></tr>
							</table>
					    
					</div>
					</div>
					
					<!--Tabbed Navigation of body-->

					<div class="col-md-8">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active" id="contesttab">
								<a href="#contestcontent" aria-controls="contesttab" data-toggle="tab">Contest</a>
							</li>
							<li role="presentation" id="submissiontab"  class="unactive" aria-controls="submissiontab" data-toggle="tab">
								<a href="#submissioncontent" aria-controls="submissiontab" data-toggle="tab">Submission History</a>
							</li>
							<li role="presentation" id="leadertab"  class="unactive" aria-controls="submissiontab" data-toggle="tab">
								<a href="#leaderboard" aria-controls="submissiontab" data-toggle="tab">Leaderboard</a>
							</li>
							<li role="presentation" id="problemarchivestab"  class="unactive" aria-controls="submissiontab" data-toggle="tab">
								<a href="#problemarchives" aria-controls="problemarchivestab" data-toggle="tab">Problem Archives</a>
							</li>
						</ul>
						<!-- Tab panes -->
						<!--CONTEST TAB PANE BEGINS-->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="contestcontent">&nbsp;
								<table class="table table-striped table-hover">
									<thead>
										<tr bgcolor="DodgerBlue">
											<th>#</th>
											<th>Contest Name</th>
											<th>Start Date and Time</th>
											<th>End Date and Time</th>
											<th>Enter Contest</th>
										</tr>
									</thead>
									<tbody>
										<?php for($i=0; $i<count($list); $i++)
										{?>
										<tr>
										<td><?php echo($i + 1); ?></td>
										<td><?php echo $list[$i]['contestname']; ?></td>
										<td><?php echo $list[$i]['startdt']; ?></td>
										<td><?php echo $list[$i]['enddt']; ?></td>
										<?php if(($list[$i]['stampst']+3600<=(strtotime('now')+19800))&& (strtotime('now')+19800)<$list[$i]['stampend']+3600)
                                         {
											//$_SESSION['contest']=$list[$i]['contestname'];?>
                                       <td>
                                         <form method="post" action="">
											<button type="button" data-toggle="modal" data-target="#contestrules" id="<?php echo $list[$i]['contestname']; ?>" onclick="setContestOnGo(this.id)"  class="btn btn-primary btn-sm">Enter Contest</button>
        										<!--div for each and every contest modal-->
        										<!--WE are keeping the rules and regulations modals in footer-->
         										<div class="modal fade" id="contestrules"  role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
												  <div class="modal-dialog" role="document">
												    <div class="modal-content">
					                                  <div class="modal-header">
						                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							                               <span aria-hidden="true">&times;</span>
						                                </button>
						                                <h1 class="modal-title" id="myModalLabel" align="center">Rules and Regulations</h1>
					                                  </div>
					                                  <div class="modal-body" align="justify">
						                                 <ol>
							
															<li>
																Your problem would be successfully submitted once it matches all the test-cases.
															</li>
															<li>
																Rating is done on the basis of time taken by a contestant to solve a problem.
															</li>
															<li>
																The contestant would be immediately disqualified if the code is found matching by our Plagiarism Detector
															</li>
															<li>
																Once you have finished all the problems you can later see the best solutions through the discussion forum.
															</li>
															<li>
																In case of JAVA programmers their class name must be <b>solution</b>.
															</li>
														</ol>
													</div>
                    								<div class="modal-footer">
                    									<button type="submit" class="btn btn-primary btn-sm" name="entercontest" id="openContest">GO</button>
                    								</div>
												  </div>
			                                     </div>
   												</div>
											</form>
											</td>
									<?php }else{?>
												<td><button type="button" class="btn btn-primary btn-sm" disabled>Enter Contest</button></td>
										<?php } ?>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<!--CONTEST TAB PANE ENDS-->
							<!--SUBMISSION TAB PANE BEGINS-->
							<div role="tabpanel" class="tab-pane fade" id="submissioncontent">
								&nbsp;
								<div>
									<div class="row"></div>
                         		<table class="table table-hover">
  										<thead>
  											<tr bgcolor="DodgerBlue">
  												<th>#</th>
  												<th>Contest</th>
  												<th>Problem Code</th>
  											<!--	<th>Submitted/Tried</th> -->
  												<th>Result</th>
  												<th>View Solution</th>
  											</tr>
  										</thead>
  										<tbody>
  										<?php for($i=0; $i<count($res); $i++)
										  {?>	
  											<tr 
  												<?php if($res[$i]['status']=='Wrong Answer'){?> 
  													bgcolor="Tomato"
  										  		<?php } else if($res[$i]['status']=='Compile Time Error') {?> 
												 	bgcolor="PowderBlue"
												 <?php }  else if($res[$i]['status']=='Time Limit Exceeded'){ ?>
												 	 bgcolor="Khaki" 
												 <?php }  else if($res[$i]['status']=='Problem Solved'){?>
												 	 bgcolor="LightGreen"
												 <?php }?> 
												 >
  												<td><a   data-toggle="modal" href="#myModal">
													<?php echo ($i+1); ?></a>
												</td>
  												<td><a href="contest.php"><?php echo $res[$i]['contestname'];?></a></td>
  												<td><a href="solve.php?problemCode=<?php echo $res[$i]['probcode'] ?>"><?php echo $res[$i]['probcode'];?></a></td>
  												
  												<td><?php echo $res[$i]['status'];?></td>
  												<td><form method="post"><button type="submit" name="solution" value="<?php echo $res[$i]['solpath']?>" class="btn btn-primary btn-sm" >View Solution</button></form></td>
  																																	
  											</tr>
  	  											<?php } ?>
  										</tbody>
									</table>
								
                         	</div>
							</div>
							<!--SUBMISSION TAB PANE ENDS-->
							<!--LEADERBOARD TAB PANE BEGINS-->
							<div role="tabpanel" class="tab-pane fade" id="leaderboard">&nbsp;
								<table class="table table-striped table-hover">
									<thead>
										<tr bgcolor="DodgerBlue">
											<th>#</th>
											<th>Codebar Username</th>
											<th>Rating</th>
											
										</tr>
									</thead>
									<tbody>
										<?php for($i=0; $i<count($lead); $i++)
{?>
										<tr>
										<td><?php echo($i + 1); ?></td>
										<td><a href="#"><?php echo $lead[$i]['username']; ?></a></td>
										<td><?php echo $lead[$i]['rating']; ?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>

							</div>
							<!--LEADERBOARD TAB PANE ENDS-->
							<!-- Problem Archives TAB PANE BEGINS -->
							<div role="tabpanel" class="tab-pane fade" id="problemarchives">&nbsp;
								<table class="table table-striped table-hover">
									<thead>
										<tr bgcolor="DodgerBlue">
											<th>#</th>
											<th>Problem Code</th>
											<th>Problem Name</th>
											<th>Difficulty Level</th>
										</tr>
									</thead>
									<tbody>
										<?php for($i=0; $i<count($archive_contest); $i++)
{?>
										<tr>
										<td><?php echo($i + 1); ?></td> 
										<td><a href="#"><?php echo $archive_contest[$i]['problemcode']; ?></a></td>
										<td><a href="#"><?php echo $archive_contest[$i]['problemhead']; ?></a></td>
										<td><?php echo $archive_contest[$i]['problemdiff']; ?></td>
										</tr>
										<?php } ?>
	
										
									</tbody>
								</table>

							</div>

							<!-- Problem Archives TAB PANE ENDS -->
						</div>

					</div>

					<div class="col-md-2"></div>

				</div>
			</div>
		</div>
		<div class="row">
			<div class="container-fluid">
				<?php
				include 'footer.php';
				?>
			</div>
		</div>
	</body>
</html>
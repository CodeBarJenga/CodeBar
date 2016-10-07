<!DOCTYPE HTML>
<html>
	<head>
		<title>CodeBar-Admin</title>
		<?php
		include 'depend.php';
		?>

	</head>
	<body>
		<div class="container-fluid">
			<div class="row"  >
				<?php
				include 'header.php';
				?>
			</div>

			<!--Tabbed Navigation of body-->
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active" id="contesttab">
						<a href="#contestcontent" aria-controls="contesttab" data-toggle="tab">Contest Setup</a>
					</li>
					<li role="presentation" id="addproblemstab"  class="unactive " >
						<a href="#problemscontent" id="problemtablink" aria-controls="problemstab" data-toggle="tab">Add Problems</a>
					</li>
					<li role="presentation" id="userstatustab"  class="unactive" >
						<a href="#userstatus" aria-controls="userstatustab" data-toggle="tab">User Status</a>
					</li>
					<li role="presentation" id="editcontesttab"  class="unactive" >
						<a href="#editcontest" aria-controls="editcontesttab" data-toggle="tab">Edit Contests</a>
					</li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="contestcontent">
						<div class="row">
							&nbsp;
						</div>
						<form class="form-horizontal" method="post">

							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Contest Name:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control"  name="contestname" placeholder="Enter Contest Name" required>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">Contest Start Date and Time:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="starttime" placeholder="YYYY-MM-DD HH:MM" required>
									<p class="help-block">
										Please strictly follow the format specified(YYYY-MM-DD HH:MM)for date.
									</p>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">Contest End Date and Time:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="endtime" placeholder="YYYY-MM-DD HH:MM" required>
									<p class="help-block">
										Please strictly follow the format specified(YYYY-MM-DD HH:MM)for date.
									</p>
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">Number of Problems:</label>
								<div class="col-sm-4">
									<input type="number" class="form-control" name="problemnum" placeholder="Enter number of problems" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-default btn-primary" name="save" id="save">
										Save
									</button>
								</div>
							</div>
						</form>
					</div>

					<div role="tabpanel" class="tab-pane fade" id="problemscontent">
						<div class="container-fluid">
							<div class="row">
								&nbsp;
							</div>
							<div class="row">
								<form class="form-horizontal" method="post" id="addingproblems">
									<div class="container-fluid">
										<div class="form-group">
											<label for="inputContestName" class="col-sm-2 control-label">Contest Name:</label>
											<div class="col-sm-4">
												<input type="text" class="form-control"  name="contestname" placeholder="Enter created contest name">
											</div>
										</div>
										<div class="form-group">
											<label for="inputProblemcode" class="col-sm-2 control-label">Unique Problem code:</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" name="probcode" placeholder="Example below" required>
												<p class="help-block">
													Ex: If a problem is related to palindromic substrings then code can be <strong>PLNDRMSUB.</strong>
												</p>
											</div>

											<label for="inputProblemhead" class="col-sm-2 control-label">Problem Head:</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" name="problemhead" placeholder="Example below" required>
												<p class="help-block">
													Ex: If a problem is related to palindromic substrings then heading can be <strong>Palindromic Substrings.</strong>
												</p>
											</div>
										</div>
										<div class="form-group">
											<label for="inputDifficulty" class="col-sm-2 control-label">Problem Difficulty:</label>
											<div class="col-sm-4">
												<select class="form-control" id="problemdiff" name="problemdiff">
													<option>Easy</option>
													<option>Normal</option>
													<option>Hard</option>
													<option>Expert</option>
												</select>
											</div>

											<label for="points" class="control-label col-sm-2">Problem Points:</label>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="points" placeholder="Problem points" required>
											</div>

										</div>
										<div class="form-group">
											<label for="inputPrpblemtimelimit" class="col-sm-2 control-label">Enter the time limit</label>
											<div class="col-sm-4">
												<input type="text" class="form-control"  name="Timelimit" placeholder="Time Limit for the problem" required>
											</div>
											<label for="inputPrpblemtimelimit" class="col-sm-2 control-label">Enter the memory limit</label>
											<div class="col-sm-4">
												<input type="text" class="form-control"  name="Memorylimit" placeholder="Memory Limit for the problem" required>
											</div>
										</div>
										
										
										<div class="form-group">
											<label for="inputPrpblemstatement" class="col-sm-2 control-label">Enter the Problem Statement:</label>
											<div class="col-sm-10">
												<textarea class="form-control" rows="10" name="problemstatement" placeholder="Enter the problem statement with the sample test cases here Here"></textarea>
											</div>
										</div>
										<!-- field for sample input and outptut START -->
										<div class="form-group">
											<label for="sampleinputtestcase" class="col-sm-2 control-label">Sample Input:</label>
											<div class="col-sm-10">
												<textarea class="form-control" rows="10" name="sampleinputtestcases" placeholder="Please give in the exact format and avoid the unnecessary spaces or line breaks."></textarea>
											</div>
										</div>
										
										<div class="form-group">
											<label for="sampleoutputtestcase" class="col-sm-2 control-label">Sample Output:</label>
											<div class="col-sm-10">
												<textarea class="form-control" rows="10" name="sampleoutputtestcases" placeholder="Please give in the exact format and avoid the unnecessary spaces or line breaks."></textarea>
											</div>
										</div>
										<!-- field for sample input and output END -->
										<div class="form-group">
											<label for="inputtestcase" class="col-sm-2 control-label">Test Case Input:</label>
											<div class="col-sm-10">
												<textarea class="form-control" rows="10" name="inputtestcases" placeholder="Please give in the exact format and avoid the unnecessary spaces or line breaks."></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="inputtestcaseoutput" class="col-sm-2 control-label">Test Case Output:</label>
											<div class="col-sm-10">
												<textarea class="form-control" rows="10" name="outputtestcases" placeholder="Please give in the exact format and avoid the unnecessary spaces or line breaks."></textarea>
											</div>
											<div class="col-sm-offset-2 col-sm-10"></div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												<button type="submit" class="btn btn-default btn-primary" name="addprob" id="addprob">
													Add Problem to contest
												</button>
												<button type="submit" class="btn btn-default btn-primary" name="delprob" id="done">
													Delete Problem
												</button>
											</div>
										</div>

									</div>
								</form>

							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="userstatus">
						<div class="row">
							&nbsp;
						</div>
						User Status
					</div>
					<!-- edit contest start -->
					<div role="tabpanel" class="tab-pane fade" id="editcontest">
						<div class="row">
							&nbsp;
						</div>
						Edit Contest
					</div>
					<!-- edirt contest end -->

				</div>
			</div>
			<div class="col-md-2"></div>
			<div class="row">
				<div class="container-fluid">
					<?php
					include 'footer.php';
					?>
				</div>
			</div>
		</div>
	</body>

</html>
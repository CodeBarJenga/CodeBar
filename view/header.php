<?php //session_start();

//header('Cache-Control: max-age=900');
ob_start();
if (isset($_REQUEST['logout'])) {
	session_unset();
	header("location:index.php");
}
?>
<head>
	
</head>
		<nav class="navbar navbar-default" >
					<div class="container-fluid" style="border-bottom: 2px solid blue;">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header"  >
							<!--<a class="navbar-brand collapsed navbar-toggle navbar-collapse" href="#" > <img src="../images/logo.png"  height="65" ></a>-->
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>

						</div>

						<a class="navbar-brand " href="user.php" > <img src="images/logo.png" alt="CodeBar" height="65" ></a>
						<!-- Login and SignUp modals -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
                          <?php if(@$_SESSION['username']!=NULL)
						  {?>
						  	<ul class="nav navbar-nav navbar-right" style="margin-right:20px; padding:20px; ">
							    <li>
									<a href="#"><Strong>Welcome!</Strong> <?php echo $_SESSION['username']; ?></a>
								</li>
								<li>
								 <form class="form-inline" method="post">	
									<button type="submit"  class="btn btn-primary btn-line btn-lg navbar-collapse" name="logout">
										Logout
									</button>
								</form>
								</li>
						  <?php }
									else
									{
								?>
							<ul class="nav navbar-nav navbar-right" style="margin-right:20px; padding:20px; ">
							
								<li>
									<button  class="btn btn-primary btn-line btn-lg navbar-collapse" data-toggle="modal" data-target="#loginModal">
										Login
									</button>
								</li>
								<li >
									<button class="btn btn-primary btn-line btn-lg  navbar-collapse" data-toggle="modal" data-target="#signupModal">
										SignUp
									</button>
								</li>
							</ul>
							<?php } ?>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
              <!-- both modals login and signup begins-->
			<!--login modal-->
			<div class="modal fade " id="loginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h1 class="modal-title text-center" id="loginmodalLabel">Login</h1>
						</div>
						<div class="modal-body">

							<form class="form-horizontal" action="index.php" method="post">
								<div class="form-group has-feedback">

									<div class="col-md-12" >
										<div class=input-group>
											<span class="glyphicon glyphicon-glass input-group-addon" aria-hidden="true"></span>
											<input  type="text" class="form-control"  name="username"  placeholder="Codebar Username" required>
										</div>
									</div>
								</div>
								<div class="form-group has-feedback">
									<div class="col-md-12">
					   					<div class=input-group>
											<span class="glyphicon glyphicon-lock input-group-addon" aria-hidden="true"></span>
											<input  type="password"  class="form-control" name="password"  placeholder="Password" required>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" name="login"  class="btn btn-primary btn-lg center-block" >
										Login
									</button>

								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
			<!--Signup modal-->
			<div class="modal fade " id="signupModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h1 class="modal-title text-center" id="signupmodalLabel">SignUp</h1>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" method="post" action="">
								<div class="container-fluid">
									<div class="row">
										<div class="form-group has-feedback">
											<div class="col-md-12" >
												<div class="input-group">

													<span class="glyphicon glyphicon-user input-group-addon" aria-hidden="true"></span>
													<input  type="text" class="form-control" name="name"   placeholder="Full Name" required>

												</div>

											</div>
										</div>

									</div>
								</div>
								<div class="form-group has-feedback">
									<div class="col-md-12">
										<div class="input-group">
											<span class="glyphicon glyphicon-envelope input-group-addon" aria-hidden="true"></span>
									<input type="email" class="form-control"name="email"   placeholder="Email" required>
										</div>
									</div>
								</div>
								<div class="form-group has-feedback">
									<div class="col-md-12">
										<div class="input-group">
											<span class="glyphicon glyphicon-phone input-group-addon" aria-hidden="true"></span>
									<input type="tel" class="form-control"name="mobile_num"   placeholder="Mobile Number" required>
										</div>
									</div>
								</div>
								<div class="form-group has-feedback">
									<div class="col-md-12">
										<div class="input-group">
											<span class="glyphicon glyphicon-glass input-group-addon" aria-hidden="true"></span>
											<input type="text" class="form-control" name="username"   placeholder="Codebar Username" required>
										</div>
									</div>
								</div>
								<div class="form-group has-feedback">
									<div class="col-md-12">
										<div class="input-group">
											<span class="glyphicon glyphicon-lock input-group-addon" aria-hidden="true"></span>
											<input type="password" class="form-control" name="password"  placeholder="Password" required>
										</div>
									</div>
								</div>
								
								<!--	<div class="form-group has-feedback">
										<div class="col-md-12">
											<div style="padding-left: 120px;" name="g-recaptcha-response" class="g-recaptcha" data-sitekey="6LdVtgoTAAAAAIOxnv_7hxguzvOFzMQiJYa2qEfD"></div>
										</div>
									</div>
								-->
								<div class="modal-footer">
									<button type="submit"  class="btn btn-primary btn-lg center-block" name="signup">
										Create An Account
									</button>

								</div>
							</form>
						</div>

					</div>
				</div>
			</div>

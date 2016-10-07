<!DOCTYPE html>
<html lang="en">
	<head>
		<style>
			body{
				overflow-x: hidden;
			}
		</style>
		<!--<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess 
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		
		<meta name="description" content="">
		<meta name="author" content="LENOVO">-->
		<title>CodeBar</title>
		<?php include 'depend.php';
		?>

	</head>

	<body >

		
		<div  class="container-fluid">

			<div class="row"  >
			<?php include'header.php'; ?>
			</div>

			<!--navigation map -->
			<div class="row">
            	<div class="container-fluid" style="padding-bottom:10px; margin-left: 10px;">
            	<a href="user.php">User Dashboard</a>&nbsp;>>&nbsp;<a href="contest.php"><?php echo $_SESSION['contest'];?></a>&nbsp;>>&nbsp;<a href="#"><?php echo $_SESSION['problem'];?></a>
            	</div>
            </div>

			<!--second div-->
			<div class="row">
				<div class="col-md-2">
				
					<div class="container-fluid">
						
					<div class="panel panel-info">
							<div class="panel-heading" >
								Problems in the contests
							</div>
	                  
						<ul class="nav nav-pills nav-stacked">
							
								<?php for($i=0; $i<count($nav_prob); $i++)
										  {?>	
  											
  												<?php if($nav_prob[$i]['problemcode']==$_GET['problemCode']) 
												       { ?>
  												  <li class="active" align="center"><a href="solve.php?problemCode=<?php echo $nav_prob[$i]['problemcode'] ?>"><?php echo $nav_prob[$i]['problemhead']; ?></a></li>
  											     <?php }else{ ?>
  											      <li align="center"><a href="solve.php?problemCode=<?php echo $nav_prob[$i]['problemcode'] ?>"><?php echo $nav_prob[$i]['problemhead']; ?></a></li>
												
  											<?php
										 } }
										 ?>
							</ul>
						
							</div>
					 
					</div>
				</div>
				<div class="col-md-8">
                      <div class="container-fluid">              
                         	<div class="row" align="center">
                         	 	<h4>Problem Name: <?php echo $result[0]['problemhead']?></h4>
                         	 	<h4>Problem Code: <?php echo $result[0]['problemcode'];?></h4>
                         	 	<h4>Time Limit: <?php echo $result[0]['timelimit']; ?>s</h4>
                         	 	<!--<p>Memory Limit: <?php echo $result[0]['testMemory']; ?></p>-->
                         	</div> 
                         	<div class="row" >
                         		<div class="row" text-align="center">
                       		  	    
                       		  	    	<?php echo $result[0]['statement']; ?>
                       		  	    	
                       		    <!--<pre style="border: none;background: none; overflow: hidden;white-space: nowrap; text-overflow: ellipsis;" align="justify">  	    
                       			</pre>-->
                         		</div>
                 
                         	</div>  
                         	<div class="row">
                         		<form method="post" target="_blank" action="editor.php">
  									<button type="submit"  class="btn btn-primary btn-sm" name="problemCode" value="<?php echo $result[0]['problemcode'];?>">Enter to solve</button>
  							  </form>
								
                         	</div>                        	
                          
				</div>
				</div>
				<div class="col-md-2">
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
					<?php include 'footer.php';?>
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
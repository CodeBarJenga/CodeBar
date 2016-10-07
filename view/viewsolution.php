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

			<div class="row ">
				<div class="container-fluid">
					<div class="col-md-2"></div>
					
					<div class="col-md-8">
						<!--<div class="form-group">
						<textarea class="form-control" rows="<?php echo $count; ?>" readonly>-->
						  <div id="editor" name="editor" style="height: 500px" >	
							<?php
							$solpath = trim($_SESSION['solpath']);
							$file_handle = fopen("$solpath", "r");
							echo "\r\n";
							while (!feof($file_handle)) {
								$line = htmlspecialchars(fgets($file_handle));
								echo $line;
							}
							fclose($file_handle);
							?>
							<!--</div>
						</textarea>-->
						</div>
					</div>

					<div class="col-md-2"></div>
				</div>
			</div>
			<div class="row">
				<?php
				include 'footer.php';
				?>
			</div>
		</div>
		
			<script>
				var editor = ace.edit("editor");
				editor.setReadOnly(true);  // false to make it editable
				//editor.getSession().foldAll(1,false);
			</script>

		
	</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="A Manager for the Apache Localhost listening">
	<meta name="author" content="Elia Reutlinger">

	<title>Localhost Manager v1.0</title>

	<!-- Bootstrap core CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

	<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<style>
		body {
			padding-top: 54px;
		}
		
		@media (min-width: 992px) {
			body {
				padding-top: 56px;
			}
		}
	</style>

</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
		<div class="container">
			<a class="navbar-brand" href="#">Localhost Manager</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
				</ul>
			</div>
		</div>
	</nav>

	<!-- Page Content -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1 class="mt-5"></h1>
				<p class="lead"></p>
				<table id="thetable" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Ordnername</th>
							<th>Zuletzt geändert</th>
							<th>Beschreibung</th>
							<th>Eingetragen am</th>
							<th>GitHub</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Ordnername</th>
							<th>Zuletzt geändert</th>
							<th>Beschreibung</th>
							<th>Eingetragen am</th>
							<th>GitHub</th>
						</tr>
					</tfoot>
					<tbody>
						<?php
				
							$conn = mysqli_connect("localhost", "root", "", "db_localmanager") or die (mysqli_error());
							
							if(isset($_GET['do']) && $_GET['do'] == "change"){
								$theid = $_GET['id'];
								$bool = $_GET['to'];
								
								$query = "UPDATE `tb_file_data` SET `github` = '$bool' WHERE `tb_file_data`.`ID` = $theid;";
								
								if ($conn->query($query) === TRUE) {
									echo "New record created successfully";
								} else {
									echo "Error: " . $query . "<br>" . $conn->error;
								}
							}
							
							if(isset($_GET['do']) && $_GET['do'] == "updescr"){
								$theid = $_GET['id'];
								$descr = $_GET['text'];
								
								$query = "UPDATE `tb_file_data` SET `file_description` = '$descr' WHERE `tb_file_data`.`ID` = $theid;";
								
								if ($conn->query($query) === TRUE) {
									echo "New record created successfully";
								} else {
									echo "Error: " . $query . "<br>" . $conn->error;
								}
							}
							
							if ($handle = opendir('.')) {
								
								$array = "";
								
								while (false !== ($entry = readdir($handle))) {
							
									if ($entry != "." && $entry != ".." && $entry != "index.php") {
										
										$query = "SELECT * FROM tb_file_data WHERE file_name = '$entry';";
										$data = mysqli_fetch_array(mysqli_query($conn, $query));
										
										if (!$data) {
											$date = date('Y-m-d h:i:s');
											$query = "INSERT INTO tb_file_data (file_name, file_reg_date, github) VALUES ('$entry', '$date', 0);";
											if ($conn->query($query) === TRUE) {
												echo "New record created successfully";
											} else {
												echo "Error: " . $query . "<br>" . $conn->error;
											}
											
										} else {
											echo "<tr>";
											echo "<td id='" . $data['ID'] . "'><a href='$entry'>$entry</a></td>";
											echo "<td id='" . $data['ID'] . "'>" . (date ("d.m.Y H:i", filemtime($entry))) . "</td>";
											echo "<td class='descr' id='" . $data['ID'] . "'>" . $data['file_description'] . "</td>";
											echo "<td id='" . $data['ID'] . "'>" . date('d.m.Y H:i:s', (strtotime($data['file_reg_date']))) . "</td>";
											
											if($data['github']){
												echo "<td class='gith' id='" . $data['ID'] . "'>✓</td>";
											} else {
												echo "<td class='gith' id='" . $data['ID'] . "'>✗</td>";
											}
											
											echo "</tr>";
										}
			
										
										
										
									}
								}
								
								echo $array;
								
								closedir($handle);
							}
							
						?>
					</tbody>
				</table>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-12">
				<div id="description_change" style="opacity: 0;">
					<form>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Change Description of</label>
							<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
						</div>
						<button type="button" class="btn btn-primary">Update</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {

			$('#thetable').DataTable();

			$('.descr').click(function() {
				
				var id = this.id;
				var iddescr = "#" + id + ".descr";
				
				$(iddescr).css("background-color: green;");

			});

			$('.gith').click(function() {

				var id = this.id;
				var idgith = "#" + id + ".gith";

				if ($(idgith).html() == "✓") {
					$(idgith).html('✗');
					$.ajax({
						url: "index.php?do=change&id=" + id + "&to=0",
						context: document.body
					}).done(function() {
						$(this).addClass("done");
					});
				} else {
					$(idgith).html('✓');
					$.ajax({
						url: "index.php?do=change&id=" + id + "&to=1",
						context: document.body
					}).done(function() {
						$(this).addClass("done");
					});
				}
			});

		});
	</script>

</body>

</html>
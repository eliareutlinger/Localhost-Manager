<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="A Manager for the Apache Localhost listening">
	<meta name="author" content="Elia Reutlinger">

	<title>Localhost Manager v1.0</title>

	<!-- Bootstrap core CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

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
		.highlighter {
		    box-shadow: 0 1px 2px rgba(0,0,0,0.15);
		    transition: box-shadow 0.3s ease-in-out;
		}
		.highlighter:hover {
		    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
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
					<li class="nav-item">
						<a class="nav-link" href="/phpmyadmin">phpMyAdmin</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Page Content -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="row" style="padding-top: 20px;">

						<?php

						function random_color_part() {
						    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
						}

						function random_color() {
						    return random_color_part() . random_color_part() . random_color_part();
						}

						function rgb_best_contrast($rgb) {

							$r = substr($rgb, 1, 2);
							$g = substr($rgb, 3, 2);
							$b = substr($rgb, 5, 2);

						    $rNew = (hexdec($r) < 128) ? 255 : 0;
						    $gNew = (hexdec($g) < 128) ? 255 : 0;
						    $bNew = (hexdec($b) < 128) ? 255 : 0;

							$R = dechex($rNew);
						    if (strlen($R)<2)
						    $R = '0'.$R;

						    $G = dechex($gNew);
						    if (strlen($G)<2)
						    $G = '0'.$G;

						    $B = dechex($bNew);
						    if (strlen($B)<2)
						    $B = '0'.$B;

						    return $R . $G . $B;

						}

						$conn = mysqli_connect("localhost", "root", "", "db_localmanager") or die (mysqli_error());

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



										$backgroundColor = "#".random_color();
										$color = "#".rgb_best_contrast($backgroundColor);
										$borderColor = $color;

										echo '
										<div class="col-lg-3" style="padding-top:20px;">
											<div class="card highlighter col-lg-12 text-center" onclick="window.location.replace(\''.$entry.'\');" style="max-height: 150px; min-height: 150px; background-color: '.$backgroundColor.'; border-color: '.$borderColor.'; color: '.$color.'; cursor: pointer;">
												<h4 class="my-auto">'.$entry.'</h2>
											</div>
										</div>
										';

									}




								}
							}

							echo $array;
							closedir($handle);

						}

						?>

				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-12">
			</div>
		</div>
	</div>

	<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

	<!-- Bootstrap core JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js" integrity="sha384-lZmvU/TzxoIQIOD9yQDEpvxp6wEU32Fy0ckUgOH4EIlMOCdR823rg4+3gWRwnX1M" crossorigin="anonymous"></script>


</body>

</html>

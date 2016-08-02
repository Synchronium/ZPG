<?php

	require_once __DIR__ . '/vendor/autoload.php';
	
	// Check for correct usage with a single argument 
	if ($argc != 2) {
		echo sprintf( "Invalid argument. Use as follows:\nphp %s \"calculation\"\n", $argv[0] );
		die();
	}
	
	// Assumption: only valid calculation string will be passed
	// No need to syntax check
	$calculation = $argv[1];

	echo "The answer is: " . CalculationParser::calculate( $calculation ) . "\n";
	
	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Calculator</title>

    <!-- Bootstrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	 <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<div class="jumbotron">
		<div class="container">
			<h1>Calculator</h1>
			<p>Submit equation below:</p>
			<form action="" action="post">
				<input name="equation" placeholder="eg. 4 * 6 ^ 8 + 1 / 3">
				<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button> 
			</form>
<?php

			if ( isset( $_POST['equation'] ) ) 
			{
				$equation = $_POST['equation'];
				echo "<p>$equation = " .  CalculationParser::calculate( $equation ) . "</p>";
			
			}

?>
	 </div>
    </div>
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>



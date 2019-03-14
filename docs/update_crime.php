 <?php

 // Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'daiy';
$password = 'MuV1oode';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
or die('Could not connect: ' . mysqli_connect_error());
print 'update_crime Connected successfully!<br>';

print ('<head><link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/custom.css" rel="stylesheet"></head>>');

print ('<br><a href="index.html">Back to Home</a><br>');


$CrimeName = strtolower($_REQUEST['CrimeName']);
$query = "SELECT CrimeID, CrimeName, motive FROM Crime WHERE LOWER(CrimeName) LIKE '%$CrimeName%'";
$result = $dbcon->query($query);



echo "number of row: " . $result->num_rows;

$sql = "";

if ($result->num_rows ==0)
{
	$sql = "INSERT INTO Crime (CrimeID, CrimeName, motive) VALUES ('" . $_POST['CrimeID'] . "', '" . $_POST['CrimeName'] . "', '" . $_POST['motive'] . "')";
}
else
{
	$sql = "UPDATE Crime SET CrimeID = '" .  $_POST['CrimeID'] . "', motive= '" . $_POST['motive'] . "' WHERE CrimeName = '" . urldecode($_POST['CrimeName'])  . "'";
}


// echo $sql;
// abort();
mysqli_query($dbcon, $sql) or die($dbcon -> error);

// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);
header("Location: https://mpcs53001.cs.uchicago.edu/~daiy/find_crime.php?CrimeName=%");
?>




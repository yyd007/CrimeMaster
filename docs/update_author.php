 <?php

 // Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'daiy';
$password = 'MuV1oode';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
or die('Could not connect: ' . mysqli_connect_error());
print 'Connected successfully!<br>';


$Author = strtolower($_REQUEST['AuthorName']);
// $Gender = 

$query = "SELECT AuthorName, Gender, Nationality, nat_id_fk FROM Authors WHERE LOWER(AuthorName) LIKE '%$Author%'";

$result = $dbcon->query($query);

$Authorrow = $result->fetch_assoc();


echo "number of row: " . $result->num_rows;

if ($result->num_rows ==0)
{
	$sql = "INSERT INTO Authors (AuthorName, Gender, nat_id_fk) VALUES ('" . $_POST['AuthorName'] . "', '" . $_POST['Gender'] . "', " . $_POST['nat_id'] . ")";

	// echo "insert";
}
else
{
	$sql = "UPDATE Authors SET Gender = '" .  $_POST['Gender'] . "', nat_id_fk=" . $_POST['nat_id'] . " WHERE AuthorName = '" . urldecode($_POST['AuthorName'])  . "'";
	// echo "update";
}


// echo $sql;
//abort();
mysqli_query($dbcon, $sql) or die($dbcon -> error);



// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);
header("Location: https://mpcs53001.cs.uchicago.edu/~daiy/find_author.php?Author=%");
?>




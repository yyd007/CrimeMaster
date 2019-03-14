 <?php

 // Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'daiy';
$password = 'MuV1oode';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
or die('Could not connect: ' . mysqli_connect_error());
print 'delete_author Connected successfully!<br>';


$Author = strtolower($_REQUEST['AuthorName']);
// $Gender = 

$query = "SELECT AuthorName, Gender, Nationality, nat_id_fk FROM Authors WHERE LOWER(AuthorName) LIKE '%$Author%'";

$result = $dbcon->query($query);

// $Authorrow = $result->fetch_assoc();


echo "number of row: " . $result->num_rows;

/*
if the input has existed author name
then delete
else
error message: can't find this author
*/
$sql = "";
if ($result->num_rows !=0)
{
	$sql = "DELETE FROM Authors WHERE AuthorName='" . urldecode($_POST['AuthorName'])  . "' ";
	
}
else
{
	echo "<br>";
	echo "Records not existed";
	
}

echo $sql;
//abort();
mysqli_query($dbcon, $sql) or die($dbcon -> error);


// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);
header("Location: https://mpcs53001.cs.uchicago.edu/~daiy/find_author.php?Author=%");
?>




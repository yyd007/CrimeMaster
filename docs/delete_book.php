 <?php

 // Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'daiy';
$password = 'MuV1oode';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
or die('Could not connect: ' . mysqli_connect_error());
print 'delete_book Connected successfully!<br>';


$Book = strtolower($_REQUEST['BookTitle']);

$query = "SELECT BookTitle, AuthorName, Languages, Length, Country FROM Books WHERE LOWER(BookTitle) LIKE '%$Book%'";

$result = $dbcon->query($query);

// $Bookrow = $result->fetch_assoc() ;


echo "number of row: " . $result->num_rows;

/*
if the input has existed author name
then delete
else
error message: can't find this book
*/
$sql = "";
if ($result->num_rows !=0)
{
	$sql = "DELETE FROM Books WHERE BookTitle='" . urldecode($_POST['BookTitle'])  . "' ";
	//echo "delete";
}
else
{	
	echo "<br>";
	echo "Records not existed";
	
}

echo $sql;

mysqli_query($dbcon, $sql) or die($dbcon -> error);


// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);
header("Location: https://mpcs53001.cs.uchicago.edu/~daiy/find_book.php?Author=%");
?>




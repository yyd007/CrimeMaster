 <?php

 // Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'daiy';
$password = 'MuV1oode';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
or die('Could not connect: ' . mysqli_connect_error());
print 'Update_book connected successfully!<br>';

print ('<head><link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/custom.css" rel="stylesheet"></head>>');

print ('<br><a href="index.html">Back to Home</a><br>');



$Book = strtolower($_REQUEST['BookTitle']);

$query = "SELECT BookTitle, AuthorName, Languages, Length, Country FROM Books WHERE LOWER(BookTitle) LIKE '%$Book%'";

$result = $dbcon->query($query);


echo $result->num_rows;

$sql = "";

if ($result->num_rows == 0)
{
	$sql = "INSERT INTO Books (BookTitle, AuthorName, Languages, Length, Country) VALUES ('" . $_POST['BookTitle'] . "', '" . $_POST['AuthorName'] . "','" . $_POST['Languages'] . "', '" . $_POST['Length'] . "', '" . $_POST['Country'] . "')";
}
else
{
	$sql = "UPDATE Books SET AuthorName = '" .  $_POST['AuthorName'] . "', Languages = '" .  $_POST['Languages'] . "', Length = '" .  $_POST['Length'] . "', Country = '" . $_POST['Country'] . "' WHERE BookTitle = '" . urldecode($_POST['BookTitle'])  . "'";
	
}

echo $sql;
//abort();
mysqli_query($dbcon, $sql) or die($dbcon -> error);


// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);
header("Location: https://mpcs53001.cs.uchicago.edu/~daiy/find_book.php?Author=%");
?>




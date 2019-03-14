 <?php

 // Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'daiy';
$password = 'MuV1oode';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
or die('Could not connect: ' . mysqli_connect_error());
print 'find_book Connected successfully!<br>';

print ('<head><link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/custom.css" rel="stylesheet"></head>>');

print ('<br><a href="index.html">Back to Home</a><br>');
print ('<br><h2>Find Your Book</h2><br>');


$Book = strtolower($_REQUEST['BookTitle']);

$query = "SELECT BookTitle, AuthorName, Languages, Length, Country FROM Books WHERE BookTitle LIKE '%$Book%'";

$result = $dbcon->query($query);


print "The following Books were found using: <b>$Book</b> and has the following attributes:<br>";
print "Number of records found: $result->num_rows<br>";

while($row = $result->fetch_assoc() )
{
	print "<ul>";
	print "<li> Book Title: ".$row['BookTitle'];
	print "<li> Author Name: ".$row['AuthorName'];
	print "<li> Languages: ".$row['Languages'];
	print "<li> Length: ".$row['Length'];
	print "<li> Country: ".$row['Country'];
	print "<li><a href='add_book.php?BookTitle=" . $row['BookTitle'] . "'>Edit Book</a>";
	print "</ul><hr>";
}
	print "<li><a href='add_book.php?BookTitle=0'>Add Book</a><br>";
	print "<li><a href='delete_book_input.php?BookTitle=0'>Delete Book</a><br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);

?>
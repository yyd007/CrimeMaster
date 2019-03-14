 <?php

 // Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'daiy';
$password = 'MuV1oode';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
or die('Could not connect: ' . mysqli_connect_error());
print 'delete_book connected successfully!<br>';
 
print ('<head><link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/custom.css" rel="stylesheet"></head>>');

print ('<br><a href="index.html">Back to Home</a><br>');

echo '<form method=post action=delete_book.php>';


$Book = strtolower($_REQUEST['BookTitle']);
$AuthorName = strtolower($_REQUEST['AuthorName']);
$Languages = strtolower($_REQUEST['Languages']);
$Length = strtolower($_REQUEST['Length']);
$Country = strtolower($_REQUEST['Country']);

$query = "SELECT BookTitle, AuthorName, Languages, Length, Country FROM Books WHERE LOWER(BookTitle) LIKE '%$Book%'";

$result = $dbcon->query($query);

// $Bookrow = $result->fetch_assoc();

print '<br>Enter Book Title:<br>';
if ($result->num_rows== 0)
{
	print "<input type=text name=BookTitle value=>";
}
else 
{
	print "<input type=text name=BookTitle value='" . urldecode($_REQUEST['BookTitle']) . "'>";
}


print '<br>Enter AuthorName:<br>';
echo '<input type="text" name="AuthorName"><br>';
print '<br>Enter Languages:<br>';
echo '<input type="text" name="Languages"><br>';
print '<br>Enter Length:<br>';
echo '<input type="text" name="Length"><br>';
print '<br>Enter Country:<br>';
echo '<input type="text" name="Country"><br>';


echo '<br><input type=submit value=Submit></form>';


// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);

?>

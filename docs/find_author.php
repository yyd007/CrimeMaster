 <?php

 // Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'daiy';
$password = 'MuV1oode';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
or die('Could not connect: ' . mysqli_connect_error());
print 'Find_author Connected successfully!<br>';

print ('<head><link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/custom.css" rel="stylesheet"></head>>');

print ('<br><a href="index.html">Back to Home</a><br>');
print ('<br><h2>Find Your Author</h2><br>');

// Getting the input parameter (user):
$Author = strtolower($_REQUEST['Author']);

$query = "SELECT AuthorName, Gender, nat_desc as Nationality FROM Authors,codeNationality WHERE (nat_id_fk = nat_id) AND LOWER(AuthorName) LIKE '%$Author%'";

$result = $dbcon->query($query);


print "<br>The following Auithors were found using: <b>$Author</b> and has the following attributes:<br>";
print "Number of records found: $result->num_rows<br>";
print "<br>";


while($row = $result->fetch_assoc() )
{
		print "<ul>";
		print "<li> Author Name: ".$row['AuthorName'];
		print "<li> Gender: ".$row['Gender'];
		print "<li> Nantionality: ".$row['Nationality'];
		print "<li><a href='add_author.php?AuthorName=" . $row['AuthorName'] . "'>Edit Author</a>";
		print "</ul><hr>";
}
		print "<li><a href='add_author.php?AuthorName=0'>Add Author</a><br>";
		print "<li><a href='delete_author_input.php?AuthorName=0'>Delete Author</a><br>";
		echo "<br>";
		echo "<br>";
		echo "<br>";

// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);

?>
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

print ('<br><a href="index.html">Back to Home</a><br>');
print ('<br><h2>Find Your Crime Fiction Subgenre</h2><br>');

// Getting the input parameter (user):
$Subgenre = strtolower($_REQUEST['Subgenre']);

//get the information of an author given the name

$query = "SELECT GenreName, TimeofPopularity FROM Subgenre WHERE GenreName LIKE '%$Subgenre%'";
$result = $dbcon->query($query);


print "The following Subgenres were found using: <b>$Subgenre</b> and has the following attributes:<br>";
print "Number of records found: $result->num_rows<br>";


while($row = $result->fetch_assoc() )
{
	print "<ul>";
	print "<li> Genre Name: ".$row['GenreName'];
	print "<li> Time of Popularity: ".$row['TimeofPopularity'];
	print "</ul><hr>";
}
// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);

?>
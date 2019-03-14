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
print ('<br><h2>Find Your Characters</h2><br>');

// Getting the input parameter (user):
$Character = $_REQUEST['Character'];

//get the information of an author given the name

$query = "SELECT CharacterName, CharacterID, Gender, Nationality FROM Characters WHERE CharacterName LIKE '%$Character%'";

$result = $dbcon->query($query);


print "The following Characters were found using: <b>$Character</b> and has the following attributes:<br>";
print "Number of records found: $result->num_rows<br>";

while($row = $result->fetch_assoc() )
{

	print "<ul>";
	print "<li> Character Name: ".$row['CharacterName'];
	print "<li> Character ID: ".$row['CharacterID'];
	print "<li> Gender: ".$row['Gender'];
	print "<li> Nationality: ".$row['Nationality'];
	print "</ul><hr>";
}
// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);

?>
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
print ('<br><h2>Find Your Character Role</h2><br>');

// Getting the input parameter (user):
$CharacterRole = $_REQUEST['CharacterRole'];

//get the information of an author given the name

$query = "SELECT CharacterRoleID, CharacterRoleType FROM CharacterRole WHERE CharacterRoleType LIKE '%$CharacterRole%'";


$result = $dbcon->query($query);

print "The following Books were found using: <b>$CharacterRole</b> and has the following attributes:<br>";
print "Number of records found: $result->num_rows<br>";


while($row = $result->fetch_assoc() )
{
	print "<ul>";
	print "<li> CharacterRole ID: ".$row['CharacterRoleID'];
	print "<li> Character Role Type: ".$row['CharacterRoleType'];
	print "</ul><hr>";
}
// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);

?>
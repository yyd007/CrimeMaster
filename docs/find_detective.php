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
print ('<br><h2>Find Your Detective</h2><br>');

// Getting the input parameter (user):
$Detective = strtolower($_REQUEST['Detective']);


$query = "SELECT DetectiveName, OrganizationName, Gender, Nationality FROM Detective WHERE DetectiveName LIKE '%$Detective%'";
$result = $dbcon->query($query);

print "The following Books were found using: <b>$Detective</b> and has the following attributes:<br>";
print "Number of records found: $result->num_rows<br>";

while($row = $result->fetch_assoc() )

{
	print "<ul>";
	print "<li> Detective Name: ".$row['DetectiveName'];
	print "<li> OrganizationName: ".$row['OrganizationName'];
	print "<li> Gender: ".$row['Gender'];
	print "<li> Nantionality: ".$row['Nationality'];
	print "</ul><hr>";
}
// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);

?>
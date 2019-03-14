 <?php
// Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'daiy';
$password = 'MuV1oode';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
or die('Could not connect: ' . mysqli_connect_error());
print 'find_crime Connected successfully!<br>';

print ('<head><link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/custom.css" rel="stylesheet"></head>>');

print ('<br><a href="index.html">Back to Home</a><br>');
print ('<br><h2>Find Your Crime</h2><br>');

// Getting the input parameter (user):
$CrimeName = strtolower($_REQUEST['CrimeName']);

//get the information of an author given the name

$query = "SELECT CrimeID, CrimeName, motive FROM Crime WHERE LOWER(CrimeName) LIKE '%$CrimeName%'";
// echo $query;
// abort();
$result = $dbcon->query($query);

print "The following Crime were found using: <b>$CrimeName</b> and has the following attributes:<br>";
print "Number of records found: $result->num_rows<br>";

while($row = $result->fetch_assoc()  )
{

	print "<ul>";
	print "<li> Crime ID: ".$row['CrimeID'];
	print "<li> Crime Name: ".$row['CrimeName'];
	print "<li> Motive: ".$row['motive'];
	print "<li><a href='add_crime.php?CrimeName=" . $row['CrimeName'] . "'>Edit Crime</a>";
	print "</ul><hr>";
}
	print "<li><a href='add_crime.php?CrimeName=0'>Add Crime</a><br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);

?>
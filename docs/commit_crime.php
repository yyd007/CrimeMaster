 <?php
// Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'daiy';
$password = 'MuV1oode';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
or die('Could not connect: ' . mysqli_connect_error());
print 'Commit_crime Connected successfully!<br>';

print ('<head><link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/custom.css" rel="stylesheet"></head>>');

print ('<br><a href="index.html">Back to Home</a><br>');
print ('<br><h2>Find Your Crime</h2><br>');

// Getting the input parameter (user):
//$Book = $_REQUEST['Book'];

//get the information of an author given the name

$query = "SELECT CrimeName FROM Crime";
//echo $query;
$result = $dbcon->query($query);
//or die('Query failed: ' . mysqli_error($dbcon));

print "Number of records found: $result->num_rows<br>";


while($row = $result->fetch_assoc() )
{

	print "<ul>";
	print "<li> Crime Name: ".$row['CrimeName'];
	
	print "</ul><hr>";
}

// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);

?>
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
print ('<br><h2>Find Your Book Series</h2><br>');

// Getting the input parameter (user):
$Series = strtolower($_REQUEST['Series']);

//get the information of an series given the name

$query = "SELECT SeriesName, AuthorName, LeadingCharacter FROM Series WHERE SeriesName LIKE '%$Series%'";
$result = $dbcon->query($query);


print "The following Book Series were found using: <b>$Series</b> and has the following attributes:<br>";
print "Number of records found: $result->num_rows<br>";

while($row = $result->fetch_assoc() )
{
print "<ul>";
print "<li> Series Name: ".$row['SeriesName'];
print "<li> Author Name: ".$row['AuthorName'];
print "<li> LeadingCharacter: ".$row['LeadingCharacter'];
print "</ul><hr>";
}
// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);

?>
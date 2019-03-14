 <?php

 // Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'daiy';
$password = 'MuV1oode';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
or die('Could not connect: ' . mysqli_connect_error());
print 'add_crime Connected successfully!<br>';

print ('<head><link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/custom.css" rel="stylesheet"></head>>');

print ('<br><a href="index.html">Back to Home</a><br>');

echo '<form method=post action=update_crime.php>';



$CrimeName = strtolower($_REQUEST['CrimeName']);
$CrimeID = $_REQUEST['CrimeID'];
$Motive = strtolower($_REQUEST['motive']);

$query = "SELECT CrimeID, CrimeName, motive FROM Crime WHERE LOWER(CrimeName) LIKE '%$CrimeName%'";
$result = $dbcon->query($query);


print '<br>Enter Crime ID:<br>';
if ($result->num_rows== 0)
{
	print "<input type=text name=CrimeID value=>";
}
else 
{
	print "<input type=text name=CrimeID value='" . urldecode($_REQUEST['CrimeID']) . "'>";
// echo '<input type="text" name="CrimeID"><br>';

print '<br>Enter Crime Name:<br>';
if ($result->num_rows== 0)
{
	print "<input type=text name=CrimeName value=>";
}
else 
{
	print "<input type=text name=CrimeName value='" . urldecode($_REQUEST['CrimeName']) . "'>";
}



print '<br>Enter Motive:<br>';
echo '<input type="text" name="motive"><br>';


echo '<br><input type=submit value=Submit></form>';

// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);
?>

 <?php

 // Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'daiy';
$password = 'MuV1oode';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
or die('Could not connect: ' . mysqli_connect_error());
print 'delete_author connected successfully!<br>';
 
print ('<head><link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/custom.css" rel="stylesheet"></head>>');

print ('<br><a href="index.html">Back to Home</a><br>');

echo '<form method=post action=delete_author.php>';

//AuthorName, Gender, Nationality, nat_id_fk

$Author = strtolower($_REQUEST['AuthorName']);
// $Gender = strtolower($_REQUEST['Gender']);
// $Nationality = strtolower($_REQUEST['Nationality']);
// $NationalityID = strtolower($_REQUEST['nat_id_fk']);

$query = "SELECT AuthorName, Gender, Nationality, nat_id_fk FROM Authors WHERE LOWER(AuthorName) LIKE '%$Author%'";

$result = $dbcon->query($query);

// $Authorrow = $result->fetch_assoc();


print '<br>Enter Author Name:<br>';
if ($result->num_rows== 0)
{
  print "<input type=text name=AuthorName value=>";
}
else 
{
  print "<input type=text name=AuthorName value='" . urldecode($_REQUEST['AuthorName']) . "'>";
}


// echo '<input type="text" name="AuthorName"><br>';


// print '<br>Enter Gender:<br>';
// echo '<input type="text" name="Gender"><br>';
// print '<br>Enter Nationality:<br>';
// echo '<input type="text" name="Nationality"><br>';
// print '<br>Enter Country:<br>';
// echo '<input type="text" name="Country"><br>';


echo '<br><input type=submit value=Submit></form>';


// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);

?>

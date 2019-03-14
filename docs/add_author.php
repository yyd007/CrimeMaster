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

print ('<head><link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/custom.css" rel="stylesheet"></head>>');

print ('<br><a href="index.html">Back to Home</a><br>');

echo '<form method=post action=update_author.php>';


$Author = strtolower($_REQUEST['AuthorName']);

$query = "SELECT AuthorName, Gender, Nationality, nat_id_fk FROM Authors WHERE LOWER(AuthorName) LIKE '%$Author%'";

$result = $dbcon->query($query);

$Authorrow = $result->fetch_assoc() ;
//echo $Authorrow['Gender'];

if ($result->num_rows== 0)
{
	print "<input type=text name=AuthorName value=>";
}
else 
{
	print "<input type=text readonly name=AuthorName value='" . urldecode($_REQUEST['AuthorName']) . "'>";
}



print '<br>Enter Gender:<br>';

echo '

<select name="Gender">
  <option value="Male"';

  if ($Authorrow['Gender'] == "Male")
  	echo " Selected";

  echo '>M</option>
  <option value="Female"';


  if ($Authorrow['Gender'] == "Female")
  	echo " Selected";

  echo '
  >F</option>
</select>
';

// echo '</form>';


$query = "SELECT nat_id, nat_desc FROM codeNationality";
//echo $query;
$result = $dbcon->query($query);
//or die('Query failed: ' . mysqli_error($dbcon));

//print "Number of records found: $result->num_rows<br>";



print 'Enter Nationality:<br>';
print "<select name='nat_id'>";
while($row = $result->fetch_assoc() )
{
	print "<option value=" . $row['nat_id'];
	if ($row['nat_id'] == $Authorrow['nat_id_fk'])
		echo " selected";

	print ">" . $row['nat_desc'];

}
print "</select>";


echo '<br><input type=submit value=Submit></form>';


// Free result
    mysqli_free_result($result);

// Closing connection
    mysqli_close($dbcon);

?>

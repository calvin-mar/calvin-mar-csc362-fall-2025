<?php
    $dbhost = 'localhost';
    $dbuser = 'calvinmar'; // Hard-coding credentials directly in code is not ideal: (1) we might have to 
    $dbpass = 'roundtable';       // change them in multiple places, and (2) this creates security concerns. 
                                // We'll fix that in the next lab.
    $conn = new mysqli($dbhost, $dbuser, $dbpass);
?>
<?php

if ($conn->connect_errno) {
    echo "Error: Failed to make a MySQL connection, here is why: ". "<br>";
    echo "Errno: " . $conn->connect_errno . "\n";
    echo "Error: " . $conn->connect_error . "\n";
    exit; // Quit this PHP script if the connection fails.
} else {
    echo "Connected Successfully!" . "<br>";
    echo "YAY!" . "<br>";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Databases Available</title>
</head>
<body>
    <h1>Databases Available</h1>

</body>
</html>
<?php
    $dblist = "SHOW databases";
    $result = $conn->query($dblist); 
    while ($dbname = $result->fetch_array()) {
        echo $dbname['Database'] . "<br>";
    }
    $conn->close(); 
?>
 <p><br><p>
 <form action="details.php" method="post">
    <label for="database">Enter a Database for more details:</label>
    <input name="database" id="database" type="text">


    <button type="submit">Submit</button>
</form> 
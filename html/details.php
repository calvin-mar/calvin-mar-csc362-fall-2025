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
} 
    $use_db = "USE " . $_POST['database'];
    $switch = $conn->query($use_db);
    
    if (!$switch) {
        echo "Failed to select database: " . htmlspecialchar($_POST['database']) . "<br>";
        echo "Error: " . $conn->error . "<br>";
        $conn->close();
        exit;
    }
    else {
        echo "<b>" . $_POST['database'] . " Database contains the following tables: </b>";
    }
    $dbtables = "SHOW TABLES";
    
    $result = $conn->query($dbtables); 
    echo "<ul>";
    while ($tblname = $result->fetch_array()) {
        echo "<br><li>" . $tblname[0] . "</li>";
    }
    echo "</ul>";
    $conn->close();   
?>
<?php
    // Show all errors from the PHP interpreter.
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Show all errors from the MySQLi Extension.
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);  
?>
<?php
    $config = parse_ini_file('/home/calvinmar/mysqli.ini');


    $dbname  = $_POST['database'];
    $conn = new mysqli(
        $config['mysqli.default_host'],
        $config['mysqli.default_user'],
        $config['mysqli.default_pw'],
        $dbname);

    if ($conn->connect_errno) {
        echo "Error: Failed to make a MySQL connection, here is why: ". "<br>";
        echo "Errno: " . $conn->connect_errno . "\n";
        echo "Error: " . $conn->connect_error . "\n";
        exit; // Quit this PHP script if the connection fails.
    } 
    
    echo "<b>" . $_POST['database'] . " Database contains the following tables: </b>";
    $dbtables = "SHOW TABLES";
    
    $result = $conn->query($dbtables); 
    echo "<ul>";
    while ($tblname = $result->fetch_array()) {
        echo "<br><li>" . $tblname[0] . "</li>";
    }
    echo "</ul>";
    $conn->close();   
?>
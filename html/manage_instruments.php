<?php
    // Show all errors from the PHP interpreter.
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Show all errors from the MySQLi Extension.
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);  
?>
<?php
function result_to_html_table($result) {
        $qryres = $result->fetch_all();
        $n_rows = $result->num_rows;
        $n_cols = $result->field_count;
        $fields = $result->fetch_fields();
        ?>
        <form method="POST">
        <!-- Description of table - - - - - - - - - - - - - - - - - - - - -->
        <!-- <p>This table has <?php //echo $n_rows; ?> rows and <?php //echo $n_cols; ?> columns.</p> -->
        
        <!-- Begin header - - - - - - - - - - - - - - - - - - - - -->
        <!-- Using default action (this page). -->
        <table>
        <thead>
        <tr>
            <td><b>DELETE?</b></td>
        <?php for ($i=0; $i<$n_cols; $i++){ ?>
            <td><b><?php echo $fields[$i]->name; ?></b></td>
        <?php } ?>
        </tr>
        </thead>
        
        <!-- Begin body - - - - - - - - - - - - - - - - - - - - - -->
        <tbody>
        <?php for ($i=0; $i<$n_rows; $i++){ ?>
            <?php $id = $qryres[$i][0]; ?>
            <tr>
            <td>
            <?php if($qryres[$i][2] === NULL || $qryres[$i][2] === ""){?>
                <?php echo "<input type=\"checkbox\" name=\"checkboxes[]\" value=$id />" ?>
            <?php } else {
                echo "<input type=\"checkbox\" name=\"checkboxes[]\" value=$id disabled=\"disabled\"x \>";
            }?>
            </td>     
            <?php for($j=0; $j<$n_cols; $j++){ ?>
                <td><?php echo $qryres[$i][$j]; ?></td>
            <?php } ?>
            </tr>
        <?php } ?>
        </tbody></table>
        <p><input type="submit" name="delbtn" value="Delete Selected Records" /></p>
        </form>
<?php } 
$config = parse_ini_file('/home/calvinmar/mysqli.ini');


$conn = new mysqli(
    $config['mysqli.personal_host'],
    $config['mysqli.personal_user'],
    $config['mysqli.personal_pw'],
    "instrument_rentals");

if ($conn->connect_errno) {
    echo "Error: Failed to make a MySQL connection, here is why: ". "<br>";
    echo "Errno: " . $conn->connect_errno . "\n";
    echo "Error: " . $conn->connect_error . "\n";
    exit; // Quit this PHP script if the connection fails.
} 
if(array_key_exists('add_records', $_POST)){
    $config = parse_ini_file('/home/calvinmar/mysqli.ini');
    
    $add_query = file_get_contents("add_instruments.sql");
    $conn->query($add_query);
    $conn->close();
    // Redirect the client to this page, but using a get request this time.
    // Code 303 means "See other"
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    exit(); 
}if (array_key_exists('delbtn', $_POST)){
    if(isset($_POST['checkboxes'])){
        $dels = $_POST['checkboxes'];
   };

    $del_stmt = file_get_contents("delete_instrument.sql");
    $del_stmt = $conn->prepare($del_stmt);
    $del_stmt->bind_param('i', $id);
    foreach($dels AS $id){
        $del_stmt->execute();
    }
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    exit(); 
}
$select_query = file_get_contents("select_instruments.sql");
$query_result = $conn->query($select_query);
result_to_html_table($query_result);
?>
<html>
<form method="POST">
<input type="submit" name="add_records" value="Add Extra Records" />
</form>
</html>

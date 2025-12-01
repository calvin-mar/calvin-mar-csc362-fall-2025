<?php
    // Show all errors from the PHP interpreter.
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Show all errors from the MySQLi Extension.
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);  
?>
<?php
ini_set('session.gc_maxlifetime', 1800);
session_set_cookie_params(1800);
session_start();
if(isset($_POST['add_name'])){
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['deleted_records'] = 0;
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
}
if(array_key_exists('logout', $_POST)){
    session_unset();            
    session_destroy(); 
}
if(array_key_exists('ld_toggle', $_POST)){
    if(!isset($_COOKIE["dark_mode"])){
        setcookie("dark_mode", 0, time()+60*30, "/", "", false, true);
    } 
    else if($_COOKIE["dark_mode"] == 0){
        setcookie("dark_mode", 1, time()+60*30, "/", "", false, true);
    }
    else{
        setcookie("dark_mode", 0, time()+60*30, "/", "", false, true);
    }
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
}

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


function name_header(){
    if(!(isset($_SESSION['name']))){
        echo "<p>Remember my session: </p>";
        echo "<form method=\"POST\">";
        echo "<input type=\"text\" id=\"name\" name=\"name\" placeholder=\"Enter name: \">";
        echo "<input type=\"submit\" name=\"add_name\" value=\"Remember Me\" />";
        echo "</form>";
    }
    else{
        echo "<p>Welcome " . $_SESSION['name'] . "</p>";
        echo "<form method=\"POST\">";
        echo "<input type=\"submit\" name=\"logout\" value=\"Logout\" />";
        echo "</form>";
    }
}

function display_deleted_records(){
    if(isset($_SESSION['deleted_records']) and $_SESSION['deleted_records'] > 1){
        echo "<p>You have deleted " . (string)$_SESSION['deleted_records'] . " records.<br></p>";
    }
    if(isset($_SESSION['deleted_records']) and $_SESSION['deleted_records'] === 1){
        echo "<p>You have deleted 1 record.<br></p>";
    }
    else{
        echo "<p>You have deleted no records.<br></p>";
    }
    echo "<p><i>Logging out will clear this counter.</i><p/>";
}

function set_dark_mode(){
    if(!isset($_COOKIE["dark_mode"]) || $_COOKIE["dark_mode"] == 0){
        echo "<link rel=\"stylesheet\" href=\"basic.css\">";
    }
    else {
        echo "<link rel=\"stylesheet\" href=\"darkmode.css\">";
    }
    
}

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
        if(isset($_SESSION['deleted_records'])){
            $_SESSION['deleted_records'] += 1;
        }
    }
    header("Location: {$_SERVER['REQUEST_URI']}", true, 303);
    exit(); 
}
$select_query = file_get_contents("select_instruments.sql");
$query_result = $conn->query($select_query);

?>
<html>
<title>Delete From Table</title>
<h1>Delete Instruments</h1>
<form method="POST">
<input type="submit" name="ld_toggle" value="Toggle Light/Dark mode" />
</form>
<?php set_dark_mode();?>
<?php name_header(); ?>
<?php result_to_html_table($query_result); ?>
<?php display_deleted_records();?>
<form method="POST">
<input type="submit" name="add_records" value="Add Extra Records" />
</form>
</html>

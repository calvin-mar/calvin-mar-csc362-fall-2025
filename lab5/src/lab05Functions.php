<?php
function summarize_text_file(string $text_file_name){
    $file_ar = [];
    $fileobj = fopen($text_file_name, "r") or die("Unable to open file!");
    $i=0;
    while(!feof($fileobj)) {
        echo (string)$i;
        $i++;
        $line = fgets($fileobj);
        $line = preg_replace('/[[:punct:]]/', '', strtolower($line));
        $line_ar = explode(" ", $line);
        foreach($line_ar as $word){
            if(key_exists($word, $file_ar)){
                $file_ar[$word] += 1;
            } else{ 
                $file_ar[$word] = 1;
            }
        }
      }
      fclose($fileobj);
      return $file_ar;
};

function make_multiplication_table(int $size){
    $array = [];
    for($i=0; $i < $size; $i++){
        $line = [];
        for($j=0; $j < $size; $j++){
            $line[] = $i*$j;
        }
        $array[] = $line;
    }
    return $array;
};

function pad_to_longest(array &$string_array, bool $do_pad_left=true){
    $max_len = 0;
    foreach($string_array as $word){
        if(strlen($word) > $max_len){
            $max_len = strlen($word);
        }
    }
    for($i=0; $i<count($string_array); $i++){
        if($do_pad_left){
            $string_array[$i] = str_pad($string_array[$i], $max_len, " ", STR_PAD_LEFT);
        }
        else{
            $string_array[$i] = str_pad($string_array[$i], $max_len, " ", STR_PAD_RIGHT);
        }
    }
};

?>

<?php
/*
This appears to longer be a part of the lab, so I am commenting it out.

function format_result_as_table(mysqli_result $result): void {
    $fields = $result->fetch_fields();
    echo "<html>";
    echo "<table>";
    echo "<tr>";
    for($i=0; $i<count($fields); $i++){
       echo "<th>" . $fields[$i] . "</th>";
    }
    echo "</tr>";
    while($row = $result->fetch_array()){
        echo "<tr>";
        for($i=0; $i<count($row); $i++){
            echo "<th>" . $row[$i] . "</th>";
        }
        echo "</tr>";
    }
    echo "</table>";
    echo "</html>";
}
*/
?>

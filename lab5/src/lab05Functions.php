<?php
function summarize_text_file(string $text_file_name){
    $file_ar = [];
    $fileobj = fopen($text_file_name, "r");
    while(!feof($fileobj)) {
        $line = $fgets.gets($fileobj);
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
      return $file_ar;
};

function make_multiplication_table(int $size){
    $array = [];
    for($i=0; $i < $size; $i++){
        $line = [];
        for($j=0; $j < $size; $J++){
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
}
?>
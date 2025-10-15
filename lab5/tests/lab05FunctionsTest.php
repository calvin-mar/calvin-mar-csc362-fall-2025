<?php
include "lab5/src/lab05Functions.php";

use PHPUnit\Framework\TestCase;

class lab05FunctionsTest extends TestCase 
{
    public function setUp(): void
    {
    # Turn on error reporting
    error_reporting(E_ALL);
    // ...
    }   

    public function test_summarize_text_file1() : void {
        $result = summarize_text_file("/home/calvinmar/calvin-mar-csc362-fall-2025/lab5/src/test_file_1.txt");
        $expected = ["there"=>4, "im"=>2, "not"=>1, "sure"=>1,"unsure"=>1,"i"=>1,"am"=>1];
        $this->assertIsArray(
            $result,
            "Expected an array, but received" . (string)gettype($result));
        $this->assertEquals(
            $expected, 
            $result, 
            "The array was incorrect");
    }

    public function test_make_multiplication_table1() : void {
        $result = make_multiplication_table(1);
        $expected = [[0]];
        $this->assertEquals(
            $expected, 
            $result, 
            "The table was incorrect");
    }
    public function test_make_multiplication_table2() : void {
        $result = make_multiplication_table(3);
        $expected = [[0, 0, 0], [0, 1, 2], [0, 2, 4]];
            $this->assertEquals(
                $expected, 
                $result, 
                "The array was incorrect.");
    }
    public function test_make_multiplication_table3() : void {
        $result = make_multiplication_table(8);
        $expected = [[0,  0,  0,  0,  0,  0,  0, 0],
                     [0,  1,  2,  3,  4,  5,  6, 7],
                     [0,  2,  4,  6,  8,  10,  12, 14],
                     [0,  3,  6,  9,  12,  15,  18, 21],
                     [0,  4,  8,  12,  16,  20,  24,  28],
                     [0,  5,  10,  15,  20,  25,  30,  35],
                     [0,  6,  12,  18,  24,  30,  36,  42],
                     [0,  7,  14,  21,  28,  35,  42,  49]];
        $this->assertEquals(
            $expected, 
            $result, 
            "The array was incorrect.");
    }

    public function test_pad_to_longest1() : void {
        $result = ["cat", "bird", "forthwith", "by"];
        pad_to_longest($result);
        $expected = ["      cat", "     bird", "forthwith", "       by"];
        $this->assertIsArray(
            $result,
            "Expected an array, but received" . (string)gettype($result));
        $this->assertEquals(
            $expected, 
            $result, 
            "The array was incorrect.");
    }
    public function test_pad_to_longest2() : void {
        $result = ["by", "cat", "bird", "forthwith"];
        pad_to_longest($result);
        $expected = ["       by", "      cat", "     bird", "forthwith"];
         $this->assertIsArray(
            $result,
            "Expected an array, but received" . (string)gettype($result));
        $this->assertEquals(
            $expected, 
            $result, 
            "The array was incorrect.");
    }
    public function test_pad_to_longest3() : void {    
        $result = ["forthwith", "by", "cat", "bird"];
        pad_to_longest($result);
        $expected = ["forthwith", "       by", "      cat", "     bird"];
         $this->assertIsArray(
            $result,
            "Expected an array, but received" . (string)gettype($result));
        $this->assertEquals(
            $expected, 
            $result, 
            "The array was incorrect.");
    }
    public function test_pad_to_longest4() : void {
        $result = ["cat", "bird", "forthwith", "by"];
        pad_to_longest($result, false);
        $expected = ["cat      ", "bird     ", "forthwith", "by       "];
        $this->assertIsArray(
            $result,
            "Expected an array, but received" . (string)gettype($result));
        $this->assertEquals(
            $expected, 
            $result, 
            "The array was incorrect.");
    }
    /*
    This isn't done and would need more tests, but it appears to no longer be a part of the lab.

    public function test_format_result_as_table1(): void{
        $dbhost = 'localhost';
        $dbuser = 'calvinmar';  
        $dbpass = 'roundtable';      
        $conn = new mysqli($dbhost, $dbuser, $dbpass, "pets");
        $table= $conn->query("SELECT * FROM cats"); 
        ob_start();
        format_result_as_table($table);
        ob_end_flush();
        $result = ob_get_clean();
        $this->assertMatchesRegularExpression(
            "<html>(.|\n)*<\/html>",
            $result,
            "The output is missing <html> and </html>tags"
        );
        }
    */
}
?>
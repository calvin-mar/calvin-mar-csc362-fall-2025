<?php

include "src/lab05Functions.php";

use PHPUnit\Framework\TestCase;

class summarizeTextFileTest extends TestCase 
{
    public function test_summarize_text_file() : void {
        $result = summarize_text_file("test_file_1.txt");
        $expected = ["there"=>4, "im"=>2, "not"=>1, "sure"=>1,"unsure"=>1,"i"=>1,"am"=>1];
        $this->assertIsArray(
            $result,
            "Expected an array, but received" . (string)gettype($result));
        $this->assertEquals(
            $expected, 
            $result, 
            "The text was $result, but should have been $expected.");
    }
}
class makeMultiplicationTableTest extends TestCase 
{
    public function test_make_multiplication_table() : void {
        $result = make_multiplication_table(1);
        $expected = [[0]];
        $this->assertEquals(
            $expected, 
            $result, 
            "The array was $result, but should have been $expected.");

        $result = make_multiplication_table(3);
        $expected = [[0, 0, 0], [0, 1, 2], [0, 2, 4]];
            $this->assertEquals(
                $expected, 
                $result, 
                "The array was $result, but should have been $expected.");

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
            "The array was $result, but should have been $expected.");
    }
}
class padToLongestTest extends TestCase 
{
    public function test_pad_to_longest() : void {
        $result = ["cat", "bird", "forthwith", "by"];
        pad_to_longest($$result);
        $expected = ["      cat", "     bird", "forthwith", "       by"];
        $this->assertIsArray(
            $result,
            "Expected an array, but received" . (string)gettype($result));
        $this->assertEquals(
            $expected, 
            $result, 
            "The text was $result, but should have been $expected.");

        $result = ["by", "cat", "bird", "forthwith"];
        pad_to_longest($result);
        $expected = ["       by", "      cat", "     bird", "forthwith"];
         $this->assertIsArray(
            $result,
            "Expected an array, but received" . (string)gettype($result));
        $this->assertEquals(
            $expected, 
            $result, 
            "The text was $result, but should have been $expected.");
        
        $result = ["forthwith", "by", "cat", "bird"];
        pad_to_longest($result);
        $expected = ["forthwith", "       by", "      cat", "     bird"];
         $this->assertIsArray(
            $result,
            "Expected an array, but received" . (string)gettype($result));
        $this->assertEquals(
            $expected, 
            $result, 
            "The text was $result, but should have been $expected.");

        $result = ["cat", "bird", "forthwith", "by"];
        pad_to_longest($result, false);
        $expected = ["cat      ", "bird    ", "forthwith", "by       "];
        $this->assertIsArray(
            $result,
            "Expected an array, but received" . (string)gettype($result));
        $this->assertEquals(
            $expected, 
            $result, 
            "The text was $result, but should have been $expected.");
    }
}

?>
<?php
/**
 * 1.Write a PHP function to sort an array of strings by their length, in ascending order. 
 * (Hint: You can use the usort() function to define a custom sorting function.)
 */
function sortByLength($a,$b){
    return strlen($b)-strlen($a);
}
$arrayAnimal = array("lion", "dog", "cat", "tiger", "monkey");
usort($arrayAnimal,'sortByLength');
// print_r($arrayAnimal);

/**
 * 2.Write a PHP function to concatenate two strings, but with the second string starting from the end of the first string.
 */

 function concatenateTwoString(string $stringOne,string $stringTwo):string{
    $result ='';
    $result = $stringOne.' '.$stringTwo;
    return $result;
 }

//  echo concatenateTwoString('Suman','Sen');
/**
 * 3.Write a PHP function to remove the first and last element from an array and return the remaining elements as a new array.
 */
 
function firstAndLastDataRemove(array $array):array{
    array_shift($array);
    array_pop($array);
    return $array;
}
$arrayAnimal = array("lion", "dog", "cat", "tiger", "monkey");
// print_r(firstAndLastDataRemove($arrayAnimal));

/**
 * 4.Write a PHP function to check if a string contains only letters and whitespace.
 */
function checkLetterWhitspace(string $string):string{

    if(!preg_match('/[^A-Za-zs*$]/', $string)){
        return 'ache';
    }else{
        return 'n/a';
    }

}
$string = '1111 2222';
echo checkLetterWhitspace($string);
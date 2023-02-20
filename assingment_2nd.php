<?php

/**
 * Company Name: HF Consultancy
 * Function Name: Commission Calculation For Admission Agent
 * Input: Tuition Fees( Data Type Double)
 * Condition:  tuition>20k=>25%,
 *             tuition>10=>20%,
 *             7<tuition<10=>15%,
 *             tuition<7k=>INVALID
 * Output: Commission (Data type Double)
 * Build Function: Ternary Oparator
 */


$tuitionFess = 7000;

$commission = ($tuitionFess >= 20000) ? ($tuitionFess * (25 / 100)) : (($tuitionFess >= 10000 ? ($tuitionFess * (20 / 100)) : (($tuitionFess >= 7000) ? ($tuitionFess * (15 / 100)) : 'INVALID')));

echo 'Fees ' . $tuitionFess . ' is Commisson ' . $commission;


//goto loop
$i = 0;
a:$i++;
echo $i.PHP_EOL;
if($i<10) goto a; 
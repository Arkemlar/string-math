<?php
require '../vendor/autoload.php';

 ini_set('display_errors','1');
 ini_set('error_reporting ',E_ALL);
$num1 = '213';
$num2 = '31254';
//$res  = '31467';
//Resolver::sum($num1, $num2);

//$num1 = '00321';
//$num2 ='-31254';
//$res  ='-30933';
//Resolver::sum($num1, $num2);

//$num1 ='-00321';
//$num2 = '00024';
//$res  ='-00297';
//Resolver::sum($num1, $num2);

//$num1 = '2013';
//$num2 = '-30000';
//$res  = '-27987';


echo '<pre>';
\Arkemlar\EndlessMath\Resolver::sum('00321', '-31254');
echo '</pre>';






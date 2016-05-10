<?php

error_reporting(E_ALL);

$link = mysql_connect('localhost', 'root', '');

if (!$link) {

    echo "-ERR MySQL Error: " . mysql_error();
    exit();
}

mysql_select_db("carrentaluni");
$smsID = $_GET["smsID"];
$MSISDN = $_GET["MSISDN"];
$mobileSP = $_GET["msp"];
$smsBody = $_GET['smsBody'];

$smssmsBody = str_replace(" ", "", $smsBody);

$smsID = addslashes($smsID);
$MSISDN = addslashes($MSISDN);
$mobileSP = addslashes($mobileSP);
$smsBody = addslashes($smsBody);

$args = explode(':', $smsBody);
$Brand = $args[0];
$Np= count($args);
if($Np==2) 
$NumOfDays = $args[1];


$selectSQL = "
	SELECT
		*
	FROM
		carrentaldata
WHERE
Brand='$Brand'
";

$rSelect = mysql_query($selectSQL);

if ($rSelect == false){

    echo "-ERR MySQL Error: " . mysql_error() . "\nSQL: $selectSQL";
    exit();
} else {

    $count = mysql_num_rows($rSelect);

    if ($count == 0) {

        echo "+OK Invalid request Brand.";
        mysql_close($link);
        exit();
    }

    $row = mysql_fetch_array($rSelect);

    $price = $row['Price'];
    $ID = $row['ID'];
    $Brand = $row['Brand'];
    $dt = $row['DateTime'];
if ($Np==2) 

{$Totalprice = $NumOfDays * $price; 


    echo '+OK your Total Price For ' . $Brand . ' for ' . $NumOfDays . '  days is ' . $Totalprice;
}
    else  
        echo "+OK The price per day is $price ";

    exit();
}
mysql_close($link);
?>

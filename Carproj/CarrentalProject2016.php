<?php

//
//	Lotto 2016 * Acceptor
//
//	http://localhost/
//
//      http://localhost/PHP2016/CarrentalProject2016.php?smsID=1&MSISDN=359899866747&msp=87&smsBody=Behnz:2:5
//
//	set error reporting
error_reporting(E_ALL);

$link = mysql_connect('localhost', 'root', '');

if (!$link) {

    echo "-ERR MySQL Error: " . mysql_error();
    exit();
}
echo "<br>CarrentalProject<br>";

mysql_select_db("carrental");
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
$NumOfDays = $args[1];

//echo '<br>$Brand=' . $Brand . ',$NumOfDays=' . $NumOfDays . '<br>';
$selectSQL = "
	SELECT
		*
	FROM
		carrentaldata
WHERE
Brand='$Brand'
";

$rSelect = mysql_query($selectSQL);

if ($rSelect == false) {

    echo "-ERR MySQL Error: " . mysql_error() . "\nSQL: $selectSQL";
    exit();
} else {

    $count = mysql_num_rows($rSelect);

    if ($count == 0) {

        echo "<br>";
        echo "+OK Invalid request Brand.";
        exit();
    }

    $row = mysql_fetch_array($rSelect);

    echo '<br> DateTime=' . $row['DateTime'];

    $price = $row['Price'];
    $ID = $row['ID'];
    $Brand = $row['Brand'];

    $Totalprice = $NumOfDays * $price;

    echo '+OK your Total Price For ' . $Brand . ' for ' . $NumOfDays . '  days is ' . $Totalprice;
    exit();
}

mysql_close($link);
?>

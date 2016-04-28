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

if ($rSelect == false) {

    echo "-ERR MySQL Error: " . mysql_error() . "\nSQL: $selectSQL";
    exit();
} else {

    $count = mysql_num_rows($rSelect);

    if ($count == 0) {

        echo "+OK Invalid request Brand.";
        exit();
    }

    $row = mysql_fetch_array($rSelect);

    $price = $row['Price'];
    $ID = $row['ID'];
    $Brand = $row['Brand'];
    $dt = $row['DateTime'];

    $Totalprice = $NumOfDays * $price;

    echo '+OK your Total Price For ' . $Brand . ' for ' . $NumOfDays . '  days is ' . $Totalprice;
    exit();

    if (0) {
        $ID1 = $ID + 1;

        $insertSQL = "
     INSERT INTO carrentaluni1
     Where ID = '$ID1'
      (ID, Brand ,Price ,DateTime)
      VALUES
      ('DateTime' . '$Brand' ,'$Price', $dt)
    ";

        $rSelect = mysql_query($insertSQL);

        if ($rSelect == false) {

            echo "-ERR MySQL Error: " . mysql_error() . "\nSQL: $selectSQL";
            exit();
        }
    }
}
mysql_close($link);
?>

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

//
//	open connection
$link = mysql_connect('localhost', 'root', '');

if (!$link) {
    //
    //	print error and exit()
    echo "-ERR MySQL Error: " . mysql_error();
    exit();
}
echo "<br>CarrentalProject<br>";

//	select db
mysql_select_db("carrental");
//echo '<br> test0 <br>';

//
//	get data from _GET
$smsID = $_GET["smsID"];
$MSISDN = $_GET["MSISDN"];
$mobileSP = $_GET["msp"];
$smsBody = $_GET['smsBody'];

//
//	prepare data (delete space and etc.)
$smssmsBody = str_replace(" ", "", $smsBody);

//
//	add slashes
$smsID = addslashes($smsID);
$MSISDN = addslashes($MSISDN);
$mobileSP = addslashes($mobileSP);
$smsBody = addslashes($smsBody);

$args = explode(':', $smsBody);
$Brand = $args[0];
$NumOfDays = $args[1];
$Price = $args[2];
//echo '<br>$Brand=' . $Brand . ',$NumOfDays=' . $NumOfDays . ',$Price=' . $Price . '<br>';


//	search SQL in codes
$selectSQL = "
	SELECT 
		* 
	FROM 
		carrentaldata 
WHERE 
Brand='$Brand'
";

//
//	exec SQL
$rSelect = mysql_query($selectSQL);

//  check result
if ($rSelect == false) {
    //
    //	print error and exit()
    echo "-ERR MySQL Error: " . mysql_error() . "\nSQL: $selectSQL";
    exit();
} else {
    //
    //	get row count
    $count = mysql_num_rows($rSelect);

    //echo '<br> test1 <br>'; //
    //	check row count
    if ($count == 0) {
        //
        //	print text for invalid code
        echo "<br>";
        echo "+OK Invalid request Brand.";
        exit();
    }

    //
    //	fetch data
    $row = mysql_fetch_array($rSelect);

    //echo '<br> ID=' . $row['ID'];
    //echo '<br> Price=' . $row['Price'];
    //echo '<br> Brand=' . $row['Brand'];
    echo '<br> DateTime=' . $row['DateTime'];



    //
    //	get data
    $price = $row['Price'];
    $ID = $row['ID'];
    $Brand = $row['Brand'];
    $Numberofdays = $row['Numberofdays'];
    echo '<br>';
//echo '+OK your Price is '.$price;
echo '+OK your Total Price For '.$Brand.' for '.$NumOfDays.'  days is '.$price;
exit();
    //
    //	check statusID

}

//
//	close connection
mysql_close($link);
?>
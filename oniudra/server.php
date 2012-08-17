

//////////////////////////////////////////////////
//THE PHP SCRIPT USED WITH THIS EXAMPLE IS BELOW//
//////////////////////////////////////////////////
//Arduino to Xport to PHP to MySQL :
//http://itp.nyu.edu/physcomp/sensors/Code/ArduinoXportMySQL
/*

<?php
// get username & pwd info:
include "secret.php";

// initialize variables:
$sensorValue = -1;        // value from the sensor
$date = -1;                // date string: YYYY-MM-DD
$time = -1;                // time string: HH:mm:ss in 24-hour clock
$recordNumber = -1;        // which record to delete
$list = 0;                // whether or not to list results in HTML format
$databaseName = 'ja771';
$tableName = 'datalogger';

// open the database:
$link = open_database('localhost', $databaseName, $username, $password);

// process all the HTTP GET variables:
while(list($key, $value) = each($HTTP_GET_VARS)) 
{ 
    // action is the SQL action: insert, delete, select, etc.
    if ($key == "action") {
        $action = $value;
    }
    // sensorValue is the result from the remote sensor system
    if ($key == "sensorValue") {
        $sensorValue = $value;
    }
    // date that the sensor reading was taken
    if ($key == "date") {
        $date = $value;    
    }
    // time that the sensor reading was taken
    if ($key == "time") {    
        $time = $value;
    }
    // database record number (for deleting only):
    if ($key == "recNum") {    
        $recordNumber = $value;
    }
    // whether or not to print out results in HTML:
    if ($key == "list") {    
        $list = $value;
    }

}

// insert a new record in the database:
if ($action == "insert") {
    // make sure date and time have values:
    if ($date == -1 || $time == -1) {
        // if not values, generate them from the server time
        // (I should probably properly check for valid date and time strings here):
        list($date, $time) = split(" ", date("Y-m-d H:i:s"));
    }

    // Only insert if we got a sensor value from the GET:
    if (sensorValue != -1) {
        insert_record($tableName, $sensorValue, $date, $time);
    }
}

// if we're supposed to delete, delete:
if ($action == "delete") {
    // only delete if we got a record number from the GET:
    if ($recordNumber != -1) {
        delete_record($tableName, $recordNumber);
    }
}

// if we should list in HTML format, list the whole table:
if ($list == 1) {
    echo "<html><head></head><body>";
    // browse the whole table:
    browse_table($tableName);
    echo "</body></html>";
}

// close the database:
close_database($link);

// end with a 0 to close the session to the client:
echo "\0";
end;

//    Functions    -------------------------------

// Connect to a server and open a database:
function open_database($myServer, $myDatabase, $myUser, $myPwd) {
    $myLink = mysql_connect($myServer, $myUser, $myPwd)
       or die('Could not connect: ' . mysql_error());
    if ($list == 1) {
        echo 'Connected successfully';
    }
    mysql_select_db($myDatabase) or die('Could not select database');
    return $myLink;
}

// close an open database:
function close_database($myLink) {
    mysql_close($myLink);
}

// select all from a table:
function browse_table($myTable) {
    $query = "SELECT * FROM `$myTable`";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());

    // Printing results in HTML
    echo "<table>\n";
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        echo "\t<tr>\n";  //
           foreach ($line as $col_value) {
               echo "\t\t<td>$col_value</td>\n";
           }
           echo "\t</tr>\n";
    }
    echo "</table>\n";
    // Free resultset
    mysql_free_result($result);
}

// insert a new record in the table:
function insert_record($myTable, $recValue, $recDate, $recTime) {
    $query = "INSERT INTO `$myTable` (`Value`, `Date`, `Timestamp`) VALUES ('$recValue', '$recDate','$recTime')";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    // Free resultset
    mysql_free_result($result);

}

// delete a record from the table:
function delete_record($myTable, $recNum) {
    $query = "DELETE FROM `$myTable` WHERE `ID` = $recNum  LIMIT 1";
    $result = mysql_query($query) or die('Query failed: ' . mysql_error());
    // Free resultset
    mysql_free_result($result);
}

?>

*/
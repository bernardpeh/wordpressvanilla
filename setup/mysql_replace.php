<?php

// usage 
$o = getopt('u:p:d:s:r:');
if (count($o) != 5) {
  exit("
    Usage: php $argv[0] -u db_user -p db_pass -d db_name -s search_string -r string_to_be_replaced.
    if no string to be replaced, leave the -r empty
  ");
}

// Config
$server = "localhost";
$username = $o['u'];
$passwd = $o['p'];
$db = $o['d'];
$searchTerm = $o['s'];
// leave $replaced empty if you want to search only
$replaced = $o['r'];
$log = "mysql_search.log";

// --- END OF CONFIGURATION -- //


// This script does a mass search and replace
mysql_connect($server, $username, $passwd) or die(mysql_error());
mysql_select_db("$db");
$r = mysql_query("show tables");

while ($table = mysql_fetch_array($r, MYSQL_ASSOC)) {
  $r1 = mysql_query("show columns from `".$table['Tables_in_'.$db]."`") or die(mysql_error());
  while ($col = mysql_fetch_array($r1, MYSQL_ASSOC)) {
    // echo "Select * from `".$table['Tables_in_'.$db]."` where `". $col['Field']."` like '%$searchTerm%'";
    $r2 = mysql_query("Select * from `".$table['Tables_in_'.$db]."` where `". $col['Field']."` like '%$searchTerm%'") or die(mysql_error());
    while ($match = mysql_fetch_array($r2)) {
        $str = "table(".$table['Tables_in_'.$db].") - First_column_id ($match[0]) - column_matched (". $col['Field'].")\n";
        echo $str;
        if ($replaced != "") {
          mysql_query("update `".$table['Tables_in_'.$db]."` set `".$col['Field']."`=replace(`".$col['Field']."`, '$searchTerm', '$replaced') where `".$col['Field']."` like '%$searchTerm%'") or die(mysql_error());
          $str .= "replaced $searchTerm\n";
          echo $str;
        }
        $fp = fopen($log, 'a+');
        fwrite($fp, $str);
        fclose($fp);
    }
  }
}

// this script fixes serialization issues.
// disable for now. I didn't find it workable
// Bernard 25 nov 2014
// cleanup_db_serialization($db, $server, $username, $passwd);

function cleanup_db_serialization($db, $host, $usr, $pwd)
{
  echo "Cleaning up seralisation data in wp_options table", $db, "\n";

  $table = 'wp_options';    // the table you need to fix
  $column = 'option_value';   // the column with the serialised data in it
  $index_column = 'option_id';// the 

  $cid = mysql_connect($host,$usr,$pwd); 

  if (!$cid) { echo("Connecting to DB Error: " . mysql_error() . "<br/>"); }

  // now let's get the data...

  $SQL = "SELECT * FROM ".$table;
  $retid = mysql_db_query($db, $SQL, $cid);

  if (!$retid) { echo( mysql_error()); }


  while ($row = mysql_fetch_array($retid)) {
      $value_to_fix = $row[$column];
      $index = $row[$index_column];

      // don't need to output everything, uncomment if you want to see, but don't be surprised if some browsers break!

  //    echo ('changing option_id: '.$index.'<br/>');
  //    echo ('before: '.$value_to_fix.'<br/>');
      $fixed_value = __recalcserializedlengths($value_to_fix);
  //    echo ('after: '.$fixed_value.'<br/>');
    
      // now let's create the update query...
    
      $UPDATE_SQL = "UPDATE ".$table." SET ".$column." = '".mysql_real_escape_string($fixed_value)."' WHERE ".$index_column." = '".$index."'";
    
  //    echo 'update SQL - '.$UPDATE_SQL.'<br/><br/>';
    
      // and run it!  Autocommit seems to be the norm with mySQL setups, so none of that here.  You may need to add it if you mod for Oracle or SQLServer.

      $result = mysql_db_query($db,"$UPDATE_SQL",$cid);
    
      if (!$result) {
          echo("ERROR: " . mysql_error() . "<br/>$SQL<br/>"); } 

  }

  mysql_close($cid); 
}

function __recalcserializedlengths($sObject) {
   
    $__ret =preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $sObject );
   
    // return unserialize($__ret);
   return $__ret;
}

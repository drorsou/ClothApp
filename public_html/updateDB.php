<?php

require_once("db.php");

// Empty the temporary tables
connectToDb();
$query = "TRUNCATE TABLE ClothesTemp";
$results = mysql_query($query);
if (!$results)
    die(mysql_error(). "<br>".$query);
$query = "TRUNCATE TABLE ClothToColorTemp";
$results = mysql_query($query);
if (!$results)
    die(mysql_error(). "<br>".$query);
$query = "TRUNCATE TABLE ClothToSizeTemp";
$results = mysql_query($query);
if (!$results)
    die(mysql_error(). "<br>".$query);

mysql_close();

// Run the indexers
include "castroIndexer.php";

include "renuarIndexer.php";

include "nauticaIndexer.php";


connectToDb();

// Switch between the real data and the temporary tables
switch_tables("Clothes", "ClothesTemp");
switch_tables("ClothToColor", "ClothToColorTemp");
switch_tables("ClothToSize", "ClothToSizeTemp");

function switch_tables($real_table, $temp_table){
    $query = "RENAME TABLE ".$real_table." TO temp";
    $results = mysql_query($query);
    if (!$results)
        die(mysql_error(). "<br>".$query);
    $query = "RENAME TABLE ".$temp_table." TO ".$real_table;
    $results = mysql_query($query);
    if (!$results)
        die(mysql_error(). "<br>".$query);
    $query = "RENAME TABLE temp TO ".$temp_table;
    $results = mysql_query($query);
    if (!$results)
        die(mysql_error(). "<br>".$query);
}

mysql_close();

// Unify data (colors, sizes, categories)
include "unifyDB.php";
include "unifyCastroCategories.php";

?>
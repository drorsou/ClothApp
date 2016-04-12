<?php
/**
 * Created by PhpStorm.
 * User: niri
 * Date: 08/04/2016
 * Time: 21:43
 */

header("Access-Control-Allow-Origin: *");
//todo protect from sql injection
require_once("db.php");
connectToDb();
//"INSERT INTO Clothes (MainCategory,SubCategory,Name,Price,Webpage,MainImage) VALUES
$mainCategory="%";
$subCategory="%";
$priceMin = -1;
$priceMax = PHP_INT_MAX ;
$resultsCount= PHP_INT_MAX;
$resultsOffset = 0;

if (isset($_GET["PriceMin"])){
    $priceMin =  $_GET["PriceMin"];
}

if (isset($_GET["PriceMax"])){
    $priceMax =  $_GET["PriceMax"];
}

if (isset($_GET["MainCategory"])){
    $mainCategory =  $_GET["MainCategory"];
}

if (isset($_GET["SubCategory"])){
    $subCategory =  $_GET["SubCategory"];
}

if (isset($_GET["ResultsCount"])){
    $resultsCount =  $_GET["ResultsCount"];
}

if (isset($_GET["ResultsOffset"])){
    $resultsOffset =  $_GET["ResultsOffset"];
}

$query = "SELECT * FROM Clothes WHERE MainCategory LIKE '$mainCategory' AND SubCategory LIKE '$subCategory' AND Price > $priceMin and Price < $priceMax LIMIT $resultsOffset, $resultsCount";

$results = mysql_query($query);

$itemsArr = array();
while($row =mysql_fetch_assoc($results))
{
    $itemsArr[] = $row;
}

echo json_encode($itemsArr,JSON_NUMERIC_CHECK);

?>
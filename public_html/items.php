<?php

header("Access-Control-Allow-Origin: *"); 

require_once("db.php");
connectToDb();
$mainCategory="%";
$subCategory="%";
$priceMin = -1;
$priceMax = PHP_INT_MAX ;
$resultsCount= PHP_INT_MAX;
$resultsOffset = 0;
$size="%";
$color="%";
$storeName = "Renuar','Castro','Nautica";
$sortBy = "RAND(1803)";

if (isset($_GET["PriceMin"]) && !(empty($_GET["PriceMin"]))){
    $priceMin =  mysql_real_escape_string($_GET["PriceMin"]);
}

if (isset($_GET["PriceMax"]) && !(empty($_GET["PriceMax"])) ){
    $priceMax =  mysql_real_escape_string($_GET["PriceMax"]);
}

if (isset($_GET["MainCategory"]) && !(empty($_GET["MainCategory"]))){
    $mainCategory =  mysql_real_escape_string($_GET["MainCategory"]);
}

if (isset($_GET["SubCategory"]) && !(empty($_GET["SubCategory"]))){
    $subCategory =  mysql_real_escape_string($_GET["SubCategory"]);
}

if (isset($_GET["ResultsCount"]) && !(empty($_GET["ResultsCount"]))){
    $resultsCount =  mysql_real_escape_string($_GET["ResultsCount"]);
}

if (isset($_GET["ResultsOffset"]) && !(empty($_GET["ResultsOffset"]))){
    $resultsOffset =  mysql_real_escape_string($_GET["ResultsOffset"]);
}

if (isset($_GET["Size"]) && !(empty($_GET["Size"]))){
    $size =  mysql_real_escape_string($_GET["Size"]);
}

if (isset($_GET["Color"]) && !(empty($_GET["Color"]))){
    $color =  mysql_real_escape_string($_GET["Color"]);
}

if (isset($_GET["StoreName"]) && !(empty($_GET["StoreName"]))){
    $stores = mysql_real_escape_string($_GET["StoreName"]);
    $storeName =  str_replace(",", "','", $stores);
}

if (isset($_GET["SortBy"]) && !(empty($_GET["SortBy"]))){
    $sortBy = mysql_real_escape_string($_GET["SortBy"]);
    if ($sortBy == "desc"){
        $sortBy = "Price DESC";
    }
    else if ($sortBy == "asc") {
        $sortBy = "Price ASC";
    }
}

//$query = "SELECT *, GROUP_CONCAT(Color SEPARATOR ',') as Colors, GROUP_CONCAT(Size SEPARATOR ',')  as Sizes  FROM ClothesDetailed WHERE MainCategory LIKE '$mainCategory' AND SubCategory LIKE '$subCategory' AND Price > $priceMin AND Price < $priceMax AND Size LIKE '$size' AND Color LIKE '$color' AND StoreName IN ('$storeName') group by WebPage ORDER BY RAND()  LIMIT $resultsOffset, $resultsCount";
//$query = 'SELECT * FROM ClothesDetailed WHERE MainCategory LIKE \'$mainCategory\' AND SubCategory LIKE \'$subCategory\' AND Price > $priceMin AND Price < $priceMax AND Size LIKE \'$size\' AND Color LIKE \'$color\' AND StoreName IN (\'$storeName\') group by WebPage ORDER BY RAND()  LIMIT $resultsOffset, $resultsCount";
$query = "SELECT Clothes.*, Clothes.MainImage as ImageColor, GROUP_CONCAT( Colors.Name SEPARATOR ',' ) AS Colors, GROUP_CONCAT( Sizes.Name
SEPARATOR ',' ) AS Sizes
      FROM ClothToSize  
INNER JOIN Clothes ON Clothes.Id = ClothToSize.ClothId 
INNER JOIN Sizes ON Sizes.Id = ClothToSize.SizeId
INNER JOIN ClothToColor ON ClothToColor.ClothId = Clothes.Id
INNER JOIN Colors ON Colors.Id = ClothToColor.ColorId
WHERE MainCategory LIKE '$mainCategory' AND SubCategory LIKE '$subCategory' AND Price > $priceMin AND Price < $priceMax AND Sizes.Name LIKE '$size' AND Colors.Name LIKE '$color' AND StoreName IN ('$storeName')
GROUP BY webpage, ClothToColor.ColorId
ORDER BY $sortBy
LIMIT $resultsOffset, $resultsCount";

/*
 * $query = "SELECT Clothes.*, ClothToColor.Image as ImageColor, GROUP_CONCAT( Colors.Name SEPARATOR ',' ) AS Colors, GROUP_CONCAT( Sizes.Name
SEPARATOR ',' ) AS sizes
      FROM ClothToSize
INNER JOIN Clothes ON Clothes.Id = ClothToSize.ClothId
INNER JOIN Sizes ON Sizes.Id = ClothToSize.SizeId
INNER JOIN ClothToColor ON ClothToColor.ClothId = Clothes.Id
INNER JOIN Colors ON Colors.Id = ClothToColor.ColorId
WHERE MainCategory LIKE '$mainCategory' AND SubCategory LIKE '$subCategory' AND Price > $priceMin AND Price < $priceMax AND Sizes.Name LIKE '$size' AND Colors.Name LIKE '$color' AND StoreName IN ('$storeName')
GROUP BY webpage
ORDER BY $sortBy
LIMIT $resultsOffset, $resultsCount";
 */

$results = mysql_query($query);
if (!$results)
    die(mysql_error(). "<br>".$query);

$itemsArr = array();
while($row =mysql_fetch_assoc($results))
{
    $row["Colors"] = array_values(array_unique(explode(",",$row["Colors"])));
    $row["Sizes"] = array_values(array_unique(explode(",",$row["Sizes"])));
    if (!empty($row["ImageColor"]))
        $row["MainImage"] = $row["ImageColor"];
    $itemsArr[] = $row;
}

echo json_encode($itemsArr,JSON_NUMERIC_CHECK);
mysql_close();
?>
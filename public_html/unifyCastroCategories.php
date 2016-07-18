<?php

require_once "db.php";
connectToDb();



$cat = array();
$cat["shirts"]= array("shirts","tops","t-shirts","tank-tops","polo-shirts","t-shirts-special-price","t-art","knits");
$cat["pants"]= array( "pants","jeans");
$cat["dresses"]= array( "dresses");
$cat["skirts"]= array( "skirts");
$cat["jackets"]= array( "jackets","blazers","coats");
$cat["swimwear"]= array( "swimwear","gideon-oberson");
$cat["shoes"]= array( "shoes");
$cat["bags-wallets"]= array( "bags-wallet");

foreach ($cat as $subCat => $toReplace) {
    foreach ($toReplace as &$value) {
        $query = "UPDATE Clothes SET SubCategory = '$subCat' where SubCategory = '$value'";
        echo ($query."<br>");
        if (!mysql_query($query))
            die(mysql_error());
    }
}

$allSubCat = "'". implode("','", array_keys($cat )) . "'";

$query = "DELETE FROM Clothes WHERE StoreName='Castro' AND SubCategory not in ($allSubCat)";
mysql_query($query);

$query = "DELETE FROM Clothes  WHERE StoreName='Castro' AND Price = 0";
mysql_query($query);

?>
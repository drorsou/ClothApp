<?php

require_once("db.php");
connectToDb();


/*
 * Here you can edit: Colors Lists
 */
$blackColors = array(
    "שחור", "שחור מודפס", "שחור מלאנז'", "אפור שחור", "שחור מט", "שחור ג'ינס", "True Black"
);
$whiteColors = array(
    "לבן", "אופוויט", "שמנת", "אופוויט מלאנז'", "cream", "קרם", "bright", "Whitecap", "Sail White"
);
$blueColors = array(
    "כחול", "כחול נייבי", "navy", "כחול ג'ינס", "ג'ינס", "כחול רוייאל", "אינדיגו", "מיד כחול", "כחול אינדיגו", "כחול עתיק",
    "פסים כחול", "כחול ים אפור", "נייבי מלאנז'", "כחול מלאנז'", "ג'ינס כהה.", "כחול כהה", "פטרול", "אייס בלו", "דנים",
    "נייבי + אדום", "אולטרה מרין", "כחול אלקטריק", "ג'ינס בהיר", "רויאל", "Peacoat", "True navy", "Classic Navy",
    "French Blue", "Union Blue", "Deep Dive Blue", "4JG", "Night sky", "BARRIER BLUE", "Spinner Blue", "Bright Cobalt", "Ocean depths", "Deep Ultra Marine", "Denim Rinse", "Blue Charm", "Woodrift Flax"
);
$greenColors = array(
    "ירוק", "ירוק זית", "מנטה", "זית", "סלדין", "ירוק מלאנז'", "מנטה מלנז'", "ירוק בהיר", "ירוק בקבוק", "ירוק בהיר מלאנז",
    "ירוק פסטל", "cii322 castro red", "black rose 324", "Hunter green", "Jade Green", "Lime Green ", "Pepper Green", "Soft Lime"
);
$redColors = array(
    "אדום", "בורדו", "קוראל נאון 259", "נייבי + אדום", "בורדו'", "אדום/ לבן", "Nautica Red", "Red Skies", "Tango Red",
    "Light Mars Red", "Sailor Red", "שרי", "Persian Red", "Maritime Red", "Windsor wine", "Hibiscus"
);
$pinkColors = array(
    "ורוד", "ורוד בהיר", "ורוד נאון", "ורוד בהיר.", "פוקסיה", "shocking pink", "Blushing Bride", "פוקסיה זוהר",
	"Orchid Pink", "רוז", "ניו קורל", "Pale Coral", "קוראל כהה", "קוראל מלנז'", "קורל", "peach", "אפרסק"
);
$purpleColors = array(
    "סגול", "חציל", "11531 lavender", "לילך", "שזיף", "Aurora Purple", "Magenta Jewel"
);
$greyColors = array(
    "אפור", "מלנז' אפור", "אבן", "אפור כהה", "אפור מלנג'", "אפור מרינגו", "כחול ים אפור", "אפור בהיר", "silver", "אפור בהיר מלאנז'",
    "כסף", "אפור מלאנז' כהה", "אפור פחם", "טאופ", "אפור שחור", "מרנגו", "אבן מלאנז'", "אנטרציט", "Charcoal Heather", "GREY HEATHER",
    "Grey Htr", "Cutting Cobalt", "Coastal Grey Heather", "Dark Oatmeal Heather", "Neutral Grey"
);
$cyanColors = array(
    "תכלת", "טורכיז", "טורקיז", "אקווה מרין", "שמיים", "תכלת מלאנז", "אקווה", "sky blue", "תכלת מלאנז'", "אוקינוס", "Moroccon Blue",
	"Cadet Heather", "Rich Teal", "Scuba Blue", "Waterfall Turq", "Aqua Isle", "טורקיז מלאנז'", "Clear Skies Blue", "Noon Blue"
);
$brownColors = array(
    "חום", "כאמל", "קאמל", "מוקה", "khaki", "בז'", "חאקי", "חאקי מלנג'", "קרמל.", "קפה", "חרדל", "ברונז", "קאמל מלאנז'", "Hanger Brown HTR", "Light Tuscany Tan", "Tannin", "טבעי", "ניוד"
);
$yellowColors = array(
    "צהוב", "gold", "ליים", "צהוב תירס", "צהוב בהיר", "Sunfish Yellow", "Voyage Yellow", "Corn"
);
$orangeColors = array(
    "כתום", "קוראל", "פפאיה", "Sun Coast Orange", "Seafarer Orange", "Orange Poppy"
);
$mixedColors = array(
    "משולב", "מודפס", "פסים..", "הדפסה", "פסים כחול", "צבעוני", "שחור + לבן", "שחור מודפס", "פרחוני", "ללא צבע", "נמר",
    "mixed metal", "נייבי פסים", "נייבי + אדום", "אדום/ לבן", "camuflage", "משובץ", "משבצות.", "Marshmallow"
);

/*
 * Here you can edit: Sizes Lists
 */
$size_30 = array(
    "30"
);
$size_32 = array(
    "32", "31", "31/32"
);
$size_34 = array(
    "34", "33", "33/34"
);
$size_36 = array(
    "36", "35", "35/36"
);
$size_38 = array(
    "38", "37", "37/38", "37-38"
);
$size_40 = array(
    "40", "39", "39/40", "39-40"
);
$size_42 = array(
    "42", "41", "41/42", "41-42"
);
$size_44 = array(
    "44", "43", "43/44", "43-44"
);
$size_XS = array(
    "XS", "Y"
);
$size_S = array(
    "S"
);
$size_M = array(
    "M"
);
$size_L = array(
    "L"
);
$size_XL = array(
    "XL"
);
$size_2X = array(
    "2X", "xxl"
);
$size_3X = array(
    "3X", "xxxl"
);


// The main color categories
$main_colors = array(
    "black" => "0",
    "white" => "0",
    "blue" => "0",
    "green" => "0",
    "red" => "0",
    "pink" => "0",
    "purple" => "0",
    "grey" => "0",
    "cyan" => "0",
    "brown" => "0",
    "yellow" => "0",
    "orange" => "0",
    "mixed" => "0"
);

foreach ($main_colors as $color => &$value){
    $query = "SELECT Id FROM Colors WHERE Name LIKE '".$color."'";
    $results = mysql_query($query);
    if (!$results)
        die(mysql_error(). "<br>".$query);
    $row = mysql_fetch_assoc($results);
    $value = $row["Id"];
}

// The main size categories
$main_sizes = array(
    "30" => "0",
    "32" => "0",
    "34" => "0",
    "36" => "0",
    "38" => "0",
    "40" => "0",
    "42" => "0",
    "44" => "0",
    "XS" => "0",
    "S" => "0",
    "M" => "0",
    "L" => "0",
    "XL" => "0",
    "2X" => "0",
    "3X" => "0"
);

foreach ($main_sizes as $size => &$value){
    $query = "SELECT Id FROM Sizes WHERE Name LIKE '".$size."'";
    $results = mysql_query($query);
    if (!$results)
        die(mysql_error(). "<br>".$query);
    $row = mysql_fetch_assoc($results);
    $value = $row["Id"];
}

echo '<a href="http://clothapp.co.il/colors.php">Colors Counter</a><br>';
echo '<a href="http://clothapp.co.il/sizes.php">Sizes Counter</a><br><br>';

update_colors($main_colors['black'], $blackColors);
update_colors($main_colors['white'], $whiteColors);
update_colors($main_colors['blue'], $blueColors);
update_colors($main_colors['green'], $greenColors);
update_colors($main_colors['red'], $redColors);
update_colors($main_colors['pink'], $pinkColors);
update_colors($main_colors['purple'], $purpleColors);
update_colors($main_colors['grey'], $greyColors);
update_colors($main_colors['cyan'], $cyanColors);
update_colors($main_colors['brown'], $brownColors);
update_colors($main_colors['yellow'], $yellowColors);
update_colors($main_colors['orange'], $orangeColors);
update_colors($main_colors['mixed'], $mixedColors);


update_sizes($main_sizes['30'], $size_30);
update_sizes($main_sizes['32'], $size_32);
update_sizes($main_sizes['34'], $size_34);
update_sizes($main_sizes['36'], $size_36);
update_sizes($main_sizes['38'], $size_38);
update_sizes($main_sizes['40'], $size_40);
update_sizes($main_sizes['42'], $size_42);
update_sizes($main_sizes['44'], $size_44);
update_sizes($main_sizes['XS'], $size_XS);
update_sizes($main_sizes['S'], $size_S);
update_sizes($main_sizes['M'], $size_M);
update_sizes($main_sizes['L'], $size_L);
update_sizes($main_sizes['XL'], $size_XL);
update_sizes($main_sizes['2X'], $size_2X);
update_sizes($main_sizes['3X'], $size_3X);


function update_colors($colorID, $colorsArray){
    $query = "SELECT *  FROM Colors WHERE";
    foreach ($colorsArray as $color){
        $query = $query." Name LIKE '".mysql_real_escape_string($color)."' OR";
    }
    $query = $query." Name LIKE 'nothing'";
    $results = mysql_query($query);
    if (!$results)
        die(mysql_error(). "<br>".$query);

    $query = "UPDATE ClothToColor SET ColorId = ".$colorID." WHERE";
    echo "<table border='1'>";
    while ($row = mysql_fetch_assoc($results)){
        $id = $row["Id"];
        $query = $query." ColorId = ".mysql_real_escape_string($row["Id"])." OR";
        $color = $row["Name"];
        echo "<tr></tr><td>$id</td><td>$color</td></tr>";
    }
    echo "</table>";

    $query = $query." ColorId = ".$colorID;
    $results = mysql_query($query);
    if (!$results)
        die(mysql_error(). "<br>".$query);
}

function update_sizes($sizeID, $sizesArray){
    $query = "SELECT *  FROM Sizes WHERE";
    foreach ($sizesArray as $size){
        $query = $query." Name LIKE '".mysql_real_escape_string($size)."' OR";
    }
    $query = $query." Name LIKE 'nothing'";
    $results = mysql_query($query);
    if (!$results)
        die(mysql_error(). "<br>".$query);

    $query = "UPDATE ClothToSize SET SizeId = ".$sizeID." WHERE";
    echo "<table border='1'>";
    while ($row = mysql_fetch_assoc($results)){
        $id = $row["Id"];
        $query = $query." SizeId = ".mysql_real_escape_string($row["Id"])." OR";
        $color = $row["Name"];
        echo "<tr></tr><td>$id</td><td>$color</td></tr>";
    }
    echo "</table>";

    $query = $query." SizeID = ".$sizeID;
    $results = mysql_query($query);
    if (!$results)
        die(mysql_error(). "<br>".$query);
}

mysql_close();
?>
<?php

function contains($pattern, $str){
    return (strpos($str, $pattern) !== false);
}

set_time_limit(0);
ob_start();
require_once("db.php");

connectToDb();

require_once("ClothItem.php");
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';


$sitemapUrl = "http://www.castro.com/sitemaps/sitemap_image_he.xml";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $sitemapUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$xmlContent = strtolower(curl_exec($ch));

// Will replace : in tags and attributes names with _ allowing easy access
$xmlContent = preg_replace('~(</?|\s)([a-z0-9_]+):~is', '$1$2_', $xmlContent);

$xml = new SimpleXMLElement($xmlContent);

echo "<table border=1>";
$cnt =0;

foreach ($xml->url as $item)
{

    $cnt++;
    if ($cnt % 20 == 0)
        flushBuffers();
    
    $clothItem = new ClothItem();
    $clothItem->setStoreName("Castro");

    echo "<tr>";
    echo "<td>$cnt</td>";
    print("<td>".$item->loc."</td>");
    $clothItem->setWebPage($item->loc);

    curl_setopt($ch, CURLOPT_URL, $item->loc);
    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $cookie = 'GlobalE_Data={"countryISO":"IL","currencyCode":"ILS","cultureCode":"en-GB"}'; //instruct castro to send price in ILS
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: $cookie"));
    // $output contains the output string
    $output = curl_exec($ch);
    $output = strtolower($output);

    $pattern = '/\<link rel=\"canonical" href\=\"http\:\/\/www.castro.com\/he\/([a-zA-Z]+)\/([a-zA-Z\-0-9]+)\//';
    preg_match($pattern, $output, $matches);
    if ($matches[1] == "sale")
    {
        $pattern = '/http\:\/\/www.castro.com\/he\/sale\/([a-zA-Z]+)\/([a-zA-Z\-0-9]+)\//';
        preg_match($pattern, strtolower($item->loc), $matches);

    }
    $clothItem->setMainCategory($matches[1]);
    $clothItem->setSubCategory($matches[2]);
    if (contains("dress",$clothItem->getSubCategory())){
        $clothItem->setSubCategory("dresses");
    }
    printf("<td>%s</td><td>%s</td>", $matches[1], $matches[2]);

    $pattern = '/<div class="name">\s*<h1>([^<]+)/';
    preg_match($pattern, $output, $matches);
    print("<td>".$matches[1]."</td>");
    $clothItem->setName($matches[1]);

    $pattern = '/class="price">\s*[<span>₪<\/span>]*\s*([0-9\.]+)\s*<\/span>/';
    preg_match($pattern, $output, $matches);
    print("<td>".$matches[1]."</td>");
    $clothItem->setPrice($matches[1]);

    if (!is_numeric($clothItem->getPrice()) || $clothItem->getPrice() == 0) //remove unparsed prices
        continue;

    $pattern = "/<a relGallery=\"{gallery:'product_gallery',smallimage:'(http.*?)',largeimage:'http/";
    $pattern = strtolower($pattern);
    preg_match($pattern, $output, $matches);
    print("<td>".$matches[1]."</td>");
    $clothItem->setImages($matches[1]);

    $pattern = '/spconfigjson = (\{.*\}),\s*spconfig =/';
    preg_match($pattern, $output, $matches);
    $json = json_decode($matches[1]);

    $pattern = '/var productgallery = (\{.*\})\;\s*\<\/script/';
    preg_match($pattern, $output, $matches);
    $colorToImageJson = json_decode($matches[1]);

    $colorsJson = $json->{"attributes"}->{"85"}->{"options"};
    $sizesJson = $json->{"attributes"}->{"136"}->{"options"};
    $colors = array();
    foreach ($colorsJson as $color ){
        if ($color->{"instock"}){
            $sizes = array();
            foreach ($color->{"products"} as $colorProdId){
                foreach ($sizesJson as $size)
                {
                    foreach ($size->{"products"} as $sizeProdId) {
                        if ($size->{"instock"} && $sizeProdId == $colorProdId) {
                            $sizes[] = $size->{"label"};
                        }
                    }
                }
            }
            if (count($sizes) == 0) {
                echo "</tr>";
                continue;
            }

            $clothItem->setSizes($sizes);
            $colorId = $color->{"id"};
            $colorImage = $colorToImageJson->{$colorId}->{"main"};
            $clothItem->setColors(array($color->{"label"}));
            $clothItem->setImages($colorImage);
            $clothItem->updateInDb();
            //$colors[] = array($color->{"label"},$colorImage);

        }
    }
    echo "</tr>";
}
echo "</table>";

// close curl resource to free up system resources
curl_close($ch);

mysql_close();

?>
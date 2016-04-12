<?php
/**
 * Created by PhpStorm.
 * User: niri
 * Date: 04/04/2016
 * Time: 20:45
 */

require_once("db.php");
die();
connectToDb();

require_once("ClothItem.php");
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';

$xmlContent = file_get_contents("castroData.xml");
// Will replace : in tags and attributes names with _ allowing easy access
$xmlContent = preg_replace('~(</?|\s)([a-z0-9_]+):~is', '$1$2_', $xmlContent);

$xml = new SimpleXMLElement($xmlContent);
$ch = curl_init();
echo "<table border=1>";
$cnt =0;

foreach ($xml->url as $item)
{
    $clothItem = new ClothItem();

    $clothItem->setImages($item->image_image->image_loc);

    echo "<tr>";
    //var_dump($item);
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
    printf("<td>%s</td><td>%s</td>", $matches[1], $matches[2]);

    $pattern = '/<div class="name">\s*<h1>([^<]+)/';
    preg_match($pattern, $output, $matches);
    print("<td>".$matches[1]."</td>");
    $clothItem->setName($matches[1]);

    $pattern = '/class="price">\s*[<span>₪<\/span>]*\s*([0-9\.]+)\s*<\/span>/';
    preg_match($pattern, $output, $matches);
    print("<td>".$matches[1]."</td>");
    $clothItem->setPrice($matches[1]);

    print("<td><img src='".$clothItem->getImages()."'/></td>");
    print("</tr>");
    $cnt++;

    $clothItem->updateInDb();

}
// close curl resource to free up system resources
curl_close($ch);


?>
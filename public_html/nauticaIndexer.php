<?php

echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
require_once("db.php");
connectToDb();

require_once("ClothItem.php");

echo "<p>Nautica Indexer</p><br>";

$arr = array();

// Women items
nautica_index_sub_category(
    'https://www.nautica.co.il/c/207/%D7%98%D7%95%D7%A4%D7%99%D7%9D-%D7%95%D7%97%D7%95%D7%9C%D7%A6%D7%95%D7%AA-%D7%9C%D7%A0%D7%A9%D7%99%D7%9D',
    'women', 'shirts');
nautica_index_sub_category(
    'https://www.nautica.co.il/c/208/%D7%A9%D7%9E%D7%9C%D7%95%D7%AA',
    'women', 'dresses');
nautica_index_sub_category(
    'https://www.nautica.co.il/c/381/%D7%97%D7%95%D7%9C%D7%A6%D7%95%D7%AA-%D7%9E%D7%9B%D7%95%D7%A4%D7%AA%D7%A8%D7%95%D7%AA-%D7%9C%D7%A0%D7%A9%D7%99%D7%9D',
    'women', 'shirts');
nautica_index_sub_category(
    'https://www.nautica.co.il/c/307/%D7%97%D7%95%D7%9C%D7%A6%D7%95%D7%AA-%D7%A4%D7%95%D7%9C%D7%95-%D7%9C%D7%A0%D7%A9%D7%99%D7%9D',
    'women', 'shirts');
nautica_index_sub_category(
    'https://www.nautica.co.il/c/212/%D7%9E%D7%9B%D7%A0%D7%A1%D7%99%D7%99%D7%9D-%D7%A7%D7%A6%D7%A8%D7%99%D7%9D-%D7%95%D7%91%D7%A8%D7%9E%D7%95%D7%93%D7%95%D7%AA-%D7%9C%D7%A0%D7%A9%D7%99%D7%9D',
    'women', 'pants');
nautica_index_sub_category(
    'https://www.nautica.co.il/c/394/%D7%97%D7%A6%D7%90%D7%99%D7%95%D7%AA',
    'women', 'skirts');
nautica_index_sub_category(
    'https://www.nautica.co.il/c/210/%D7%9E%D7%9B%D7%A0%D7%A1%D7%99%D7%99%D7%9D-%D7%95%D7%92%D7%99%D7%A0%D7%A1%D7%99%D7%9D-%D7%9C%D7%A0%D7%A9%D7%99%D7%9D',
    'women', 'pants');
nautica_index_sub_category(
    'https://www.nautica.co.il/c/209/%D7%9E%D7%A2%D7%99%D7%9C%D7%99%D7%9D-%D7%95%D7%96%D7%A7%D7%98%D7%99%D7%9D',
    'women', 'jackets');
nautica_index_sub_category(
    'https://www.nautica.co.il/c/211/%D7%A1%D7%A8%D7%99%D7%92%D7%99%D7%9D-%D7%9C%D7%A0%D7%A9%D7%99%D7%9D',
    'women', 'shirts');

// Men items
nautica_index_sub_category(
    'https://www.nautica.co.il/c/182/%D7%97%D7%95%D7%9C%D7%A6%D7%95%D7%AA-%D7%9E%D7%9B%D7%95%D7%A4%D7%AA%D7%A8%D7%95%D7%AA-%D7%9C%D7%92%D7%91%D7%A8',
    'men', 'shirts');
nautica_index_sub_category(
    'https://www.nautica.co.il/c/180/%D7%97%D7%95%D7%9C%D7%A6%D7%95%D7%AA-%D7%A4%D7%95%D7%9C%D7%95',
    'men', 'shirts');
nautica_index_sub_category(
    'https://www.nautica.co.il/c/181/%D7%A0%D7%90%D7%95%D7%98%D7%99%D7%A7%D7%94-%D7%99%D7%A9%D7%A8%D7%90%D7%9C-%D7%97%D7%95%D7%9C%D7%A6%D7%95%D7%AA-%D7%98%D7%A8%D7%99%D7%A7%D7%95-%D7%9C%D7%92%D7%91%D7%A8',
    'men', 'shirts');
nautica_index_sub_category(
    'https://www.nautica.co.il/c/187/%D7%91%D7%92%D7%93%D7%99-%D7%99%D7%9D-%D7%9C%D7%92%D7%91%D7%A8%D7%99%D7%9D',
    'men', 'swimwear');
nautica_index_sub_category(
    'https://www.nautica.co.il/c/183/%D7%9E%D7%9B%D7%A0%D7%A1%D7%99-%D7%91%D7%A8%D7%9E%D7%95%D7%93%D7%94-%D7%9C%D7%92%D7%91%D7%A8%D7%99%D7%9D',
    'men', 'pants');
nautica_index_sub_category(
    'https://www.nautica.co.il/c/186/%D7%9E%D7%9B%D7%A0%D7%A1%D7%99%D7%99%D7%9D-%D7%95%D7%92%D7%99%D7%A0%D7%A1%D7%99%D7%9D-%D7%9C%D7%92%D7%91%D7%A8%D7%99%D7%9D',
    'men', 'pants');
nautica_index_sub_category(
    'https://www.nautica.co.il/c/188/%D7%A0%D7%90%D7%95%D7%98%D7%99%D7%A7%D7%94-%D7%99%D7%A9%D7%A8%D7%90%D7%9C-%D7%A1%D7%A8%D7%99%D7%92%D7%99%D7%9D-%D7%9C%D7%92%D7%91%D7%A8',
    'men', 'shirts');
nautica_index_sub_category(
    'https://www.nautica.co.il/c/189/%D7%9E%D7%A2%D7%99%D7%9C%D7%99%D7%9D-%D7%95%D7%96%D7%A7%D7%98%D7%99%D7%9D-%D7%9C%D7%92%D7%91%D7%A8%D7%99%D7%9D',
    'men', 'jackets');


echo "<table border=1>";
foreach ($arr as $color) {
    print("<tr><td>".$color."</td></tr>");
}
echo "</table>";
flushBuffers();
mysql_close();


function nautica_load_dom($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $html = curl_exec($ch);
    curl_close($ch);

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();


    return $dom;
}

function nautica_index_sub_category($url, $main_category, $sub_category)
{
    $dom = nautica_load_dom($url);

    // Debugging
    echo "<table border=1>";
    $counter = 1;
    //

    $counter = nautica_get_items_from_dom($dom, $main_category, $sub_category, $counter);

    // Debugging
    echo "</table>";
    //
    flushBuffers();
}

function nautica_get_items_from_dom($dom, $main_category, $sub_category, $counter){

    foreach($dom->getElementsByTagName('div') as $div_tag)
        if ($div_tag->getAttribute('class') == 'product-list clearfix')
            foreach($div_tag->getElementsByTagName('a') as $a_tag)
                if ($a_tag->getAttribute('class') == 'product-title'){

                    $cloth_item = new ClothItem();
                    $cloth_item->setStoreName('Nautica');
                    $cloth_item->setMainCategory($main_category);
                    $cloth_item->setSubCategory($sub_category);

                    $cloth_item->setName($a_tag->getAttribute('title'));
                    $cloth_item->setWebPage("https://www.nautica.co.il".$a_tag->getAttribute('href'));

                    $counter = nautica_get_item_info($cloth_item, $counter);
                }

    return $counter;
}

function nautica_get_item_info($cloth_item, $counter){
    $url = $cloth_item->getWebPage();
    global $arr;

    $dom = nautica_load_dom($url);

    // Add price to item
    foreach ($dom->getElementsByTagName('span') as $span_tag)
        if ($span_tag->getAttribute('class') == 'price' || $span_tag->getAttribute('class') == 'salePrice'){
            $price = explode('₪', $span_tag->nodeValue);
            $cloth_item->setPrice(trim($price[0]));
        }

    // Add sizes to item
    $sizes_list = array();
    foreach ($dom->getElementsByTagName('select') as $select_tag)
        if ($select_tag->getAttribute('class') == 'size')
            foreach ($select_tag->getElementsByTagName('option') as $option_tag)
                if ($option_tag->getAttribute('value') != "")
                    $sizes_list[] = $option_tag->nodeValue;
    $cloth_item->setSizes($sizes_list);

    // Add color to item
    foreach ($dom->getElementsByTagName('ul') as $ul_tag)
        if ($ul_tag->getAttribute('class') == 'color-list')
            foreach ($ul_tag->getElementsByTagName('a') as $a_tag){

                $item_color = $a_tag->getAttribute('title');
                $cloth_item->setColors(array($item_color));
                if (!in_array($item_color, $arr))
                    $arr[] = $item_color;

                $cut_before_img_link = explode("smallimage: '", $a_tag->getAttribute('rel'));
                $cut_after_img_link = explode("',largeimage", $cut_before_img_link[1]);
                $img_link = $cut_after_img_link[0];
                $cloth_item->setImages($img_link);

                // Debugging
                echo "<tr>";
                print("<td>".$counter."</td>");
                print("<td>".$cloth_item->getWebPage()."</td>");
                print("<td>".$cloth_item->getName()."</td>");
                print("<td>".$cloth_item->getPrice()."</td>");
                print("<td>".implode("," , $cloth_item->getColors())."</td>");
                print("<td>".implode("," , $cloth_item->getSizes())."</td>");
                print("<td>".$img_link."</td>");
                $counter++;
                echo "</tr>";
                //

                // Add item to DB
                $cloth_item->updateInDb();
            }

    return $counter;
}

function nautica_DOMinnerHTML(DOMNode $element)
{
    $innerHTML = "";
    $children  = $element->childNodes;

    foreach ($children as $child)
    {
        $innerHTML .= $element->ownerDocument->saveHTML($child);
    }

    return $innerHTML;
}

?>
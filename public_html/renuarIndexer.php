<?php

echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
require_once("db.php");
connectToDb();

require_once("ClothItem.php");

echo "<p>Renuar Indexer</p><br>";

$arr = array();

// Women items
renuar_index_sub_category('https://www.renuar.co.il/he/women/dresses.html', 'women', 'dresses');
renuar_index_sub_category('https://www.renuar.co.il/he/women/jeans.html', 'women', 'pants');
renuar_index_sub_category('https://www.renuar.co.il/he/women/shirts.html', 'women', 'tops');
renuar_index_sub_category('https://www.renuar.co.il/he/women/shirts-141.html', 'women', 'tops');
renuar_index_sub_category('https://www.renuar.co.il/he/women/skirts.html', 'women', 'skirts');
renuar_index_sub_category('https://www.renuar.co.il/he/women/pants.html', 'women', 'pants');
renuar_index_sub_category('https://www.renuar.co.il/he/women/sweaters.html', 'women', 'tops');
renuar_index_sub_category('https://www.renuar.co.il/he/women/coatsandjackets.html', 'women', 'coats');
renuar_index_sub_category('https://www.renuar.co.il/he/women/pvtrim.html', 'women', 'tops');
renuar_index_sub_category('https://www.renuar.co.il/he/women/swimwear.html', 'women', 'swimwear');
renuar_index_sub_category('https://www.renuar.co.il/he/shoes/women/sniqrs.html', 'women', 'shoes');
renuar_index_sub_category('https://www.renuar.co.il/he/shoes/women/neli-qz-val.html', 'women', 'shoes');
renuar_index_sub_category('https://www.renuar.co.il/he/shoes/women/neli-erb.html', 'women', 'shoes');
renuar_index_sub_category('https://www.renuar.co.il/he/shoes/women/mgpvnim.html', 'women', 'shoes');
renuar_index_sub_category('https://www.renuar.co.il/he/accessories/women/bags.html', 'women', 'bags-wallets');

// Men items
renuar_index_sub_category('https://www.renuar.co.il/he/men/t-shirts.html', 'men', 'tops');
renuar_index_sub_category('https://www.renuar.co.il/he/men/jeans.html', 'men', 'pants');
renuar_index_sub_category('https://www.renuar.co.il/he/men/pants.html', 'men', 'pants');
renuar_index_sub_category('https://www.renuar.co.il/he/men/shirts.html', 'men', 'tops');
renuar_index_sub_category('https://www.renuar.co.il/he/men/polo-shirts.html', 'men', 'tops');
renuar_index_sub_category('https://www.renuar.co.il/he/men/bermuda.html', 'men', 'pants');
renuar_index_sub_category('https://www.renuar.co.il/he/men/swimwear.html', 'men', 'swimwear');
renuar_index_sub_category('https://www.renuar.co.il/he/men/blazers.html', 'men', 'coats');
renuar_index_sub_category('https://www.renuar.co.il/he/men/sweatshirts.html', 'men', 'tops');
renuar_index_sub_category('https://www.renuar.co.il/he/shoes/men/sniqrs.html', 'men', 'shoes');
renuar_index_sub_category('https://www.renuar.co.il/he/shoes/men/neliim.html', 'men', 'shoes');
renuar_index_sub_category('https://www.renuar.co.il/he/shoes/men/mgpiim.html', 'men', 'shoes');
renuar_index_sub_category('https://www.renuar.co.il/he/accessories/men/bags.html', 'men', 'bags-wallets');

echo "<table border=1>";
foreach ($arr as $color) {
    print("<tr><td>".$color."</td></tr>");
}
echo "</table>";
flushBuffers();
mysql_close();


function renuar_load_dom($url){
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

function renuar_index_sub_category($url, $main_category, $sub_category)
{
    $dom = renuar_load_dom($url);

    // Debugging
    echo "<table border=1>";
    $counter = 1;
    //

    // Get items from the first page
    $counter = renuar_get_items_from_dom($dom, $main_category, $sub_category, $counter);

    // Get items from the next pages (if they exist)
    $page_num = 1;
    $has_next_page = TRUE;
    while ($has_next_page) {
        $has_next_page = FALSE;
        foreach ($dom->getElementsByTagName('a') as $a_tag) {
            if ($a_tag->getAttribute('class') == 'next i-next') {
                $page_num ++;

                $dom = renuar_load_dom($url . '?p=' . $page_num);

                $counter = renuar_get_items_from_dom($dom, $main_category, $sub_category, $counter);

                $has_next_page = TRUE;
                break;
            }
        }
    }

    // Debugging
    echo "</table>";
    //
    flushBuffers();
}

function renuar_get_items_from_dom($dom, $main_category, $sub_category, $counter){
    foreach ($dom->getElementsByTagName('li') as $li_tag){
        if ($li_tag->getAttribute('class') == 'item ' || $li_tag->getAttribute('class') == 'item largeItem'){
            foreach ($li_tag->getElementsByTagName('div') as $div_tag){
                if ($div_tag->getAttribute('class') == 'product-image-container'){
                    foreach ($div_tag->getElementsByTagName('a') as $a_tag){
                        if ($a_tag->getAttribute('class') == 'product-image'){
                            foreach ($a_tag->getElementsByTagName('img') as $img_tag){
                                $img_link = $img_tag->getAttribute('src');
                            }

                            $cloth_item = new ClothItem();
                            $cloth_item->setStoreName('Renuar');
                            $cloth_item->setMainCategory($main_category);
                            $cloth_item->setSubCategory($sub_category);

                            $cloth_item->setName($a_tag->getAttribute('title'));
                            $cloth_item->setWebPage($a_tag->getAttribute('href'));
                            $cloth_item->setImages($img_link);

                            $cloth_item = renuar_get_item_info($cloth_item);
                            if (is_null($cloth_item)){
                                continue;
                            }

                            // Add item to DB
                            $cloth_item->updateInDb();

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
                        }
                    }
                }
            }
        }
    }

    return $counter;
}

function renuar_get_item_info($cloth_item){
    $url = $cloth_item->getWebPage();
    global $arr;

    $dom = renuar_load_dom($url);

    // Add price to item
    foreach ($dom->getElementsByTagName('span') as $span_tag){
        if ($span_tag->getAttribute('class') == 'price-box-wrap'){
            foreach ($span_tag->getElementsByTagName('span') as $span_price_tag){
                $price = explode('₪', $span_price_tag->nodeValue);
                $cloth_item->setPrice(trim($price[0]));
            }
        }
    }

    // Add color to item
    $item_attributes = $dom->getElementById('product-attribute-specs-table');
    if (is_null($item_attributes)){
        return NULL;
    }
    foreach ($item_attributes->getElementsByTagName('td') as $td_tag)
        if ($td_tag->getAttribute('class') == 'data'){
            $item_color = renuar_DOMinnerHTML($td_tag);
            $cloth_item->setColors(array($item_color));
            if (!in_array($item_color, $arr))
                $arr[] = $item_color;
            break;
        }

    // Add sizes to item
    $script_nodes = $dom->getElementsByTagName('script');
    foreach($script_nodes as $node){
        if (preg_match( '~new Product\.Config\((.+?)\);~', $node->nodeValue, $matches)){
            $data = json_decode($matches[1]);
        }

        // Retrieve stock according to sizes
        $script = renuar_DOMinnerHTML($node);
        if (strpos($script, 'outOfStockAttributes') !== false) {
            $first_cut_script = explode('outOfStockAttributes = ', $script);
            $second_cut_script = explode(';', $first_cut_script[1]);
            $stock_json = json_decode($second_cut_script[0]);
        }
    }
    $sizes_list = array();
    $options = $data->attributes->{141}->options;
    foreach ($options as $option){
        if ($stock_json->{$option->id} == 1){
            $sizes_list[] = $option->label;
        }
    }
    $cloth_item->setSizes($sizes_list);


    return $cloth_item;
}

function renuar_DOMinnerHTML(DOMNode $element)
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
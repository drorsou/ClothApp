<?php
/**
 * Created by PhpStorm.
 * User: niri
 * Date: 04/04/2016
 * Time: 22:17
 */
$ch = curl_init();
$cookie = 'GlobalE_Data={"countryISO":"IL","currencyCode":"ILS","cultureCode":"he-IL"}'; //instruct castro to send price in ILS
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: $cookie"));
curl_setopt($ch, CURLOPT_URL, 'http://www.castro.com/he/SALE/Women/Tops/Tank-top-40027.html');
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($ch);
//print(htmlspecialchars($output));
$output = '<link rel="canonical" href="http://www.castro.com/he/SALE/Women/Tank-top.html" />';
$output = strtolower($output);

$pattern = '/\<link rel=\"canonical" href\=\"http\:\/\/www.castro.com\/he\/[sale\/]?([a-zA-Z]+)\/([a-zA-Z\-0-9]+)\//';
preg_match($pattern, $output, $matches);
//printf("<td>%s</td><td>%s</td>", $matches[1], $matches[2]);
var_dump($matches);



?>
<?php

echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
require_once("db.php");
connectToDb();

$query = "SELECT `Name`,count(*) as cnt  FROM ClothToColor inner join Colors on Colors.Id = ColorId group by `Name` order by cnt desc";
$result = mysql_query($query);
if (!$result)
    die(mysql_error());

echo "<table border='1'>";
while ($row = mysql_fetch_assoc($result)){
    $color = $row["Name"];
    $cnt = $row["cnt"];
    echo "<tr></tr><td>$color</td><td>$cnt</td></tr>";
}
echo "</table>";

mysql_close();
?>
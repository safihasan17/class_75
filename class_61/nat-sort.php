<?php

$arr = ["picture1.jpg", "picture20.jpg","picture4.jpg","Picture10.jpg","picture21.jpg" ];

echo "<pre>";
print_r($arr);
echo "</pre>";

natsort($arr);
echo "<pre>";
print_r($arr);
echo "</pre>";

natcasesort($arr);
echo "<pre>";
print_r($arr);
echo "</pre>";

?>

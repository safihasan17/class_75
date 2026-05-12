<?php

 $name = "Raju";
 echo <<< HERDOC
    $name is a good boy
    <p>Text messaging, or texting, is the act of composing and sending electronic messages, typically consisting of alphabetic and numeric characters, between two or more users of mobile phones, tablet computers, smartwatches, desktops/laptops, or another type of compatible computer. Text messages may be sent over a cellular network or may also be sent via satellite or Internet connection.</p>

HERDOC;

echo <<< 'NOWDOC'
    $name is a good boy
    <p>Text messaging, or texting, is the act of composing and sending electronic messages, typically consisting of alphabetic and numeric characters, between two or more users of mobile phones, tablet computers, smartwatches, desktops/laptops, or another type of compatible computer. Text messages may be sent over a cellular network or may also be sent via satellite or Internet connection.</p>

NOWDOC;


?>
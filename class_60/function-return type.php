<?php
  function add(int $a ,int $b ,int $c): array{
    return [$a , $b, $c];
  }
  // echo add(1,2);
  // echo add("50",40);
  
  echo "<pre>";
  print_r(add(1,2,5));
  print_r(add(10,20,10));
  var_dump(add(30,40,10));


?>
<?php

trait calculator{
    public function add($a, $b){
        return $a +$b;
    }
    public function sub($a, $b){
        return $a - $b;
    }
    public function mul($a, $b){
        return $a *$b;
    }
    public function div($a, $b){
        return $a /$b;
    }


}

trait Operator{
     public function power($a, $b){
        return $a **$b;
    }

    public function mod($a, $b){
        return $a %$b;
    }
}

class Result{
    use calculator, Operator;

    public $num1;
    public $num2;
}

$result = new result();
echo $result->mul(10,2);
echo "<br>";
echo $result->power(2,3);
echo "<br>";
echo $result->mod(5,2);

?>
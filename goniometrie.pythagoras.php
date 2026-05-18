<?php

require_once("class.oefening.php");
require_once("class.math.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$gezochte_zijde = ['a','b','c'];
$te_berekenen = $gezochte_zijde[array_rand($gezochte_zijde)];

if ($te_berekenen == 'c'){
    $a = rand(3,50);
    $b =rand(3,50);
    $c = sqrt($a*$a+$b*$b);
    $opgave = " a= $a , b = $b , bereken :c";
    $oplossing = $c;
    
}elseif ($te_berekenen == 'a'){
    $c = rand(10,50);
    $b =rand(1, $c-1);
    $a= sqrt($c*$c- $b*$b);
    $opgave = "b = $b,  c= $c bereken:a";
    $oplossing= $a;
}else{
     $c = rand(2,50);
    $a =rand(1,$c-1);
    $b= sqrt($c*$c- $a*$a);
    $opgave = "a=$a,  c= $c,  bereken:b ";
    $oplossing= $b;
}

$oplossing = round($oplossing, 2);
$stamp = "$a.$b.$te_berekenen";
echo "<img src='Stelling_van_Pythagoras_rechthoekige_driehoek.png' alt='Pythagoras driehoek' style='max-width:300px;'><br>";
return new Oefening($this->titel, $opgave, $oplossing, $stamp);



    }
}
?>
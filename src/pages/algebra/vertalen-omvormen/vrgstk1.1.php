<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");
/////////
class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,13);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$a			= nietnul(4, 10)*5;
		$b			= nietnulcopriem($a, 2, 8);
		$c			= nietnul(3, 8);
		$leeftijd	= nietnul(10, 17);
		$product	= array("zakje chips", "cola", "chocoladereep")[random_int(0, 2)];
		$jongen		= array("Ilias","Noah","Wietse","Sofiane","Xander","Ruben", "Lennert","Joran")[random_int(0,7)];
		$oef 		= array(
						array(	"opgave"=>"\\)je betaalt $a eurocent voor een $product, maar de kassierster zegt dat je $b eurocent tekortkomt. Hoeveel kost een $product ?\\(" , 
								"oplossing"=>"x=$a + $b \\Leftrightarrow x=".($a+$b) , "stamp"=> "11.".$product),
						array(	"opgave"=>"\\)je betaalt $a eurocent voor een $product. De kassierster geeft je $b eurocent terug. Hoeveel kost een $product ?\\(" , 
								"oplossing"=>"x=$a - $b \\Leftrightarrow x=".($a-$b) , "stamp"=> "11.".$product),
						array(	"opgave"=>"\\)als je een getal vermeerdert met $a bekom je ".($a+$b*$c).". Wat is het getal?\\(" , 
								"oplossing"=>"x+$a = ".($a + $b*$c). "\\Leftrightarrow x=".($a + $b*$c)."- $a \\Leftrightarrow x = ".($b*$c) , "stamp"=> "11.1"),
						array(	"opgave"=>"\\)als je een getal vermindert met $a bekom je ".($b*$c-$a).". Wat is het getal?\\(" , 
								"oplossing"=>"x-$a = ".($b*$c-$a). "\\Leftrightarrow x=".($b*$c-$a)."+ $a \\Leftrightarrow x = ".($b*$c) , "stamp"=> "11.2"),
						array(	"opgave"=>"\\)de som van drie opeenvolgende gehele getallen is ".(3*$leeftijd).". Wat zijn die getallen?\\(" , 
								"oplossing"=>"x+x+1+x+2 = ".(3*$leeftijd). "\\Leftrightarrow 3x+3=".(3*$leeftijd)." \\Leftrightarrow 3x = ".(3*$leeftijd-3) ."\\Leftrightarrow x = ".($leeftijd-1) ." \\text{ De getallen zijn ".($leeftijd-1).", $leeftijd en ".($leeftijd+1)."}" , "stamp"=> "11.3"),
						array(	"opgave"=>"\\)$jongen is x jaar. Zijn zus is $c jaar ouder. Samen zijn ze ".(2*$leeftijd+$c)." jaar. Hoe oud is $jongen ?\\(" , 
								"oplossing"=>"x+x+$c = ".(2*$leeftijd+$c). "\\Leftrightarrow 2x+$c=".(2*$leeftijd+$c)." \\Leftrightarrow 2x = ".(2*$leeftijd) ."\\Leftrightarrow x = ".($leeftijd) ." \\text{ $jongen is $leeftijd jaar}" , "stamp"=> "11.oud"),
						array(	"opgave"=>"\\)$jongen is x jaar. Zijn zus is $c jaar jonger. Samen zijn ze ".(2*$leeftijd-$c)." jaar. Hoe oud is $jongen ?\\(" , 
								"oplossing"=>"x+x-$c = ".(2*$leeftijd-$c). "\\Leftrightarrow 2x-$c=".(2*$leeftijd-$c)." \\Leftrightarrow 2x = ".(2*$leeftijd) ."\\Leftrightarrow x = ".($leeftijd) ." \\text{ $jongen is $leeftijd jaar}" , "stamp"=> "11.jong"),
								
						);
		$res		= $oef[random_int(0, count($oef)-1)];
		$opgave 	= $res["opgave"];
		$oplossing 	= $res["oplossing"];
		$stamp		= $res["stamp"];
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$a			= nietnul(4, 12);
		$b			= nietnulcopriem($a, 2, $a-1);
		$kgv		= kgv($a, $b); 
		$x			= $kgv * nietnul(1, 5);
		$c			= intdiv($x, $b) - intdiv($x, $a);
		$oef 		= array(//\overset{\mbox{This?}}{\longrightarrow}
						array(	"opgave"=>"\\)als je ".breuken(1, $a)." van een getal aftrekt van ".breuken(1,$b)." van dat getal, dan krijg je $c . Wat is dat getal? \\(" , 
								"oplossing"=>"	\\frac{1}{".$b."}x-\\frac{1}{".$a."}x=$c 
												\\overset{\\mbox{ .".$kgv." }}{ \\Leftrightarrow } ".intdiv($kgv, $b)."x-".intdiv($kgv, $a)."x=".$kgv*$c."
												\\Leftrightarrow ".(intdiv($kgv, $b)-intdiv($kgv, $a))."x=".$kgv*$c."
												\\Leftrightarrow x=". $x, 
								"stamp"=> "12.$kgv"),
						);
		$res		= $oef[random_int(0, count($oef)-1)];
		$opgave 	= $res["opgave"];
		$oplossing 	= $res["oplossing"];
		$stamp		= $res["stamp"];
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13() //Het verschil van een a-voud van een getal en b is gelijk aan de som van de c-breuk van het getal en d
	{
		$a			= nietnul(3, 9);
		$c			= nietnul(3, 9);
		$x			= $c * nietnul(2, 7);
		$b			= nietnulcopriem($a, 3, 10);
		$d			= $a*$x - $b - intdiv($x, $c);
		$oef 		= array(//\overset{\mbox{This?}}{\longrightarrow}
						array(	"opgave"=>"\\) het verschil van het ".voud($a)." van een getal en ".ntt($b)." is gelijk aan de som van ".breuken(1,$c)." van het getal en $d. Wat is het getal?\\(" , 
								"oplossing"=>"	$a x-$b=\\frac{x}{".$c."}+$d 
												\\overset{\\mbox{ .".$c." }}{ \\Leftrightarrow } ".($a*$c)."x-".($b*$c)."=x+".($c*$d)."
												\\Leftrightarrow ".($a*$c)."x-x=".($c*$d)."+".($b*$c)."
												\\Leftrightarrow ".($a*$c-1)."x=".($c*$d+$b*$c)."
												\\Leftrightarrow x=". $x, 
								"stamp"=> "13.$a"),
						);
		$res		= $oef[random_int(0, count($oef)-1)];
		$opgave 	= $res["opgave"];
		$oplossing 	= $res["oplossing"];
		$stamp		= $res["stamp"];
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

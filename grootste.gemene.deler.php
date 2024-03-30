<?php 
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once("class.oefening.php");
require_once("class.math.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		//Teller
		$a = nietnul(3,20);
		//Noemer is een copriem van de teller -- niet vereenvoudigbaar
		$b = copriem($a,2,30);
		//Een bepaalde factor c bevat minstens een stuk dat op zicht vereenvoudigbaar is
		$x = array(2,3,5,7,11)[rand(0,4)];
		$y = array(2,3,5,7)[rand(0,3)];
		$z = array(2,3)[rand(0,1)];
		
		$optie = rand(0,2);
		if($optie == 0)
		{
			$p = $a * $x * $y * $z;
			$q = $b * $x * $y * $z;
			$res = array($x, $y, $z);
		}elseif($optie == 1)
		{
			$p = $a * $x * $y;
			$q = $b * $x * $y;
			$res = array($x, $y);
		}elseif($optie = 2)
		{
			$p = $a * $x * $z;
			$q = $b * $x * $z;
			$res = array($x, $z);
		}
		//Opgave in LaTeX
		$opgave = "\\text{Grootste gemene deler van ".$p." en ".$q."}";
		//Oplossing in LaTeX
		asort($res);
		$oplossing = "\\begin{array}{ r r | r }";
		$factor = 1;
		foreach($res as $deler)
		{
			$oplossing .= " $p &  $q & $deler \\\\";
			$p /= $deler;
			$q /= $deler;
			$factor *= $deler;
		}
		//$oplossing .= " & & & & --- \\\\";
		$oplossing .= " \\hline";
		$oplossing .= " $p & $q & \\textbf{ $factor } \\end{array}";
		//Vanaf hier mag je negeren
		if($p<$q){ $stamp = "$p.$q"; }else{$stamp = "$q.$p";}
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

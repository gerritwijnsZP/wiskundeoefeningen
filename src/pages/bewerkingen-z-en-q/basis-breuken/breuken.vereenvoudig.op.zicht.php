<?php 
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		//Teller
		$a = nietnul(-20,20);
		//Noemer is een copriem van de teller -- niet vereenvoudigbaar
		$b = copriem($a,2,30);
		//Een bepaalde factor c bevat minstens een stuk dat op zicht vereenvoudigbaar is
		$c = array(2,3,5,9,10)[rand(0,4)] * array(2,3)[rand(0,1)];
		//Opgave in LaTeX
		$opgave = "\\frac{".($a*$c)."}{".($b*$c)."}";
		//Oplossing in LaTeX
		$oplossing = "\\frac{".$a."}{".$b."}";
		//Extra informatie oplossing
		$res = array();
		foreach(array(2,3,5,9,10) as $deler)
		{
			//Als onze factor c deelbaar is door 2, 3, 5, 9 of 10, houd dit dan even bij in $res
			if($c % $deler ==  0){array_push($res, $deler);}
		}
		if(count($res)>0)
		{
			//Geef aan welke factoren men op zicht had moeten kunnen zien
			$oplossing .= " \\leftarrow ".$opgave."\\textrm{ is op zicht deelbaar door ".implode(', ',$res)."| ggd: ".$c."}";
		}
		//Vanaf hier mag je negeren
		$stamp = "$a.$b.$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
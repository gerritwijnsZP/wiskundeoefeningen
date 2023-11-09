<?php 
require_once("class.oefening.php");
require_once("class.math.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		//Teller
		$a = nietnul(-20,20);
		//Noemer is een copriem van de teller -- niet vereenvoudigbaar
		$b = copriem($a,2,30);
		//Een bepaalde factor c bevat minstens een stuk dat op zicht vereenvoudigbaar is (zijnde 2, 3, 5, 9 of 10)
		$c = array(2,3,5,9,10)[rand(0,4)] * random_int(2,30);
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
			$oplossing .= " \\rightarrow ".$opgave."\\textrm{ is op zicht deelbaar door ".implode(', ',$res)."| ggd: ".$c."}";
		}
		//Vanaf hier mag je negeren
		$stamp = "$a.$b.$c";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");
require_once("class.hoek.php");
require_once("class.rational.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,12);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$alfa 	= 5*rand(1,18);
		$halfa 	= new Hoek($alfa);
		$straal	= rand(2,10);
		$eenheid= array("mm","cm","dm","m")[rand(0,3)];
		$AB 	= round($halfa->getRad() * $straal, 2); 
		$opgave = "\\textbf{ geg: } \alpha=".$alfa."^\circ \\text{ en } r = ".$straal . "\\text{ ".$eenheid."} \\\\ 
					\\textbf{gevr: } |\overparen{AB}| \\textit{ (op 0,01 nwk)}";
		$oplossing = $opgave."\\\\";
		$breuk	= new R($alfa, 180);
		$breuk->vereenvoudig();
		$oplossing.= "\\textbf{opl: } \alpha = ".$alfa."^\circ = ".$alfa.".\\frac{\pi}{180} \\text{rad} = $breuk . \pi \\text{ rad} \\\\";
		$oplossing.= "|\overparen{AB}| = r . \alpha \\textit{(rad)} = $straal . $breuk . \pi \\text{ $eenheid } ";
		$breuk = $breuk->mul($straal);
		$breuk->vereenvoudig();
		//$oplossing.= "= $breuk . \pi \\text{ $eenheid } \\\\";
		$oplossing.= "\\\\";
		$oplossing.= "\\Leftrightarrow |\overparen{AB}| = $breuk \pi \\text{ $eenheid } \approx ".puntkomma($AB)." \\text{ $eenheid}";
		$oplossing.= "\\\\ --------------- ";
		$stamp		= "$alfa.$straal"; 
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$AB		= rand(2,12);
		$alfa 	= 5*rand(1,18);
		$halfa 	= new Hoek($alfa);
		$eenheid= array("mm","cm","dm","m")[rand(0,3)];
		$straal	= round($AB / $halfa->getRad(),2); 
		$opgave = "\\textbf{ geg: } \alpha=".$alfa."^\circ \\text{ en } |\overparen{AB}| = ".$AB . "\\text{ ".$eenheid."} \\\\ 
					\\textbf{gevr: } r \\textit{ (op 0,01 nwk)}";
		$oplossing = $opgave."\\\\";
		$breuk	= new R($alfa, 180);
		$breuk->vereenvoudig();
		$oplossing.= "\\textbf{opl: } \alpha = ".$alfa."^\circ = ".$alfa.".\\frac{\pi}{180} \\text{rad} = $breuk . \pi \\text{ rad} \\\\";
		$oplossing.= "r = \\dfrac{|\overparen{AB}|}{ \alpha } = $AB . \\frac{". ($breuk->noemer)  ."}{". ($breuk->teller) .". \pi } \\text{ $eenheid } ";
		$breuk->omgekeerde();
		$breuk = $breuk->mul($AB);
		$breuk->vereenvoudig();
		//$oplossing.= "= $breuk . \pi \\text{ $eenheid } \\\\";
		$oplossing.= "\\\\";
		$oplossing.= "\\Leftrightarrow r = \\frac{". ($breuk->teller)  ."}{". ($breuk->noemer) .". \pi } \\text{ $eenheid }  \approx ".puntkomma($straal)." \\text{ $eenheid}";
		$oplossing.= "\\\\ --------------- ";
		$stamp		= "$alfa.$straal"; 
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

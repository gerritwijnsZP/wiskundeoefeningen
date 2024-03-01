<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");
class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,12);
		$i=12;
		return call_user_func(array($this,"oef".$i));
	}

	private function oef11()
	{
		//Oefeningen op bepalen van functievoorschrift eerstegraadsfunctie met 2 coordinaten gegeven
		$ga =	random_int(-10,10);
		$gb =	random_int(-10,10);
		$rico = random_int(-5,5);

		$functieletter = chr(rand(97,118));
		$randomletter = rand(65,80);
		$letter1 = chr($randomletter);

		$opg1		= "\\text {Bepaal het functievoorschrift van ".$functieletter."(x) als de functie als richtingscoëfficiënt ".$rico." heeft en door de punt ".$letter1."(".$ga.",".$gb.") gaat.}";
		$opgave 	= $opg1;
		$oplossing	= $opgave;
		if ($gb<0){
			$gbafdruk="(".$gb.")";
		}else{
			$gbafdruk=$gb;}
		if ($ga<0){
			$gaafdruk="(".$ga.")";
		}else{$gaafdruk=$ga;
		}
		$oplossing .= "\\\\ \\begin{align} ";
		if ($rico!=0){
			$vergelijkingoplossing = p($rico,1)."x".getalafdruk(-$ga*$rico+$gb,2);}
		else{
			$vergelijkingoplossing = -$ga*$rico+$gb;
			$oplossing .="\\ & \\text {Als de rico gelijk is aan 0, kunnen we besluiten dat de functie als voorschrift heeft: }";
			$oplossing .= $functieletter."(x) = ".$vergelijkingoplossing;
			$oplossing .="\\\\ & \\text {Functie gelijk stellen aan de y-waarde van een coördinaat.}";
			$oplossing .="\\\\ & \\text {Op de gewone manieren uitwerken kan ook, maar duurt langer (zie onder).} \\\\";
		}
		$oplossing .= "\\ & \\text {Opstellen vergelijking: methode 1: invullen a = ".$rico." en ".$letter1."(".$ga.",".$gb.")}  \\\\ & y-y_1 = a(x-x_1) \\\\";
		$oplossing .="\\Leftrightarrow & y ".getalafdruk(-$gb,0)." = ".$rico."(x ".p(-$ga,2).") \\\\";
		$oplossing .="\\Leftrightarrow & y = ".p($rico,1)."x". p(-$ga*$rico,2).p($gb,2)."\\\\";
		$oplossing .="\\Leftrightarrow & y = ".$vergelijkingoplossing."\\\\";
		$oplossing .="& ".$functieletter."(x) = ".$vergelijkingoplossing."\\\\";
		$oplossing .="& \\text {Opstellen vergelijking: methode 2 invullen a = ".$rico." en ".$letter1."(".$ga.",".$gb.")} \\\\ & y= ax + b \\\\";
		$oplossing .="\\Leftrightarrow & y = ".$rico."x +b \\\\";
		$oplossing .="\\Leftrightarrow & ".$gb. " = ".$rico." \cdot ".getalafdruk($ga,1)." +b \\\\";
		$oplossing .="\\Leftrightarrow & ".$gb. " = ".$rico*$ga."+b \\\\";
		$oplossing .="\\Leftrightarrow & b = ".(-$ga*$rico+$gb) ."\\\\";
		$oplossing .="\\Rightarrow & y = ".$vergelijkingoplossing."\\\\";
		$oplossing .="& ".$functieletter."(x) = ".$vergelijkingoplossing;
		$oplossing 	.="\\end{align} \\\\";


		$b =	nietnul(-20,20);
		$stamp		= "11.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}

	private function oef12()
	{
		//Oefeningen op bepalen van functievoorschrift eerstegraadsfunctie met 2 coordinaten gegeven
		$ga =	random_int(-10,10);
		$gb =	random_int(-10,10);
		$rico = random_int(-5,5);
		$factor = nietnul(-5,5);
		$gc =	$ga+$factor;
		$gd =	$gb+$factor*$rico;
		$functieletter = chr(rand(97,118));
		$randomletter = rand(65,80);
		$letter1 = chr($randomletter);
		$letter2 = chr($randomletter+1);
		$opg1		= "\\text {Bepaal het functievoorschrift van ".$functieletter."(x) als de functie door de punten ".$letter1."(".$ga.",".$gb.") en ".$letter2."(".$gc.",".$gd.") gaat.}";
		$opgave 	= $opg1;
		$oplossing	= $opgave;
		if ($gb<0){
			$gbafdruk="(".$gb.")";
		}else{
			$gbafdruk=$gb;}
		if ($ga<0){
			$gaafdruk="(".$ga.")";
		}else{$gaafdruk=$ga;
		}
		$oplossing .= "\\\\ \\text {Bepalen rico: a = } \\frac{y_2-y_1}{x_2-x_1} = \\frac{".$gd."-".$gbafdruk."}{".$gc."-".$gaafdruk."} = \\frac{".$gd-$gb."}{".$gc-$ga."}=".$rico."\\\\";
		$oplossing .= "\\begin{align} ";
		if ($rico!=0){
			$vergelijkingoplossing = p($rico,1)."x".getalafdruk(-$ga*$rico+$gb,2);}
		else{
			$vergelijkingoplossing = -$ga*$rico+$gb;
			$oplossing .="\\ & \\text {Als de rico gelijk is aan 0, kunnen we besluiten dat de functie als voorschrift heeft: }";
			$oplossing .= $functieletter."(x) = ".$vergelijkingoplossing;
			$oplossing .="\\\\ & \\text {Functie gelijk stellen aan de y-waarde van een coördinaat.}";
			$oplossing .="\\\\ & \\text {Op de gewone manieren uitwerken kan ook, maar duurt langer (zie onder).} \\\\";
		}
		$oplossing .= "\\ & \\text {Opstellen vergelijking: methode 1: invullen a = ".$rico." en ".$letter1."(".$ga.",".$gb.")}  \\\\ & y-y_1 = a(x-x_1) \\\\";
		$oplossing .="\\Leftrightarrow & y ".getalafdruk(-$gb,0)." = ".$rico."(x ".p(-$ga,2).") \\\\";
		$oplossing .="\\Leftrightarrow & y = ".p($rico,1)."x". p(-$ga*$rico,2).p($gb,2)."\\\\";
		$oplossing .="\\Leftrightarrow & y = ".$vergelijkingoplossing."\\\\";
		$oplossing .="& ".$functieletter."(x) = ".$vergelijkingoplossing."\\\\";
		$oplossing .="& \\text {Opstellen vergelijking: methode 2 invullen a = ".$rico." en ".$letter1."(".$ga.",".$gb.")} \\\\ & y= ax + b \\\\";
		$oplossing .="\\Leftrightarrow & y = ".$rico."x +b \\\\";
		$oplossing .="\\Leftrightarrow & ".$gb. " = ".$rico." \cdot ".getalafdruk($ga,1)." +b \\\\";
		$oplossing .="\\Leftrightarrow & ".$gb. " = ".$rico*$ga."+b \\\\";
		$oplossing .="\\Leftrightarrow & b = ".(-$ga*$rico+$gb) ."\\\\";
		$oplossing .="\\Rightarrow & y = ".$vergelijkingoplossing."\\\\";
		$oplossing .="& ".$functieletter."(x) = ".$vergelijkingoplossing;
		$oplossing 	.="\\end{align} \\\\";


		$b =	nietnul(-20,20);
		$stamp		= "12.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}


}

?>

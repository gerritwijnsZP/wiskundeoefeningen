<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");
/////////
class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,12);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{//Brug
		$teller		= 1;
		$factor		= nietnul(2,4);
		$noemer		= nietnul(2,3)*$factor;
		$water		= $teller*$factor;
		$totaal		= $water * $noemer;
		$lucht		= nietnul(1,$totaal-$water-1);
		$grond		= $totaal - $water - $lucht;
		
		$opgave 	= "\\text{ Een pijler van een brug zit $grond meter in de grond. }\\\\";
		$opgave 	.="\\text{".ucfirst(breuken($teller, $noemer))." van de pijler staat in het water.} \\\\";
		$opgave 	.="\\text{ $lucht meter steekt boven het water uit.}\\\\
						\\text{ Wat is de lengte van de pijler?}";
		$oplossing	= $opgave . "\\\\";
		$oplossing .= "\\text{x is de lengte van de pijler} \\\\
						\\color{red}{ $grond + \\frac{ $teller}{ $noemer}.x + $lucht = x }\\\\
						\\Leftrightarrow \\frac{ $teller}{ $noemer}.x + ".($lucht+$grond)." = x \\\\
						\\Leftrightarrow \\frac{ $teller}{ $noemer}.x - x = ".(-$lucht-$grond)." \\\\
						\\Leftrightarrow \\frac{".($teller-$noemer)."}{ $noemer}.x = ".(-$lucht-$grond)." \\\\
						\\Leftrightarrow x = \\frac{ $noemer}{".( $teller-$noemer)."}\\left(".(-$lucht-$grond)."\\right) = $totaal \\\\
						\\text{De lengte van de pijler is $totaal m}";
		$stamp		= "11.$grond.$lucht";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{//Enquête
		$personen	= array("Mariam","Nada","Noor","Oumaima","Mila","Lore","Lotte","Chemse","Alysia","Drieka","Laura","Jitte","Lina","Kiara","Rowenn",
		"Zahra", "Amani","Geogrios","Mila","Rebecca","Khadija","Emely","Tibo","Ines","Romaisae","Anthe",
		"Mila","Maxim","Ayman","Lina","Loubna","Wouter","Jana","Sarah","Nihad","Mohamed","Warinda");
		$i			= random_int(0,count($personen)-1);
		$iemand		= $personen[$i];
		$n1			= nietnul(3,5);
		$n2			= nietgetal(3,6,array($n1));
		$rest 		= nietnul(2,5)*($n1 * $n2 - $n1 - $n2);
		$totaal		= $rest * $n1 * $n2 / ($n1 * $n2 - $n1 - $n2);
		$opgave 	= "\\text{ $iemand vult een enquête in. }\\\\
						\\text{De eerste dag vult ze ".breuken(1,$n1)." in.} \\\\
						\\text{De tweede dag vult ze ".breuken(1,$n2)." in.} \\\\
						\\text{De derde (en laatste) dag vult ze de resterende $rest vragen in.}\\\\
						\\text{Hoeveel vragen bevatte de enquête in het totaal?}";
		$oplossing	= $opgave . "\\\\";
		$oplossing .= "\\text{x is het totaal aantal vragen van de enquête} \\\\
						\\color{red}{\\frac{1}{ $n1}.x + \\frac{1}{ $n2}.x + $rest = x} \\\\
						\\Leftrightarrow \\frac{1}{ $n1}.x + \\frac{1}{ $n2}.x - x = -$rest \\\\
						\\Leftrightarrow \\frac{ $n2 + $n1 - ".($n1*$n2)."}{ ".($n1*$n2)."} . x = -$rest \\\\
						\\Leftrightarrow \\frac{".($n2 + $n1 - $n1*$n2)."}{".($n1*$n2)."} . x = -$rest \\\\
						\\Leftrightarrow x = -$rest.\\left( \\frac{".($n1*$n2)."}{".($n2 + $n1 - $n1*$n2)."} \\right) = $totaal \\\\
						\\text{De enquête bevatte $totaal vragen}
						";
		$stamp		= "12.$iemand";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	
}
?>

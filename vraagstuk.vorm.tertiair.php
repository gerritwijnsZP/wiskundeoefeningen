<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");
/////////
class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,13);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{ //
		
		$personen	= array("Mariam","Nada","Noor","Oumaima","Mila","Lore","Lotte","Chemse","Alysia","Drieka","Laura","Jitte","Kiara","Rowenn",
		"Zahra", "Amani","Geogrios","Rebecca","Khadija","Emely","Tibo","Ines","Romaisae","Anthe",
		"Mila","Maxim","Ayman","Lina","Loubna","Wouter","Jana","Sarah","Nihad","Mohamed","Warinda");
		$i			= random_int(0,count($personen)-1);
		$iemandA	= $personen[$i];
		$j			= nietgetal(0, count($personen)-1, array($i));
		$iemandB	= $personen[$j];
		$k			= nietgetal(0, count($personen)-1, array($i,$j));
		$iemandC	= $personen[$k];
		$leeftijdA	= nietnul(4,15);
		$factor		= nietnul(2,5);
		
		$leeftijdB	= $factor * $leeftijdA;
		$verschil	= nietnul(-5,5);
		$leeftijdC	= $leeftijdB + $verschil;
		$totaal		= $leeftijdA + $leeftijdB + $leeftijdC;
		$opgave 	= "\\text{ $iemandA, $iemandB en $iemandC zijn samen $totaal jaar oud.}\\\\
						\\text{ $iemandB is ".abs($verschil)." jaar ".($verschil < 0 ? "ouder" : "jonger")." dan $iemandC .} \\\\
						\\text{De leeftijd van $iemandA is ".breuken(1, $factor)." van de leeftijd van $iemandB .}\\\\
						\\text{Hoe oud is elk van hen?}
						";
		$oplossing	= $opgave . "\\\\";
		$oplossing	.= "\\text{x is de leeftijd van $iemandB} \\\\
						\\text{x".p($verschil,2)." is de leeftijd van $iemandC} \\\\
						\\frac{1}{ $factor}\\text{.x is de leeftijd van $iemandA} \\\\
						\\color{red}{x + \\frac{1}{ $factor}.x + (x".p($verschil,2).") = $totaal} \\\\
						\\Leftrightarrow x + \\frac{1}{ $factor}.x + x".p($verschil,2)." = $totaal \\\\
						\\Leftrightarrow \\frac{ $factor + 1 + $factor}{ $factor} .x = $totaal".p(-$verschil,2)." \\\\
						\\Leftrightarrow \\frac{ ".($factor + 1 + $factor)."}{ $factor} .x = ".($totaal-$verschil)." \\\\
						\\Leftrightarrow x = \\frac{ $factor}{ ".($factor + 1 + $factor)."} . ".($totaal-$verschil)." = ".$leeftijdB." \\\\
						\\text{ $iemandB is $leeftijdB jaar, $iemandA is $leeftijdA jaar en $iemandC is $leeftijdC jaar.}
						";
		$stamp		= "11.$iemandA";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	
	private function oef12()
	{ //
		
		$personen	= array("Mariam","Nada","Noor","Oumaima","Mila","Lore","Lotte","Chemse","Alysia","Drieka","Laura","Jitte","Kiara","Rowenn",
		"Zahra", "Amani","Geogrios","Rebecca","Khadija","Emely","Tibo","Ines","Romaisae","Anthe",
		"Mila","Maxim","Ayman","Lina","Loubna","Wouter","Jana","Sarah","Nihad","Mohamed","Warinda");
		$i			= random_int(0,count($personen)-1);
		$iemandA	= $personen[$i];
		$j			= nietgetal(0, count($personen)-1, array($i));
		$iemandB	= $personen[$j];
		$k			= nietgetal(0, count($personen)-1, array($i,$j));
		$iemandC	= $personen[$k];
		$leeftijdA	= nietnul(6,15);
		$factor		= nietnul(2,5);
		$leeftijdB	= $factor * $leeftijdA;
		$verschil	= nietnul(-5,5);
		$leeftijdC	= $leeftijdA + $verschil;
		$totaal		= $leeftijdA + $leeftijdB + $leeftijdC;
		$opgave 	= "\\text{ $iemandA, $iemandC en $iemandB zijn samen $totaal jaar oud.}\\\\
						\\text{ $iemandA is ".abs($verschil)." jaar ".($verschil > 0 ? "jonger" : "ouder")." dan $iemandC .} \\\\
						\\text{De leeftijd van $iemandB is ".ntt($factor)." keer de leeftijd van $iemandA .}\\\\
						\\text{Hoe oud is elk van hen?}
						";
		$oplossing	= $opgave . "\\\\";
		$oplossing	.= "\\text{x is de leeftijd van $iemandA} \\\\
						\\text{x".p($verschil,2)." is de leeftijd van $iemandC} \\\\
						\\text{ $factor .x is de leeftijd van $iemandB} \\\\
						\\color{red}{x + (x".p($verschil,2).") + $factor .x  = $totaal} \\\\
						\\Leftrightarrow ".(1+1+$factor)." .x = $totaal".p(-$verschil,2)." \\\\
						\\Leftrightarrow x = \\frac{ 1}{ ".($factor + 1 + 1)."} . ".($totaal-$verschil)." = ".$leeftijdA." \\\\
						\\text{ $iemandB is $leeftijdB jaar, $iemandA is $leeftijdA jaar en $iemandC is $leeftijdC jaar.}
						";
		$stamp		= "12.$iemandA";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{ //
		
		$a			= nietnul(27,50);
		$b			= $a+1;
		$c			= $a+2;
		$totaal		= $a+$b+$c;
		$opgave 	= "\\text{De som van drie opeenvolgende gehele getallen is $totaal .}\\\\
						\\text{Bepaal elk getal}
						";
		$oplossing	= $opgave . "\\\\";
		$oplossing	.= "\\text{x is het eerste getal} \\\\
						\\text{x+1 is het tweede getal} \\\\
						\\text{x+2 is het derde getal} \\\\
						\\color{red}{x + (x+1) + (x+2)  = $totaal} \\\\
						\\Leftrightarrow 3.x+3=$totaal\\\\
						\\Leftrightarrow 3.x = $totaal - 3 = ".($totaal-3)."\\\\
						\\Leftrightarrow x = $a \\\\
						\\text{De getallen zijn $a, $b en $c}";
		$stamp		= "13.$totaal";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	
}
?>

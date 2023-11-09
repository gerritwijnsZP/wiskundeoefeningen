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
		$i = random_int(11,14);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		
		$personen	= array("Zahra", "Amani","Geogrios","Mila","Rebecca","Khadija",
							"Emely","Tibo","Ines","Romaisae","Anthe");
		$items		= array("pokemonkaarten", "stickers", "streaks", "magneten", "bebloede tanden");
		
		$aantalA	= nietnul(123,321);
		$aantalB	= nietnul(123,321);
		$totaal		= $aantalA+$aantalB;
		$verschil	= abs($aantalA-$aantalB);
		
		$i			= random_int(0,count($personen)-1);
		$j			= nietgetal(0,count($personen)-1, array($i));
		$iemandA	= $personen[$i];
		$iemandB	= $personen[$j];
		$item		= $items[random_int(0,count($items)-1)];
		
		$opgave 	= "\\text{ $iemandA en $iemandB verzamelen $item.}\\\\";
		$opgave 	.="\\text{ Samen hebben ze er $totaal, maar $iemandA heeft er $verschil ".($aantalA > $aantalB ? "meer" : "minder"). " dan $iemandB .} \\\\";
		$opgave 	.="\\text{ Hoeveel $item hebben ze elk? }";
		$oplossing	= $opgave . "\\\\";
		$oplossing	.= "\\text{ x is aantal $item van $iemandB } \\\\
						\\text{ x".p($aantalA-$aantalB,2)." is het aantal $item van $iemandA } \\\\
						\\color{red}{x + x ".p($aantalA-$aantalB,2)." = $totaal} \\\\
						\\Leftrightarrow 2.x ".p($aantalA-$aantalB,2)." = $totaal \\\\
						\\Leftrightarrow 2.x = $totaal ".p($aantalB-$aantalA,2) ."=".(2*$aantalB)."\\\\
						\\Leftrightarrow x = $aantalB \\\\
						\\text{ $iemandB heeft $aantalB $item en $iemandA heeft er $verschil ".($aantalA > $aantalB ? "meer" : "minder").", dus $aantalA }";
		$stamp		= "11.$iemandA.$item";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	
	private function oef12()
	{
		
		$breedte	= nietnul(7,20);
		$lengte		= nietnul($breedte+12, 4*($breedte+12));
		$omtrek		= 2*$lengte + 2*$breedte;
		$verschil	= $lengte-$breedte;
		$opgave 	= "\\text{De speelplaats heeft een omtrek van $omtrek meter.} \\\\";
		$opgave 	.= "\\text{De lengte is $verschil meter langer dan de breedte.} \\\\";
		$opgave 	.= "\\text{Wat zijn de afmetingen van de speelplaats?} \\\\";
		$oplossing	= $opgave . "\\\\";
		$oplossing 	.= "\\text{x is de lengte van de speelplaats} \\\\";
		$oplossing 	.= "\\text{x - $verschil is de breedte van de speelplaats} \\\\";
		$oplossing	.= "\\color{red}{x + (x - $verschil) + x + (x - $verschil) = $omtrek} \\\\
						\\Leftrightarrow 4.x - ".(2*$verschil)."= $omtrek \\\\
						\\Leftrightarrow 4.x = $omtrek + ".(2*$verschil)." = ".(4*$lengte)."\\\\
						\\Leftrightarrow x = $lengte \\\\
						\\text{De speelplaats heeft een lengte van $lengte m en een breedte van $breedte m}";
		$stamp		= "12.$omtrek";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{ //Quiz
		
		$totaal		= nietnul(4,10)*5;
		$juist		= nietnul(18,$totaal-1);
		$fout		= $totaal - $juist;
		$loss		= nietnul(2,5);
		$win		= nietnul(8,10);
		$prijs		= $juist*$win - $fout*$loss;
		$personen	= array("Zahra", "Amani","Geogrios","Mila","Rebecca","Khadija",
							"Emely","Tibo","Ines","Romaisae","Anthe");
		$iemand		= $personen[random_int(0,count($personen)-1)];
		
		$opgave 	= "\\text{ $iemand doet mee aan een quiz waarin je $totaal vragen moet beantwoorden. }\\\\ 
						\\text{Per goed antwoord krijgt men $win euro. Bij een fout antwoord gaat er $loss euro af.}\\\\
						\\text{Uiteindelijk verdient $iemand $prijs euro.} \\\\
						\\text{Hoeveel vragen heeft $iemand juist?}";
		$oplossing	= $opgave . "\\\\";
		$oplossing 	.= "\\text{x is het aantal juiste antwoorden}\\\\
						\\text{ $totaal - x is het aantal foute antwoorden} \\\\
						\\color{red}{ $win.x-$loss.($totaal-x) = $prijs}\\\\
						\\Leftrightarrow $win.x - $loss.$totaal + $loss.x = $prijs \\text{(distributiviteit)} \\\\
						\\Leftrightarrow ".($win+$loss).".x - ".($loss*$totaal)." = $prijs \\\\
						\\Leftrightarrow ".($win+$loss).".x  = $prijs + ".($loss*$totaal) ."=".($prijs+$loss*$totaal)." \\\\ 
						\\Leftrightarrow x = $juist \\\\
						\\text{ $iemand heeft $juist antwoorden juist}";
		$stamp		= "13.$iemand";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef14()
	{ //
		$vogels		= array("Pinguins","Flamingo's");
		$dieren		= array("Hyena's","Kamelen");
		$vogel		= $vogels[random_int(0, count($vogels)-1)];
		$dier		= $dieren[random_int(0, count($dieren)-1)];
		$n_vogel	= nietnul(20,50);
		$n_dier		= nietgetal(20,50, array($n_vogel));
		$koppen		= $n_vogel + $n_dier;
		$poten		= $n_vogel * 2 + $n_dier * 4;
		$opgave 	= "\\text{In de zoo van California zijn er heel wat $vogel en $dier.}\\\\
						\\text{De hoogtechnologische voederbakken telden door een bug het aantal $vogel en $dier samen.} \\\\
						\\text{De machines telden in totaal $koppen verschillende koppen en $poten verschillende poten.} \\\\
						\\text{Hoeveel $vogel en $dier zijn er precies?}";
		$oplossing	= $opgave . "\\\\
						\\text{x is het aantal $vogel}\\\\
						$koppen - x \\text{ is het aantal $dier (op basis van het aantal koppen)}\\\\
						\\color{red}{2.x + 4.($koppen-x)=$poten } \\text{ (op basis van het aantal poten)}\\\\
						\\Leftrightarrow 2.x + 4.$koppen - 4.x = $poten \\\\
						\\Leftrightarrow -2.x + ".(4*$koppen)."=$poten \\\\
						\\Leftrightarrow -2.x = $poten - ".(4*$koppen)."=".($poten-4*$koppen)."\\\\
						\\Leftrightarrow x = ".($poten-4*$koppen).".\\left(\\frac{1}{-2}\\right)=$n_vogel\\\\
						\\text{Er zijn $n_vogel $vogel en dus $n_dier $dier }";
		$stamp		= "14.$koppen";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

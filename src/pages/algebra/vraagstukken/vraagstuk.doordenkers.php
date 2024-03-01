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
		$i = random_int(11,13);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{ //
		$tafels		= nietnul(20,50);
		$a			= nietnul(5,12);
		$rest_a		= nietnul(4,$a-1);
		$gasten		= $a * $tafels + $rest_a;
		$b			= $a+nietnul(1,4);
		$rest_b		= $gasten-$b*$tafels;
		
		$opgave 	= "\\text{In een feestzaal staan tafels.}\\\\
						\\text{Als aan elke tafel $a gasten zitten, dan hebben $rest_a gasten geen plaats }\\\\
						\\text{Als er aan elke tafel $b gasten zitten, dan zijn er ".abs($rest_b)." plaatsen ".($rest_b < 0 ? "over" : "tekort")."}\\\\
						\\text{Hoeveel tafels staan er in de feestzaal?}
						";
		$oplossing	= $opgave . "\\\\--\\\\
					\\text{x is het aantal tafels}\\\\
					\\color{red}{ $a.x+$rest_a = $b.x $rest_b } \\\\
					\\Leftrightarrow $a.x - $b.x = $rest_b - $rest_a\\\\
					\\Leftrightarrow ".p($a-$b,1)."x = ".($rest_b -$rest_a)."\\\\
					\\Leftrightarrow x = $tafels \\\\
					\\text{Er staan $tafels tafels in de feestzaal.}
					";
		$stamp		= "11.$tafels";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{ //
		$n_a		= nietnul(500,800);
		$n_b		= nietgetal(500,800, array($n_a));
		$n			= $n_a + $n_b;
		$p_a		= nietnul(20,40);
		$p_b		= $p_a + nietnul(3,10);
		$totaal		= $n_a*$p_a + $n_b * $p_b;
		$opgave 	= "\\text{De Red Flames spelen een wedstrijd tegen Portugal.}\\\\
						\\text{Door de coronamaatregelen waren er slechts $n toeschouwers.}\\\\
						\\text{De toegangskaarten kosten $p_a euro en $p_b euro.}\\\\
						\\text{In totaal bracht dit $totaal euro op.}\\\\
						\\text{Hoeveel kaarten waren er van elke soort?}";
		$oplossing	= $opgave . "\\\\--\\\\
						\\text{x is het aantal kaarten van $p_a euro }\\\\
						\\text{ $n - x is het aantal kaarten van $p_b euro }\\\\
						\\color{red}{ $p_a.x+$p_b.($n - x)=$totaal }\\\\
						\\Leftrightarrow $p_a.x+$p_b.$n-$p_b.x=$totaal \\\\
						\\Leftrightarrow ".($p_a-$p_b).".x+".($p_b*$n)."=$totaal \\\\
						\\Leftrightarrow ".($p_a-$p_b).".x=".($totaal-$p_b*$n)." \\\\
						\\Leftrightarrow x=".($totaal-$p_b*$n).".\\frac{1}{".($p_a-$p_b)."} = $n_a \\\\
						\\text{Er zijn $n_a kaarten van $p_a euro en $n_b kaarten van $p_b euro.}
						";
		$stamp		= "12.$totaal";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{ //
		$totaal		= nietnul(400,2000);
		$a			= nietnul(5,20);
		$r_a		= $totaal % $a;
		$b			= nietnulcopriem($a,5,20);
		$r_b		= $totaal % $b;
		$opgave 	= "\\text{In de 3e E vC had het Chinese leger een bijzondere manier om haar manschappen te tellen.}\\\\
						\\text{Tijdens het marcheren werd gevraagd om in rijen van (bvb.) $a soldaten te lopen.}\\\\
						\\text{Achteraan noteerde iemand het aantal soldaten in de laatste (onvolledige) rij. Hier: $r_a }\\\\
						\\text{Vervolgens werd gevraagd om in een ander aantal rijen te lopen, bvb. per $b }\\\\
						\\text{De persoon achteraan noteerde (in dit geval) dat er $r_b soldaten in de laatste rij stonden }\\\\
						\\text{Hoeveel soldaten zaten er in deze grote groep? }
						";
		$oplossing	= $opgave . "\\\\--\\\\
						\\text{Dit vraagstuk heeft helemaal niets te maken met vergelijkingen van de eerste graad.}\\\\
						\\text{Het totaal aantal soldaten was $totaal . Maar het had ook een andere waarde kunnen zijn.}\\\\
						\\text{Heb jij een idee?}
						";
		$stamp		= "13.$totaal";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

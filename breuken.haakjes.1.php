<?php 
require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$tk0 = nietnul(-1,1);
		//Breuk 1
		$t1 = nietnul(2,15);
		$n1 = nietnulcopriem($t1,2,15);
		$tkt1 = nietnul(-1,1);
		$tkn1 = nietnul(-1,1);
		//Breuk 2
		$t2 = nietnul(2,15);
		$n2 = nietnulcopriem($t2,2,15);
		$tkt2 = nietnul(-1,1);
		$tkn2 = nietnul(-1,1);
		//Bewerking
		$bewerking = nietnul(-1,1);
		//Latex
		$opgave = p($tk0,0)."\\left(\\frac{".$tkt1*$t1."}{".$tkn1*$n1."}\\right)".p($bewerking,0)."\\left(\\frac{".$tkt2*$t2."}{".$tkn2*$n2."}\\right)";
		$oplossing = $opgave;
		//Haakjes opheffen
		$t1 = $tk0* $tkt1 * $tkn1 * $t1;
		$bewerking = p($bewerking*$tkt2*$tkn2,0);
		$oplossing .= "\\\\= \\frac{".$t1."}{".$n1."}".$bewerking."\\frac{".$t2."}{".$n2."}";
		//Vereenvoudig
		if(abs(ggd($t1,$n1))!=1 or abs(ggd($t2, $n2))!=1)
		{
			$ggd1 = abs(ggd($t1, $n1));
			$ggd2 = abs(ggd($t2, $n2));
			$t1 /= $ggd1;
			$n1 /= $ggd1;
			$t2 /= $ggd2;
			$n2 /= $ggd2;
			$oplossing .= "\\\\=\\frac{".$t1."}{".$n1."}$bewerking\\frac{".$t2."}{".$n2."}";
		}
		//Gelijknamig maken
		$kgv = kgv($n1, $n2);
		$noemer = $kgv;
		if($kgv != $n1)
		{
			$t1 = $t1 * $kgv / $n1;
			$t2 = $t2 * $kgv / $n2;
			
			$oplossing .= "\\\\=\\frac{".$t1."}{".$noemer."}$bewerking\\frac{".$t2."}{".$noemer."}";
		}
		//Op zelfde noemer zetten
		$oplossing .= "\\\\=\\frac{".$t1.$bewerking.$t2."}{".$noemer."}";
		//Teller vereenvoudigen
		if($bewerking == '+')
		{
			$teller = $t1 + $t2;
		}else{
			$teller = $t1 - $t2;
		}
		$oplossing .= "\\\\=\\frac{".$teller."}{".$noemer."}";
		//Breuk vereenvoudigen
		if(abs(ggd($teller, $noemer)) != 1)
		{
			$ggd = abs(ggd($teller, $noemer));
			$teller /= $ggd;
			$noemer /= $ggd;
			$oplossing .= "\\\\=\\frac{".$teller."}{".$noemer."}";
		}
		$stamp = "$n1.$n2.$t1.$t2";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

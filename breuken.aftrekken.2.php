<?php 
require_once("class.oefening.php");
require_once("class.math.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		//Breuk 1
		$t1 = nietnul(-20,20);
		$n1 = nietnulcopriem($t1,2,20);
		//Breuk 2
		$t2 = nietnul(2,20);
		$n2 = nietnulcopriem($t2,2,20);
		//Latex
		$opgave = "\\frac{".$t1."}{".$n1."}-\\frac{".$t2."}{".$n2."}";
		$oplossing = $opgave;
		//Vereenvoudig
		if(abs(ggd($t1,$n1))!=1 or abs(ggd($t2, $n2))!=1)
		{
			$ggd1 = abs(ggd($t1, $n1));
			$ggd2 = abs(ggd($t2, $n2));
			$t1 /= $ggd1;
			$n1 /= $ggd1;
			$t2 /= $ggd2;
			$n2 /= $ggd2;
			$oplossing .= "\\\\=\\frac{".$t1."}{".$n1."}-\\frac{".$t2."}{".$n2."}";
		}
		//Gelijknamig maken
		$kgv = kgv($n1, $n2);
		$noemer = $kgv;
		if($kgv != $n1)
		{
			$t1 = $t1 * $kgv / $n1;
			$t2 = $t2 * $kgv / $n2;
			
			$oplossing .= "\\\\=\\frac{".$t1."}{".$noemer."}-\\frac{".$t2."}{".$noemer."}";
		}
		//Op zelfde noemer zetten
		$oplossing .= "\\\\=\\frac{".$t1."-".$t2."}{".$noemer."}";
		//Teller vereenvoudigen
		$teller = $t1 - $t2;
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

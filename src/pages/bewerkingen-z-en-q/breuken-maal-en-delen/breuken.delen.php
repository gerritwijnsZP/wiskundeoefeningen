<?php 
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		//Breuk 1
		$t1 = nietnul(2,12);
		$n1 = nietnul(2,15);
		//Breuk 2
		$t2 = nietnul(2,12);
		$n2 = nietnul(2,15);
		//Latex
		$opgave = "\\frac{".$t1."}{".$n1."} : \\frac{".$t2."}{".$n2."}";
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
			$oplossing .= "\\\\=\\frac{".$t1."}{".$n1."} : \\frac{".$t2."}{".$n2."}";
		}
		//Maal omgekeerde
		$dummy = $t2;
		$t2 = $n2;
		$n2 = $dummy;
		$oplossing .= "\\\\=\\frac{".$t1."}{".$n1."} . \\frac{".$t2."}{".$n2."}";
		//Samen
		$oplossing .= "\\\\=\\frac{".$t1.".".$t2."}{".$n1.".".$n2."}";
		//Uitwerken
		$teller = $t1 * $t2;
		$noemer = $n1 * $n2;
		$oplossing .= "\\\\=\\frac{".$teller."}{".$noemer."}";
		//Breuk vereenvoudigen
		if(abs(ggd($teller, $noemer)) != 1)
		{
			$ggd = abs(ggd($teller, $noemer));
			$teller /= $ggd;
			$noemer /= $ggd;
			$oplossing .= "\\\\=\\frac{".$teller."}{".$noemer."}";
		}
		if($noemer == 1)
		{
			$oplossing .= "= ".$teller;
		}
		$stamp = "$n1.$n2.$t1.$t2";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

<?php 
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$tk1 = nietnul(-1,1);
		//Breuk 1
		$t1 = nietnul(2,10);
		$n1 = nietnulcopriem($t1,2,10);
		$tkt1 = nietnul(-1,1);
		$tkn1 = nietnul(-1,1);
		//Breuk 2
		$tk2 = nietnul(-1,1);
		$t2 = nietnul(2,10);
		$n2 = nietnul(2,10);
		$tkt2 = nietnul(-1,1);
		$tkn2 = nietnul(-1,1);
		//Breuk3
		$tk3 = nietnul(-1,1);
		$t3 = nietnul(2,12);
		$n3 = nietnul(2,12);
		$tkt3 = nietnul(-1,1);
		$tkn3 = nietnul(-1,1);
		//Latex
		$opgave = p($tk1,0)."\\left(\\frac{".$tkt1*$t1."}{".$tkn1*$n1."}\\right)
				".p($tk2,0)."\\left(\\frac{".$tkt2*$t2."}{".$tkn2*$n2."}\\right)
				".p($tk3,0)."\\left(\\frac{".$tkt3*$t3."}{".$tkn3*$n3."}\\right)";
		$oplossing = $opgave;
		//Haakjes opheffen
		$t1 = $tk1* $tkt1 * $tkn1 * $t1;
		$bewerking1 = p($tk2*$tkt2*$tkn2,0);
		$bewerking2 = p($tk3*$tkt3*$tkn3,0);
		$oplossing .= "\\\\= 	\\frac{".$t1."}{".$n1."}".$bewerking1."
								\\frac{".$t2."}{".$n2."}".$bewerking2."\\frac{".$t3."}{".$n3."}";
		
		//Vereenvoudig
		if(abs(ggd($t1,$n1))!=1 or abs(ggd($t2, $n2))!=1 or abs(ggd($t3, $n3))!=1)
		{
			$ggd1 = abs(ggd($t1, $n1));
			$ggd2 = abs(ggd($t2, $n2));
			$ggd3 = abs(ggd($t3, $n3));
			$t1 /= $ggd1;
			$n1 /= $ggd1;
			$t2 /= $ggd2;
			$n2 /= $ggd2;
			$t3 /= $ggd3;
			$n3 /= $ggd3;
			$oplossing .= "\\\\=\\frac{".$t1."}{".$n1."}$bewerking1\\frac{".$t2."}{".$n2."}$bewerking2\\frac{".$t3."}{".$n3."}";
		}
		
		//Gelijknamig maken
		$kgv = kgv(kgv($n1, $n2),$n3);
		$noemer = $kgv;
		if($kgv != $n1)
		{
			$t1 = $t1 * $kgv / $n1;
			$t2 = $t2 * $kgv / $n2;
			$t3 = $t3 * $kgv / $n3;
			$oplossing .= "\\\\=\\frac{".$t1."}{".$noemer."}$bewerking1\\frac{".$t2."}{".$noemer."}$bewerking2\\frac{".$t3."}{".$noemer."}";
		}
		
		//Op zelfde noemer zetten
		$oplossing .= "\\\\=\\frac{".$t1.$bewerking1.$t2.$bewerking2.$t3."}{".$noemer."}";
		//
		//Teller vereenvoudigen
		if($bewerking1 == '+')
		{
			$teller = $t1 + $t2;
		}else{
			$teller = $t1 - $t2;
		}
		if($bewerking2 == '+')
		{
			$teller += $t3;
		}else{
			$teller -= $t3;
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

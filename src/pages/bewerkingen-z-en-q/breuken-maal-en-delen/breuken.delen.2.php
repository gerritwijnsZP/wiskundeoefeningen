<?php 
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");
class Fabriek extends OefeningFactory
{
	public function run()
	{
		//Breuk 1
		$tkt1 = nietnul(-1,1);
		$t1 = nietnul(2,12);
		$tkn1 = nietnul(-1,1);
		$n1 = nietnul(2,15);
		//Breuk 2
		$t2 = nietnul(2,12);
		$tkt2 = nietnul(-1,1);
		$n2 = nietnul(2,15);
		$tkn2 = nietnul(-1,1);
		//Latex
		$opgave = "\\frac{".$tkt1*$t1."}{".$tkn1*$n1."} : ";
		if($tkt2 < 0 or $tkn2 < 0){
			$opgave .= "\\left(\\frac{".$tkt2*$t2."}{".$tkn2*$n2."}\\right)";
		}else{
			$opgave .= "\\frac{".$tkt2*$t2."}{".$tkn2*$n2."}";
		}
		$oplossing = $opgave;
		$teken = p($tkt1*$tkn1*$tkt2*$tkn2,0);
		//Vereenvoudig
		if(abs(ggd($t1,$n1))!=1 or abs(ggd($t2, $n2))!=1)
		{
			$ggd1 = abs(ggd($t1, $n1));
			$ggd2 = abs(ggd($t2, $n2));
			$t1 /= $ggd1;
			$n1 /= $ggd1;
			$t2 /= $ggd2;
			$n2 /= $ggd2;
			$oplossing .= "\\\\=$teken\\frac{".$t1."}{".$n1."} : \\frac{".$t2."}{".$n2."}";
		}
		//Maal omgekeerde
		$dummy = $t2;
		$t2 = $n2;
		$n2 = $dummy;
		$oplossing .= "\\\\=$teken\\frac{".$t1."}{".$n1."} . \\frac{".$t2."}{".$n2."}";
		
		if($teken == '+'){$teken = '';}
		//Samen
		$oplossing .= "\\\\=$teken\\frac{".$t1.".".$t2."}{".$n1.".".$n2."}";
		//Uitwerken
		$teller = $t1 * $t2;
		$noemer = $n1 * $n2;
		$oplossing .= "\\\\=$teken\\frac{".$teller."}{".$noemer."}";
		//Breuk vereenvoudigen
		if(abs(ggd($teller, $noemer)) != 1)
		{
			$ggd = abs(ggd($teller, $noemer));
			$teller /= $ggd;
			$noemer /= $ggd;
			$oplossing .= "\\\\=$teken\\frac{".$teller."}{".$noemer."}";
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

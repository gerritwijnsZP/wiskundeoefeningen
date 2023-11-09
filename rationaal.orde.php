<?php
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,12);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		//Begrensd kommagetal
		$a 	= nietnul(-20,20);
		$b	= array(nietnul(2,9),nietnul(10,99),nietnul(100,999))[rand(0,2)];
		$num = strlen("".$b);
		if($a > 0)
		{
			$teller = $a*pow(10,$num)+$b;
		}else{
			$teller = $a*pow(10,$num)-$b;
		}
		$noemer = pow(10,$num);
		$ggd	= abs(ggd($teller, $noemer));
		if($ggd > 1)
		{
			$teller /= $ggd;
			$noemer /= $ggd;
		}
		$breuk1	= "\\dfrac{".$teller."}{".$noemer."}";
		$getal1 = floatval($a.".".$b);
		$getal2 = $getal1 + array(-1,-0.1,0,0.1,1)[rand(0,4)];
		$opgave 	= $breuk1 . "\\ldots" . puntkomma($getal2);
		
		$teken		= "\\ldots";
		if($getal1 < $getal2){$teken = "<";}
		elseif($getal1 == $getal2){$teken = "=";}
		else{$teken = ">";}
		
		$oplossing	= $breuk1 . $teken . puntkomma($getal2);
		
		$stamp		= '11.'.$a.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		//Breuk met breuk
		$a		= nietnul(-20,20);
		$b		= nietnulcopriem($a,2,20);
		$getal1	= $a/$b;
		$breuk1 = "\\dfrac{".$a."}{".$b."}";
		$c		= $a + nietnul(-3,3);
		$d		= $b + nietnul(-3,3);
		$ggd = abs(ggd($c,$d));
		$c /= $ggd;
		$d /= $ggd;
		if($d <= 1)
		{
			$d = nietnulcopriem($c,2,10);
		}
		$getal2 = $c/$d;
		$breuk2 = "\\dfrac{".$c."}{".$d."}";
		$opgave = $breuk1 . "\\ldots" . $breuk2;
		
		$teken		= "\\ldots";
		if($getal1 < $getal2){$teken = "<";}
		elseif($getal1 == $getal2){$teken = "=";}
		else{$teken = ">";}
		
		$oplossing	= $breuk1 . $teken . $breuk2;
		
		$stamp		= '12.'.$a.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");

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
		$opgave 	= $a . ',' . $b;
		$oplossing	= $opgave;
		$oplossing 	.= '=' . "\\dfrac{".$teller."}{".$noemer."}";
		if($ggd > 1)
		{
			$teller /= $ggd;
			$noemer /= $ggd;
			$oplossing	.= '=' . "\\dfrac{".$teller."}{".$noemer."}";
		}
		$stamp		= '11.'.$a.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		//Onbegrensd kommagetal met repeterend deel
		$a 	= rand(0,20);
		$b	= array("",nietnul(2,9),nietnul(10,99),nietnul(100,999))[rand(0,3)];
		$c	= array(mismatched(1),mismatched(2),mismatched(3))[rand(0,2)];
		$num1 = strlen("".$b.$c);
		$num2 = strlen("".$b);
		$getal = floatval($a . '.' . $b.$c.$c);
		$opgave 	= $a . ',' . $b.$c.$c."\\ldots";
		$oplossing	= "x = ".$a.','.$b."\\textbf{".$c."}\\textbf{".$c."}\\ldots\\Leftrightarrow ";
		$oplossing	.= "\\begin{array}{ r | r }";
		$oplossing	.= pow(10,$num1)."x & ".puntkomma($getal * pow(10,$num1)).$c."\\ldots \\\\";
		$oplossing	.= pow(10,$num2)."x & ".puntkomma($getal * pow(10,$num2))."\\ldots \\\\";
		$oplossing	.= "\\hline";
		$noemer		= pow(10,$num1)-pow(10,$num2);
		$teller		= intval("".$a.$b.$c) - intval("".$a.$b);
		$oplossing	.= $noemer."x & ". $teller .",".nullen(strlen("".$c.$c)) ."\\ldots \\end{array}";
		$oplossing 	.= "\\Leftrightarrow x = \\dfrac{".$teller."}{".$noemer."}";
		$ggd = ggd($teller,$noemer);
		if($ggd > 1)
		{			
			$teller /= $ggd;
			$noemer /= $ggd;
			$oplossing	.= "= \\dfrac{".$teller."}{".$noemer."}"; 
		}
		$stamp		= '12.'.$a.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");
//require_once("class.rational.php");
//require_once("class.hoek.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		$lijst		= array();
		$aantal		= nietnul(5,12);
		for($i = 0; $i < $aantal; $i++)
		{
			array_push($lijst, nietnul(0, 10));
		}
		$opgave 	= "\\text{".implode(", ", $lijst)."}";
		$oplossing 	= $opgave;
		$oplossing .= "\\\\= \\frac{".implode(" + ",$lijst)."}{".$aantal."}";
		$res 		= array_sum($lijst);
		$oplossing .= "\\\\=\\frac{".$res."}{".$aantal."}";
		$res 		= $res / $aantal;
		if($res == round($res, 1))
		{
			$oplossing .= "=".puntkomma($res);
		}else{
			$oplossing .= "\\approx ".puntkomma(round($res,1), 1);
		}
		$stamp		= $aantal.nietnul(0,5);
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

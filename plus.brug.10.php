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
		$e			= rand(0,10);
		$f			= 10-$e;
		$coin		= rand(0,1);
		if($coin == 0)
		{
			$opgave 	= "$e + \\ldots = 10";
			$oplossing 	= "$e + $f = 10";
		}else{
			$opgave 	= "\\ldots + $f = 10";
			$oplossing 	= "$e + $f = 10";
		}
		$stamp = $coin.".".$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

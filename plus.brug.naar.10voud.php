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
		$d1			= rand(1,9)*10;
		$d2			= rand(1,9);
		$e			= $d1 + $d2;
		$f			= 10 - $d2;
		$coin		= rand(0,1);
		if($coin == 0)
		{
			$opgave 	= "$e + \\ldots = ".($d1+10);
			$oplossing 	= "$e + $f = ".($d1+10);
		}else{
			$opgave 	= "\\ldots + $f = ".($d1+10);
			$oplossing 	= "$e + $f =".($d1+10);
		}
		$stamp = $coin.".".$d2;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

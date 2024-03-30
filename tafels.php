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
		$i = random_int(11,12);
		//Meer kans op oefening 11
		if($i == 12){$i = random_int(11,12);}
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		$a 			= rand(2,10);
		$e			= rand(1,10);
		$f 			= $a * $e;
		$opgave 	= $e." \\times $a = ";
		$oplossing 	= $opgave;
		$oplossing .= $e * $a;
		$stamp		= "$f.";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{	
		$a 			= rand(1,10);
		$e			= rand(1,10);
		$f 			= $a * $e;
		$opgave 	= "$f : $a = ";
		$oplossing 	= $opgave;
		$oplossing .= $e;
		$stamp		= "$f:";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

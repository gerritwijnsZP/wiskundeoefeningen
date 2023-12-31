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
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	//log a + log b = log (a.b) = ...
		$delers		= array(2,4,5,8,10,20,25,50);
		$a			= $delers[random_int(0, count($delers)-1)] * pow(10,random_int(-1,1));
		$b			= pow(10,random_int(-2,4)) / $a;
		$opgave 	= "\\log ".puntkomma($a)." + \\log". puntkomma($b);
		$oplossing 	= $opgave;
		$oplossing	.= "\\\\ = \\log(".puntkomma( $a)." \\cdot ".puntkomma($b)." ) 
						\\\\ = \\log ( ".puntkomma($a*$b).")
						\\\\ =".log($a*$b, 10);
		$stamp		= "11.".(min($a,$b));
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{	//log a - log b = log (a.b) = ...
		$delers		= array(2,4,5,8,10,20,25,50);
		$b			= $delers[random_int(0, count($delers)-1)] * pow(10,random_int(-1,1));
		$a			= pow(10,random_int(-2,4)) * $b;
		$opgave 	= "\\log ".puntkomma($a)." - \\log". puntkomma($b);
		$oplossing 	= $opgave;
		$oplossing	.= "\\\\ = \\log(".puntkomma( $a)." : ".puntkomma($b)." ) 
						\\\\ = \\log ( ".puntkomma($a/$b).")
						\\\\ =".log($a/$b, 10);
		$stamp		= "12.".(min($a,$b));
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	
}
?>

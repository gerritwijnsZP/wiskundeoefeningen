<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");
//require_once(LIB . "class.rational.php");
//require_once(LIB . "class.hoek.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,13);
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
	private function oef13()
	{	//a log b = log b^a = ...
		$e			= random_int(10,20) * 4 / 10;
		$x			= pow(10,$e);
		$opgave		= "\\log ".puntkomma($x);
		$oplossing	= $opgave;
		$stamp		= "13.".$x;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

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
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		$e			= rand(0,5);
		//Kans op 0 verkleinen
		if($e == 0){$e	= rand(0,2);}
		$f			= rand(0,5-$e);
		if($f == 0){$f	= rand(0,5-$e);}
		$opgave 	= $e." + " . $f ." = ";
		$oplossing 	= $opgave;
		$oplossing .= $e + $f;
		$stamp		= $e.$f;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

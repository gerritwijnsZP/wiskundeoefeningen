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
require_once(LIB . "class.hoek.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$rad = rand(1,1999)/1000*array(-1,1,1,1)[rand(0,3)];
		$hoek = new Hoek(0);
		$hoek->setRad($rad);
		$opgave = $hoek->radialen();
		$oplossing = $opgave;
		$oplossing .= "= ".$hoek;
		$stamp		= "$rad"; 
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);

	}
}
?>

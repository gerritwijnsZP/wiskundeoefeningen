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
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$a			= random_int(2,399);
		
		$voorvoegsels 	= array("m","c","d","","da","h","k");
		$e 				= "m²";
		$m 				= rand(0, count($voorvoegsels)-1);
		$n				= nietgetal(max(0,$m-3), min($m+2,count($voorvoegsels)-1), array($m));
		
		$opgave		= "\\)Zet ".puntkomma($a)." ".$voorvoegsels[$m].$e." om in ".$voorvoegsels[$n].$e."\\(";
		$oplossing	= puntkomma($a)." \\text{ }".$voorvoegsels[$m].$e."=".puntkomma($a*pow(10,2*($m-$n)))."\\text{ }".$voorvoegsels[$n].$e;
		$stamp		= '11.'.$a;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

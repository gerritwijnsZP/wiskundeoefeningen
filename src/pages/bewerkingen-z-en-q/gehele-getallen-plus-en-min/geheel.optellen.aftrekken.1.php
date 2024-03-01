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
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		$a	= nietnul(-12,8);
		if($a > 0){$b 	= nietnul(-12,-$a);} //Negatief resultaat
		else{$b = nietnul(-8,8); } //Om 't even
		
		$opgave = $a.p($b,2)."=";
		$oplossing = $opgave . ($a+$b);
		$stamp		= "$a.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	
	
}
?>

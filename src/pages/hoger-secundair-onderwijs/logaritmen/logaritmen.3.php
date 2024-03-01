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
		$a			= pow(-1, rand(1,2)) * rand(2,39) / pow(10,rand(1,2));
		$opgave 	= "\\log x = ". puntkomma($a);
		$oplossing 	= $opgave;
		$oplossing .= "\\\\ \\Leftrightarrow x = 10^{".puntkomma($a)."} \\\\ \\Leftrightarrow x ";
		$res 		= pow(10,$a);
		if(is_int($a))
		{
			$oplossing .= "=".$res;
		}else{
			$oplossing .= "\\approx ".puntkomma($res);
		}
		$stamp		= "$a";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	
	
}
?>

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
		$e			= rand(2,9);
		$f			= rand(11-$e,20-$e);
		$opgave 	= $e." + " . color("red",$f) ." = ";
		$oplossing 	= $opgave;
		if($f < 10)
		{
			if($e < $f)
			{
				$oplossing .= $f. " + ".color("green",$e) . " = ". $f . " + ".color("green", (10-$f). " + " .($e+$f-10)); 
			}else{
				$oplossing .= $e. " + ".color("red",10-$e).color("red"," + ").color("red",$e+$f-10);
			}
		}else{
			$oplossing .= color("red",$f). " + ".$e;
		}
		$oplossing .= " = " . ($e+$f);
		$stamp		= $e.$f;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

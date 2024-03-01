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
		$tabel	= array(-2 	=>array("min"=>2,"max"=>20),
						2	=>array("min"=>2,"max"=>20),
						3	=>array("min"=>2,"max"=>5),
						4	=>array("min"=>2,"max"=>3),
						5	=>array("min"=>2,"max"=>2)
						);
		$expo 	= array(	-2,-2,-2,-2,-2,-2,-2,-2,-2,-2, //Kans op (neg) kwadraat stuk groter dan andere exponenten
							2,2,2,2,2,2,2,2,2,2,
							3,3,3,
							4,4,5);
		$e		= $expo[rand(0, count($expo)-1)];
		$g		= rand($tabel[$e]["min"], $tabel[$e]["max"]);
		$opgave = $g . "^{".$e."}";
		$oplossing = $opgave;
		if($e < 0)
		{
			$oplossing .= "= \\frac{1}{".pow($g,abs($e))."}";
		}else{
			$oplossing .= "=".pow($g,$e);
		}
		$stamp		= "$g.$e";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	
	
}
?>

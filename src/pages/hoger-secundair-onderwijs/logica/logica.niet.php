<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.logica.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		/*
		$a = nietnul(2,100);
		$b = random_int(0,1);
		$p = new Propositie((nietnul(3,4)*$a-$b). " is ## veelvoud van ".$a, (1-$b==1), "een", "geen");
		*/
		$boek = new Boek();
		$b = $boek->get();
		$c = new Combo();
		$c->push("p", $b["propositie"]);
		$switch = array( random_int(0,1) );
		$opgave = $c->opgave("notp", $switch);
		$oplossing = $c->oplossing("notp", $switch);
		$stamp		= $b["stamp"];
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	
	
}
?>

<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';

require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.logica.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,12);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11() //en
	{
		$boek = new Boek();
		$a = $boek->get();
		$b = $boek->get();
		$c = new Combo();
		$c->push("p", $a["propositie"]);
		$c->push("q", $b["propositie"]);
		$switch = array( random_int(0,1), random_int(0,1) );
		$opgave = $c->opgave("penq", $switch);
		$oplossing = $c->oplossing("penq", $switch);
		$stamp		= $a["stamp"].$b["stamp"];
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12() //of
	{
		$boek = new Boek();
		$a = $boek->get();
		$b = $boek->get();
		$c = new Combo();
		$c->push("p", $a["propositie"]);
		$c->push("q", $b["propositie"]);
		$switch = array( random_int(0,1), random_int(0,1) );
		$opgave = $c->opgave("pofq", $switch);
		$oplossing = $c->oplossing("pofq", $switch);
		$stamp		= $a["stamp"].$b["stamp"];
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}

}
?>

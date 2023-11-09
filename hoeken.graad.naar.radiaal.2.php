<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");
require_once("class.hoek.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$graad = rand(1,179)*array(-1,1,1,1)[rand(0,3)];
		$minuut = rand(0,59)*array(0,1,1,1)[rand(0,3)];
		if($minuut == 0)
		{
			$seconde = rand(1,59);
		}else{
			$seconde = rand(0,59)*array(0,1,1,1)[rand(0,3)];
		}
		$hoek = new Hoek($graad, $minuut, $seconde);
		$opgave = (string) $hoek;
		$oplossing = $opgave;
		$oplossing .= "= ".($hoek->radialen());
		$stamp		= "$graad.$minuut.$seconde";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);

	}
}
?>

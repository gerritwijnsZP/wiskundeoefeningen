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
		$optie = rand(0,3);
		$trios = array( array(3,4,5), array(6,8,10), array(9,12,15), array(5,12,13) )[$optie];
		$x = pow($trios[0],2);
		$y = pow($trios[1],2);
		$z = pow($trios[2],2);
		$vormen = array(array('opgave'=>"\\sqrt{ $x + $y}",				'oplossing'=>"=\\sqrt{".($x+$y)."} = ".ivkw($x+$y)),
						array('opgave'=>"\\sqrt{ $z - $y}",			'oplossing'=>"=\\sqrt{".($z-$y)."} = ".ivkw($z-$y)),
						array('opgave'=>"\\sqrt{ $z - $x}",				'oplossing'=>"=\\sqrt{".($z-$x)."} = ".ivkw($z-$x)),
						array('opgave'=>"\\sqrt{ $z } - \\sqrt{ $x }",	'oplossing'=>"=".ivkw($z)."-".ivkw($x)."=".(ivkw($z)-ivkw($x))),
						array('opgave'=>"\\sqrt{ $z } - \\sqrt{ $y }",	'oplossing'=>"=".ivkw($z)."-".ivkw($y)."=".(ivkw($z)-ivkw($y))),
						array('opgave'=>"\\sqrt{ $x } + \\sqrt{ $y }",	'oplossing'=>"=".ivkw($x)."+".ivkw($y)."=".(ivkw($x)+ivkw($y))),
		);
		$optie2 = rand(0,5);
		$opgave		= $vormen[$optie2]['opgave'];
		$oplossing	= $opgave;
		$oplossing .= $vormen[$optie2]['oplossing'];
		$stamp		= '11.'.$optie.$optie2;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

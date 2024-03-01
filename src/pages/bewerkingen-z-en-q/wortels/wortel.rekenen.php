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
//require_once(LIB . "class.rational.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,12);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$x  = nietnul(2,12);
		$y	= nietnulcopriem($x,2,5);
		$a	= pow($x * $y,2);
		$opgave		= "\\sqrt{".$a."}";
		$oplossing	= $opgave;
		$res		= array($a);
		while(sqrt($res[0]) > 20)
		{
			$factoren = array(100,4,25,9,16,49,121,169,289,361);
			foreach($factoren as $factor)
			{
				if($res[0] % $factor == 0)
				{
					array_push($res, $factor);
					$res[0] = $res[0]/$factor;
					$oplossing .= "=\\sqrt{".implode(" \\cdot ", $res)."}";
					break;
				}
			}
		}
		if(count($res) > 1)
		{
			$oplossing	.= "=".implode(" \\cdot ", array_map('vkw', $res));
			$oplossing	.= "=".implode(" \\cdot ", array_map('ivkw', $res));
		}
		$oplossing	.= "=".ivkw($a);
		$stamp		= '11.'.$a;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$x  = pow(nietnul(2,12),2);
		$y	= array(2,3,5,6,10)[rand(0,4)];
		$a = $x*$y;
		$opgave		= "\\sqrt{".$a."}";
		$oplossing	= $opgave;
		$oplossing .= "=\\sqrt{".$x." \\cdot ".$y."}";
		$oplossing .= "=".vkw($x). "\\cdot ".vkw($y);
		$oplossing .= "=".ivkw($x).vkw($y);
		$stamp		= '12.'.$a;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

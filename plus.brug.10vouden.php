<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");
//require_once("class.rational.php");
//require_once("class.hoek.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		$d1			= rand(1,8)*10;
		//Lagere waardes krijgen hogere kans
		if($d1 > 50){$d1= rand(1,9)*10;}
		$d2			= rand(1,9);
		$e			= $d1 + $d2;
		$f			= rand(1, 9-$d1/10)*10;
		$coin		= rand(0,1);
		if($coin)
		{
			$opgave 	= "$e + $f = \\ldots";
			$oplossing 	= "\\begin{align} & $e + $f \\\\
						= & $f + $e \\\\";
		}else{
			$opgave 	= "$f + $e = \\ldots";
			$oplossing 	= "\\begin{align} & $f + $e \\\\";
		}
		
		$oplossing .= "= & $f + ".color("green",$d1)."+".color("red",$d2)."\\\\
						= & ".color("green",$f+$d1)."+".color("red",$d2)."\\\\
						= & ".color("red",$e+$f)."\\end{align}";
		$stamp = $e.".".$f;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

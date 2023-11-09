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
	//Rekenregel 1
	public function run()
	{
		$i = random_int(11,12);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		$a			= nietnul(-10,10)*2;
		$b			= nietnul(-10,10);
		$e			= array(2,-2,3,-3,4,-4)[random_int(0,5)];
		$opgave		= "(".$a.")^{".$e."}.(".$b.")^{".$e."}";
		$oplossing	= $opgave;
		$oplossing  .= "=\\left(".$a.".".($b < 0 ? "(".$b.")" : $b)."\\right)^{".$e."}";
		$oplossing  .= "=\\left(".($a*$b)."\\right)^{".$e."}";
		$t			= (($a*$b)<0 ? -1 : 1);
		if(abs($e)%2==0)
		{
			//Geen teken want even exponent
			if($e < 0)
			{
				$e			= abs($e);
				$oplossing	.= "=\\frac{1}{".abs($a*$b)."^{".$e."}}";
			}else{
				$oplossing	.= "=".abs($a*$b)."^{".$e."}";
			}
		}else{
			if($e < 0)
			{
				$e			= abs($e);
				$oplossing	.= "=".p($t, 1)."\\frac{1}{".abs($a*$b)."^{".$e."}}";
			}else{
				$oplossing	.= "=".p($t, 1).abs($a*$b)."^{".$e."}";
			}
		}
		$oplossing	.= "=\\ldots";
		$stamp		= "11.".($a*$b).$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{	
		$a			= nietnul(-5,5);
		$b			= pow(-1, random_int(0,1)) * nietnulcopriem($a,2,10) * $a;
		$e			= array(2,-2,3,-3,4,-4)[random_int(0,5)];
		$opgave		= "(".$a.")^{".$e."}:(".$b.")^{".$e."}";
		$oplossing	= $opgave;
		$t			= ($a*$b > 0 ? 1 : -1);
		$a			= abs($a);
		$b			= abs($b);
		$oplossing  .= "=\\left(".p($t,1)."\\frac{".$a."}{".$b."}\\right)^{".$e."}";
		$g			= ggd($a,$b);
		if($g > 1)
		{
			$a			/= $g;
			$b			/= $g;
			$oplossing  .= "=\\left(".p($t,1)."\\frac{".$a."}{".$b."}\\right)^{".$e."}";
		}
		if(abs($e)%2==0)
		{
			//Geen teken want even exponent
			if($e < 0)
			{
				$e			= abs($e);
				$oplossing	.= "=\\frac{".$b."^{".$e."}}{".$a."^{".$e."}}";
			}else{
				$oplossing	.= "=\\frac{".$a."^{".$e."}}{".$b."^{".$e."}}";
			}
		}else{
			if($e < 0)
			{
				$e			= abs($e);
				$oplossing	.= "=".p($t, 1)."\\frac{".$b."^{".$e."}}{".$a."^{".$e."}}";
			}else{
				$oplossing	.= "=".p($t, 1)."\\frac{".$a."^{".$e."}}{".$b."^{".$e."}}";
			}
		}
		$oplossing	.= "=\\ldots";
		$stamp		= "12.".($a*$b).$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

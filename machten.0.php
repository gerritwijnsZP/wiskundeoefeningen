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
{	//Noteer met een positieve exponent
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		$a			= nietnul(-20,4);
		$e			= nietnul(-4,-1);
		$haakjes	= random_int(0,1) == 1;
		if($haakjes)
		{
			$opgave		= "($a)^{".$e."}";
			if($a < 0){ $teken = -1;}else{$teken=1;}
			$oplossing	= $opgave."=\\left(".p($teken,1)."\\frac{1}{".abs($a)."}\\right)^{".abs($e)."}";
			if(abs($e)%2==0)
			{
				$teken = 1;
			}
			$oplossing	.= "=".p($teken, 1)." \\frac{1}{".abs($a)."^{".abs($e)."}}";
		}else{
			$opgave		= "$a^{".$e."}";
			if($a < 0){ $teken = -1;}else{$teken=1;}
			$oplossing	= $opgave."=".p($teken,1)."\\left(\\frac{1}{".abs($a)."}\\right)^{".abs($e)."}";
			$oplossing	.= "=".p($teken, 1)." \\frac{1}{".abs($a)."^{".abs($e)."}}";
		}
		$status = False; //Om te voorkomen dat bij grondtal 1 ook nog eens exponent 1 of zo wordt toegepast
		if(abs($a)==1)
		{
			$oplossing	.= "=".$teken;
			$status = True;
		}elseif((abs($a)==2) or (abs($a)==10))
		{
			$oplossing	.= "=".p($teken, 1)." \\frac{1}{".pow(abs($a),abs($e))."}";
			$status = True;
		}
		if((abs($e)==1) and (!$status))
		{
			$oplossing	.= "=".p($teken, 1)." \\frac{1}{".abs($a)."}";
		}elseif((abs($e)==2) and (!$status))
		{
			$oplossing	.= "=".p($teken, 1)." \\frac{1}{".pow(abs($a),abs($e))."}";

		}elseif(!$status){
			$oplossing	.= "=\\ldots \\text{ZRM}";
		}
		$stamp		= "11.".$a.$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

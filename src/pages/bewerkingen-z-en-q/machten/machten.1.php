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
{	//Noteer met een positieve exponent
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		$a			= nietnul(-20,-2);
		$b			= nietnulcopriem($a,2,10);
		$e			= nietnul(-4,-1);
		$t			= pow(-1,random_int(0,1));
		$opgave		= p($t,1)."\\left(\\frac{".$a."}{".$b."}\\right)^{".$e."}";
		if($a < 0){ $teken = -1;}else{$teken=1;}
		$oplossing	= $opgave."=".p($t,1)."\\left(".p($teken,1)."\\frac{".$b."}{".abs($a)."}\\right)^{".abs($e)."}";
		if(abs($e)%2==0)
		{
			$teken = 1;
		}
		$oplossing	.= "=".p($teken*$t, 1)." \\frac{".abs($b)."^{".abs($e)."}}{".abs($a)."^{".abs($e)."}}";
		
		if(abs($e)==1)
		{
			$oplossing	.= "=".p($teken*$t, 1)." \\frac{".abs($b)."}{".abs($a)."}";
		}elseif(abs($e)==2)
		{
			$oplossing	.= "=".p($teken*$t, 1)." \\frac{".pow(abs($b),abs($e))."}{".pow(abs($a),abs($e))."}";

		}else{
			$oplossing	.= "=\\ldots \\text{ZRM}";
		}
		$stamp		= "11.".$a.$b.$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

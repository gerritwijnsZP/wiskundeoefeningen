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
{	
	//Rekenregel 1
	public function run()
	{
		$i = random_int(11,13);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		$a			= nietnul(-20,20);
		$e			= random_int(-8,8);
		$f			= random_int(-8,8);
		$b = "(".$a.")";
		$opgave		= $b."^{".$e."}.".$b."^{".$f."}";
		$oplossing	= $opgave;
		if($a > 0){ $b = $a;}
		$oplossing .= "=".$b."^{".($e+$f)."}";
		if($e+$f < 0)
		{
			$oplossing .= "=\\frac{1}{".$b."^{".abs($e+$f)."}}";
			if($a < 0)
			{
				if(($e+$f)%2==0)
				{
					$oplossing .= "=\\frac{1}{".abs($a)."^{".abs($e+$f)."}}";
				}else{
					$oplossing .= "=-\\frac{1}{".abs($a)."^{".abs($e+$f)."}}";
				}
			}
		}elseif($e+$f == 0)
		{
			$oplossing .= "=1";
		}else{
			if($a < 0)
			{
				if(($e+$f)%2==0)
				{
					$oplossing .= "=".abs($a)."^{".abs($e+$f)."}";
				}else{
					$oplossing .= "=-".abs($a)."^{".abs($e+$f)."}";
				}
			}
		}
		if($a==1)
		{
			$oplossing .= "=1";
		}elseif($a==-1)
		{
			$oplossing .= "=".(($e+$f)%2==0 ? 1 : -1);
		}
		$stamp		= "11.".$a.".".($e+$f);
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	//Rekenregel 2
	private function oef12()
	{	
		$a			= nietnul(-20,20);
		$e			= random_int(-8,8);
		$f			= random_int(-8,8);
		$b = "(".$a.")";
		$opgave		= $b."^{".$e."}:".$b."^{".$f."}";
		$oplossing	= $opgave;
		if($a > 0){ $b = $a;}
		$oplossing .= "=".$b."^{".($e-$f)."}";
		if($e-$f < 0)
		{
			$oplossing .= "=\\frac{1}{".$b."^{".abs($e-$f)."}}";
			if($a < 0)
			{
				if(($e-$f)%2==0)
				{
					$oplossing .= "=\\frac{1}{".abs($a)."^{".abs($e-$f)."}}";
				}else{
					$oplossing .= "=-\\frac{1}{".abs($a)."^{".abs($e-$f)."}}";
				}
			}
		}elseif($e-$f == 0)
		{
			$oplossing .= "=1";
		}else{
			if($a < 0)
			{
				if(($e-$f)%2==0)
				{
					$oplossing .= "=".abs($a)."^{".abs($e-$f)."}";
				}else{
					$oplossing .= "=-".abs($a)."^{".abs($e-$f)."}";
				}
			}
		}
		if($a==1)
		{
			$oplossing .= "=1";
		}elseif($a==-1)
		{
			$oplossing .= "=".(($e-$f)%2==0 ? 1 : -1);
		}
		$stamp		= "12.".$a.".".($e-$f);
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	//Rekenregel 3
	private function oef13()
	{	
		$a			= nietnul(-20,20);
		$e			= random_int(-8,8);
		$f			= random_int(-8,8);
		if($a<0){$b = "(".$a.")";}else{$b=$a;}
		$opgave		= "\\left(".$b."^{".$e."}\\right)^{".$f."}";
		$oplossing	= $opgave;
		$oplossing .= "=".$b."^{".($e*$f)."}";
		if($e*$f < 0)
		{
			$oplossing .= "=\\frac{1}{".$b."^{".abs($e*$f)."}}";
			if($a < 0)
			{
				if(($e*$f)%2==0)
				{
					$oplossing .= "=\\frac{1}{".abs($a)."^{".abs($e*$f)."}}";
				}else{
					$oplossing .= "=-\\frac{1}{".abs($a)."^{".abs($e*$f)."}}";
				}
			}
		}elseif($e*$f == 0)
		{
			$oplossing .= "=1";
		}else{
			if($a < 0)
			{
				if(($e*$f)%2==0)
				{
					$oplossing .= "=".abs($a)."^{".abs($e*$f)."}";
				}else{
					$oplossing .= "=-".abs($a)."^{".abs($e*$f)."}";
				}
			}
		}
		if($a==1)
		{
			$oplossing .= "=1";
		}elseif($a==-1)
		{
			$oplossing .= "=".(($e*$f)%2==0 ? 1 : -1);
		}
		$stamp		= "13.".$a.".".($e*$f);
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

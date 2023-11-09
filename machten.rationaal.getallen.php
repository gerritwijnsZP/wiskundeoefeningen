<?php
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.rational.php");
require_once("class.helper.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,12);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$e = array(-1,1,1)[rand(0,2)]*rand(2,4);
		$w = array(2,3,4)[rand(0,2)];
		
		$grondtallen = array(2=>array("min"=>2,"max"=>20),
							3=>array("min"=>2,"max"=>4),
							4=>array("min"=>2,"max"=>3));
		$g	= rand($grondtallen[abs($e)]["min"],$grondtallen[abs($e)]["max"]);
		if($g < $grondtallen[abs($e)]["max"])
		{
			$h = rand($g+1, $grondtallen[abs($e)]["max"]);
		}else{
			$h = rand($grondtallen[abs($e)]["min"], $g-1);
		}
		$breuk = new R($g,$h);
		$breuk->vereenvoudig();
		$breuk->haakjes(True);
		$res   = new R(pow($g,abs($e)),pow($h,abs($e)));
		$res->vereenvoudig();
		$res->haakjes(False);
		$opgave		= proot($breuk, $e*$w, $w);
		$oplossing	= $opgave;
		$oplossing .= "\\\\= ".$breuk."^{\\frac{".$e*$w."}{".$w."}}";
		$oplossing .= "\\\\= ".$breuk."^{".$e."}";
		if($e > 0)
		{
			$oplossing .= "=".$res;
		}else{
			$breuk->omgekeerde();
			$res->omgekeerde();
			$oplossing .= "\\\\= ".$breuk."^{".abs($e)."}";
			$oplossing .= "= ".$res;
		}
		
		$stamp		= "$e.$w.$g";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$e = rand(2,4);
		$w = rand(2,4);
		$min = array(-1,1,1)[rand(0,2)];
		$grondtallen = array(2=>array("min"=>2,"max"=>20),
							3=>array("min"=>2,"max"=>4),
							4=>array("min"=>2,"max"=>3));
		$g	= rand($grondtallen[abs($e)]["min"],$grondtallen[abs($e)]["max"]);
		if($g < $grondtallen[abs($e)]["max"])
		{
			$h = rand($g+1, $grondtallen[abs($e)]["max"]);
		}else{
			$h = rand($grondtallen[abs($e)]["min"], $g-1);
		}
		$res   = new R($g,$h);
		$res->vereenvoudig();
		$breuk = new R(pow($g,abs($e)),pow($h,abs($e)));
		$breuk->vereenvoudig();
		$breuk->haakjes(True);
		$opgave		= proot($breuk, $w, $e*$w);
		$oplossing	= $opgave;
		$oplossing .= "\\\\= ".$breuk."^{\\frac{".$min*$w."}{".$e*$w."}}";
		$oplossing .= "\\\\= ".$breuk."^{\\frac{".$min."}{".$e."}}";
		if($min < 0)
		{
			$breuk->omgekeerde();
			$res->omgekeerde();
			/*
			$oplossing .= "\\\\= ".$breuk."^{".abs($e)."}";
			$oplossing .= "= ".$res;
			*/
		}
		$breuk->haakjes(False);
		$oplossing .= "\\\\=".proot($breuk, 1, $e);
		$oplossing .= "=".$res;
		$stamp		= "$e.$w.$g.$h";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}

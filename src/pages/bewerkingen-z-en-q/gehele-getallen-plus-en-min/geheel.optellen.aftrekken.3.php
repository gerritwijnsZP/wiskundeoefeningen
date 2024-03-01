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

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		$a	= nietnul(-9,9);
		$b 	= nietnul(-9,2);
		$c	= nietnul(-2,9);
		$d	= nietnul(-9,9);
		$e	= nietnul(-9,9);
		
		$mogelijkheden = array(	array("opgave"=> $a.p($b,2).p($c,2).p($d,2).p($e,2)."=", 				"oplossing"=>($a+$b+$c+$d+$e)),
								$this->mix($a,$b,$c,$d,$e),
							);
		$keuze = $mogelijkheden[rand(0, count($mogelijkheden)-1)];
		$opgave = $keuze["opgave"];
		$oplossing = $opgave . $keuze["oplossing"];
		$stamp		= "$a.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function mix($a,$b,$c,$d,$e)
	{
		$opgave = "";
		$tussenstap = "";
		$oplossing = 0;
		foreach(array($a,$b,$c,$d,$e) as $t)
		{
			$teken = array('+','-')[rand(0,1)];
			$opgave .= $teken . "(" . p($t,2) . ")";
			if($teken == '-')
			{
				$oplossing -= $t;
				$tussenstap .= p(-$t,2);
			}else{
				$oplossing += $t;
				$tussenstap .= p($t,2);
			}
		}
		return array("opgave"=>$opgave . "=", "oplossing" => $tussenstap ."=".$oplossing);
	}
	
	
}
?>

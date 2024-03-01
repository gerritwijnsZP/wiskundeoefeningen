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
		$a	= nietnul(-12,8);
		if($a > 0){$b 	= nietnul(-12,-$a);} //Negatief resultaat
		else{$b = nietnul(-8,8); } //Om 't even
		
		$mogelijkheden = array(	array("opgave"=> $a.'-('.p($b,2).')'."=", "oplossing"=>$a.p(-$b,2)."=".($a-$b)),
								array("opgave"=> '-('.p($a,2).')+('.p($b,2).')'."=", "oplossing"=>p(-$a,2).p($b,2)."=".(-$a+$b)),
								array("opgave"=> '-('.p($a,2).')+('.p($b,2).')'."=", "oplossing"=>(-$a).p($b,2)."=".(-$a+$b)),
								array("opgave"=> '-('.p($a,2).')-('.p($b,2).')'."=", "oplossing"=>(-$a).p(-$b,2)."=".(-$a-$b)),
							);
		$keuze = $mogelijkheden[rand(0, count($mogelijkheden)-1)];
		$opgave = $keuze["opgave"];
		$oplossing = $opgave . $keuze["oplossing"];
		$stamp		= "$a.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	
	
}
?>

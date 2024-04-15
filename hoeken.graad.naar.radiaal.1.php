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
		$i = random_int(11,12);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$graad 	= rand(1,180);
		$opgave = "$graad ^\circ";
		$oplossing = $opgave;
		$oplossing .= "= ".$graad."^\circ.\\frac{\\pi \\text{ rad}}{180 ^\circ}";
		$ggd = ggd(180, $graad);
		if($graad == $ggd){
			$oplossing .= "= \\frac{ \\pi }{".(180/$ggd)."} \\text{rad}";
		}else{
			$oplossing .= "= \\frac{".($graad/$ggd)." \\pi}{".(180/$ggd)."} \\text{rad}";
		}
		$stamp		= "$graad";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);

	}
	private function oef12()
	{
		$graad = rand(1,30);
		$minutenlijst = array(20=>"\\frac{1}{3}",30=>"\\frac{1}{2}",40=>"\\frac{2}{3}");
		$minuten = array(20,30,40)[rand(0,2)];
		$opgave = "$graad ^\circ $minuten'";
		$oplossing = $opgave;
		$oplossing .= "= \\left( $graad + ". $minutenlijst[$minuten] ." \\right)^\circ" ;
		$noemer = 1;
		if($minuten == 20){$graad = 3*$graad + 1;$noemer = 3;}
		elseif($minuten == 30){$graad = 2*$graad + 1;$noemer = 2;}
		elseif($minuten == 40){$graad = 3*$graad + 2;$noemer = 3;}
		$oplossing .= "= \\frac{".$graad."}{$noemer}^\circ.\\frac{\\pi \\text{ rad}}{180 ^\circ}";
		$noemer *= 180;
		$ggd = ggd($noemer, $graad);
		if($graad == $ggd){
			$oplossing .= "= \\frac{ \\pi }{".($noemer/$ggd)."} \\text{rad}";
		}else{
			$oplossing .= "= \\frac{".($graad/$ggd)." \\pi}{".($noemer/$ggd)."} \\text{rad}";
		}
		$stamp		= "$graad.$minuten";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

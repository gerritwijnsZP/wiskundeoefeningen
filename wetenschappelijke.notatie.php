<?php
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once("class.oefening.php");
require_once("class.math.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,13);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$getal 	= rand(-9999,9999);
		$macht	= floor(log10(abs($getal)));
		$start	= (double) $getal / pow(10,$macht);
		$duw	= rand(2,6)*pow(-1,rand(0,1));
		$result	= $start*pow(10,$duw);
		if($duw < -4){$result = number_format($result,$macht-$duw);}
		$result = puntkomma($result);
		$opgave 	= "\\text{Schrijf }".$result."\\text{ in wetenschappelijke notatie}";
		$oplossing	= $result;
		$oplossing 	.= '=' .puntkomma($start).".10^{".($duw)."}";
		$stamp		= '11.'.$getal;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		$getal 	= rand(-9999,9999);
		$macht	= floor(log10(abs($getal)));
		$start	= (double) $getal / pow(10,$macht);
		$duw	= rand(2,6)*pow(-1,rand(0,1));
		$result	= $start*pow(10,$duw);
		if($duw < -4){$result = number_format($result,$macht-$duw);}
		$result = puntkomma($result);
		$opgave 	= "\\text{Schrijf }".puntkomma($start).".10^{".($duw)."} \\text{ als een decimaal getal}";
		$oplossing	= puntkomma($start).".10^{".($duw)."}";
		$oplossing 	.= '=' .$result;
		$stamp		= '12.'.$getal;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{
		$getal 	= rand(-9999,9999);
		$macht	= floor(log10(abs($getal)));
		$start	= (double) $getal / pow(10,$macht);
		$duw	= rand(2,6)*pow(-1,rand(0,1));
		$extra	= rand(2,6)*pow(-1,rand(0,1));
		$result	= $start*pow(10,$duw);
		if($duw < -4){$result = number_format($result,$macht-$duw);}
		$result = puntkomma($result);
		$opgave 	= "\\text{Schrijf }".$result.".10^{".$extra."}\\text{ in wetenschappelijke notatie}";
		$oplossing	= $result.".10^{".$extra."}";
		$oplossing 	.= '=' .puntkomma($start).".10^{".($duw)."}.10^{".$extra."}";
		$oplossing 	.= '=' .puntkomma($start).".10^{".($duw+$extra)."}";
		$stamp		= '13.'.$getal;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}

?>

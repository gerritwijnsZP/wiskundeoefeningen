<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

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
		//Omtrek
		$l			= nietnul(2,20);
		$b			= nietnul(2,20);
		$zinnen		= array(
						array(	"zin"		=>"De leerkracht LO bakent een rechthoekig gebied af met lengte #l m en breedte #b m en bedekt het met een zeil. Hoeveel meter is één rondje rond dit gebied?",
								"eenheid"	=>"m"),
						array(	"zin"		=>"Je kleurt de rand van een strook papier met lengte #l cm en breedte #b cm. Hoeveel centimeter moet je kleuren?",
								"eenheid"	=>"cm"),
						array(	"zin"		=>"Je bakent met een touw een rechthoekig gebied af met lengte #l m en breedte #b m. Hoe lang moet je touw minstens zijn?",
								"eenheid"	=>"m"),
						array(	"zin"		=>"Je verzaagt een lange plank tot een kader voor een poster met lengte #l dm en breedte #b dm. Hoe lang moet de plank minstens zijn?",
								"eenheid"	=>"dm"),
						array(	"zin"		=>"Je versiert een foto met lengte #l cm en breedte #b cm met een felkleurig lint. Hoe lang moet je lint minstens zijn?",
								"eenheid"	=>"cm"),
					);
		$item		= $zinnen[random_int(0, count($zinnen)-1)];
		$zin		= strReplaceAssoc(array("#l"=>$l,"#b"=>$b), $item["zin"]);
		$e			= $item["eenheid"];
		$opgave		= "\\)".$zin."\\(";
		$r			= 2*($l+$b);
		$oplossing	= "2 \\times (".$l."\\text{ ".$e."}+".$b."\\text{ ".$e."})=".$r."\\text{ ".$e."}";
		$stamp		= '11.'.$l.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		//Oppervlakte
		$l			= nietnul(2,20);
		$b			= nietnul(2,20);
		$zinnen		= array(
						array(	"zin"		=>"De leerkracht LO bakent een rechthoekig gebied af met lengte #l m en breedte #b m en bedekt het met een zeil. Hoe groot is dit zeil?",
								"eenheid"	=>"m"),
						array(	"zin"		=>"Je verft een rechthoekig plankje met lengte #l cm en breedte #b cm. Hoe groot is het beschilderde oppervlak?",
								"eenheid"	=>"cm"),
						array(	"zin"		=>"Je bakent met een touw een rechthoekig gebied af met lengte #l m en breedte #b m. Hoe groot is dat gebied?",
								"eenheid"	=>"m"),
						array(	"zin"		=>"Je verzaagt een lange plank tot een kader voor een poster met lengte #l dm en breedte #b dm. Hoe groot is die poster?",
								"eenheid"	=>"dm"),
						array(	"zin"		=>"Je versiert een foto met lengte #l cm en breedte #b cm met een felkleurig lint. Hoe groot is die foto?",
								"eenheid"	=>"cm"),
					);
		$item		= $zinnen[random_int(0, count($zinnen)-1)];
		$zin		= strReplaceAssoc(array("#l"=>$l,"#b"=>$b), $item["zin"]);
		$e			= $item["eenheid"];
		$opgave		= "\)".$zin."\(";
		$r			= $l*$b;
		$oplossing	= $l."\\text{ ".$e."}\\times".$b."\\text{ ".$e."}=".$r."\\text{ ".$e."}^2";
		$stamp		= '12.'.$l.$b;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

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
		/*
		 *In een bedrijf met #totaal werknemers zijn er #breuk mannen. Hiervan zijn er #breuk2 die minstens 3 talen spreken. 
		 *Hoeveel mannen die minstens 3 talen spreken zijn er?
		 *In een school met #totaal leerlingen zijn er #breuk meisjes. Hiervan zijn er #breuk2 die eten van thuis meenemen. 
		 *Hoeveel meisjes die eten van thuis meenemen zijn er?
		 *In een doos met #totaal snoepgoed zijn er #breuk gele snoepjes. Hiervan zijn er #breuk2 die rond zijn.
		 *Hoeveel gele snoepjes die rond zijn zijn er?
		 *In een #container met #totaal #items zijn er #breuk #kenmerk1. Hiervan zijn er #breuk2 die #kenmerk2 .
		 *Hoeveel #kenmerk1 die #kenmerk2 zijn er?
		 */
		$n1		= nietnul(3,10);
		$t1		= nietnul(1,$n1-1);
		
		$n2		= nietnul(3,10);
		$t2		= nietnul(1,$n2-1);
		
		$f		= nietnul(3,10);
		$totaal	= $f * $n1 * $n2;
		
		$sjabloon	= "In een #container met #totaal #items zijn #breuk1 van de #items #kenmerk1. Hiervan zijn er #breuk2 die #kenmerk2. Hoeveel #kenmerk1 die #kenmerk2 zijn er?";
		$data		= array(
						array(	"container"	=>"bedrijf",
								"items"		=>"werknemers",
								"kenmerk1"	=>array("mannen","vrouwen"),
								"kenmerk2"	=>array("minstens 3 talen spreken","minstens 2 kinderen hebben"),
						),
						array(	"container"	=>"school",
								"items"		=>"leerlingen",
								"kenmerk1"	=>array("jongens","meisjes"),
								"kenmerk2"	=>array("eten van thuis meenemen","met de fiets naar school komen"),
						),
						array(	"container"	=>"doos",
								"items"		=>"stukken snoepgoed",
								"kenmerk1"	=>array("gele snoepjes","koekjes"),
								"kenmerk2"	=>array("een ronde vorm hebben","een vierkante vorm hebben"),
						),
						array(	"container"	=>"vrachtwagen",
								"items"		=>"dozen",
								"kenmerk1"	=>array("kartonnen doosjes","metalen doosjes"),
								"kenmerk2"	=>array("gedeukt zijn","gebarsten zijn"),
						),
						array(	"container"	=>"doos",
								"items"		=>"prullen",
								"kenmerk1"	=>array("sleutelhangers","polsbandjes"),
								"kenmerk2"	=>array("fluoriscerend zijn","lekker ruiken"),
						),
					);
		
		$item		= $data[random_int(0, count($data)-1)];
		$info		= array(
								"#container"	=> 	$item["container"],
								"#items"		=>	$item["items"],
								"#kenmerk1"		=>	$item["kenmerk1"][random_int(0, count($item["kenmerk1"])-1)],
								"#kenmerk2"		=>	$item["kenmerk2"][random_int(0, count($item["kenmerk2"])-1)],
								"#totaal"		=>	$totaal,
								"#breuk1"		=>	"\(\\frac{".$t1."}{".$n1."}\)",
								"#breuk2"		=>	"\(\\frac{".$t2."}{".$n2."}\)",
								);
		$zin		= strReplaceAssoc($info, $sjabloon);
		$opgave		= "\\)".$zin."\\(";
		$r			= $t1*$t2*$totaal/$n1/$n2;
		$oplossing	= "\\frac{".$t1."}{".$n1."}\\times\\frac{".$t2."}{".$n2."}\\times ".$totaal."=".$r."\\text{ ".$info["#kenmerk1"]." die ".$info["#kenmerk2"]."}"; 
		$stamp		= '11.'.$n1.$n2;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

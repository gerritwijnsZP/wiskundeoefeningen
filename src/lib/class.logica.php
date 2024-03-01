<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
require_once(LIB . "class.helper.php");//ntt(..)
function pwaarde($waarde) //Print
{
	if($waarde || $waarde == 1)
	{
		return 1;
	}else{
		return 0;
	}
}
class Propositie
{
	public $zin;
	public $waarde;
	public $pos;
	public $neg;
	public function __construct($zin, $waarde, $posreplace, $negreplace)
	{
		$this->zin = $zin;
		$this->waarde = pwaarde($waarde);
		$this->pos = $posreplace;
		$this->neg = $negreplace;
	}
	public function zin($waarde)
	{
		if($waarde)
		{
			return $this->ware_zin();
		}else{
			return $this->valse_zin();
		}
	}
	private function ware_zin()
	{
		if($this->waarde)
		{
			return str_replace("##", $this->pos, $this->zin);
		}else{
			return str_replace("##", $this->neg, $this->zin);	
		}
	}
	private function valse_zin()
	{
		if($this->waarde)
		{
			return str_replace("##", $this->neg, $this->zin);
		}else{
			return str_replace("##", $this->pos, $this->zin);	
		}
	}
	public function waarde($waarde)
	{
		return $waarde;
	}
	/*
	public function pwaarde($waarde) //Print
	{
		if($waarde)
		{
			pwaarde($this->waarde);
		}else{
			pwaarde(!$this->waarde);
		}
	}
	*/
}
class Combo
{
	public $lijst;
	public function __construct()
	{
		$this->lijst = array();
	}
	public function push($letter, $propositie)
	{
		array_push($this->lijst, array("letter"=>$letter, "propositie"=>$propositie));
	}
	public function opgave($type, $switch)
	{
		$txt = "\\textbf{Gegeven} \\\\ \\begin{array}{r|l}";
		for($i=0; $i < count($this->lijst); $i++)
		{
			$txt .= $this->lijst[$i]["letter"] . " & \\text{ " .$this->lijst[$i]["propositie"]->zin($switch[$i]) . " }\\\\";
		}
		$txt .="\\end{array} \\\\ \\textbf{Gevraagd} \\\\";
		$txt .= $this->print_latex($type);
		return $txt;
	}
	public function print_latex($type)
	{
		if($type == "notp")
		{
			return "\\neg ".$this->lijst[0]["letter"];
		}elseif($type == "penq")
		{
			return $this->lijst[0]["letter"]. "\\land ".$this->lijst[1]["letter"];
		}elseif($type == "pofq")
		{
			return $this->lijst[0]["letter"]. "\\lor ".$this->lijst[1]["letter"];
		}elseif($type == "p=>q")
		{
			return $this->lijst[0]["letter"]. "\\implies ".$this->lijst[1]["letter"];
		}elseif($type == "pxorq")
		{
			return $this->lijst[0]["letter"]. "\\oplus ".$this->lijst[1]["letter"];
		}
	}
	public function print_tekst($type, $switch)
	{
		if($type == "notp")
		{
			return "\\text{ ". $this->lijst[0]["propositie"]->zin(!$switch[0])." }";
		}elseif($type == "penq")
		{
			return "\\text{ ". $this->lijst[0]["propositie"]->zin($switch[0])." en ".$this->lijst[1]["propositie"]->zin($switch[1])." }";
		}elseif($type == "pofq")
		{
			return "\\text{ ". $this->lijst[0]["propositie"]->zin($switch[0])." of ".$this->lijst[1]["propositie"]->zin($switch[1])." }";
		}elseif($type == "p=>q")
		{
			return "\\text{ als geldt '". $this->lijst[0]["propositie"]->zin($switch[0])."', dan geldt '".$this->lijst[1]["propositie"]->zin($switch[1])."' }";
		}elseif($type == "pxorq")
		{
			return "\\text{ ofwel geldt '". $this->lijst[0]["propositie"]->zin($switch[0])."', ofwel geldt '".$this->lijst[1]["propositie"]->zin($switch[1])."' }";
		}
	}
	public function print_resultaat($type, $switch)
	{
		if($type == "notp")
		{
			return pwaarde(!$switch[0]);
		}elseif($type == "penq")
		{
			return pwaarde(
						$switch[0] && $switch[1]
					);
		}elseif($type == "pofq")
		{
			return pwaarde(
						$switch[0] || $switch[1]
					);
		}elseif($type == "p=>q")
		{
			return pwaarde(
						(!$switch[0]) || $switch[1]
					);
		}elseif($type == "pxorq")
		{
			return pwaarde(
						($switch[0] || $switch[1]) && (!($switch[0] && $switch[1]))
					);
		} 
	}
	public function oplossing($type, $switch)
	{
		$txt = $this->tabel($type, $switch) . "\\\\";
		$txt .= "\\begin{array}{r|l} ".$this->print_latex($type)." & ".$this->print_tekst($type, $switch)."\\end{array}";
		return $txt;
	}
	public function tabel($type, $switch)
	{
		$label = "";
		$titelrij = "";
		$waarderij = "";
		for($i=0; $i < count($this->lijst)+1; $i++)
		{
			if($i < count($this->lijst))
			{
				$label 		.= "r";
				$titelrij	.= $this->lijst[$i]["letter"]." & ";
				$waarderij	.= pwaarde($switch[$i])." & ";
			}else{
				$label  	.= "|r";
				$titelrij	.= $this->print_latex($type)." \\\\ ";
				$waarderij	.= $this->print_resultaat($type, $switch)." \\\\ ";
			}
		}
		$txt = "\\begin{array}{".$label."}";
		$txt .=$titelrij . "\\hline";
		$txt .= $waarderij;
		$txt .= "\\end{array}";
		//print_r($this->lijst); print_r($type); print_r($switch);
		return $txt;
	}
}
class Boek
{
	public $lijst;
	public function __construct()
	{
		$this->lijst = array();
		$this->load();
	}
	public function push($zin, $waarde, $pos, $neg)
	{
		array_push($this->lijst, array("zin"=>$zin, "waarde"=>$waarde, "pos"=>$pos, "neg"=>$neg));
	}
	public function get()
	{
		$i = random_int(0, count($this->lijst)-1);
		$p = new Propositie($this->lijst[$i]["zin"], $this->lijst[$i]["waarde"], $this->lijst[$i]["pos"], $this->lijst[$i]["neg"]);
		return array("stamp"=>$i, "propositie"=>$p);
	}
	public function load()
	{ 
		//Wiskunde
		$a = nietnul(2,20);
		$b = nietnul(2,20);
		$c = nietnul(2,20);
		$r = random_int(0,1);
		$this->push("".(nietnul(2,4)*$a-$r). " is ## veelvoud van ".$a, 1-$r, "een", "geen");
		$this->push("de absolute waarde van ".(-$a). " is ## ".$a, True, "gelijk aan", "verschillend van");
		$this->push("de absolute waarde van ".$a. " is ## ".(-$a), False, "gelijk aan", "verschillend van");
		$this->push((-$a)." is ## ".(-$b), (-$a) > (-$b), "groter dan", "kleiner dan of gelijk aan");
		$this->push((-$a)." is ## ".(-$b), (-$a) < (-$b), "kleiner dan", "groter dan of gelijk aan");
		//Algemeen
		//Steden
		$steden = array(array("Stad"=>"Brussel", "Land"=>"België"), 
						array("Stad"=>"Amsterdam", "Land"=>"Nederland"), 
						array("Stad"=>"Parijs", "Land"=>"Frankrijk"),
						array("Stad"=>"Berlijn", "Land"=>"Duitsland"),
						array("Stad"=>"Kopenhagen", "Land"=>"Denemarken"),
						array("Stad"=>"Brugge", "Land"=>"West-Vlaanderen"),
						array("Stad"=>"Gent", "Land"=>"Oost-Vlaanderen"),
						array("Stad"=>"Dublin", "Land"=>"Ierland"),
						array("Stad"=>"Rome","Land"=>"Itali&euml;"),
						array("Stad"=>"Belgrado", "Land"=>"Servi&euml;"),
						);
		for($i=0; $i < count($steden)-1; $i++)
		{
			$r = random_int(0,count($steden)-1);
			random_int(0,2)==1 ? $s = $i : $s = $r;
			if(random_int(0,1)==1)
			{
				$this->push("de hoofdstad van ".$steden[$i]["Land"]." is ##".$steden[$s]["Stad"], (int) $i==$s, "", "niet ");
			}else{
				$this->push($steden[$s]["Stad"]." is ##de hoofdstad van ".$steden[$i]["Land"], (int) $i==$s, "", "niet ");
			}
		}
		//Dieren
		$dieren = array(array("naam"=>"mier", "poten"=>6, "type"=>"insect"), 
						array("naam"=>"kip","poten"=>2, "type"=>"vogel"), 
						array("naam"=>"hond","poten"=>4, "type"=>"zoogdier"), 
						array("naam"=>"spin","poten"=>8, "type"=>"spinachtige"),
						array("naam"=>"dolfijn", "poten"=>0, "type"=>"zoogdier"),
						array("naam"=>"slang", "poten"=>0, "type"=>"reptiel"),
					);
		//Dieren
		for($i=0; $i < count($dieren)-1;$i++)
		{
			$r = random_int(0,count($dieren)-1);
			random_int(0,2)==1 ? $s = $i : $s = $r;
			$n = random_int(2,8);
			if(random_int(0,1)==0)
			{
				$this->push("een ".$dieren[$i]["naam"]." heeft ## ".ntt($n)." poten", $dieren[$i]["poten"] > $n, "meer dan", "hoogstens");
			}else{
				$this->push("een ".$dieren[$i]["naam"]." heeft ## ".ntt($n)." poten", $dieren[$i]["poten"] < $n, "minder dan", "minstens");
			}
			$this->push("een ".$dieren[$i]["naam"]." is ## ".$dieren[$s]["type"], $dieren[$i]["type"] == $dieren[$s]["type"], "een", "geen");
		}
		//Leerlingen
		$leerlingen = array(array("naam"=>"Amina", "geslacht"=>"meisje"),
							array("naam"=>"Bram", "geslacht"=>"jongen"),
							array("naam"=>"Julie", "geslacht"=>"meisje"),
							array("naam"=>"Bilal", "geslacht"=>"jongen"),
						);
		//Leerlingen
		for($i=0; $i < count($leerlingen)-1;$i++)
		{
			$r = random_int(0,count($leerlingen)-1);
			random_int(0,2)==1 ? $s = $i : $s = $r;
			$this->push($leerlingen[$i]["naam"]." is ## ".$leerlingen[$s]["geslacht"], $leerlingen[$i]["geslacht"] == $leerlingen[$s]["geslacht"], "een", "geen");
		}
		//Eten
		$eten = array(	array("naam"=>"blad spinazie", "type"=>"groente", "kleur"=>"groen"),
						array("naam"=>"banaan", "type"=>"stuk fruit", "kleur"=>"geel"),
						array("naam"=>"biefstuk", "type"=>"vlees","kleur"=>"rood"),
						array("naam"=>"cola", "type"=>"drank", "kleur"=>"zwart"),
					);
		//Eten
		for($i=0; $i < count($eten)-1; $i++)
		{
			$q = random_int(0,count($leerlingen)-1);
			$r = random_int(0,count($leerlingen)-1);
			random_int(0,2)==1 ? $s = $i : $s = $r;
			random_int(0,2)==1 ? $t = $i : $t = $q;
			$this->push("een ".$eten[$i]["naam"]." is ## ".$eten[$s]["type"], $eten[$i]["type"] == $eten[$s]["type"], "een", "geen");
			$this->push("een ".$eten[$i]["naam"]." is ##".$eten[$t]["kleur"], $eten[$i]["kleur"] == $eten[$t]["kleur"], "", "niet ");
		}
	}
}

?>

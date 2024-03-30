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
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		/*
			Jef beweegt zich voort aan een constante snelheid van ... voor een duur van ...
		*/
		$v1	= nietnul(1,50);//m/s
		$v0 = $v1*3.6; //km/h
		$t1 = nietnul(10, 7*60)*9; //s
		$t0 = $t1 / 3600.0; //h
		$s0 = $v0 * $t0;
		$s1 = $v1 * $t1;
		$s0 = str_replace('.',',',"".$s0);
		$t0 = str_replace('.',',',"".$t0);
		$v0 = str_replace('.',',',"".$v0);
		
		$personen = array('Amal','Ilias','Sofiane','Zo&euml;','Laura','Kaoutar','Noah','Wietse');
		$vragen = array('s'=>"##persoon## rijdt aan een constante snelheid van ##v## voor een duur van ##t##. Hoe ver rijdt ##persoon##?",
						'v'=>"##persoon## legde een afstand van ##s## af in ##t##. Hoe snel reed ##persoon##?",
						't'=>"##persoon## legde een afstand van ##s## af aan een constante snelheid van ##v##. Hoe lang deed ##persoon## hier over?");
		$vraagk		= array('s','v','t')[random_int(0,2)];
		$vk = random_int(0,1);$sk = random_int(0,1);$tk = random_int(0,1);
		$vraag		= $vragen[$vraagk];
		$persoon 	= $personen[random_int(0,count($personen)-1)];
		$v			= array($v0." km/h ", $v1." m/s")[$vk];
		$s			= array($s0." km ", $s1." m")[$sk];
		$t			= array($t0." h ", $t1." s")[$tk];
		
		$vraag		= str_replace(array("##persoon##","##v##","##s##","##t##"), array($persoon, $v, $s, $t), $vraag);

		$opgave 	= "\\)$vraag\\(";
		
		$zelfde_eenheid = (($vraagk == 's') && ($vk == $tk)) || (($vraagk == 't') && ($vk == $sk)) || (($vraagk == 'v') && ($sk == $tk));
		$geggevr 	= array(	's'=>"v&=$v  \\\\ t&=$t \\\\ s&=? \\\\", 
								't'=>"s&=$s \\\\ v&=$v \\\\ t&=? \\\\", 
								'v'=>"s&=$s \\\\ t&=$t \\\\ v&=? \\\\");
		$oplossing 	= "\\begin{align}----&---- \\\\". $geggevr[$vraagk];
		
		if(($vraagk != 's') && ($sk == 1))
		{ 
			if(!$zelfde_eenheid)
			{
				$oplossing .= "s &= $s \\rightarrow s = $s0 km \\\\"; 
				$s = $s1." km";
				$k = 0;
				$s2 = $s0; $v2 = $v0; $t2 = $t0;
			}else{
				$k = 1;
				$s2 = $s1; $v2 = $v1; $t2 = $t1;
			}
		}elseif(($vraagk != 's') && ($sk == 0))
		{ 
			if(!$zelfde_eenheid)
			{
				$oplossing .= "s &= $s \\rightarrow s = $s1 m \\\\"; 
				$s = $s1." m"; 
				$k = 1;
				$s2 = $s1; $v2 = $v1; $t2 = $t1;
			}else{
				$k = 0;
				$s2 = $s0; $v2 = $v0; $t2 = $t0;
			}
		}
		elseif(($vraagk != 'v') && ($vk == 0))
		{
			if(!$zelfde_eenheid)
			{
				$oplossing .= "v &= $v \\rightarrow v = $v1 m/s \\\\"; 
				$v = $v1." m/s"; 
				$k = 1;
				$s2 = $s1; $v2 = $v1; $t2 = $t1;
			}else{
				$k = 0;
				$s2 = $s0; $v2 = $v0; $t2 = $t0;
			}
		}elseif(($vraagk != 'v') && ($vk == 1))
		{
			if(!$zelfde_eenheid)
			{
				$oplossing .= "v &= $v \\rightarrow v = $v0 km/h \\\\"; 
				$v = $v0." km/h"; 
				$k = 0;
				$s2 = $s0; $v2 = $v0; $t2 = $t0;
			}else{
				$k = 1;
				$s2 = $s1; $v2 = $v1; $t2 = $t1;
			}
		}else{
			$oplossing .= "dju";
		}
	
		$eenheid	= array('s'=> array('km','m'),
							't'=> array('h','s'),
							'v'=>array('km/h','m/s'));
		$formule	= array(	's'=>"s &= v . t \\\\ 
										\\Leftrightarrow s &= $v2 . $t2 ".$eenheid[$vraagk][$k]." \\\\
										\\Leftrightarrow s &= $s2".$eenheid[$vraagk][$k],
								'v'=>"v &= \\frac{s}{t} \\\\ 
										\\Leftrightarrow v &= \\frac{".$s2."}{".$t2."} ".$eenheid[$vraagk][$k]." \\\\
										\\Leftrightarrow v &= $v2".$eenheid[$vraagk][$k],
								't'=>"t &= \\frac{s}{v} \\\\ 
										\\Leftrightarrow t &= \\frac{".$s2."}{".$v2."} ".$eenheid[$vraagk][$k]." \\\\
										\\Leftrightarrow t &= $t2".$eenheid[$vraagk][$k]
							);
		$oplossing .= $formule[$vraagk];
		$oplossing .= "\\end{align}";		
		$stamp		= "11.$v1$t1";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>

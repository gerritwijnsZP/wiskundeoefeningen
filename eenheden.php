<?php
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.rational.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$voorvoegsels = array("m","c","d","","da","h","k");
		$eenheden = array("g","l","m");
		$a = array(1,1,2,3)[rand(0,3)];
		if($a == 1)	{	$e = $eenheden[rand(0, count($eenheden)-1)]; 	}
		else		{	$e = "m^".$a; }
		$waarde = rand(100,999);
		$wm		= rand(-4,4);
		$tien	= nietnul(-10,10);
		$m = rand(0, count($voorvoegsels)-1);
		while(True)
		{
			$n = rand(0, count($voorvoegsels)-1);
			if ($m != $n){ break;}
		}
		$antwoord = $waarde * pow(10, ($m-$n)*$a);
		$opgave = "\\text{Zet }".puntkomma($waarde/pow(10, $wm))."\cdot 10^{".$tien."}\\text{ }".$voorvoegsels[$m].$e."\\text{ om in }".$voorvoegsels[$n].$e;
		if($wm != 2)
		{
			$oplossing = "\\color{red}{".puntkomma($waarde/pow(10, $wm))."}.10^{".$tien."}\\text{ }".$voorvoegsels[$m].$e;
			$oplossing .= "\\)<br/>\\(".
						  "=\\color{red}{".puntkomma($waarde/100).".10^{".(-$wm +2)."}}.10^{".($tien)."}\\text{ }".$voorvoegsels[$m].$e;
			$oplossing .= "=\\color{red}{".puntkomma($waarde/100).".10^{".($tien-$wm +2)."}}\\text{ }\\color{blue}{".$voorvoegsels[$m].$e."}";
		}else{
			$oplossing = "\\color{red}{".puntkomma($waarde/pow(10, $wm)).".10^{".$tien."}}\\text{ }\\color{blue}{".$voorvoegsels[$m].$e."}";
		}
		$waarde /= 100;
		$tien = $tien - $wm + 2;
		$oplossing .= 	"\\)&nbsp;&nbsp;&nbsp;<i style=\"color:red;\">(Wetenschappelijke notatie)</i><br/>\\(".
						"=".puntkomma($waarde).".10^{".$tien."}.\\color{blue}{10^{".(($m-$n)*$a)."}\\text{ }".$voorvoegsels[$n].$e."}";
		$oplossing .= 	"=".puntkomma($waarde).".10^{".($tien+(($m-$n)*$a))."}\\text{ }".$voorvoegsels[$n].$e.
						"\\)&nbsp;&nbsp;&nbsp;<i style=\"color:blue;\">(Eenheden omzetten)</i>\\(";
		$stamp = "ee".$a.$m.$n.$e;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
/*****python
voorvoegsels = ['m','c','d','','da','h','k']
eenheden = ['g','l','m']

from random import randint
def run():
    #Heeft de eenheid een macht? Bepaal dit random.
    a = [1,1,2,3][randint(0,3)]
    if a == 1:
        #Kies random uit g, l en m 
        e = eenheden[randint(0,len(eenheden)-1)]
    else:
        #*m^2 of *m^3
        e = "m^%s" % a
    #Kies een willekeurig getal tussen 1 en 1000 als waarde
    waarde = randint(1,1000)
    #Kies een willekeurig voorvoegsel m en n (verschillend)
    m = randint(0, len(voorvoegsels)-1)
    while True:
        n = randint(0, len(voorvoegsels)-1)
        if n != m:
            break
    #Bereken het antwoord
    antwoord = str(waarde * 10. ** ((m - n)*a))
    print str(
            "Zet %s %s%s om in %s%s;%s" % (waarde,
                                      voorvoegsels[m],
                                      e,
                                      voorvoegsels[n],
                                      e,
                                      antwoord)
            )

for i in range(200):
    run()

*/
?>

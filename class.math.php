<?php 
function puntkomma($a)
{
	$x = (string) $a;
	return str_replace('.','{,}',$x);
}
/*
function p($getal, $first=0)
{
	//Begin
	if($getal == 1 and $first == 1){ return "";}
	//Midden
	elseif($getal == 1 and $first == 0){ return "+";}
	elseif($getal == -1 and $first < 2){ return "-";}
	elseif($getal > 0 and $first == 0){ return "+".$getal;}
	//Einde
	elseif($getal > 0 and $first == 2){ return "+".$getal;}
	else{ return $getal;}
}
*/
function ggd($a, $b) 
{ 
    // Everything divides 0 
    if($b==0)
    { 
        return $a ; 
	}
    return ggd( $b , $a % $b ) ; 
} 
function kgv($a, $b)
{
	return $a * $b / ggd($a, $b);
}
function copriem($a, $van=2, $tot=20)
{
	if(abs($a)==1)
	{ return random_int($van,$tot);	} //Onmogelijke shit
	$teller = 0;
	$low 	= min($van,$tot);
	$diff 	= abs($tot - $van);
	$lucky	= random_int(0,$diff);
	for($i=0;$i<$diff;$i++)
	{
		$b = $low + (($lucky + $i) % $diff);
		if(ggd($a,$b)==1)
		{
			break;
		}
	}
	return $b;
	//throw new Exception('onmogelijke aanvraag copriem');
	/*
	while(True)
	{
		$teller++;
		$b = random_int($van, $tot);
		if(($teller == 10) and (abs($a) < $tot - 1)){$b = abs($a)+1;}
		if(($teller == 11) and (abs($b) > $van + 1)){$b = abs($a)-1;}
		if($b==0){ continue; }
		if(ggd($a,$b)==1)
		{
			break;
		}
		$teller++;
		$b = ($b + 1) % $tot;
		if($teller > 20){throw new Exception('onmogelijke aanvraag copriem');}
	}
	return $b;
	*/
}

function nietnulcopriem($a, $van = 2, $tot = 20)
{
	if(abs($a)==1)
	{ return random_int($van,$tot);	} //Onmogelijke shit
	$teller = 0;
	$low 	= min($van,$tot);
	$diff 	= abs($tot - $van);
	$lucky	= random_int(0,$diff);
	for($i=0;$i<$diff;$i++)
	{
		$b = $low + (($lucky + $i) % $diff);
		if($b == 0){continue;}
		if(ggd($a,$b)==1)
		{
			break;
		}
	}
	return $b;
	/*
	if(abs($a)==1)
	{ return random_int($van,$tot);	} //Onmogelijke shit
	$teller = 0;
	while(True)
	{
		$teller++;
		if($teller < 3){$b = copriem(abs($a), $van, $tot);}
		if(($teller == 4) and (abs($a) < $tot - 1)){$b = abs($a)+1;}
		if(($teller == 5) and (abs($b) > $van + 1)){$b = abs($a)-1;}
		if($b != 0){ break; }
		if($teller > 20){throw new Exception('onmogelijke aanvraag nietnulcopriem');}
	}
	return $b;
	*/
}
function onvolkomen()
{
	$mogelijkheden = array(-6,-5,-3,-2,-1,1,2,3,5,6);
	$i = random_int(0, count($mogelijkheden)-1);
	return $mogelijkheden[$i];
}
function nietnul($van=2, $tot=20)
{
	$teller = 0;
	while(True)
	{
		$teller++;
		$a = random_int($van, $tot);
		if($a!=0){break;}
		if($teller > 20){throw new Exception('onmogelijke aanvraag nietnul');}
	}
	return $a;
}
function nietgetal($van=2, $tot=20, $diff=array(0))
{
	$teller = 0;
	while(True)
	{
		$teller++;
		$a = random_int($van, $tot);
		if(!in_array($a, $diff)){break;}
		if($teller > 20){throw new Exception('onmogelijke aanvraag nietgetal');}
	}
	return $a;
}
function randonbekende($not = array())
{
	$letters = array_diff(array('a','b','p','q','s','x','y'), $not);
	$i 		= array_rand($letters);
	return $letters[$i];
}
function randdelerpaar($getal)
{
	$factoren = array(2,3,4,5,6,7,8,9,10,11,13,17,19,23);
	$res = array(array(1,$getal));
	foreach($factoren as $factor)
	{
		if($factor >= $getal){ break; }
		if(intdiv($getal,$factor)==$getal/$factor){ array_push($res, array($factor, $getal/$factor)); }
	}
	return $res[rand(0,count($res)-1)];
}
//https://stackoverflow.com/questions/22316348/converting-degree-minutes-seconds-dms-to-decimal-in-php
function DMStoDD($deg,$min,$sec)
{

    // Converting DMS ( Degrees / minutes / seconds ) to decimal format
    return $deg+((($min*60)+($sec))/3600);
}    

function DDtoDMS($dec)
{
    // Converts decimal format to DMS ( Degrees / minutes / seconds ) 
    $vars = explode(".",$dec);
    $deg = $vars[0];
    $min = 0;
    $sec = 0;
    if(count($vars) > 1)
    {
		$tempma = "0.".$vars[1];

		$tempma = $tempma * 3600;
		$min = floor($tempma / 60);
		$sec = $tempma - ($min*60);
	}
	if($sec == 0)
	{
		if($min == 0)
		{
			$res = $deg."^\\circ  ";
		}else{
			$res = $deg."^\\circ ".$min."'";
		}
	}else{
		$res = $deg."^\\circ  ".$min."'  ".puntkomma(round($sec,1))."\"";
	}
    return $res;
}    

?>

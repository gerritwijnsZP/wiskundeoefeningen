<?php
//Vergelijkingen en zo
function p($getal, $first=0)
{
	//Begin
	if($getal == 1 and $first == 1){ return "";}
	//Midden
	elseif($getal == 1 and $first == 0){ return "+";}
	elseif($getal == -1 and $first < 2){ return "-";}
//	elseif($getal == 0 and $first == 3){ return "";}   // toegevoegd om nullen niet af te drukken  2023.12.08
	elseif($getal >= 0 and $first == 0){ return "+".$getal;}
	//Einde
	elseif($getal >= 0 and $first == 2){ return "+".$getal;}
	else{ return $getal;}
}
function h($getal)
{
	if($getal < 0)
	{ return "(".$getal.")";}
	else
	{ return $getal; }
}

// Afdrukken getallen
function getalafdruk($getal, $first=0)
{
	//Begin
	switch($first){
		case 0:
			// Getal altijd afdrukken, steeds met teken
			if($getal >= 0){ return "+".$getal;}
			else{ return $getal;}
			break;
		Case 1:
			// getal altijd afdrukken, negatieve getallen met haakjes
			if($getal < 0){ return "(".$getal.")";}
			else{ return $getal;}
			break;
		case 2:
			// Getal altijd afdrukken behalve 0, steeds met teken
			if($getal == 0){ return "";}
			elseif($getal>0) {return "+".$getal;}
			else{ return $getal;}
			break;
		default:
		   return $getal;
	}


}


//Wortelvormen
function vkw($getal)
{
	return "\\sqrt{".$getal."}";
}
function ivkw($getal)
{
	return (int) sqrt($getal);
}
//Print root \\sqrt[$y]{$x} met teller >=0 en noemer > 0 -- rationale machten enz.
function proot($a,$teller,$noemer)
{
	$onder 	= "";
	$wortel	= "##";
	if($teller == 0)
	{
		return "1";
	}elseif($teller == 1)
	{
		$onder = $a;
	}else{
		$onder = $a."^{".$teller."}";
	}
	
	if($noemer == 1)
	{
		$wortel = "##";
	}
	elseif($noemer == 2){
		$wortel = " \\sqrt{ "."##"." } ";
	}
	else{
		$wortel = "\\sqrt[".$noemer."]{ "."##"." }";
	}
	return str_replace("##", $onder, $wortel);
}


//Vraagstukken 1.1
function color($color, $text)
{
	return " \\color{".$color."}{".$text."} ";
}
function ntt($a) //number to text van 1 tot 10
{
	$lijst 	= array(1=>'een', 2=>'twee', 3=>'drie', 4=>'vier', 5=> 'vijf', 6 =>'zes', 7=>'zeven', 8=>'acht', 9=>'negen', 10=>'tien', 11=>'elf', 12=>'twaalf');
	return $lijst[$a];
}
function voud($a) //van 2 tot 10
{
	if($a == 2){ return "dubbel";}
	else{return ntt($a)."voud";}
}
function breuk($a) //van 2 tot 10
{
	if($a == 2){ return "helft";}
	elseif($a==3){ return "derde";}
	elseif($a==8){return ntt($a)."ste";}
	else{ return ntt($a)."de"; }
}
function breuken($a, $b) //drie vijfden $a, $b >= 2
{
	if($a == 1){ return ntt($a) . " " . breuk($b); }
	else{ return ntt($a) . " " . breuk($b) . "n";}
}
//decimaal
function nullen($aantal)
{
	$txt = "";
	for($i=0; $i < $aantal; $i++)
	{
		$txt .= "0";
	}
	return $txt;
}
function mismatched($aantal)
{
	$txt = 0;
	$laatste = 0;
	for($i=0;$i<$aantal;$i++)
	{
		$getal = ($laatste + rand(1,9)) % 10;
		$txt = $txt * 10 + $getal;
		$laatste = $getal;
	}
	return $txt;
}
//Python --neemt een associatieve lijst aan array('L'=>$parameter, 's'=>$variabele) en vervangt in een zin de letters (keys) door de waarden
function strReplaceAssoc(array $replace, $subject) {
   return str_replace(array_keys($replace), array_values($replace), $subject);   
}

?>

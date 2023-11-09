<?php
//if(strpos(__FILE__, 'http:')){die("Fuck off");}
//if(basename(__FILE__)=='library.php'){die("Fuck off -");} 
require_once('db.php');


function print_table($res)
{
	if(count($res) == 0)
	{
		return "";
	}
	$sleutelvelden = array_keys($res[0]);
	$txt = "<table>\n";
	$txt .= "<t<tr><th>".implode("</th><th>",$sleutelvelden)."</th></tr>\n";
	foreach($res as $row)
	{
		$txt .="\t<tr><td>".implode("</td><td>", array_values($row))."</td></tr>\n";
	}
	$txt .= "</table>\n";
	echo $txt;
}

function doe($sql, $type, $data)
{
	try{
		$db = DB::getInstance();$mysqli = $db->getConnection();
		//$sql = "INSERT INTO basta_session_log (session_id, sleutel, waarde, moment) VALUES (?, ?, ?, ?)";
		$stmt = $mysqli->prepare($sql);
		if(count($data)==1){	$stmt->bind_param($type,$data[0]);}
		elseif(count($data)==2){$stmt->bind_param($type,$data[0],$data[1]);}
		elseif(count($data)==3){$stmt->bind_param($type,$data[0],$data[1],$data[2]);}
		elseif(count($data)==4){$stmt->bind_param($type,$data[0],$data[1],$data[2],$data[3]);}
		elseif(count($data)==5){$stmt->bind_param($type,$data[0],$data[1],$data[2],$data[3], $data[4]);}
		elseif(count($data)==6){$stmt->bind_param($type,$data[0],$data[1],$data[2],$data[3], $data[4], $data[5]);}
		elseif(count($data)==7){$stmt->bind_param($type,$data[0],$data[1],$data[2],$data[3], $data[4], $data[5], $data[6]);}
		elseif(count($data)==8){$stmt->bind_param($type,$data[0],$data[1],$data[2],$data[3], $data[4], $data[5], $data[6], $data[7]);}
		elseif(count($data)==9){$stmt->bind_param($type,$data[0],$data[1],$data[2],$data[3], $data[4], $data[5], $data[6], $data[7], $data[8]);}
		elseif(count($data)==10){$stmt->bind_param($type,$data[0],$data[1],$data[2],$data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9]);}
		$res = $stmt->execute();
		$id = $stmt->insert_id;
		$stmt->close();
		return $id;
	}catch(Exception $e ){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

function krijg($sql, $type, $data, $res_fields)
{	//type = "sss" voor drie strings
	//data = array($vraagteken, $nogeenvraagteken) die worden meegegeven met de query
	//res_fields = array("ID", "Bla") die worden geselecteerd
	$res = array();
	try{
		$db = DB::getInstance();$mysqli = $db->getConnection();
		$stmt = $mysqli->prepare($sql);
		if(count($data)==1){	$stmt->bind_param($type,$data[0]);}
		elseif(count($data)==2){$stmt->bind_param($type,$data[0],$data[1]);}
		elseif(count($data)==3){$stmt->bind_param($type,$data[0],$data[1],$data[2]);}
		elseif(count($data)==4){$stmt->bind_param($type,$data[0],$data[1],$data[2],$data[3]);}
		elseif(count($data)==5){$stmt->bind_param($type,$data[0],$data[1],$data[2],$data[3], $data[4]);}
		elseif(count($data)==6){$stmt->bind_param($type,$data[0],$data[1],$data[2],$data[3], $data[4], $data[5]);}
		$resdb = $stmt->execute();
		$a = ""; $b = ""; $c = ""; $d = ""; $e = ""; $f = ""; $g = ""; $h = ""; $i = ""; $j = "";$k="";
		if(count($res_fields)==1){ 	$stmt->bind_result($a); }
		elseif(count($res_fields)==2){ $stmt->bind_result($a, $b); }
		elseif(count($res_fields)==3){ $stmt->bind_result($a, $b, $c); }
		elseif(count($res_fields)==4){ $stmt->bind_result($a, $b, $c, $d); }
		elseif(count($res_fields)==5){ $stmt->bind_result($a, $b, $c, $d, $e); }
		elseif(count($res_fields)==6){ $stmt->bind_result($a, $b, $c, $d, $e, $f); }
		elseif(count($res_fields)==7){ $stmt->bind_result($a, $b, $c, $d, $e, $f, $g); }
		elseif(count($res_fields)==8){ $stmt->bind_result($a, $b, $c, $d, $e, $f, $g, $h); }
		elseif(count($res_fields)==9){ $stmt->bind_result($a, $b, $c, $d, $e, $f, $g, $h, $i); }
		elseif(count($res_fields)==10){$stmt->bind_result($a, $b, $c, $d, $e, $f, $g, $h, $i, $j); }
		elseif(count($res_fields)==11){$stmt->bind_result($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k); }
		//echo "Volgens mij zijn er ".count($res_fields)." velden<br/>";
		$teller = 1;
		while($stmt->fetch())
		{
			//echo "Lus ".$teller."<br/>";$teller+=1;print_r($res);
			if(count($res_fields)==1){ 	array_push($res, array($res_fields[0]=>$a)); }
			elseif(count($res_fields)==2){ array_push($res, array($res_fields[0]=>$a, $res_fields[1]=>$b)); }
			elseif(count($res_fields)==3){ array_push($res, array($res_fields[0]=>$a, $res_fields[1]=>$b, $res_fields[2]=>$c)); }
			elseif(count($res_fields)==4){ array_push($res, array($res_fields[0]=>$a, $res_fields[1]=>$b, $res_fields[2]=>$c, $res_fields[3]=>$d)); }
			elseif(count($res_fields)==5){ array_push($res, array($res_fields[0]=>$a, $res_fields[1]=>$b, $res_fields[2]=>$c, $res_fields[3]=>$d, $res_fields[4]=>$e)); }
			elseif(count($res_fields)==6){ array_push($res, array($res_fields[0]=>$a, $res_fields[1]=>$b, $res_fields[2]=>$c, $res_fields[3]=>$d, 
																	$res_fields[4]=>$e, $res_fields[5]=>$f)); }
			elseif(count($res_fields)==7){ array_push($res, array($res_fields[0]=>$a, $res_fields[1]=>$b, $res_fields[2]=>$c, $res_fields[3]=>$d, 
																	$res_fields[4]=>$e, $res_fields[5]=>$f, $res_fields[6]=>$g)); }
			elseif(count($res_fields)==8){ array_push($res, array($res_fields[0]=>$a, $res_fields[1]=>$b, $res_fields[2]=>$c, $res_fields[3]=>$d, 
																	$res_fields[4]=>$e, $res_fields[5]=>$f, $res_fields[6]=>$g, $res_fields[7]=>$h)); }
			elseif(count($res_fields)==9){ array_push($res, array($res_fields[0]=>$a, $res_fields[1]=>$b, $res_fields[2]=>$c, $res_fields[3]=>$d, 
																	$res_fields[4]=>$e, $res_fields[5]=>$f, $res_fields[6]=>$g, $res_fields[7]=>$h, 
																	$res_fields[8]=>$i )); }
			elseif(count($res_fields)==10){array_push($res, array($res_fields[0]=>$a, $res_fields[1]=>$b, $res_fields[2]=>$c, $res_fields[3]=>$d, 
																	$res_fields[4]=>$e, $res_fields[5]=>$f, $res_fields[6]=>$g, $res_fields[7]=>$h, 
																	$res_fields[8]=>$i, $res_fields[9]=>$j)); }
			elseif(count($res_fields)==11){array_push($res, array($res_fields[0]=>$a, $res_fields[1]=>$b, $res_fields[2]=>$c, $res_fields[3]=>$d, 
																	$res_fields[4]=>$e, $res_fields[5]=>$f, $res_fields[6]=>$g, $res_fields[7]=>$h, 
																	$res_fields[8]=>$i, $res_fields[9]=>$j, $res_fields[10]=>$k)); }
		}
		$stmt->close();
	}catch(Exception $e ){
		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	return $res;
}
function formulier($methode, $actie, $velden, $waarden=array())
{
	$txt = "";
	foreach($velden as $name=>$veld)
	{
		if(!in_array('extra',$veld)){ $veld['extra'] = '';}
		if($veld['type']=='text')
		{
			$txt .= "<input type=\"text\" name=\"$name\" id=\"$name\" placeholder=\"".ucfirst($name)."\"value=\"".$waarden[$name]."\" size=\"".$veld['size']."\" maxlength=\"".$veld['size']."\"".$veld['extra']."/><br/>";
		}
		elseif($veld['type']=='textarea')
		{
			$txt .= "<textarea name=\"$name\" id=\"$name\" ".$veld['extra'].">".$waarden[$name]."</textarea>";
		}
		elseif($veld['type']=='submit')
		{
			$txt .= "<input type=\"submit\" name=\"$name\" id=\"$name\" value=\"".$veld['value']."\" ".$veld['extra']."/>";
		}
		elseif($veld['type']=='hidden')
		{
			$txt .= "<input type=\"hidden\" name=\"$name\" id=\"$name\" value=\"".$waarden[$name]."\" ".$veld['extra']."/>";
		}
		elseif($veld['type']=='select')
		{
			$txt .= "<label for=\"$name\">".ucfirst($name)."</label><select name=\"".$name."[]\" ".$veld['extra'].">"; //multiple is voorbeeld van extra veld
			foreach($veld['value'] as $id => $tekst)
			{
				$selected = "";
				if(in_array($id, $waarden[$name])){ $selected = "selected"; }
				$txt .= "<option value=\"".$id."\" $selected>".$tekst."</option>";
			}
			$txt .= "</select><br/>";
		}
		elseif($veld['type']=='dropdown')
		{
			$txt .= "<label for=\"$name\">".ucfirst($name)."</label><select name=\"".$name."\" ".$veld['extra'].">"; //multiple onmogelijk
			foreach($veld['value'] as $id => $tekst)
			{
				$selected = "";
				if(in_array($id, $waarden[$name])){ $selected = "selected"; }
				$txt .= "<option value=\"".$id."\" $selected>".$tekst."</option>";
			}
			$txt .= "</select><br/>";
		}
		elseif($veld['type']=='date')
		{
			if($waarden[$name])
			{
				$vandaag = $waarden[$name];
			}else{
				$vandaag = date("Y-m-d");
			}
			$huidige_maand = (int) date("n");
			$huidig_jaar = (int) date("Y");
			if($huidige_maand < 8)
			{
				$min = ($huidig_jaar - 1)."-08-01";
				$max = ($huidig_jaar)."-07-31";
			}
			else
			{
				$min = ($huidig_jaar)."-08-01";
				$max = ($huidig_jaar + 1)."-07-31";	
			}
			$txt .= "<label for=\"$name\">".ucfirst($name)."</label><input type=\"date\" id=\"$name\" name=\"$name\" value=\"$vandaag\"  min=\"$min\" max=\"$max\" ".$veld["extra"]." /><br/>";
		}
		elseif($veld['type']=="datetime")
		{
			$vandaag = date("Y-m-d",strtotime('tomorrow'))."T08:00";
			$txt .= "<label for=\"$name\">".ucfirst($name)."</label><input type=\"datetime-local\" id=\"$name\" name=\"$name\" value=\"$vandaag\" ".$veld["extra"]." /><br/>";
		}
		elseif($veld['type']=='checkbox')
		{
			
			foreach($veld['value'] as $id => $tekst)
			{
				$selected = "";
				if(in_array($id, $waarden[$name])){ $selected = "checked"; }
				$txt .= "<input type=\"checkbox\" name=\"".$name."[]\" id=\"".$name."\" value=\"".$id."\" ".$selected.">".ucwords($tekst)."<br/>" ;
			}
		}
		elseif($veld['type']=='password')
		{
			$txt .= "<input type=\"password\" name=\"$name\" id=\"$name\" placeholder=\"".ucfirst($name)."\"value=\"".$waarden[$name]."\" size=\"".$veld['size']."\" maxlength=\"".$veld['size']."\"".$veld['extra']."/><br/>";
		}
	}
	echo "<form method=\"$methode\" action=\"$actie\">";
	echo $txt;
	echo "</form>";
}
function kuis($input)
{
	return htmlentities(trim($input));
}
function kuisdatum($input)
{
	return date_format(date_create($input), "d M Y");
}
function shorttime($input)
{
	return date_format(date_create($input), "H:i");
}
function shortdate($input)
{
	return date_format(date_create($input), "d.M");
}
function kuisdatetime($input)
{
	return date_format(date_create($input), "d-m-Y H:i");
}
function huidig_schooljaar()
{
	$maand 	= (int) date("n");
	$jaar 	= (int) date("y");
	if(1 <= $maand and $maand <= 7)
	{
		return ($jaar - 1)*100+$jaar;
	}
	else
	{
		return $jaar * 100 + ($jaar + 1);
	}
}
function afstand($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  return ceil($angle * $earthRadius);
}function get_timeline_types(){	return array(""=>"Maak uw keuze",							"COMB"	=>"Combinatie van meerdere competentieclusters [ALL]",						"SAM"	=>"Communiceren & samenwerken m. team & instelling [ALL]",						"OMG"	=>"Omgangscompetentie [VZ|TB]", 						"KWAL"	=>"Kwaliteitsbewust handelen [OH]",						"REFL"	=>"Zelfreflectie & levenslang leren [ALL]",						"ZORG"	=>"Zorgcompetentie [VZ|TB]",						"ALG"	=>"Algemene communicatie [Secr.|Co&ouml;rd.]"						);}
?>

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
		return $this->oef21();
	}

	private function canvas($marge = 30, $x = 0, $y = 0)
	{
		return "<br/><input type='number' value=".$marge." step=5 min=5 id='marge' onchange='teken(f);' style='width:1.5cm;visibility:hidden;' />
				<button onclick=\"document.getElementById('marge').value = parseInt(document.getElementById('marge').value) + 5;teken(f);\">+</button>
				<button onclick=\"document.getElementById('marge').value = Math.max(5, parseInt(document.getElementById('marge').value) - 5);teken(f);\">-</button>
				<i style='font-size:70%'>Gebruik de toetsenbordpijltjes om grafiek te verschuiven</i>
				<input type='number' value=".$x." step=1 id='x' onchange='teken(f);' style='visibility:hidden;width:0cm;' />
				<input type='number' value=".$y." step=1 id='y' onchange='teken(f);' style='visibility:hidden;width:0cm;' /><br/>
				<canvas id=\"surface\" height=\"500px\" width=\"500px\">Canvas not Supported</canvas>";
	}

	

	// Bouw LaTeX-string voor ax² + bx + c
	private function fx_latex($a, $b, $c)
	{
		$fx = "";
		if ($a == 1)       { $fx .= "x^2"; }
		elseif ($a == -1)  { $fx .= "-x^2"; }
		else               { $fx .= $a."x^2"; }
		if ($b == 0)       { }
		elseif ($b == 1)   { $fx .= "+x"; }
		elseif ($b == -1)  { $fx .= "-x"; }
		elseif ($b > 0)    { $fx .= "+".$b."x"; }
		else               { $fx .= $b."x"; }
		if ($c > 0)        { $fx .= "+".$c; }
		elseif ($c < 0)    { $fx .= $c; }
		return $fx;
	}

	// Geeft een nette LaTeX-breuk voor p/q, vereenvoudigd
	private function breuk_latex($teller, $noemer)
	{
		if ($noemer == 0) { return "0"; }
		$g = ggd(abs($teller), abs($noemer));
		$t = $teller / $g;
		$n = $noemer / $g;
		if ($n < 0) { $t *= -1; $n *= -1; }
		if ($n == 1) { return (string)$t; }
		return "\\dfrac{".$t."}{".$n."}";
	}


	private function bereken_canvas($a, $p_dec, $q, $x_punten)
	{
		$canvas_px = 500;

		// Horizontale extremen: top + alle nulpunten + wat ruimte
		$x_min = $p_dec;
		$x_max = $p_dec;
		foreach ($x_punten as $xp) {
			$x_min = min($x_min, $xp);
			$x_max = max($x_max, $xp);
		}
		// Voeg altijd wat speling toe (minstens 2 eenheden aan elke kant)
		$speling_h = max(2, ($x_max - $x_min) * 0.4 + 1.5);
		$x_min -= $speling_h;
		$x_max += $speling_h;
		$breedte_x = $x_max - $x_min;

		// Verticale extremen: top is het minimum (a>0) of maximum (a<0)
		// De parabool gaat aan de randen van het x-venster omhoog/omlaag
		$y_rand = $a * $x_max * $x_max + ($a * -2 * $p_dec) * $x_max + ($q + $a * $p_dec * $p_dec);
		// herbereken correct: f(x) = a(x-p)^2 + q
		$y_rand_min = $a * pow($x_min - $p_dec, 2) + $q;
		$y_rand_max_val = $a * pow($x_max - $p_dec, 2) + $q;
		$y_top  = $q;
		$y_min  = min($y_top, $y_rand_min, $y_rand_max_val);
		$y_max  = max($y_top, $y_rand_min, $y_rand_max_val);
		$speling_v = max(2, ($y_max - $y_min) * 0.25 + 1.5);
		$y_min -= $speling_v;
		$y_max += $speling_v;
		$breedte_y = $y_max - $y_min;

		// Marge = pixels per eenheid, afgerond naar veelvoud van 5, min 5 max 80
		$marge_h = $canvas_px / $breedte_x;
		$marge_v = $canvas_px / $breedte_y;
		$marge   = max(5, min(80, (int)(min($marge_h, $marge_v) / 5) * 5));
		if ($marge < 5) { $marge = 5; }

		// Centrum: het midden van het interessante venster
		$cx = ($x_min + $x_max) / 2;
		$cy = ($y_min + $y_max) / 2;

		$canvas_x = (int)round(-$cx);
		$canvas_y = (int)round(-$cy);

		return array($marge, $canvas_x, $canvas_y);
	}

	// Bouw de gemeenschappelijke oplossing (waardentabel t/m limieten)
	private function bouw_oplossing($a, $b, $c, $p_dec, $p_latex, $q, $q_latex, $type)
	{
		$fx = $this->fx_latex($a, $b, $c);

		// ── 1. Waardentabel ───────────────────────────────────────────────────
		// Altijd: top, snijpunt y-as (x=0), en nulpunten indien aanwezig
		$tabel_x_raw = array();
		if (!in_array(0.0, array_map('floatval', $tabel_x_raw))) {
			$tabel_x_raw[] = 0.0;
		}
		$tabel_x_raw[] = (float)$p_dec;

		if ($type == 'twee') {
			$disc = $p_dec * $p_dec - $c / $a; // x² - (b/a)x + c/a = 0 → via Vieta
			$D    = $b * $b - 4 * $a * $c;
			$x1_f = (-$b - sqrt($D)) / (2 * $a);
			$x2_f = (-$b + sqrt($D)) / (2 * $a);
			$tabel_x_raw[] = $x1_f;
			$tabel_x_raw[] = $x2_f;
		} elseif ($type == 'een') {
			$tabel_x_raw[] = $p_dec; // al toegevoegd, dubbelcheck
		}
		// Uniek maken en sorteren
		$tabel_x_raw = array_unique(array_map(function($v){ return round($v, 6); }, $tabel_x_raw));
		sort($tabel_x_raw);

		$tabel_x_latex  = array();
		$tabel_fx_latex = array();
		foreach ($tabel_x_raw as $xval) {
			// Gebruik p_latex als het de top-x is
			if (abs($xval - $p_dec) < 0.001) {
				$tabel_x_latex[] = $p_latex;
				$tabel_fx_latex[] = $q_latex;
			} else {
				$tabel_x_latex[]  = puntkomma((string)round($xval, 2));
				$fval = $a * $xval * $xval + $b * $xval + $c;
				$tabel_fx_latex[] = puntkomma((string)round($fval, 2));
			}
		}

		$oplossing  = "\\textbf{Waardentabel} \\\\ \\begin{array}{l|".str_repeat("c|", count($tabel_x_raw))."}";
		$oplossing .= "x & ".implode(' & ', $tabel_x_latex)." \\\\";
		$oplossing .= " \\hline ";
		$oplossing .= "f(x) & ".implode(' & ', $tabel_fx_latex);
		$oplossing .= "\\end{array} \\\\";

		// ── 2. Nulwaarden ─────────────────────────────────────────────────────
		$oplossing .= "\\\\ \\underline{\\text{Nulwaarden}} \\\\";
		$D = $b * $b - 4 * $a * $c;
		if ($type == 'twee') {
			$D_latex = (string)$D;
			$oplossing .= "\\Delta = b^2-4ac = ".($b*$b)."-".h(4*$a*$c)." = ".$D_latex." > 0 \\\\";
			$x1_n = $this->breuk_latex(-$b - (int)round(sqrt($D)), 2*$a);
			$x2_n = $this->breuk_latex(-$b + (int)round(sqrt($D)), 2*$a);
			$oplossing .= "x_1 = \\dfrac{-b-\\sqrt{\\Delta}}{2a} = ".$x1_n."\\quad x_2 = \\dfrac{-b+\\sqrt{\\Delta}}{2a} = ".$x2_n." \\\\";
		} elseif ($type == 'een') {
			$oplossing .= "\\Delta = b^2-4ac = ".$D." = 0 \\\\";
			$oplossing .= "\\text{Eén nulpunt (raakpunt met de x-as): } x = ".$p_latex." \\\\";
		} else {
			$oplossing .= "\\Delta = b^2-4ac = ".$D." < 0 \\\\";
			$oplossing .= "\\text{Geen reële nulpunten.} \\\\";
		}

		// ── 3. Snijpunt y-as ──────────────────────────────────────────────────
		$oplossing .= "\\\\ \\underline{\\text{Snijpunt Y-as}} \\\\ (0;".$c.") \\\\ \\\\";

		// ── 4. Symmetrie-as en top ────────────────────────────────────────────
		$oplossing .= "\\underline{\\text{Symmetrie-as en top}} \\\\";
		$oplossing .= "x = -\\dfrac{b}{2a} = -\\dfrac{".$b."}{2 \\cdot ".$a."} = ".$p_latex." \\\\";
		$oplossing .= "f\\!\\left(".$p_latex."\\right) = ".$q_latex." \\\\";
		$oplossing .= "\\text{Top: } T\\!\\left(".$p_latex." ;\\ ".$q_latex."\\right) \\\\ \\\\";

		// ── 5. Tekenschema ────────────────────────────────────────────────────
		$oplossing .= "\\textbf{Tekenschema} \\\\";
		$t_buiten = ($a > 0) ? '+' : '-';
		$t_tussen = ($a > 0) ? '-' : '+';

		if ($type == 'twee') {
			$x1_l = $this->breuk_latex(-$b - (int)round(sqrt($D)), 2*$a);
			$x2_l = $this->breuk_latex(-$b + (int)round(sqrt($D)), 2*$a);
			$oplossing .= "\\begin{array}{r|ccccccc}
				x & -\\infty & & ".$x1_l." & & ".$x2_l." & & +\\infty \\\\
				\\hline
				f(x) & ".$t_buiten." & ".$t_buiten." & 0 & ".$t_tussen." & 0 & ".$t_buiten." & ".$t_buiten."\\\\
			\\end{array}\\\\";
		} elseif ($type == 'een') {
			$t_altijd = ($a > 0) ? '+' : '-';
			$oplossing .= "\\begin{array}{r|ccccc}
				x & -\\infty & & ".$p_latex." & & +\\infty \\\\
				\\hline
				f(x) & ".$t_altijd." & ".$t_altijd." & 0 & ".$t_altijd." & ".$t_altijd."\\\\
			\\end{array}\\\\";
		} else {
			$t_altijd = ($a > 0) ? '+' : '-';
			$oplossing .= "\\begin{array}{r|ccc}
				x & -\\infty & & +\\infty \\\\
				\\hline
				f(x) & ".$t_altijd." & ".$t_altijd." & ".$t_altijd."\\\\
			\\end{array}\\\\";
		}

		// ── 6. Domein en bereik ───────────────────────────────────────────────
		if ($a > 0) {
			$bereik = "[".$q_latex.",\\ +\\infty[";
		} else {
			$bereik = "]-\\infty,\\ ".$q_latex."]";
		}
		$oplossing .= "\\textbf{Domein en bereik} \\\\
						\\text{dom} f = \\mathbb{R} \\text{ en ber} f = ".$bereik."\\\\ \\\\";

		// ── 7. Verloopschema ──────────────────────────────────────────────────
		if ($a > 0) {
			$ver_links  = "+\\infty"; $ver_pijl1 = "\\searrow";
			$ver_pijl2  = "\\nearrow"; $ver_rechts = "+\\infty";
		} else {
			$ver_links  = "-\\infty"; $ver_pijl1 = "\\nearrow";
			$ver_pijl2  = "\\searrow"; $ver_rechts = "-\\infty";
		}
		$oplossing .= "\\textbf{Verloopschema} \\\\
						\\begin{array}{r|ccccc}
							x & -\\infty & & ".$p_latex." & & +\\infty \\\\
							\\hline
							f(x) & ".$ver_links." & ".$ver_pijl1." & ".$q_latex." & ".$ver_pijl2." & ".$ver_rechts."\\\\
						\\end{array}\\\\ \\\\";

		// ── 8. Limieten ───────────────────────────────────────────────────────
		$lim_min  = ($a > 0) ? "+\\infty" : "-\\infty";
		$lim_plus = ($a > 0) ? "+\\infty" : "-\\infty";
		$oplossing .= "\\textbf{Voor leerlingen derde graad} \\\\
                \\displaystyle{ \\lim_{x \\to -\\infty} } f(x) = ".$lim_min." \\\\
                \\displaystyle{ \\lim_{x \\to +\\infty} } f(x) = ".$lim_plus."";

		return $oplossing;
	}

	// ══════════════════════════════════════════════════════════════════════════
	//  OEF 21 — Random: twee nulpunten / één nulpunt / geen nulpunten
	// ══════════════════════════════════════════════════════════════════════════
	private function oef21()
	{
		$a_keuzes = array(-2, -1, 1, 2);
		$a        = $a_keuzes[random_int(0, 3)];
		$type     = array('twee', 'een', 'geen')[random_int(0, 2)];

		if ($type == 'twee') {
			// f(x) = a(x-x1)(x-x2), gehele nulpunten
			$nulpunten_pool = array(
				array(-4,-1), array(-3,-1), array(-3,1), array(-2,1),
				array(-1,2),  array(-1,3),  array(1,2),  array(1,3),
				array(1,4),   array(2,4),   array(-2,3), array(-4,2),
				array(-3,2),  array(-2,-1), array(-4,1), array(2,5),
				array(-5,1),  array(-1,4),  array(-2,5), array(3,5),
				array(-3,-1), array(-1,5),  array(0,3),  array(-3,0),
				array(0,4),   array(-2,0),  array(0,5),  array(-4,0),
			);
			$keuze  = $nulpunten_pool[random_int(0, count($nulpunten_pool)-1)];
			$x1     = $keuze[0]; $x2 = $keuze[1];
			$b      = -$a * ($x1 + $x2);
			$c      =  $a * $x1 * $x2;
			$p_dec  = ($x1 + $x2) / 2.0;
			$q      = $a * ($p_dec - $x1) * ($p_dec - $x2);
			$p_latex = $this->breuk_latex($x1 + $x2, 2);
			$q_latex = $this->breuk_latex((int)round($q * 4), 4);
			$x_punten = array($x1, $x2);
			$stamp  = "21.".$a.".".$x1.".".$x2;

		} elseif ($type == 'een') {
			// f(x) = a(x-p)², dubbel nulpunt
			$p_pool  = array(-4,-3,-2,-1,1,2,3,4);
			$p_dec   = $p_pool[random_int(0, count($p_pool)-1)];
			$b       = -2 * $a * $p_dec;
			$c       =  $a * $p_dec * $p_dec;
			$q       = 0;
			$p_latex = (string)$p_dec;
			$q_latex = "0";
			$x_punten = array($p_dec);
			$stamp   = "21.".$a.".".$p_dec.".e";

		} else {
			// f(x) = a(x-p)² + q  met a·q > 0  →  Δ < 0
			$p_pool  = array(-3,-2,-1,0,1,2,3);
			$p_dec   = $p_pool[random_int(0, count($p_pool)-1)];
			$q_abs   = random_int(1, 6);
			$q       = ($a > 0) ? $q_abs : -$q_abs;
			$b       = -2 * $a * $p_dec;
			$c       = $a * $p_dec * $p_dec + $q;
			$p_latex = (string)$p_dec;
			$q_latex = (string)$q;
			$x_punten = array();
			$stamp   = "21.".$a.".".$p_dec.".g.".$q;
		}

		$fx = $this->fx_latex($a, $b, $c);
		list($marge, $cx, $cy) = $this->bereken_canvas($a, $p_dec, $q, $x_punten);

		$opgave  = "f(x)=".$fx;
		$opgave .= "\\) 
						".$this->canvas($marge, $cx, $cy)."
						<script>
							function f(x) { return ".$a."*x*x".p($b,2)."*x".p($c,2)."; }
							teken(f);
						</script>
					\\(";

		$oplossing = $this->bouw_oplossing($a, $b, $c, $p_dec, $p_latex, $q, $q_latex, $type);
		return new Oefening($this->titel, $opgave, $oplossing, $stamp);
	}
}
?>
<script src="grafiek.js"></script>

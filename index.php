<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
session_start();
//AANTAL OEFENINGEN 
if (!isset($_SESSION['aantal'])) {
	$_SESSION['aantal'] = 12;
}
//IMPORT
include('kop.php');
include('index.overzicht.php'); //Bevat wat CSS, $paginas, $menu en $aantal_oefeningenreeksen
//OVERZICHT
if (!isset($_GET['page']) or (isset($_GET['page']) and !in_array($_GET['page'], array_keys($paginas)))) //EXTRA VEILIGHEID
{
?>
	<div class="container" id='rijnr-1'>
		<h1 id='top'>Oefeningen Generator</h1>
		<p>
			<a href='over.php' class='button'>Info</a>&nbsp; Keuze uit <b><?php echo $aantal_oefeningenreeksen; ?></b> oefeningenreeksen
			<?php
			if (isset($_SESSION['latex']) && $_SESSION['latex'] == True) {
				echo "<span style=\"color:red;float:right;\">LaTeX optie staat aan. <a href='latex.php'>Zet LaTeX uit</a>.</span>";
			} else {
				echo "<span style=\"color:grey;float:right;\"><a href='latex.php'>Zet LaTeX aan</a> <i>(Voor leerkrachten)</i></span>";
			}
			?>
		</p>
		<div class='row'>
			<div class='one-third column'>
				<h3>Inhoud</h3>
				<ol style="list-style-type: upper-roman">
					<?php
					foreach ($pages as $key => $value) {
						echo "
						<li>
							<a href='#$key'>" . $value['title'] . "</a>
						</li>
						";
					}
					?>
				</ol>
			</div>
			<div class='two-thirds column'>
				<h3>Uitleg</h3>
				<p style='font-style: italic'>
					Alle reeksen werden ondergebracht in logische blokken.
					Klik op de links om een specifieke, afdrukbare versie van 12 oefeningen te genereren.
					Om een willekeurige oefening uit de reeksen van een blok te maken, klik op de bloktitel.
					Oefeningen op meetkunde en grafieken vind je onderaan deze lijst in andersgekleurde blokken.
				</p>
			</div>
		</div>

		<!-- <pre> -->
<?php
	echo '<div class="chapters-container">';
	$pages = generateChapterArray();
	// echo '<pre>';
	// print_r($pages);
	// echo '</pre>';
	// foreach ($pages as $page) {
	// 	echo 'Chapter Title: ' . $page['title'] . ' -> ' . $page['description'];
	// 	echo '<br />';

	// 	$sections = $page['sections'];
	// 	foreach ($sections as $section) {
	// 		echo '- Section Title: ' . $section['title'] . ' -> ' . $section['description'];
	// 		echo '<br />';

	// 		$exercises = $section['exercises'];
	// 		foreach ($exercises as $exercise) {
	// 			echo '-- Exercise File: ' . $exercise['file'] . ' -> ' . $exercise['description'];
	// 			echo '<br />';
	// 		}

	// 		echo '<br />';
	// 	}

	// 	echo '<br />';
	// 	echo '<br />';
	// }
	// echo '</pre>';
	
	foreach ($pages as $page) {
		echo '
		<div class="chapter">
			<h1 id="BSS">
				' . $page['title'] . '
				<span style="float: right; text-color: black">
					<a href="#">\(\uparrow\)</a>
				</span>
			</h1>
		';

		$sections = $page['sections'];
		$count = 0;
		foreach($sections as $section) {
			if ($count % 3 == 0) {
				echo '<div class="cards-wrapper">';
			}

			echo '
			<fieldset class="card">
				<legend>' . $section['title'] . '</legend>
			';

			echo '<div class="exercises-wrapper">';
			$exercises = $section['exercises'];
			foreach($exercises as $exercise) {
				echo '
				<a class="link" href="?page=' . $exercise['file'] . '">' . $exercise['title'] . '</a>
				';
			}
			echo '
				</div>
			</fieldset>
			';

			$count++;
			if ($count % 3 == 0) {
				echo '</div>';
			}
		}
		
		if ($count % 3 != 0) {
			echo '</div>';
		}
	}
	
	echo '</div>';
	echo '</div>';
	echo '</div>';
?>

	</div>
	<div class="container">
		<?= $menu; ?>
	</div>
<?php

} else {
	//ONTVANGEN
	$label = $_GET['page'];
	if (!in_array($label, array_keys($paginas))) {
		die('Onbekend verzoek');
	}
	//MOTOR
	require_once(LIB . "class.pagina.php");
	$pagina = $paginas[$label];
?>
	<div class="container">
		<h1><?php echo $pagina["Titel"]; ?></h1>
		<?php
		if (isset($_GET['embed'])) {
			echo "<a href=\"mixer.php?blok=$label&embed\" class='button'>Eentje per keer</a>&nbsp; ";
		} else {
			$ref = "#";
			$rijnr = -1;
			if (isset($_GET['rijnr'])) {
				$rijnr = $_GET['rijnr'];
				$ref = "#rijnr$rijnr";
			}
			echo "<a href=\"index.php$ref\" style='text-decoration:none;' class='button'>Hoofdmenu</a>&nbsp;";
			echo "<a href=\"mixer.php?blok=$label&rijnr=$rijnr\" class='button'>Eentje per keer</a>&nbsp; ";
			echo "<span style='float:right;' class='special'><button style='font-size:150%' onclick=\"window.print()\">&#128424;</button></span>";
		}
		?>
	</div>
	<div class="container">

		<?php

		if (!isset($_SESSION['aantal'])) {
			$_SESSION['aantal'] = 10;
		}
		try {
			var_dump($pagina);
			$P = new Pagina($pagina["Opgave"], $label . '.php', $pagina["folder"]);
			$P->toon($_SESSION['aantal']);
		} catch (Exception $e) {

			echo '<p>Oeps, ergens een rekenfoutje gemaakt: ' . $e->getMessage();
			echo '<br/>Zoals je ziet, het overkomt iedereen wel eens</p>';
			echo "<a href='?pagina=$label' class='button'>Probeer opnieuw</a>";
		}
		?>

	</div>
<?php

}
?>
<?php include(COMPONENTS . 'voet.html'); ?>
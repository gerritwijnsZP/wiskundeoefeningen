<?php
session_start(); 
include('kop.html');
if(isset($_GET['code']))
{
?>
<style>
	<!-- thanks to https://www.benmarshall.me/responsive-iframes/ -->
.iframe-container {
	overflow: hidden;
	/* 16:9 aspect ratio */
	padding-top: 56.25%;
	position: relative;
}
.iframe-container iframe {
   border: 0;
   height: 100%;
   left: 0;
   position: absolute;
   top: 0;
   width: 100%;
   border: 1px solid #e4e4e4;
   border-radius: 4px;
}
</style>
<div class="container">
	<h1>Geogebra applet wordt geladen ...</h1>
	<a href="index.php"><<<</a>
</div>
<div class="iframe-container">
	<iframe	src="https://www.geogebra.org/classic/<?php echo $_GET['code']; ?>?embed"
			loading="lazy" 
			title="Responsive iframe example" 
			allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
			allowfullscreen />
</div>
<?php
}
include('voet.html');?>

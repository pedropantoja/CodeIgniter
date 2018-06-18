<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>
<body>

<div>
	<code>
		<?php
			//linea de autores
			foreach($autores as $reg) {
                echo "<p>" . $reg['nombre'] . "</p>";
                echo "<p><a href=" . "\"" . site_url('welcome/autores/' . $reg['id']) . "\"" .  ">View frases</a></p>";
			//linea de fliker
			//foreach ($fliker as $key => $value) {
			//	echo "<p><a href='" . $value['link'] . "</a></p>";
			//	echo "<p>" . $value['title'] . "</p>" . "<hr/>";
			//}

			//linea de productos
			//echo $product;
			//foreach ($product as $key => $value) {
			//	echo "<p>" . $value['product'] . "</p>";
			
			//linea de noticias
			//	echo "<p>" . $value['title'] . "</p>";
			//}
		?>
	</code>
</div>

</body>
</html>
 
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Planet Test</title>
</head>
<body>
	<?php
		require_once('Planet.php');

		foreach (Planet::values() as $planet)
			printf('%s has a diameter of %d!<br>', ucwords(strtolower($planet->name())), $planet->getDiameter());
	?>
</body>
</html>
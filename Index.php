<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ůkol č. 1 - Hledání maxima a minima v dvourozměrném poli</title>
</head>
<body>  

<?php
// Proměnné
$XErr = $YErr = "";
$X = $Y = $max = $min = "";



// Ověření vstupu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["X"])) {
    $XErr = "Rozměr X je nezbytný k vykonání funkce";
  } else {
    $X = ($_POST["X"]);
  }
  
  if (empty($_POST["Y"])) {
    $YErr = "Rozměr Y je nezbytný k vykonání funkce";
  } else {
    $Y = ($_POST["Y"]);
  }
}
?>

<h2>Hledání maxima a minima v dvourozměrném poli</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  X= <input type="number" name="X">
  <span class="error">* <?php echo $XErr;?></span>
  <br><br>
  Y= <input type="number" name="Y">
  <span class="error">* <?php echo $YErr;?></span>
  <br"><br>
  <input type="submit" name="submit" value="Vytvořit">  
</form>

<?php
	// Výpis matice pokud jsou obě hodnoty zadané
	if ($X != "" && $Y != ""){
		// Generování matice
		$matice = array ();
			for ($i=0; $i < $X; $i++) { 
			for ($k=0; $k < $Y ; $k++) { 
			$matice[$i][$k]= rand();
			}
		}
		// Nalezení max hodnoty
		for ($j=0; $j < $X; $j++) { 
			if (max($matice[$j])>$max) {
				$max = max($matice[$j]);
			}
		}
		// Nalezení min hodnoty
		$min = $matice[0][0];
		for ($p=0; $p < $X; $p++) { 
			if (min($matice[$p])<$min) {
				$min = min($matice[$p]);
			}
		}
		// Výpis všeho
		echo "<h4>Max:</h4>".$max;
		echo "<h4>Min:</h4>".$min;
		echo "<h2>Matice</h2>";
		for ($row = 0; $row < $Y; $row++) {
 		for ($col = 0; $col < $X; $col++) {
 			if ($matice[$col][$row]==$max || $matice[$col][$row]==$min) {
 				print_r("<a style=color:red>[".$matice[$col][$row]."]<a> ");
 			}
       	print_r("[".$matice[$col][$row]."] ");
  		}
  		echo "<br>";
  		}
	}
	// Mazání hodnot
	$X = $Y = "";
?>

</body>
</html>
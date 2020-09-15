<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ůkol č. 2 - Sčítání libovolně velkých čísel</title>
</head>
<body>  

<?php
// Proměnné
$XErr = $YErr = "";
$X = $Y = $String = $Vysledek = $Repeat = $LastN = "";
$Memory = $Zbytek = 0;


// Ověření vstupu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["X"]) || !is_numeric($_POST["X"])) {
    $XErr = "Číslo X není ve správném formátu nebo není vůbec zadané.";
  } else {
    $X = ($_POST["X"]);
  }
  
  if (empty($_POST["Y"]) || !is_numeric($_POST["Y"])) {
    $YErr = "Číslo Y není ve správném formátu nebo není vůbec zadané";
  } else {
    $Y = ($_POST["Y"]);
  }
}
?>

<h2>Sčítání libovolně velkých čísel</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  X= <input type="text" name="X">
  <span class="error">* <?php echo $XErr;?></span>
  <br><br>
  Y= <input type="text" name="Y">
  <span class="error">* <?php echo $YErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Sečíst">  
</form>

<?php
	// Výpis výsledku pokud jsou hodnoty zadané
	if ($X != "" && $Y != ""){
		$String = $X . $Y;
		$Repeat = mb_strlen($X);
		if ($Repeat < mb_strlen($Y)) {
			$Repeat = mb_strlen($Y);
		}
		//Kontrola délky obou čísel a následná oprava
		if (mb_strlen($X) != mb_strlen($Y)) {
			if (mb_strlen($Y) > mb_strlen($X)) {
				$RepeatTo = $Repeat - 1 - mb_strlen($X);
				$PCount = mb_strlen($X);
				for ($j=$Repeat - 1; $j > $RepeatTo; $j--) { 
				$LastN = $PCount - $Zbytek -1;
				$X[$j] = $X[$LastN];
				$X[$LastN] = 0;
				$Zbytek ++;
				}
			}
			else{
				$RepeatTo = $Repeat - 1 - mb_strlen($Y);
				$PCount = mb_strlen($Y);
				for ($l=$Repeat - 1; $l > $RepeatTo; $l--) { 
				$LastN = $PCount - $Zbytek -1;
				$Y[$l] = $Y[$LastN];
				$Y[$LastN] = 0;
				$Zbytek ++;
				}
			}
			
		}
		// Sčítání do výsledku
		for ($i=$Repeat-1; $i > -1; $i--) { 
			if (is_numeric($X[$i])!= true) {
				$X[$i] = 0;
			}
			if (is_numeric($Y[$i])!= true) {
				$Y[$i] = 0;
			}
			if ($X[$i] + $Y[$i] + $Memory > 9) {
				$Vysledek[$i+1] = $X[$i] + $Y[$i] + $Memory - 10;
				$Memory = 1;
			}
			else{
				$Vysledek[$i+1] = $X[$i] + $Y[$i] + $Memory;
				$Memory = 0;
			}
			if ($Memory > 0 & $i == 0) {
				$Vysledek[$i] = $X[$i] + $Y[$i] + $Memory;
			}	
		}
		// Výpis výsledku
		echo "<h2>Výsledek</h2>";
		echo "$Vysledek";
	}
	// Mazání hodnot
	$X = $Y = "";
	$Zbytek = 0;
?>

</body>
</html>
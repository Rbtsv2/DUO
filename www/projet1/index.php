<?php
echo "Projet 1 - PHP 5.6<br>";

// Vérification du module mysqli
if (function_exists('mysqli_connect')) {
    echo "<div style='color: green'>Module mysqli est activé ✓</div><br>";
} else {
    echo "<div style='color: red'>Module mysqli n'est pas activé ✗</div><br>";
}

phpinfo();
?>

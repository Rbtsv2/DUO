<?php
echo "Projet 2 - PHP 8.1<br>";

// Fonction pour vérifier et afficher le statut d'une extension
function checkExtension($name) {
    if (extension_loaded($name)) {
        echo "<div style='color: green'>Module $name est activé ✓</div>";
    } else {
        echo "<div style='color: red'>Module $name n'est pas activé ✗</div>";
    }
}

echo "<h2>Vérification des extensions :</h2>";

// Vérification de mysqli
checkExtension('mysqli');

// Vérification de sqlsrv
checkExtension('sqlsrv');

// Vérification de pdo_sqlsrv
checkExtension('pdo_sqlsrv');

// Afficher les versions des drivers
echo "<h3>SQL Server Driver Version:</h3>";
if (function_exists('sqlsrv_connect')) {
    // Paramètres de connexion temporaire pour obtenir les informations du client
    $serverName = "localhost";
    $connectionInfo = array("TrustServerCertificate" => true);
    
    // Tentative de connexion
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    
    if ($conn) {
        $serverInfo = sqlsrv_client_info($conn);
        echo "<pre>";
        print_r($serverInfo);
        echo "</pre>";
        sqlsrv_close($conn);
    } else {
        echo "<div style='color: orange'>Impossible d'obtenir les informations du driver (pas de connexion active)</div>";
        echo "<div>Driver SQL Server est installé mais nécessite une connexion pour plus d'informations</div>";
    }
} else {
    echo "<div style='color: red'>Fonction sqlsrv_connect non disponible</div>";
}

// Exemple de code pour se connecter à SQL Server (à adapter avec vos paramètres)
echo "<h3>Test de connexion SQL Server:</h3>";
echo "Pour tester la connexion, décommentez le code suivant et ajoutez vos paramètres de connexion:<br><br>";

/*
try {
    $serverName = "your_server_name";
    $connectionOptions = array(
        "Database" => "your_database",
        "Uid" => "your_username",
        "PWD" => "your_password",
        "TrustServerCertificate" => true
    );

    // Test de connexion avec sqlsrv
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if($conn) {
        echo "<div style='color: green'>Connexion SQLSRV réussie ✓</div>";
    }

    // Test de connexion avec PDO
    $pdo = new PDO(
        "sqlsrv:Server=$serverName;Database={$connectionOptions['Database']}", 
        $connectionOptions['Uid'], 
        $connectionOptions['PWD']
    );
    echo "<div style='color: green'>Connexion PDO réussie ✓</div>";

} catch(Exception $e) {
    echo "<div style='color: red'>Erreur de connexion: " . $e->getMessage() . "</div>";
}
*/

phpinfo();
?>
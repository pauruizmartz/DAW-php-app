<?php

// Dependències necessàries.
require_once('Connexio.php');

/**
 * Classe Actualitzar 
 * 
 * Classe per gestionar l'actualització de productes existents.
 * 
 * @package DAW-php-app
 */
class Actualitzar {

    /**
     * Actualitza un producte existent a la base de dades 
     * 
     * @param int|null $id ID del producte a actualitzar
     * @param string|null $nom Nou nom del producte
     * @param string|null $descripcio Nova descripcio del producte
     * @param float|null $preu Nou preu del producte
     * @param int|null $categoria Nova Categoria ID del producte
     * 
     * @return void 
     */    
    public function actualizar($id, $nom, $descripcio, $preu, $categoria) {
        // Verifica si tots els camps necessaris son presents
        if (!isset($id) || !isset($nom) || !isset($descripcio) || !isset($preu) || !isset($categoria)) {
            echo '<p>Se requieren todos los campos para actualizar el producto.</p>';
            return;
        }

        // Crea una instancia de la classe de connexió
        $conexionObj = new Connexio();
        // Obté la connexió a la base de dades
        $conexion = $conexionObj->obtenirConnexio();

        // Escapa les variables per prevenir SQL injection
        $id = $conexion->real_escape_string($id);
        $nom = $conexion->real_escape_string($nom);
        $descripcio = $conexion->real_escape_string($descripcio);
        $preu = $conexion->real_escape_string($preu);
        $categoria = $conexion->real_escape_string($categoria);

        // Construeix la consulta SQL d'actualizació
        $consulta = "UPDATE productes
                     SET nom = '$nom', descripció = '$descripcio', preu = '$preu', categoria_id = '$categoria'
                     WHERE id = '$id'";

        // Executa la consulta i redirigeix a la pàgina principal si és exitosa
        if ($conexion->query($consulta) === TRUE) {
            header('Location: Principal.php');
            exit();
        } else {
            // Mostra un missatge d'error si la consulta falla
            echo '<p>Error al actualizar el producto: ' . $conexion->error . '</p>';
        }

        // Tanca la connexió a la base de dades
        $conexion->close();
    }
}

// Obté els valors del formulari (si existeixen)
$id = isset($_POST['id']) ? $_POST['id'] : null;
$nom = isset($_POST['nom']) ? $_POST['nom'] : null;
$descripcio = isset($_POST['descripcio']) ? $_POST['descripcio'] : null;
$preu = isset($_POST['preu']) ? $_POST['preu'] : null;
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;

// Crea una instància de la classe Actualitzar i crida al mètode actualitzar
$actualizarProducto = new Actualitzar();
$actualizarProducto->actualizar($id, $nom, $descripcio, $preu, $categoria);

?>

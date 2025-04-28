<?php
// Dependències necessàries.
require_once('Connexio.php');
require_once('Header.php');
/**
 * Classe Modificar
 * 
 * Classe per mostrar el formulari per modificar els productes a la base de dades
 * 
 * @package DAW-php-app
 */
class Modificar {
    
    /**
     * Mostra el formulari de modificació d'un producte.
     * 
     * Aquest mètode obté la informació d'un producte mitjançant un ID i la mostra al HTML.
     * 
     * @param int $id L'ID del producte a modificar.
     * 
     * @return void
     */
    public function mostrarFormulari($id) {
        // Verifica si l'ID del producte és vàlid
        if (!isset($id) || !is_numeric($id)) {
            echo '<p>ID de producto no válido.</p>';
            return;
        }

        // Obté la connexió a la base de dades
        $conexionObj = new Connexio();
        $conexion = $conexionObj->obtenirConnexio();

        // Consulta per obtenir la informació del producte
        $consulta = "SELECT id, nom, descripció, preu, categoria_id
                     FROM productes
                     WHERE id = " . $id;
        $resultado = $conexion->query($consulta);

        // Verifica si s'ha trobat el producte
        if ($resultado && $resultado->num_rows > 0) {
            $producto = $resultado->fetch_assoc();

            // Imprimeix la estructura HTML del formulari de modificació
            echo '<!DOCTYPE html>
                  <html lang="es">
                  <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <title>Modificar producte</title>
                    <!-- Enlace a Bootstrap desde su repositorio remoto -->
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
                  </head>
                  <body>
                    <div class="container mt-5" style="margin-bottom: 200px">
                        <h2>Modificar producte</h2>
                        <hr>
                        <form action="Actualitzar.php" method="POST">
                            <!-- Campos del formulario con la información actual del producto -->
                            <input type="hidden" name="id" value="' . $producto['id'] . '">

                            <div class="mb-3">
                                <label for="nom" class="form-label">Nombre:</label>
                                <input type="text" name="nom" class="form-control" value="' . $producto['nom'] . '" required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcio" class="form-label">Descripción:</label>
                                <input type="text" name="descripcio" class="form-control" value="' . $producto['descripció'] . '" required>
                            </div>

                            <div class="mb-3">
                                <label for="preu" class="form-label">Precio:</label>
                                <input type="number" name="preu" class="form-control" value="' . $producto['preu'] . '" required>
                            </div>

                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría:</label>
                                <select name="categoria" class="form-select" required>
                                    <!-- Opciones del selector de categorías con la opción seleccionada según la información actual -->
                                    <option value="1" ' . ($producto['categoria_id'] == 1 ? 'selected' : '') . '>Electrónicos</option>
                                    <option value="2" ' . ($producto['categoria_id'] == 2 ? 'selected' : '') . '>Roba</option>
                                    <!-- Agrega más opciones según sea necesario -->
                                </select>
                            </div>

                            <!-- Agrega más campos según sea necesario -->

                            <hr>
                            <!-- Botones de guardar y cancelar -->
                            <input type="submit" value="Guardar" class="btn btn-primary">
                            <a href="Principal.php" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>';
            
            // Inclou el peu de pàgina
            require_once('Footer.php');
        } else {
            echo '<p>No se encontró el producto.</p>';
        }

        // Tanca la connexió a la base de dades
        $conexion->close();
    }
}

// Obté l'ID del producte de la variable GET
$idProducto = isset($_GET['id']) ? $_GET['id'] : null;

// Crea una instància de la classe Modificar i crida al mètode mostrarFormulari
$modificarProducto = new Modificar();
$modificarProducto->mostrarFormulari($idProducto);

?>

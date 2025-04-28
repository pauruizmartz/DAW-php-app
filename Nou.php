<?php

// Dependències necessàries 
require_once('Connexio.php');
require_once('Header.php');
require_once('Footer.php');

/**
 * Classe Nou 
 * 
 * Classe per a gestionar l'afegiment de nous productes.
 * 
 * @package DAW-php-app
 */
class Nou{

  /**
   * Mostra el formulari per afegir un nou producte.
   * 
   * @return void
   */
    public function mostrarFormulari(){
        // Mostra el header. 
        $header = new Header();
        $header->mostrarHeader();
        // Mostra el formulari.
        echo '<div class="container mt-5">
                  <h2>Afegir un nou producte</h2>
                  <form action="Nou.php" method="POST">
                    <div class="mb-3">
                      <label for="nom" class="form-label">Nom del producte</label>
                      <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                      <label for="descripcio" class="form-label">Descripció</label>
                      <textarea class="form-control" id="descripcio" name="descripcio" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                      <label for="preu" class="form-label">Preu</label>
                      <input type="number" class="form-control" id="preu" name="preu" step="0.01" required>
                    </div>
                    <div class="mb-3">
                      <label for="categoria" class="form-label">Categoria</label>
                      <select class="form-control" id="categoria" name="categoria" required>
                        <option value="">Selecciona una categoria</option>';
        // Mostra categories segons base de dades.
        $this->mostrarCategories();
        echo '</select>
                    </div>
                    <button type="submit" class="btn btn-primary">Afegir producte</button>
                    <a href="Principal.php" class="btn btn-secondary">Cancel·lar</a>
                  </form>
                </div>';
        // Mostra footer.
        echo '<div class="alert alert-info mt-3">Modificació a la branca develop.</div>';
        $footer = new Footer();
        $footer->mostrarFooter();

        echo '</body>
              </html>';
    }
    /**
     * Mostra les categories disponibles a la base de dades.
     * 
     * @return void 
     */
    private function mostrarCategories(){
        $connexioSel = new Connexio();
        $connexio = $connexioSel->obtenirConnexio();

        $consulta = "SELECT id, nom FROM categories";
        $resultat = $connexio->query($consulta);

        if ($resultat->num_rows > 0){
            while ($fila = $resultat->fetch_assoc()){
                echo '<option value="' . $fila['id'] .'">'. $fila['nom'] . '</option>';
            }
        }

        $connexio->close();
    }
    /**
     * Afegeix un nou producte a la base de dades.
     * 
     * @param string $nom Nom del producte
     * @param string $descripcio Descripcio del producte
     * @param float $preu  Preu del producte
     * @param int $categoria ID de la categoria del producte
     * 
     * @return void
     */
    public function nouProducte($nom, $descripcio, $preu, $categoria){
        $connexioSel = new Connexio();
        $connexio = $connexioSel->obtenirConnexio();
        
        $consulta = "INSERT INTO productes (nom, descripcio, preu, categoria_id)
                     VALUES (?, ?, ?, ?)";
        $stmt = $connexio->prepare($consulta);
        $stmt->bind_param("ssdi", $nom, $descripcio, $preu, $categoria);

        if ($stmt->execute()){
            echo '<div class="alert alert-success mt-3">Producte afegit correctament.</div>';
        } else {
            echo '<div class="alert alert-danger mt-3">Error al afegir el producte.</div>';
        }

        $stmt->close();
        $connexio->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nom = $_POST['nom'];
    $descripcio = $_POST['descripcio'];
    $preu = $_POST['preu'];
    $categoria = $_POST['categoria'];

    $nouProducte = new Nou();
    $nouProducte->nouProducte($nom, $descripcio, $preu, $categoria);
} else {
    $nouProducte = new Nou();
    $nouProducte->mostrarFormulari();
}
?>
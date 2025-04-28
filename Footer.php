<?php
/**
 * Classe Footer
 * 
 * Classe per gestionar la visualització del peu de pàgina de l'aplicació web.
 * 
 * @package DAW-php-app
 */
class Footer {
    /**
     * Mostra el peu de pàgina amb HTML i scripts.
     * 
     * Aquest mètode imprimeix el contingut HTML del peu de pàgina,
     * inclou els scripts de Bootstrap des d'un CDN i un script personalitzat
     * per inicialitzar el carrusel.
     * 
     * @return void
     */
   public function mostrarFooter() {
        // Imprimeix el HTML del peu de pàgina
        echo '<div class="footer text-center bg-dark text-white py-2">
                <p>&copy; 2023 CIFP Pau Casesnoves · Centro de Formación Profesional</p>
              </div>';

        // Imprimeix els scripts de Bootstrap des del seu repositori remot i el script personalitzat per activar el carrusel
        echo '<!-- Scripts de Bootstrap desde su repositorio remoto y script personalizado para activar el carrusel -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener(\'DOMContentLoaded\', function () {
        // Inicializar el carrusel utilizando Bootstrap
        var myCarousel = new bootstrap.Carousel(document.getElementById(\'carrusel\'), {
            interval: 2000, // Cambiar la velocidad del carrusel (en milisegundos)
            wrap: true // Repetir el carrusel al llegar al final
        });
    });
</script>';
        
        // Tanca la etiqueta </body> i </html>
        echo '</body></html>';
    }
}

// Crea una instància de la classe Footer i crida al mètode mostrarFooter
$footer = new Footer();
$footer->mostrarFooter();

?>

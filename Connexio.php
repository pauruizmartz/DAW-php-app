<?php
/**
 * Classe Connexió
 * 
 * Classe per gestionar la connexió a la base de dades 'la_meva_botiga'
 * 
 * @package DAW-php-app
 */
class Connexio {
    /**
     * Nom del servidor de base de dades.
     * 
     * @var string
     */
    private $host = "localhost";
    /**
     * Nom d'usuari per a la connexió a la base de dades.
     * 
     * @var string
     */
    private $usuario = "root";
    /**
     * Contrasenya de l'usuari per a la connexió a la de base de dades.
     * 
     * @var string
     */
    private $contraseña = "";
    /**
     * Nom de la base de dades.
     * 
     * @var string
     */
    private $baseDatos = "la_meva_botiga";
    /**
     * Obté una connexió activa a la base de dades.
     * 
     * @return mysqli Connexió activa a la base de dades.
     */
    public function obtenirConnexio() {
        $conexion = new mysqli($this->host, $this->usuario, $this->contraseña, $this->baseDatos);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        return $conexion;
    }
}

?>

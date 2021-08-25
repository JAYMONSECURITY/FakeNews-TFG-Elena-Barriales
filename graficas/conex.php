<?php  
    
session_start(); #Inicia una conexion o reanuda una exixtente
    
$servername = "localhost";   #Localhost o IP
    
$username = "root";          #Usuario de la dB
    
$password = "";   #Contraseña de la dB
    
$database = "elenatfg";       #Nombre de la db
    
$port = "3306";              #puerto por el que se conecta la dB
    
$conn = mysqli_connect($servername, $username, $password, $database, $port);
        
if (!$conn) {
        
die("Conexion no establecida: " . mysqli_connect_error());
        
}
   
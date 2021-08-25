<?php
    include ("conexion.php");
    

if (isset($_POST['send']))
{
        
$candidato = $_POST['CANDIDATO'];

$rating = $_POST['RATING'];

$tipo = $_POST['TIPO'];
        
$cuando = $_POST['CUANDO'];
        
$donde = $_POST['DONDE'];
        
$enlace = $_POST['ENLACE'];

$contenido = $_POST['CONTENIDO'];

$tipobulo = $_POST['TIPOBULO'];


$insert = "INSERT INTO bdatos (CANDIDATO,RATING,TIPO,CUANDO,DONDE,ENLACE,CONTENIDO,TIPOBULO)
 
VALUES ('$candidato','$rating','$tipo','$cuando','$donde','$enlace','$contenido','$tipobulo')";
    
        

if (mysqli_query($conn,$insert)){
            
$_SESSION['message'] = 'Registro guardado exitosamente';
            
$_SESSION['message_type'] = 'success'; #Funcion de bootstrap
  
          
header('Location:index.php');
        
}else{
        

echo "El registro no se pudo guardar". mysqli_error($conn);
        
}         #Devuelve una cadena que describe el último error
    

}
?>
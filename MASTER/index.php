
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   
 <meta http-equiv="X-UA-Compatible" content="ie=edge" />
   

 <title>BBDD FAKE NEWS ELECCIONES EEUU - ELENA</title>    

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        
integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        
integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
<script>
        

function validarform() {
            
var x = document.forms["form"]["id"].value;
            
if (x == "") {
                
alert("El campo de id no puede ir vacio");
                
return false;
            }
        }
    

</script>
</head>



<body>
    



<div class="container">
        <nav class="navbar navbar-dark bg-dark">
            <div class="container">
                <a href="index.php" class="navbar-brand">BBDD FAKE NEWS ELECCIONES EEUU - ELENA </a>
            </div>
        </nav>
        <div class="container p-4">
            

<?php 

include("conexion.php");
                        

if(isset($_SESSION['message'])){?>
            <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                <?=  $_SESSION['message']?>
                
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            

<?php session_unset(); } #Libera todas las variables de sesión ?>
            

<div class="row">
                <div class="col-md-4 mx-auto">
                    <div class="card card-body">
                        
<form method="post" name="form" onsubmit="return validarform()" action="create.php">
                            
<div class="form-group">
            <input type="text" name="CANDIDATO" class="form-control" placeholder="Ingresa candidato" autocomplete="off" autofocus></div> <div class="form-group">
                                
<input type="text" name="RATING" class="form-control" placeholder="Ingresa rating" autocomplete="off" required> </div><div class="form-group">
                                
<input type="text" name="TIPO" class="form-control" placeholder="Ingresa tipo" autocomplete="off" required>

</div>
                       <div class="form-group">
                                
<input type="text" name="CUANDO" class="form-control" placeholder="Ingresa cuando" autocomplete="off" required>
                            
</div>
  
<div class="form-group">
                                
<input type="text" name="DONDE" class="form-control" placeholder="Ingresa donde" autocomplete="off" required>
                            
</div>
     
<div class="form-group">
                                
<input type="text" name="ENLACE" class="form-control" placeholder="Ingresa enlace" autocomplete="off" required>
                            
</div>
     
<div class="form-group">
                                
<input type="text" name="CONTENIDO" class="form-control" placeholder="Ingresa contenido" autocomplete="off" required>
                            
</div>
 
<div class="form-group">
                                
<input type="text" name="TIPOBULO" class="form-control" placeholder="Ingresa tipo bulo" autocomplete="off" required>
                            
</div>
 
                          
<input type="submit" class="btn btn-success btn-block" name="send" value="Agregar">
                            

<input type="reset" class="btn btn-secondary btn-block" value="Limpiar">
  
</form>
                    
</div>
                
</div> <!--End col-md-4-->
                

<div class="col-md-8 mx-auto">
                    <table class="table table-hover">
                        
<thead>
    <tr>
                               
 <th>CANDIDATO</th>
 <th>RATING</th>
 <th>TIPO</th>
<th>CUANDO</th>
<th>DONDE</th>
 <th>ENLACE</th>
 <th>CONTENIDO</th>
  <th>TIPOBULO</th>
                             
</tr>
                        
</thead>
                        
<tbody>
                            

<?php 
 header("Content-Type: text/html;charset=utf-8");

$query = "SELECT * FROM bdatos";
  
$result = mysqli_query($conn, $query);
                                      

while($row = mysqli_fetch_array($result)){ 
  #Obtiene una fila de resultados como un array asociativo, numérico, o ambos
                            ?>
                            <tr>
                                <td>

<?php echo $row['CANDIDATO'] ?></td>


<td><?php echo $row['RATING'] ?></td>

<td><?php echo $row['TIPO'] ?>  </td>
                                
<td>
<?php echo $row['CUANDO']?></td>
  
<td>
<?php echo $row['DONDE']?></td>
<td>
<?php echo $row['ENLACE']?></td> 
<td>
<?php echo $row['CONTENIDO']?></td>
<td>
<?php echo $row['TIPOBULO']?></td>                         

</tr>
                            <?php } ?>
                 </tbody>
                    </table>
                </div> <!--End col-md-8-->
            </div> <!--End row-->
        </div><!--End container p-4-->
    </div><!--End container-->
    <!--Scripts-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
</body>

</html>
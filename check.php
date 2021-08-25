<?php
function anti_injection($input){
      $clean=strip_tags(addslashes(trim($input)));
      $clean=str_replace("'","\'",$clean);
      $clean=str_replace('"','\"',$clean);
      $clean=str_replace(';','\;',$clean);
      $clean=str_replace('--','\--',$clean);
      $clean=str_replace('+','\+',$clean);
      $clean=str_replace('(','\(',$clean);
      $clean=str_replace(')','\)',$clean);
      $clean=str_replace('=','\=',$clean);
      $clean=str_replace('>','\>',$clean);
      $clean=str_replace('<','\<',$clean);
      return $clean;
}
	$password = "FakeNews";

	$salt = md5(sha1($password));			
	$password = sha1($password.$salt);

	$test_string = $_POST['password'];

    $off = (strip_tags(addslashes($_POST['username'])));

    $key = anti_injection($off);
    $username = $key;
    
    //default user is test
    if ((sha1($test_string.$salt) == $password) && ($username == "FakeNews")){
    	session_start();
		$_SESSION['user']['id'] = 3;
?>

<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   
 <meta http-equiv="X-UA-Compatible" content="ie=edge" />
   

 <title>BBDD FAKE NEWS ELECCIONES EEUU - ELENA</title>    

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        
integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        
integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>
<body>

<div class="container">
        <nav class="navbar navbar-dark bg-dark">
            <div class="container">
                <a href="index.php" class="navbar-brand">BBDD FAKE NEWS ELECCIONES EEUU - ELENA </a>
            </div>
        </nav>
        <div class="container p-4">

  <p>&nbsp;</p>
<br><br>
<a href="./MASTER/index.php">Administrar valores de la Base de Datos Fake News Elecciones EEUU</a> <br><br>

  <a href="./graficas/index.php">Ver gráficas de porcentajes sobre Fake News por candidatos</a> <br><br>


	 <br><br>

	

	<h2></h2>
	

	
	</form>	
</body>
</html>













<?php





    }
    else {
    		header("refresh:0;url=./index.html");
    		echo '<script>alert("Username Or Password not correct");</script>';
            exit;
         }

?>

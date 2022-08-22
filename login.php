
<link rel="stylesheet" href="css/bootstrap.css">
<?php
if(isset($_POST['Sign'])){
$con = new PDO('mysql:host=localhost;dbname=bd1;', 'root', '');
$email=$_POST['email'];
$pwd=$_POST['pwd'];
//$Fname= $_POST['first_name'];
//$Lname= $_POST['last_name'];
$recup= $con->prepare('SELECT * FROM inscription WHERE Email= ? AND Password= ?');
$recup->execute(array($email, $pwd));
if($recup->rowCount()>0 ){
  session_start();
  $_SESSION['connecte']=1;
    $_SESSION['email']=$email;
    $_SESSION['pwd']=$pwd;
    $_SESSION['a']=$recup->fetchAll();
    //$_SESSION['last_name']=$recup->fetch()['Lname'];
    header("Location:index.php");
}
else {
    ?>

    <div class="alert alert-danger p-3 col-6" role="alert" style="margin: 60px;">
    email or password is wrong !
  </div> 
  <?php
 
}
}
function est_connecte (){
  if(session_status()===PHP_SESSION_NONE)
  {
      session_start();
  }
  return !empty($_SESSION['connecte']);
}
if(!est_connecte()){
  header('location:login.html');
  exit();
}
if(est_connecte()){
  header('location:index.php');
  exit();
}
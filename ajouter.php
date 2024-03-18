 
 
<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=connexion;charset=utf8;','root','');

if(isset($_POST['envoie'])){

if(!empty($_POST['email']) AND !empty($_POST['password'])){
    $email = htmlspecialchars($_POST['email']);
    $password =sha1($_POST['password']);
    $ajouterUtilisateur = $bdd->prepare('INSERT INTO utilisateurs ( email, password )VALUES(?,?)');
    $ajouterUtilisateur->execute(array($email, $password));

    $recuputilisateur = $bdd->prepare('SELECT * FROM utilisateurs  WERE email = ? AND password = ?');
    $recuputilisateur->execute(array($email, $password));

    if($recuputilisateur->rowCount() > 0){
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['id'] = $recuputilisateur->fetch() ['id'];

        echo $_SESSION['id'];
     

    }
     else{
        echo "votre email ou password est incorrect";
    }

}
}
 ?>
 
 <!DOCTYPE html>
<html>
    <head>
<title>ajouter</title>
<meta charset="utf"-8>
</head>
<body>
    <form method="POST" action="" align="center">
        <input type ="text" name="email">
        <br>
        <input type ="password" name="password">
        <br><br>
     <input type ="Submit" name="envoie">
</form>
</body>
</html>
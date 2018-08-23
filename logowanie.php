<?php
/**
 * Created by PhpStorm.
 * User: braun
 * Date: 7/5/2018
* Time: 10:51 AM
*/

session_start();
if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
{
    header('Location: polaczenie_zebranie_danych.php')  ;
    exit();
}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>


</head>
<body>

<form action="sprawdzenie_zalogowania.php" method="post" >
    Login: <br/> <input type="text" name="login" /> <br/>
    Haslo: <br/> <input type="password" name="haslo"/><br/>
    <input type="submit" value="Zaloguj sie" />

</form>
<?php
if(isset($_SESSION['blad'])){
    echo $_SESSION['blad'];
}
?>

</body>
</html>
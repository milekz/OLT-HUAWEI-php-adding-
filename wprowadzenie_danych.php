<?php
/**
 * Created by PhpStorm.
 * User: braun
 * Date: 7/5/2018
 * Time: 10:53 AM
 */
session_start();
include_once "funkcje.php";
if($_SESSION['zalogowany']!= true){
    header('Location: zaloguj.php');
    exit();
}
echo "<p>Witaj ".$_SESSION['urzytkownik'];
echo "<br/> <p> <a href='logout.php'>Wyloguj sie</a> ";
echo "<br/> <p> <a href='polaczenie_zebranie_danych.php'>Odswiez</a> ";

$numer_id=1;//$_SESSION['numer_porzatkowy'];
$numer_seryjny=$_SESSION['numer_seryjny'];
$numer_seryjny=str_arr($numer_seryjny);
$porty=$_SESSION['numer_portu'];
$porty=str_arr($porty);


/*

$_SESSION['porty_wejscie'] = tab_grep_adres_urzycie($porty); //porty mozliwe uzyty w wejsciu

$_SESSION['numer_karty'] = numer_karty($porty);  //numer uzyty do dodania
//$_SESSION['']


 // NUMER KONCOWKI KTORA CHCESZ DODAC: <br/>
            //<input type="text" name="nr_przadkowy">


*/

?>

<!DOCTYPE HTML>
<html>
<head>


    <meta charset="utf-8" />
    <meta http-equiv= "X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="stylesheet" type="text/css" href="wyglad.css"  />
</head>
<body>

<div id="container">
    <div id="formularz">

        <form method="post" action="wykonanie.php">


            <br/>OPIS KLIENTA: <br/>
            <input type="text" name="opis_klienta">
            <br/>SERVICE PORT: <br/>
            <input type="text" name="service_port">
            <br/>SRV PROFILE: <br/>
            <input type="text" name="srv_port">
            <br/>LINE PROFILE: <br/>
            <input type="text" name="line_profil">
            <br/>VLAN: <br/>
            <input type="text" name="vlan">
            <input type="submit" value="Zatwierdź - dodaj końcówke">


        </form>


    </div>
    <div class="wyniki_zapytania">
        nr koncowki<br/>
        <?php
        echo "1";
        //wyswietl_tablice($numer_id);
        ?>
    </div>
    <div class="wyniki_zapytania">
        port<br/>
        <?php
        wyswietl_tablice($porty)
        ?>
    </div>
    <div class="wyniki_zapytania">
        nr seryjny<br/>
        <?php
        wyswietl_tablice($numer_seryjny);
        ?>
    </div>
    <div style="clear:both;"></div>
</div>


</body>

</html>

</body>
</html>
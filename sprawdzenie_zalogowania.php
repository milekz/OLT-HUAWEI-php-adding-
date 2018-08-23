<?php

/**
 * Created by PhpStorm.
 * User: braun
 * Date: 2/14/2018
 * Time: 2:13 AM
 */



session_start();
/*
include_once "conn_sql.php";
$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name );

if($polaczenie->connect_errno !=0){
    echo "error ".$polaczenie->connect_errno ;
}
else{



    $sql= "SELECT * FROM pracownicy WHERE login='$name' AND haslo ='$pass'" ;

    if($rezultat = $polaczenie->query($sql)){
        $ilu_userow=$rezultat->num_rows;


        if($ilu_userow ==1 )
        {

            $wiersz = $rezultat->fetch_assoc();
            $_SESSION['zalogowany']=true;
            $_SESSION['id']=$wiersz['id'];
            $_SESSION['urzytkownik']=$wiersz['login'];

            $user = $wiersz['login'];

            unset($_SESSION['blad']);
            $rezultat->close();
            header('Location: olt_conn.php');


        }

*/
@$name = $_POST['login'];
@$pass = $_POST['haslo'];
$login="interplus";
$haslo="123interplus!@#";

if(($name == $login)and ($pass == $haslo)){
    $_SESSION['zalogowany']=true;
    $_SESSION['id']=1;
    $_SESSION['urzytkownik']="inter-plus";
    header('Location: polaczenie_zebranie_danych.php');
}
else {
    $_SESSION['blad']= '<span style="color:red">Nieprawidlowy login lub haslo </span>';

    header('Location: logowanie.php');
}




// $polaczenie->close();


?>
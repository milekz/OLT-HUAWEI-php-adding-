<?php
/**
 * Created by PhpStorm.
 * User: braun
 * Date: 7/5/2018
 * Time: 10:54 AM
 */

require_once "TPHPtelnet.php";
require_once "Tkoncowka.php";
require_once "Tparametry.php";
require_once "funkcje.php";
session_start();
if($_SESSION['zalogowany']!= true){
    header('Location: zaloguj.php');
    exit();
}


$arr_ontadd = array("\r\n","\n","\r","\t");
$adres = '192.168.50.5';
$login = 'testowy';
$haslo = '123testowy!@#';
$polaczenie = new PHPTelnet();
if ($polaczenie == false){
    echo "nie udalo sie polaczyc";
}
//-----------FORMULARZ

//$numer_porzadkowy = 1;//$_POST['nr_id'];
//$numer_porzadkowy=(intval($numer_porzadkowy)-1);
$opis_klienta= $_POST['opis_klienta'];
$service_port=$_POST['service_port'];
$srv_profile=$_POST['srv_port'];
$line_profile=$_POST['line_profil'];
$vlan=$_POST['vlan'];

if (($srv_profile == null) and (($vlan != null) or ($line_profile != null))){
    if($vlan != null){
        $srv_profile =$vlan;

    }
    elseif($line_profile != null){
        $srv_profile =$line_profile;
    }
    else{
        echo "błąd przypisania srv <a href='polaczenie_zebranie_danych.php'>Odswiez<br/></a> ";
    }
}

if ($vlan == null){
    $vlan =$srv_profile;
}
if ($line_profile == null){
    $line_profile =$srv_profile;
}


$tablica = $_SESSION['tablica'];
$port = $_SESSION['numer_portu'];
$idp1=$_SESSION['idp1'];
$numer_seryjny = $_SESSION['numer_seryjny'];
$numer_karty=$_SESSION['numer_karty'];
$port_wejscie=$_SESSION['port_wejscie'];
//--------

echo "$port , $idp1 , $numer_seryjny , $numer_karty , $port_wejscie ";
//--------------
$Koncowka = new Tkoncowka($opis_klienta,$service_port,$srv_profile,$line_profile,$vlan);
$Parametry = new Tparametry($port_wejscie,$numer_karty,$idp1,$numer_seryjny,$port);
$result = $polaczenie->Connect($adres, $login, $haslo);

echo "<br/> <p> <a href='logout.php'>Wyloguj sie</a> ";
echo "<br/> <p> <a href='polaczenie_zebranie_danych.php'>Odswiez<br/></a> ";

//---------KOMENDY PRZYGOTOWUJACE
$polaczenie->DoCommand("enable", $result);
sleep(0.2);
$polaczenie->DoCommand('config', $result);
sleep(0.2);
$polaczenie->DoCommand('undo smart', $result);
sleep(0.2);
$polaczenie->DoCommand('clear terminal user login failure', $result);
sleep(0.2);
$polaczenie->DoCommand('y',$result);

//--------KOMEDNDY DODAJACE

$idp1=23;

$dodawanie_ont1= "interface gpon $numer_karty";
sleep(0.2);
$dodawanie_ont1 = str_replace($arr_ontadd," ",$dodawanie_ont1);
$polaczenie->DoCommand("$dodawanie_ont1", $result);
//echo "$result";
//------------------------------------
$dodawanie_ont2="display ont info $port_wejscie all";
sleep(0.2);
$dodawanie_ont2 = str_replace($arr_ontadd,"",$dodawanie_ont2);
$polaczenie->DoCommand("$dodawanie_ont2", $result);
//echo "$result";
//------------------------------------------
sleep(0.2);
$polaczenie->DoCommand("q", $result);

sleep(0.2);
//$temp = "omci ont-lineprofile-id";
$dodawanie_ont3= "ont add $port_wejscie  $idp1 sn-auth \"$numer_seryjny\" omci ont-lineprofile-id $Koncowka->line_profile ont-srvprofile-id $Koncowka->srv_profile desc \"$Koncowka->opis_klienta\"";
echo "<br/>$dodawanie_ont3<br/>";
$dodawanie_ont3 = str_replace($arr_ontadd,"",$dodawanie_ont3);
$polaczenie->DoCommand("$dodawanie_ont3", $result);
echo "$result";
//-----------------------------------

sleep(0.2);
$dodawanie_ont4 = " ont alarm-profile $port_wejscie $idp1 profile-id 1";

$dodawanie_ont4 = str_replace($arr_ontadd,"",$dodawanie_ont4);
$polaczenie->DoCommand($dodawanie_ont4,$result);
echo "$result";
//--------------------------------------
$dodawanie_ont5=" ont optical-alarm-profile $port_wejscie $idp1 profile-id 1";
sleep(0.2);
$dodawanie_ont5 = str_replace($arr_ontadd,"",$dodawanie_ont5);
$polaczenie->DoCommand($dodawanie_ont5,$result);
echo "$result";
//-------------------------
sleep(0.2);
$dodawanie_ont6="quit";
//$dodawanie_ont6 = str_replace($arr_ontadd,"",$dodawanie_ont6);
$polaczenie->DoCommand($dodawanie_ont6,$result);
echo "$result";
//-----------------------
sleep(0.2);
$dodawanie_ont7=" service-port $Koncowka->service_port vlan $Koncowka->vlan gpon $port ont $idp1 gemport 0 multi-service user-vlan $Koncowka->vlan tag-transform translate inbound traffic-table index 6 outbound traffic-table index 6 ";
$dodawanie_ont7 = str_replace($arr_ontadd,"",$dodawanie_ont7);
$polaczenie->DoCommand($dodawanie_ont7,$result);
echo "$result";

$polaczenie->Disconnect();
?>
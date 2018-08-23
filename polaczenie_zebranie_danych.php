<?php
include_once "TPHPtelnet.php";
include_once "funkcje.php";
session_start();

if($_SESSION['zalogowany']!= true){
    header('Location: logowanie.php');
    exit();
}

else {
    $arr = array("\r\n", "\n", "\r", "\t", "  ",":");

    $adres = '127.0.0.0';
    $login = 'login';
    $haslo = 'password';
    $polaczenie = new PHPTelnet();
    $result = $polaczenie->Connect($adres, $login, $haslo);
    $_SESSION['$result'] = $result;
    $comm = $result;
    $komenda = "enable";
    $polaczenie->DoCommand("$komenda", $result);
    $polaczenie->DoCommand('config', $result);
    $polaczenie->DoCommand('undo smart', $comm);
    $polaczenie->DoCommand('clear terminal user login failure', $comm);
    $polaczenie->DoCommand('display ont autofind all', $comm); //nr portu zwrocony uzywany w nastepnej komendzie po gpon
    $tablica1 = str_arr($comm);

    //echo "-----------<br/>";

    $_SESSION['tablica'] = $tablica1;
   // echo "$tablica1[44]";
    //tablica na wartosci zeby sie dostac do najwiekszej wart
    $wartosci = explode("/", $tablica1[44]);
    //-----------------
    //wartosci do sesji

    //usyskanie numeru karty
    $_SESSION['numer_karty'] = "$wartosci[0]/$wartosci[1]";


    $_SESSION['port_wejscie']=$wartosci[2];
    $_SESSION['numer_portu'] = $tablica1[44];
    $_SESSION['numer_seryjny'] =$tablica1[63];
echo "$tablica1[44],$tablica1[63] ";



 //----------------
    $komenda2 = "interface gpon $wartosci[0]/$wartosci[1]";
    $polaczenie->DoCommand("$komenda2", $comm);
    sleep(0.2);// dostanie sie do najwiekszych wart na karcie
    $komenda3 = "display ont info $wartosci[2] all";
    $komenda3 = str_replace($arr, "", $komenda3);
    $polaczenie->DoCommand("$komenda3", $comm);
    $polaczenie->DoCommand("y", $comm2);
    $polaczenie->DoCommand("y", $comm3);
    $polaczenie->DoCommand("y", $comm4);
    $polaczenie->DoCommand("y", $comm5);
    $polaczenie->DoCommand("y", $comm6);
    $polaczenie->DoCommand("y", $comm7);

echo "$comm <br/>";
echo "$comm2 <br/>";
echo "$comm3 <br/>";
echo "$comm4 <br/>";
echo "$comm5 <br/>";
echo "$comm6 <br/>";
echo "$comm7 <br/>";
//--------------------------------------------------------------
function obrobienie($comm=array()){
    $result = str_replace(':', " ", $comm);
    $tab_z_mozliwym_id = str_arr($result);
    for ($i = 0; $i < 6; $i++)    //usuniecie komendy
    {
        unset($tab_z_mozliwym_id[$i]);
    }
    $nr_id = array();
    $nr_id = tab_grep_id($tab_z_mozliwym_id);

    //wyswietl_tablice($nr_id);
    // if (sizeof($nr_id) == 0) {
    //   $polaczenie->Disconnect();
    // exit;
    //}
    $nr_id = przepisz_tablice($nr_id);
return $nr_id;
}
$tab1 = obrobienie($comm);
$tab2 = obrobienie($comm2);
    $tab3 = obrobienie($comm3);
    $tab4 = obrobienie($comm4);
    $tab5 = obrobienie($comm5);
    $tab6 = obrobienie($comm6);
    $tab7 = obrobienie($comm7);
    $nr_id = array_merge($tab1,$tab2,$tab3,$tab4,$tab5,$tab6,$tab7);



//--------------------------------------------------------------
        $idp1 = (max_var($nr_id)); //posortowana tablica od najmn do najw
        //wyswietl_tablice($idp);
        //$idp1=(intval($idp[sizeof($idp)])+1);
    $idp1=przepisz_tablice($idp1);
    $k=sizeof($idp1)-1;
    //wyswietl_tablice($idp1);
array_unique($idp1);
wyswietl_tablice($idp1);
    //wybieranie najmniejszej wolnej liczyb
    for ($i=0; $i<=$k;$i++){
      if($idp1[$i+1] - $idp1[$i] !=1 and $idp1[$i] != 0 ){
          break;
      }
    };
    $k=$i;
    //echo "$idp1[$k]";

 //------------------
    $idp1[$k] += 1 ; //do najw wart dodanie 1
       // echo "<br/>$idp1[$k]<br/>";
    $_SESSION['idp1']=$idp1[$k];

    $polaczenie->Disconnect();
header('Location: wprowadzenie_danych.php');


}



?>

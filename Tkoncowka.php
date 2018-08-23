<?php
/**
 * Created by PhpStorm.
 * User: braun
 * Date: 7/5/2018
 * Time: 10:55 AM
 */
//dane podane przez osobe dodajaca do olta
class Tkoncowka
{
    public $opis_klienta,$service_port, $srv_profile, $line_profile, $vlan ;



    function __construct($ok,$sep,$srp,$lp,$vl)
    {
        $this ->line_profile =$lp;
        $this->opis_klienta=$ok;
        $this->service_port=$sep;
        $this->srv_profile=$srp;
        $this->vlan=$vl;
    }
}



/*
$port_wejscie_uzywane
$numer_karty_uzywane
$numer_karty_uzywane
$najwieksza_wartosc_uzycie
$numer_seryjny_koniec
$line_profile
$srv_profile
$opis_klienta
$numer_karty_uzywane
$numer_karty_uzywane
$najwieksza_wartosc_uzycie
$service_port
$vlan
$port_ont_dodawanie
$najwieksza_wartosc_uzycie

*/
?>



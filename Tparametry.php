<?php
/**
 * Created by PhpStorm.
 * User: braun
 * Date: 7/5/2018
 * Time: 1:41 PM
 */
class Tparametry
{
    public $port_wejscie;
    public $numer_karty;
    public $idp1;
    public $numer_seryjny;
    public $port;


    function __construct($pw,$nk,$idp,$ns,$po)
    {
        $this-> port_wejscie=$pw;
        $this-> numer_karty=$nk; //  >0/0<
        $this-> idp1=$idp;
        $this-> numer_seryjny=$ns;
        $this-> port=$po;

    }

}
?>
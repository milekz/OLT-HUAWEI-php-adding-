<?php
/**
 * Created by PhpStorm.
 * User: braun
 * Date: 7/5/2018
 * Time: 11:51 AM
 */


function str_arr($x){
    $y=array();
    $y=explode(" ",$x);
    return $y;
}

function wyswietl_tablice($tab){
    $i=1;
    if($tab ==0)
    {
        echo "brak wartosci";
        return;
    }
    else
    foreach ($tab as $wartosc){
        echo "wartosc $i = $wartosc <br/>";
        $i++;
    }
}

function tab_grep_id ($tab_surowa){
    $tab_koncowa=array();
    $tab_koncowa= preg_grep('@^[0-9]{1,2}$@', $tab_surowa);
    return $tab_koncowa;
}

function max_var($tab)
{

    $n = count($tab);
    for($j=0; $j<$n-1; $j++)
    {
        $pmin = $j;
        for($i=$j+1; $i<$n; $i++)
        {
            if($tab[$i] < $tab[$pmin])
            {
                $pmin = $i;
            }
        }
        $x = $tab[$pmin];
        $tab[$pmin] = $tab[$j];
        $tab[$j] = $x;
    }
    return $tab;
}

function przepisz_tablice($tab){
    $tablica=array();
    $i=0;
    foreach ($tab as $t){
        $tablica[$i]=$t;
    $i=+1;
    }
    return $tablica;
}



/*
function swap(&$x,&$y) {
    $tmp=$x;
    $x=$y;
    $y=$tmp;
}

function max_var($tab_ns){
    $i = sizeof($tab_ns);
    for ($j = ($i-1); $j >0; $j--){
        $p =1;
        for( $k=0;$k<$j;$k++){
            if($tab_ns[$k] >$tab_ns[$k+1]){
                swap($tab_ns[$k],$tab_ns[$k+1]);
                $p=0;
            }
            if($p) break;
        }
    }
    return $tab_ns[$i];
}


*/

?>
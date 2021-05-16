<?php
function parseXfield($xfield_str = "")
{
    $xfields = explode('||', $xfield_str);

    $r = [];
    foreach ($xfields as $xfield) {
        $xf = explode("|", $xfield);
        if (count($xf) === 2) {
            $r[$xf[0]] = $xf[1];
        }
    }
    return $r;
}

if(!function_exists('getQuery')){

//    require app_path('Helpers/helpers.php');
//    dd(getQuery($productsQuery));


    function getQuery($sql){
        $query = str_replace(array('?'), array('\'%s\''), $sql->toSql());
        $query = vsprintf($query, $sql->getBindings());
        return $query;
    }
}
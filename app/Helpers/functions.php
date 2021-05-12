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

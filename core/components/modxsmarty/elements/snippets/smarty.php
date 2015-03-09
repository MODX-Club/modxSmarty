<?php
foreach($scriptProperties as $key => $value){
    $modx->smarty->assign($key, $value);
}

return preg_replace("/[ \r\n\t]+$/sm", "", $modx->smarty->fetch($tpl));

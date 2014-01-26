<?php
foreach($scriptProperties as $key => $value){
    $modx->smarty->assign($key, $value);
}

return $modx->smarty->fetch($tpl);
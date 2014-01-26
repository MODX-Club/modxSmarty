<?php

$snippets = array();


$snippet= $modx->newObject('modSnippet');
$snippet->fromArray(array(
    'name' => 'smarty',
    'description' => 'Include Smarty-template',
    'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/smarty.php'),
),'',true,true);
$snippets[] = $snippet;


return $snippets;
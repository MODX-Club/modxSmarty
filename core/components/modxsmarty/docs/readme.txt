modxSmarty
============================================

Using MODX-elements via Smarty
==============================

 
System variable
---------------
{config name="configName"}

Example
{config name="site_name"}
return $modx->getOption('site_name')


Placeholder
-----------
{px name="configName"}


Snippet
-------
{snippet name="SnippetName" scriptProperties="var=`value`&var2=`value`" parse="true"}

parse - not necessary. If set 'true', output will be parset by MODX-parser. Default - false

scriptProperties - not necessary. Can use String or Array.

Example 1
PHP: $modx->smarty->assign('params', array("param1" => "value", "param2" => "value",))
Template: {snippet name="test" scriptproperties=$params}

Example 2
{snippet name="test" assign=params}{snippet name="test2" scriptProperties=$params nocache}


Chunk
-----
{chunk name="ChunkName" scriptProperties="var=`value`&var2=`value`" noparse="true"}

noparse - not necessary. If set 'true', output will not be parset by MODX-parser. Default - false

scriptProperties - not necessary. Can use String or Array.


Parser
------
{parser content="some content with MODX-tags"}
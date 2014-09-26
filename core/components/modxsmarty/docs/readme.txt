modxSmarty 0.0.4-beta.
=================================================

Using MODX-elements via Smarty


Snippet
=====================

{snippet name="SnippetName" params="var=`value`&var2=`value`" parse="true"}

parse - not necessary. If set 'true', output will be parsed by MODX-parser. Default - false

params - not necessary. Can use String or Array.
Example 1

PHP: $modx->smarty->assign('params', array("param1" => "value", "param2" => "value",))

Template: {snippet name="test" params=$params}
Example 2

{snippet name="test" assign=params}{snippet name="test2" params=$params nocache}


Chunk
===================

{chunk name="ChunkName" params="var=`value`&var2=`value`" noparse="true"}

noparse - not necessary. If set 'true', output will not be parsed by MODX-parser. Default - false

params - not necessary. Can use String or Array.
System variable

{config name="configName"}
Example

{config name="site_name"}

return $modx->getOption('site_name')


Placeholder
===================

{ph name="configName"}
Field

{field name="modResourceFieldName"}
Link

{link id="modResourceID"}
TV

{tv name="TvName" contentid="modResourceID" parse="true"}

contentid - not necessary. If not specified, will be used current modResource.

parse - not necessary. If set 'true', output will be parsed by MODX-parser. Default - false


Parser
===================

{parser content="some content with MODX-tags"}


Processor
===================

{processor action="web/menu/getcatalogmenu" location=path ns="npghardwarestore" params="foo=`foo`"}
return $modx->runProcessor();

action - required.

ns (namespace) - optionaly. If set, path for namespace_core_path/processors/ will be created automaticly

location - optionaly. See MODx::runProcessor manual.

params - optionaly. $scriptPproperties.


Addition params
===================================================
You can set this params for all this tags


assign
===================

{chunk name=chunk_name assign=param}
Assign chunk result to var $param.


nocache
===================

{chunk name=chunk_name nocache}
If Smarty caching enabled, this tag will be no-cached.

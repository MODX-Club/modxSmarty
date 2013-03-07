<!doctype html>
<html>
<head>
    <title>{config name="site_name"} | Sample Smarty template 0.0.4-beta</title>
    <link type="text/css" rel="stylesheet" href="{config name="assets_url"}components/modxsmarty/templates/default/css/style.css" />
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <h1>modxSmarty 0.0.4-beta. Sample Smarty template</h1>
        </div>
        <div class="body">
            <h2>Using MODX-elements via Smarty</h2>
                
            <div class="block">{literal}
                <h3>Snippet</h3>
                <p class="sample">{snippet name="SnippetName" params="var=`value`&var2=`value`"  parse="true"}</p>
                <div class="info">
                    <p><strong>parse</strong> - not necessary. If set 'true', output will be parsed by MODX-parser. Default - false</p>
                    <p><strong>params</strong> - not necessary. Can use String or Array.</p>
                    <h4>Example 1</h4>
                    <p>PHP: $modx->smarty->assign('params', array("param1" => "value", "param2" => "value",))</p>
                    <p>Template: {snippet name="test" params=$params}</p>
                    <h4>Example 2</h4>
                    <p>{snippet name="test" assign=params}{snippet name="test2" params=$params nocache}</p>
                </div>
                {/literal}
            </div>
                
            <div class="block">{literal}
                <h3>Chunk</h3>
                <p class="sample">{chunk name="ChunkName" params="var=`value`&var2=`value`" noparse="true"}</p>
                <div class="info">
                    <p><strong>noparse</strong> - not necessary. If set 'true', output will not be parsed by MODX-parser. Default - false</p>
                    <p><strong>params</strong> - not necessary. Can use String or Array.</p>
                </div>{/literal}
            </div> 
            
            <div class="block">{literal}
                <h3>System variable</h3>
                <p class="sample">{config name="configName"}</p>
                <div class="info">
                    <h4>Example</h4>
                    <p>{config name="site_name"}</p>
                    <p>return $modx->getOption('site_name')</p>
                </div>
                {/literal}
            </div>
            
            <div class="block">{literal}
                <h3>Placeholder</h3>
                <p class="sample">{px name="configName"}</p>
                <div class="info">
                </div>
                {/literal}
            </div>
            
            <div class="block">{literal}
                <h3>Field</h3>
                <p class="sample">{field name="modResourceFieldName"}</p>
                <div class="info">
                </div>
                {/literal}
            </div>
            
            <div class="block">{literal}
                <h3>Link</h3>
                <p class="sample">{link id="modResourceID"}</p>
                <div class="info">
                </div>
                {/literal}
            </div>
                
            <div class="block">{literal}
                <h3>TV</h3>
                <p class="sample">{tv name="TvName" contentid="modResourceID" parse="true"}</p>
                <div class="info">
                    <p><strong>contentid</strong> - not necessary. If not specified, will be used current modResource.</p>
                    <p><strong>parse</strong> - not necessary. If set 'true', output will be parsed by MODX-parser. Default - false</p>
                </div>{/literal}
            </div> 
            
            
            <div class="block">{literal}
                <h3>Parser</h3>
                <p class="sample">{parser content="some content with MODX-tags"}</p>
                <div class="info"></div>
                {/literal}
            </div> 
            
            
            <div class="block">{literal}
                <h3>Processor</h3>
                <p class="sample">{processor action="web/menu/getcatalogmenu" location=path ns="npghardwarestore" params="foo=`foo`"}</p>
                <div class="info">return $modx->runProcessor();
                    <p><strong>action</strong> - required.</p>
                    <p><strong>ns</strong> (namespace) - optionaly. If set, path for namespace_core_path/processors/ will be created automaticly</p>
                    <p><strong>location</strong> - optionaly. See MODx::runProcessor manual.</p>
                    <p><strong>params</strong> - optionaly. $scriptPproperties.</p>
                </div>
                {/literal}
            </div> 
            
            <h2>Addition params</h2>
            <div class="block">You can set this params for all this tags</div>
            <div class="block">{literal}
                <h3>assign</h3>
                <p class="sample">{chunk name=chunk_name assign=param}</p>
                <div class="info">Assign chunk result to var $param.
                </div>
                {/literal}
            </div> 
            <div class="block">{literal}
                <h3>nocache</h3>
                <p class="sample">{chunk name=chunk_name nocache}</p>
                <div class="info">If Smarty caching enabled, this tag will be no-cached.
                </div>
                {/literal}
            </div> 
        </div>
            
        <div class="footer"></div>
    </div>
</body>
</html>
<!doctype html>
<html>
<head>
    <title>{config name="site_name"} | Sample Smarty template</title>
    <link type="text/css" rel="stylesheet" href="{config name="assets_url"}components/modxsmarty/templates/default/css/style.css" />
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <h1>modxSmarty Extra. Sample Smarty template</h1>
        </div>
        <div class="body">
            <h2>Using MODX-elements via Smarty</h2>
            
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
                <h3>Snippet</h3>
                <p class="sample">{snippet name="SnippetName" scriptProperties="var=`value`&var2=`value`"  parse="true"}</p>
                <div class="info">
                    <p><strong>parse</strong> - not necessary. If set 'true', output will be parset by MODX-parser. Default - false</p>
                    <p><strong>scriptProperties</strong> - not necessary. Can use String or Array.</p>
                    <h4>Example 1</h4>
                    <p>PHP: $modx->smarty->assign('params', array("param1" => "value", "param2" => "value",))</p>
                    <p>Template: {snippet name="test" scriptproperties=$params}</p>
                    <h4>Example 2</h4>
                    <p>{snippet name="test" assign=params}{snippet name="test2" scriptProperties=$params nocache}</p>
                </div>
                {/literal}
            </div>
                
            <div class="block">{literal}
                <h3>Chunk</h3>
                <p class="sample">{chunk name="ChunkName" scriptProperties="var=`value`&var2=`value`" noparse="true"}</p>
                <div class="info">
                    <p><strong>noparse</strong> - not necessary. If set 'true', output will not be parset by MODX-parser. Default - false</p>
                    <p><strong>scriptProperties</strong> - not necessary. Can use String or Array.</p>
                </div>{/literal}
            </div>
            
            
            <div class="block">{literal}
                <h3>Parser</h3>
                <p class="sample">{parser content="some content with MODX-tags"}</p>
                <div class="info"></div>
                {/literal}
            </div> 
        </div>
            
        <div class="footer"></div>
    </div>
</body>
</html>
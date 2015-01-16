<?php

require_once dirname(dirname(dirname(__FILE__))) . '/external/smarty/libs/Smarty.class.php';

class modxSmarty extends Smarty {
    /**
     * A reference to the modX instance
     * @var modX
     * @access protected
     */
    public $modx= null;
    /**
     * A reference to the Smarty instance
     * @var Smarty
     * @access protected
     */
    public $smarty;
    /**
     * Any custom blocks loaded
     * @var array
     * @access private
     */
    public $_blocks;
    /**
     * The derived block loaded
     * @var mixed
     * @access private
     */
    public $_derived;

    /**
     * @param modX $modx A reference to the modX object
     * @param array $params An array of configuration parameters
     */
    function __construct(modX &$modx, $params= array ()) {
        $this->modx= & $modx;

        /* set up configuration variables for Smarty. */
        $this->template_dir = $modx->getOption('manager_path') . 'templates/';
        # $this->compile_dir  = $modx->getOption(xPDO::OPT_CACHE_PATH) . 'mgr/smarty/';
        $this->config_dir   = $modx->getOption('core_path') . 'model/smarty/configs';
        $this->plugins_dir  = array(
            $this->modx->getOption('core_path') . 'model/smarty/plugins',
        );
        $this->caching = false;
 

        foreach ($params as $paramKey => $paramValue) {
            $this->$paramKey= $paramValue;
        }

        # if (!is_dir($this->compile_dir)) {
        #     $this->modx->getCacheManager();
        #     $this->modx->cacheManager->writeTree($this->compile_dir);
        # }

        $this->assign('app_name','MODX');

        $this->_blocks = array();
        $this->_derived = null;
        
        parent :: __construct();
    }

    /**
     * Sets the cache path for this Smarty instance
     *
     * @access public
     * @param string $path The path to set. Defaults to '', which in turn
     * defaults to $this->modx->cachePath.
     */
    public function setCachePath($path = '') {
        $path = $this->modx->getOption(xPDO::OPT_CACHE_PATH).$path;
        if (!is_dir($path)) {
            $this->modx->getCacheManager();
            $this->modx->cacheManager->writeTree($path);
        }
        $this->compile_dir = $path;
    }

    /**
     * Sets the template path for this Smarty instance
     *
     * @access public
     * @param string $path The path to set.
     * @return boolean True if successful
     */
    public function setTemplatePath($path = '') {
        if ($path == '') return false;

        $this->template_dir = $path;
        return true;
    }

    /**
     * Display a template by echoing the output of a Smarty::fetch().
     *
     * @param string|object $template the resource handle of the template file or template object
     * @param mixed $cache_id cache id to be used with this template
     * @param mixed $compile_id compile id to be used with this template
     * @param object $parent next higher level of Smarty variables
     */
    public function display($template = NULL, $cache_id = NULL, $compile_id = NULL, $parent = NULL) {
        echo $this->fetch($template, $cache_id, $compile_id, $parent);
    }
}


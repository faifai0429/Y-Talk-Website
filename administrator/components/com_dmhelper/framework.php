<?php

	/**
     * DM Digital Framework for Joomla! extensions
     *
	 * @copyright		(C)2013 DM Digital S.r.l
	 * @author 			DM Digital <support@dmjoomlaextensions.com>
	 * @link		    http://www.dmjoomlaextensions.com
	 * @license 		GNU/LGPL http://www.gnu.org/copyleft/gpl.html
	 **/
	
	defined('_JEXEC') or die('Restricted access');
	
	if (!defined('DS') && defined(DIRECTORY_SEPARATOR)) {
		define('DS', DIRECTORY_SEPARATOR);
	} else if (!defined('DS')) {
		define('DS', '/');
	}
	
	if (version_compare(JVERSION, '3.0', 'ge')) {
        define('DMVERSION', 30);
    } else if (version_compare(JVERSION, '2.5', 'ge')) {
        define('DMVERSION', 25);
    } else {
        define('DMVERSION', 16);
    }
    
    define('DMHELPER_PATH', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_dmhelper');
	
	require(DMHELPER_PATH . DS . 'core' . DS . 'main.php');
	require(DMHELPER_PATH . DS . 'core' . DS . 'compatibility.php');
	
	require(DMHELPER_PATH . DS . 'helpers' . DS . 'data.php');
	require(DMHELPER_PATH . DS . 'helpers' . DS . 'input.php');
	require(DMHELPER_PATH . DS . 'helpers' . DS . 'html.php');
    require(DMHELPER_PATH . DS . 'helpers' . DS . 'image.php');

?>
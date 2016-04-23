<?php
	
	/**
	* @copyright		(C)2013 DM Digital S.r.l
	* @author 			DM Digital <support@dmjoomlaextensions.com>
	* @link				http://www.dmjoomlaextensions.com
	* @license 			GNU/LGPL http://www.gnu.org/copyleft/gpl.html
	**/
	
	defined('_JEXEC') or die('Restricted access');
	
	class DMHelper {
		
		/**
		 * Used to include non-default resource
		 *
		 * @param string $name the resource name composed by res_type.res_name
		 */
		public static function import($name) {
			
			$name = explode('.', $name);
			$path = DMHELPER_PATH . DS . $name[0] . DS . $name[1] . '.php';
			if (file_exists($path)) {
				require_once($path);
			}
		}
		
	}
	
?>
<?php
	
	/**
	* @copyright		(C)2013 DM Digital S.r.l
	* @author 			DM Digital <support@dmjoomlaextensions.com>
	* @link				http://www.dmjoomlaextensions.com
	* @license 			GNU/LGPL http://www.gnu.org/copyleft/gpl.html
	**/

	defined('_JEXEC') or die('Restricted access');

	class com_dmhelperInstallerScript {
		
		public function install($parent) {
		}
		
		public function uninstall($parent) {
		}
		
		public function update($parent) {
		}
		
		public function preflight($type, $parent) {
		}
		
		public function postflight($type, $parent) {

            $db = JFactory::getDbo();
            $db->setQuery('DELETE FROM #__menu WHERE title = "com_dmhelper"');
            $db->query();
		}
		
	}
	
?>
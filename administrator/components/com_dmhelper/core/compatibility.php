<?php
	
	/**
	* @copyright		(C)2013 DM Digital S.r.l
	* @author 			DM Digital <support@dmjoomlaextensions.com>
	* @link				http://www.dmjoomlaextensions.com
	* @license 			GNU/LGPL http://www.gnu.org/copyleft/gpl.html
	**/
	
	defined('_JEXEC') or die('Restricted access');
	jimport('joomla.application.component.controller');
	jimport('joomla.application.component.view');
	
	
    /**
     * Temporaneous compatibility Classes
     **/

	if (DMVERSION == 30) {
	    
	    class DMTempController extends JControllerLegacy {
	        
	        public function display($cachable = false, $urlparams = array()) {
	        	parent::display($cachable, $urlparams);
	        }
	    }
	    
	} else {
	    
	    class DMTempController extends JController {
	    	
	    	public function display($cachable = false, $urlparams = false) {
	        	parent::display($cachable, $urlparams);
	        }
	    }
	    
	}
	
	if (DMVERSION == 30) {
	    
	    class DMTempView extends JViewLegacy { }
	    
	} else {
	    
	    class DMTempView extends JView { }
	    
	}


    /**
     * DM Classes
     **/

     class DMController extends DMTempController {
	     
     }

     class DMView extends DMTempView {
	     
     }
	
?>
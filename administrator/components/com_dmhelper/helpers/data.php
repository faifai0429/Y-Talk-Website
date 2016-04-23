<?php

	/**
     * TODO: questa è solo una libreria temporanea, richiede un aggiornamento per prepararci al multi DM type (MySQL, PostgreSQL ecc...)
     *
	 * @copyright		(C)2013 DM Digital S.r.l
	 * @author 			DM Digital <support@dmjoomlaextensions.com>
	 * @link			http://www.dmjoomlaextensions.com
	 * @license 		GNU/LGPL http://www.gnu.org/copyleft/gpl.html
	 **/
	
	defined('_JEXEC') or die('Restricted access');
	
	class DMData {

        /**
         * Description needed...
         *
         * @param String $myQuery
         * @return Mixed
         */
        public static function query($myQuery) {
	    	
	    	$db = JFactory::getDBO();
	    	$db->setQuery($myQuery);
	    	$db->query();
	    	if (strpos(' ' . $myQuery, 'INSERT') > 0) {
	    		return $db->insertid();
	    	}
	    }

        /**
         * Description needed...
         *
         * @param String $myQuery
         * @return Mixed
         */
        public static function loadObject($myQuery) {
	    	
	    	$db = JFactory::getDBO();
	    	$db->setQuery($myQuery);
	    	return $db->loadObject();
	    }

        /**
         * Description needed...
         *
         * @param String $myQuery
         * @param String $limitstart
         * @param String $limit
         * @param Int $total
         * @return Mixed
         */
        public static function loadObjectList($myQuery, $limitstart = '', $limit = '', &$total = null) {
	    	
	    	$db = JFactory::getDBO();
            if ($limitstart != '' && $limit != '') {
	            $db->setQuery($myQuery, $limitstart, $limit);
            } else {
                $db->setQuery($myQuery);
            }
	        $results = $db->loadObjectList();
	        if (isset($total)) {
	        	$db->setQuery('SELECT FOUND_ROWS()');
	    	    $total = $db->loadResult();
	        }
	    	return $results;
	    }

        /**
         * Description needed...
         *
         * @param String $myQuery
         * @return Mixed
         */
        public static function loadResult($myQuery) {
	    	
	    	$db = JFactory::getDBO();
	    	$db->setQuery($myQuery);
	    	return $db->loadResult();
	    }
	    
	}

?>
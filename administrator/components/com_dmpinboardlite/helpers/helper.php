<?php

/**
 * @copyright		(C)2013 DM Digital S.r.l
 * @author 			DM Digital <support@dmjoomlaextensions.com>
 * @link				http://www.dmjoomlaextensions.com
 * @license 			GNU/LGPL http://www.gnu.org/copyleft/gpl.html
 **/

defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.database.tablenested' );
class DMPBHelper {

    public static function createHiddenMenu() {

        $db = JFactory::getDBO();
        $myQuery = 	"
                    INSERT IGNORE INTO #__menu_types (menutype, title, description)
                    VALUES ('dmpinboard-menu-hidden', 'DM Pinboard Menu', 'DM Pinboard hidden menu');
            ";
        $db->setQuery($myQuery);
        $db->query();

        $myQuery = "SELECT *
                        FROM #__categories
                        WHERE level = 1
                        AND extension LIKE 'com_content';
            ";
        $db->setQuery($myQuery);
        $jcategories = $db->loadObjectList();

        if (!empty($jcategories)) {
            foreach ($jcategories as $cat) {

				$cat->title = addslashes($cat->title);

                $myQuery = "INSERT IGNORE INTO #__menu (menutype, title, alias, path, link, type, published, parent_id, level, component_id, access )
                                VALUES ('dmpinboard-menu-hidden', '" . $cat->title ."', '" . $cat->alias ."', '" . $cat->path ."', 'index.php?option=com_content&view=category&id=" . $cat->id . "', 'component', 1, 1, 1, " . self::getComponentId('com_content') . ", 1);
                    ";
                $db->setQuery($myQuery);
                $db->query();
            }
        }

		if (self::isInstalled('com_k2')) {
		    $myQuery = "SELECT *
		                        FROM #__k2_categories
		            ";
		    $db->setQuery($myQuery);
		    $k2categories = $db->loadObjectList();

		    if (!empty($k2categories)) {
		        foreach ($k2categories as $cat) {

					$cat->name = addslashes($cat->name);

		            $json = '{"categories":["' . $cat->id . '"],"singleCatOrdering":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}';
		            $myQuery = "INSERT IGNORE INTO #__menu (menutype, title, alias, path, link, type, published, parent_id, level, component_id, params, access )
		                                VALUES ('dmpinboard-menu-hidden', '" . $cat->name ."', '" . $cat->alias ."', '" . $cat->alias ."', 'index.php?option=com_k2&view=itemlist&layout=category&task=category&id=" . $cat->id . "', 'component', 1, 1, 1, " . self::getComponentId('com_k2') . ", '" . $json  . "', 1);
		                    ";
		            $db->setQuery($myQuery);
		            $db->query();
		        }
		    }
		}

		if (self::isInstalled('com_zoo')) {
		    $myQuery = "SELECT *
		                        FROM #__zoo_category
		            ";
		    $db->setQuery($myQuery);
		    $zoocategories = $db->loadObjectList();

		    if (!empty($zoocategories)) {
		        foreach ($zoocategories as $cat) {
					$cat->name = addslashes($cat->name);

		            $json='{"category":"'.$cat->id.'","application":"'.$cat->application_id.'","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}';
		            $myQuery = "INSERT IGNORE INTO #__menu (menutype, title, alias, path, link, type, published, parent_id, level, component_id, params, access )
		                                VALUES ('dmpinboard-menu-hidden', '" . $cat->name ."', '" . $cat->alias ."', '" . $cat->alias ."', 'index.php?option=com_zoo&view=category&layout=category', 'component', 1, 1, 1, " . self::getComponentId('com_zoo') . ", '" . $json . "', 1);
		                    ";
		            $db->setQuery($myQuery);
		            $db->query();
		        }
		    }
		}

		$db = JFactory::getDBO();
        $menu = new JTableNested('#__menu', 'id', $db);
        $menu->rebuild();
    }

    public static function eraseCache() {

        self::deleteFiles('jcontent');
        self::deleteFiles('k2');
        self::deleteFiles('zoo');
    }

    public static function deleteFiles($source) {

        $jPath = JPATH_SITE . DS . 'media' . DS . 'com_dmpinboard' . DS . 'cache' . DS . $source;
        $jCacheImages = scandir($jPath);

        foreach ($jCacheImages as $image) {
            if ($image != 'index.html' && $image != '.' && $image != '..')
                unlink($jPath . DS . $image);
        }
    }

    public static function getComponentId($name) {

        $myQuery = "SELECT extension_id
                    FROM #__extensions
                    WHERE name LIKE '" . $name . "'
        ";

        return DMData::loadObject($myQuery)->extension_id;
    }

    public static function isInstalled($name) {

        $myQuery = "SELECT *
                    FROM #__extensions
                    WHERE name LIKE '" . $name . "'
        ";

        $result = DMData::loadObject($myQuery);
		if (count($result) > 0) {
			return true;			
		} else {
			return false;		
		}
    }
}

?>

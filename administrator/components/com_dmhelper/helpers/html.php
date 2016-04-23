<?php

	/**
     * Backward compatibility helper for Joomla! HTML elements
     *
	 * @copyright		(C)2013 DM Digital S.r.l
	 * @author 			DM Digital <support@dmjoomlaextensions.com>
	 * @link			http://www.dmjoomlaextensions.com
	 * @license 		GNU/LGPL http://www.gnu.org/copyleft/gpl.html
	 **/
	
	defined('_JEXEC') or die('Restricted access');
	
	class DMHtml {

        /**
         * Description needed...
         *
         * @param String $name
         * @param Array $config
         * @return Mixed
         */
        public static function tabContStart($name, $config) {
    
            if (DMVERSION == 30) {
                if (!isset($config['active'])) {
                    $config['active'] = 'tab1';
                }
                return JHtml::_('bootstrap.startTabSet', $name, $config);
            } else {
                return JHtml::_('tabs.start', $name, $config);
            }
        }

        /**
         * Description needed...
         *
         * @param Resource $tab
         * @param String $name
         * @param String $text
         * @return Mixed
         */
        public static function tabAdd($tab, $name, $text) {
    
            if (DMVERSION == 30) {
                return JHtml::_('bootstrap.addTab', $tab, $name, $text);
            } else {
                return JHtml::_('tabs.panel', $text, $name);
            }
        }

        /**
         * Description needed...
         *
         * @return Mixed
         */
        public static function tabEnd() {
    
            if (DMVERSION == 30) {
                return JHtml::_('bootstrap.endTab');
            } else {
                return '';
            }
        }

        /**
         * Description needed...
         *
         * @return Mixed
         */
        public static function tabContStop() {
    
            if (DMVERSION == 30) {
                return JHtml::_('bootstrap.endTabSet');
            } else {
                return JHtml::_('tabs.end');
            }
        }

        /**
         * Description needed...
         *
         * @param Int $cid
         * @param Int $published
         * @param String $controller
         * @return String
         */
        public static function buttonState($cid, $published, $controller) {
    
            if ($published == 1) {
                $task = 'unpublish';
                $icon = 'publish';
            } else {
                $task = 'publish';
                $icon = 'unpublish';
            }
            $url = JRoute::_('index.php?option=' . JRequest::getCmd('option') . '&controller=' . $controller . '&task=' . $task . '&cid=' . $cid);
            if (DMVERSION == 30) {
                return '<a class="btn btn-micro" href="' . $url . '"><i class="icon-' . $icon . '"></i></a>';
            } else {
                return '<a class="jgrid" href="' . $url . '"><span class="state ' . $icon . '"></span></a>';
            }
        }

        /**
         * Description needed...
         *
         * @param String $name
         * @param Array $config
         * @return Mixed
         */
        public static function sliderContStart($name, $config = array()) {

            if (DMVERSION == 30) {
                if (!isset($config['active'])) {
                    $config['active'] = 'collapse1';
                }
                return JHtml::_('bootstrap.startAccordion', $name, $config);
            } else {
                if (!isset($config['startOffset'])) {
                    $config['startOffset'] = -1;
                }
                return JHtml::_('sliders.start', $name, $config);
            }
        }

        /**
         * Description needed...
         *
         * @param String $cont
         * @param String $name
         * @param Int $i
         * @return Mixed
         */
        public static function addSlider($cont, $name, $i = -1) {

            if (DMVERSION == 30) {
                return JHtml::_('bootstrap.addSlide', $cont, $name, 'collapse' . $i);
            } else {
                return JHtml::_('sliders.panel', $name, $cont);
            }
        }

        /**
         * Description needed...
         *
         * @return Mixed
         */
        public static function endSlider() {

            if (DMVERSION == 30) {
                return JHtml::_('bootstrap.endSlide');
            } else {
                return '';
            }
        }

        /**
         * Description needed...
         *
         * @return Mixed
         */
        public static function sliderContStop() {

            if (DMVERSION == 30) {
                return JHtml::_('bootstrap.endAccordion');
            } else {
                return JHtml::_('sliders.end');
            }
        }
    
    }

?>
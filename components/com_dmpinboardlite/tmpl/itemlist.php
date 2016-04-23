<?php
	
	/**
	* @copyright		(C)2013 DM Digital S.r.l
	* @author 			DM Digital <support@dmjoomlaextensions.com>
	* @link				http://www.dmjoomlaextensions.com
	* @license 			GNU/LGPL http://www.gnu.org/copyleft/gpl.html
	**/
	
	defined('_JEXEC') or die('Restricted access');
	
	if (count($articles) > 0) {
		foreach ($articles as $article) {
			
			echo '<a class="pbitem_cont justadded" '.$article->link.'>';
			
			if (!empty($article->image)) {
				echo '<img src="'.JUri::base().$article->image.'" class="pbitem_image"/>';
			}
			if (!empty($article->title)) {
				echo '<div class="pbitem_title">'.$article->title.'</div>';
			}
			if (!empty($article->intro)) {
				echo '<div class="pbitem_intro">'.$article->intro.'</div>';
			}
			
			echo '</a>';
		}
	}
	
?>
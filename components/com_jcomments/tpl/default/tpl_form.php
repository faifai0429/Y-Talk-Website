<?php

(defined('_VALID_MOS') OR defined('_JEXEC')) or die;

/*
*
* Comments form template
*
*/
class jtt_tpl_form extends JoomlaTuneTemplate
{
	function render() 
	{
		if ($this->getVar('comments-form-message', 0) == 1) {
			$this->getMessage( $this->getVar('comments-form-message-text') );
			return;
		}
		
		if ($this->getVar('comments-form-link', 0) == 1) {
			$this->getCommentsFormLink();
			return;
		}

		$this->getCommentsFormFull();
	}

	/*
	 *
	 * Displays full comments form (with smiles, bbcodes and other stuff)
	 * 
	 */
	function getCommentsFormFull()
	{
		$object_id = $this->getVar('comment-object_id');
		$object_group = $this->getVar('comment-object_group');

		$htmlBeforeForm = $this->getVar('comments-form-html-before');
		$htmlAfterForm = $this->getVar('comments-form-html-after');
?>
<div class="comment-formular">
<h3>Leave a comment</h3>
<?php
		if ($this->getVar( 'comments-form-policy', 0) == 1) {
?>
<div class="comments-policy"><?php echo $this->getVar( 'comments-policy' ); ?></div>
<?php
		}
?>
<?php echo $htmlBeforeForm; ?>
<a id="addcomments" href="#addcomments"></a>
<form id="comments-form" class="validate" name="comments-form" action="javascript:void(null);">
<?php
		if ($this->getVar( 'comments-form-user-name', 1) == 1) {
			$text = ($this->getVar('comments-form-user-name-required', 1) == 0) ? JText::_('FORM_NAME') : JText::_('FORM_NAME_REQUIRED');
?>
<div class="row">

   <div class="col-md-6 col-sm-6 col-md-6 col-xs-12">
   <div class="form-group">
        <label for="name">Name</label>
		<input id="comments-form-name" type="text" class="form-control input-lg required" name="name" value="" maxlength="<?php echo $this->getVar('comment-name-maxlength');?>" size="22" tabindex="1" placeholder="Enter name" />
   </div>	
	
<?php
		}
		if ($this->getVar( 'comments-form-user-email', 1) == 1) {
			$text = ($this->getVar('comments-form-email-required', 1) == 0) ? JText::_('FORM_EMAIL') : JText::_('FORM_EMAIL_REQUIRED');
?>
    <div class="form-group">
        <label for="email">Email</label>
		<input id="comments-form-email" type="text" class="form-control input-lg required email" placeholder="Enter email" name="email" value="" size="22" tabindex="2" />
		
	</div>
  </div>
<?php
		}
		if ($this->getVar('comments-form-user-homepage', 0) == 1) {
			$text = ($this->getVar('comments-form-homepage-required', 1) == 0) ? JText::_('FORM_HOMEPAGE') : JText::_('FORM_HOMEPAGE_REQUIRED');
?>
<p>
	<span>
		<input id="comments-form-homepage" type="text" name="homepage" value="" size="22" tabindex="3" />
		<label for="comments-form-homepage"><?php echo $text; ?></label>
	</span>
</p>
<?php
		}
		if ($this->getVar('comments-form-title', 0) == 1) {
			$text = ($this->getVar('comments-form-title-required', 1) == 0) ? JText::_('FORM_TITLE') : JText::_('FORM_TITLE_REQUIRED');
?>
<p>
	<span>
		<input id="comments-form-title" type="text" name="title" value="" size="22" tabindex="4" />
		<label for="comments-form-title"><?php echo $text; ?></label>
	</span>
</p>
<?php
		}
?>
        <div class="col-md-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
        <label for="message">Message</label>
		<textarea id="comments-form-comment" placeholder="Enter Message" class="form-control input-lg required" name="comment" cols="65" rows="9" tabindex="5"></textarea>
	    </div>
        </div>
        </div>

<div class="row">
 <div class="col-md-12">
    <div class="action form-button medium">
      <div class="mybutton medium">
    
	<div id="comments-form-send"><div><a href="#" tabindex="7" onclick="jcomments.saveComment();return false;" title="<?php echo JText::_('FORM_SEND_HINT'); ?>"><span data-hover="Post comment">Post comment</span></a></div></div>
	<div id="comments-form-cancel" style="display:none;"><div><a href="#" tabindex="8" onclick="return false;" title="<?php echo JText::_('FORM_CANCEL'); ?>"><span data-hover="<?php echo JText::_('FORM_CANCEL'); ?>"><?php echo JText::_('FORM_CANCEL'); ?></span></a></div></div>
	
    </div>
     
    </div>
 </div>

<div>
	<input type="hidden" name="object_id" value="<?php echo $object_id; ?>" />
	<input type="hidden" name="object_group" value="<?php echo $object_group; ?>" />
</div>
</form>
</div>
</div>
<script type="text/javascript">
<!--
function JCommentsInitializeForm()
{
	var jcEditor = new JCommentsEditor('comments-form-comment', true);
<?php
		if ($this->getVar('comments-form-bbcode', 0) == 1) {
			$bbcodes = array( 'b'=> array(0 => JText::_('FORM_BBCODE_B'), 1 => JText::_('BBCODE_HINT_ENTER_TEXT'))
					, 'i'=> array(0 => JText::_('FORM_BBCODE_I'), 1 => JText::_('BBCODE_HINT_ENTER_TEXT'))
					, 'u'=> array(0 => JText::_('FORM_BBCODE_U'), 1 => JText::_('BBCODE_HINT_ENTER_TEXT'))
					, 's'=> array(0 => JText::_('FORM_BBCODE_S'), 1 => JText::_('BBCODE_HINT_ENTER_TEXT'))
					, 'img'=> array(0 => JText::_('FORM_BBCODE_IMG'), 1 => JText::_('BBCODE_HINT_ENTER_FULL_URL_TO_THE_IMAGE'))
					, 'url'=> array(0 => JText::_('FORM_BBCODE_URL'), 1 => JText::_('BBCODE_HINT_ENTER_FULL_URL'))
					, 'hide'=> array(0 => JText::_('FORM_BBCODE_HIDE'), 1 => JText::_('BBCODE_HINT_ENTER_TEXT_TO_HIDE_IT_FROM_UNREGISTERED'))
					, 'quote'=> array(0 => JText::_('FORM_BBCODE_QUOTE'), 1 => JText::_('BBCODE_HINT_ENTER_TEXT_TO_QUOTE'))
					, 'list'=> array(0 => JText::_('FORM_BBCODE_LIST'), 1 => JText::_('BBCODE_HINT_ENTER_LIST_ITEM_TEXT'))
					);

			foreach($bbcodes as $k=>$v) {
				if ($this->getVar('comments-form-bbcode-' . $k , 0) == 1) {
					$title = trim(JCommentsText::jsEscape($v[0]));
					$text = trim(JCommentsText::jsEscape($v[1]));
?>
	jcEditor.addButton('<?php echo $k; ?>','<?php echo $title; ?>','<?php echo $text; ?>');
<?php
				}
			}
		}

		$customBBCodes = $this->getVar('comments-form-custombbcodes');
		if (count($customBBCodes)) {
			foreach($customBBCodes as $code) {
				if ($code->button_enabled) {
					$k = 'custombbcode' . $code->id;
					$title = trim(JCommentsText::jsEscape($code->button_title));
					$text = empty($code->button_prompt) ? JText::_('BBCODE_HINT_ENTER_TEXT') : JText::_($code->button_prompt);
					$open_tag = $code->button_open_tag;
					$close_tag = $code->button_close_tag;
					$icon = $code->button_image;
					$css = $code->button_css;
?>
	jcEditor.addButton('<?php echo $k; ?>','<?php echo $title; ?>','<?php echo $text; ?>','<?php echo $open_tag; ?>','<?php echo $close_tag; ?>','<?php echo $css; ?>','<?php echo $icon; ?>');
<?php
				}
			}
		}

		$smiles = $this->getVar( 'comment-form-smiles' );

		if (isset($smiles)) {
			if (is_array($smiles)&&count($smiles) > 0) {
?>
	jcEditor.initSmiles('<?php echo $this->getVar( "smilesurl" ); ?>');
<?php
				foreach ($smiles as $code => $icon) {
					$code = trim(JCommentsText::jsEscape($code));
					$icon = trim(JCommentsText::jsEscape($icon));
?>
	jcEditor.addSmile('<?php echo $code; ?>','<?php echo $icon; ?>');
<?php
				}
			}
		}
		if ($this->getVar( 'comments-form-showlength-counter', 0) == 1) {
?>
	jcEditor.addCounter(<?php echo $this->getVar('comment-maxlength'); ?>, '<?php echo JText::_('FORM_CHARSLEFT_PREFIX'); ?>', '<?php echo JText::_('FORM_CHARSLEFT_SUFFIX'); ?>', 'counter');
<?php
		}
?>
	jcomments.setForm(new JCommentsForm('comments-form', jcEditor));
}

<?php
	if ($this->getVar('comments-form-ajax', 0) == 1) {
?>
setTimeout(JCommentsInitializeForm, 100);
<?php
	} else {
?>
if (window.addEventListener) {window.addEventListener('load',JCommentsInitializeForm,false);}
else if (document.addEventListener){document.addEventListener('load',JCommentsInitializeForm,false);}
else if (window.attachEvent){window.attachEvent('onload',JCommentsInitializeForm);}
else {if (typeof window.onload=='function'){var oldload=window.onload;window.onload=function(){oldload();JCommentsInitializeForm();}} else window.onload=JCommentsInitializeForm;} 
<?php
	}
?>
//-->
</script>
<?php echo $htmlAfterForm; ?>
<?php
	}

	/*
	 *
	 * Displays link to show comments form
	 *
	 */
	function getCommentsFormLink()
	{
		$object_id = $this->getVar('comment-object_id');
		$object_group = $this->getVar('comment-object_group');
?>
<div id="comments-form-link">
<a id="addcomments" class="showform" href="#addcomments" onclick="jcomments.showForm(<?php echo $object_id; ?>,'<?php echo $object_group; ?>', 'comments-form-link'); return false;"><?php echo JText::_('FORM_HEADER'); ?></a>
</div>
<?php
	}

	/*
	 *
	 * Displays service message
	 *
	 */
	function getMessage( $text )
	{
		if ($text != '') {
?>
<a id="addcomments" href="#addcomments"></a>
<p class="message"><?php echo $text; ?></p>
<?php
		}
	}
}
?>
<?php
namespace PFBC\Element;

class Checksort extends \PFBC\Element\Sort {
	protected $attributes = array("type" => "checkbox");
	protected $inline;
	protected $maxheight;

	public function jQueryDocumentReady() {
		parent::jQueryDocumentReady();	
		if(!empty($this->inline))
			echo 'jQuery("#', $this->attributes["id"], ' .pfbc-checkbox:last").css("margin-right", "0");';

		if(!empty($this->maxheight) && is_numeric($this->maxheight)) {
			echo <<<JS
var checkboxes = jQuery("#{$this->attributes["id"]} .pfbc-checkboxes");
if(checkboxes.outerHeight() > {$this->maxheight}) {
	checkboxes.css({ 
		"height": "{$this->maxheight}px", 
		"overflow": "auto", 
		"overflow-x": "hidden" 
	});
}	
JS;
		}	
	}
	
	public function render() { 
		if(isset($this->attributes["value"])) {
			if(!is_array($this->attributes["value"]))
				$this->attributes["value"] = array($this->attributes["value"]);
		}
		else
			$this->attributes["value"] = array();
		
		$count = 0;
		echo '<div id="', $this->attributes["id"], '"><div class="pfbc-checkboxes">';
		foreach($this->options as $value => $text) {
			echo '<div class="pfbc-checkbox"><table cellpadding="0" cellspacing="0"><tr><td valign="top"><input id="', $this->attributes["id"], "-", $count, '"', $this->getAttributes(array("id", "value", "checked", "name", "onclick")), ' value="', $this->filter($value), '"';
			if(in_array($value, $this->attributes["value"]))
				echo ' checked="checked"';
			echo ' onclick="updateChecksort(this, \'', $this->filter($text), '\');"/></td><td><label for="', $this->attributes["id"], "-", $count, '">', $text, '</label></td></tr></table></div>';
			++$count;
		}	
		echo '</div>';

		if(!empty($this->inline))
			echo '<div style="clear: both;"></div>';

		echo '<ul>';
		foreach($this->attributes["value"] as $value)
			echo '<li id="', $this->attributes["id"], "-sort-", $count, '" class="ui-state-default"><input type="hidden" name="', $this->attributes["name"], '" value="', $value, '"/>', $this->options[$value], '</li>';
		echo '</ul></div>';
	}

	function renderJS() {
		echo <<<JS
if(typeof updateChecksort != "function") {		
	function updateChecksort(element, text) {
		var position = element.id.lastIndexOf("-");
		var id = element.id.substr(0, position);
		var index = element.id.substr(position + 1);
		if(element.checked)
			jQuery("#" + id + " ul").append('<li id="' + id + '-sort-' + index + '" class="ui-state-default"><input type="hidden" name="' + id + '[]" value="' + element.value + '"/>' + text + '</li>');
		else
			jQuery("#" + id + "-sort-" + index).remove();
	}
}
JS;
	}

	function renderCSS() {
		if(!empty($this->inline))
			echo '#', $this->attributes["id"], ' .pfbc-checkbox { float: left; margin-right: 0.5em; }';
		parent::renderCSS();
	}
}
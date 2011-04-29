<?php
error_reporting(E_ALL);
session_start();
include("../class.form.php");

if(isset($_POST["cmd"]) && in_array($_POST["cmd"], array("submit_0", "submit_1"))) {
	$form = new form("formelements_" . substr($_POST["cmd"], -1));
	if($form->validate()) {
		//The form has passed validation.  We can now move forward with any necessary processing.
		$form->setError("Congratulations! The information you enter passed the form's validation.");
	}
	else {
		/*One or more validation errors were found.  These errors have been saved in the session 
		and will automatically be displayed after redirecting back to the form.*/ 
	}	

	header("Location: form-elements.php");
	exit();
}
elseif(!isset($_GET["cmd"]) && !isset($_POST["cmd"])) {
	$title = "All Supported Form Elements";
	include("../header.php");
	?>

	<p><b>All Supported Form Elements</b> - This example demonstrates all 26 supported form element types: hidden, textbox, textarea, webeditor, password, file, date, daterange, expdate, state, country, yesno, truefalse, select, radio, checkbox, latlng,
	sort, checksort, captcha, slider, html, color, email, htmlexternal, button.  More information on each of these form elements can be found in the <a href="../documentation/index.php#Form-Elements">Supported Form Elements section of the documentation</a>.</p>

	<?php
	$form = new form("formelements_0", 400);
	$form->addHidden("cmd", "submit_0");
	$form->addTextbox("Textbox:", "MyTextbox");
	$form->addTextarea("Textarea:", "MyTextarea");
	$form->addPassword("Password:", "MyPassword");
	$form->addFile("File:", "MyFile");
	$form->addDate("Date:", "MyDate");
	$form->addDateRange("Date Range:", "MyDateRange");
	$form->addExpDate("Expiration Date:", "MyExpDate");
	$form->addState("State:", "MyState");
	$form->addCountry("Country:", "MyCountry");
	$form->addYesNo("Yes/No:", "MyYesNo");
	$form->addTrueFalse("True/False:", "MyTrueFalse");
	$form->addSelect("Select Box:", "MySelect", "", array("Option #0", "Option #1", "Option #2"));
	$form->addRadio("Radio Buttons:", "MyRadio", "", array("Option #0", "Option #1", "Option #2"));
	$form->addCheckbox("Checkboxes:", "MyCheckbox", "", array("Option #0", "Option #1", "Option #2"));
	$form->addLatLng("Latitude/Longitude:", "MyLatitudeLongitude");
	$form->addSort("Sort:", "MySort", array("Option #0", "Option #1", "Option #2"));
	$form->addCheckSort("Checksort:", "MyChecksort", "", array("Option #0", "Option #1", "Option #2"));
	$form->addCaptcha("Captcha:");
	$form->addSlider("Slider:", "MySlider");
	$form->addHTML("HTML:");
	$form->addColor("Color:", "MyColor");
	$form->addEmail("Email:", "MyEmail");
	$form->addHTMLExternal("External HTML:");
	$form->addButton();
	$form->render();
	?>

	<br/><br/>

	<?php
	$form = new form("formelements_1", 850);
	$form->setAttributes(array(
		"noAutoFocus" => 1,
		"preventJQueryLoad" => 1,
		"preventJQueryUILoad" => 1
	));	
	$form->addHidden("cmd", "submit_1");
	$form->addWebEditor("Web Editor - TinyMCE:", "MyWebEditor");
	$form->addCKEditor("Web Editor - CKEditor:", "MyCKEditor");
	$form->addButton();
	$form->render();

	echo '<pre>', highlight_string('<?php
$form = new form("formelements_0", 400);
$form->addHidden("cmd", "submit_0");
$form->addTextbox("Textbox:", "MyTextbox");
$form->addTextarea("Textarea:", "MyTextarea");
$form->addPassword("Password:", "MyPassword");
$form->addFile("File:", "MyFile");
$form->addDate("Date:", "MyDate");
$form->addDateRange("Date Range:", "MyDateRange");
$form->addExpDate("Expiration Date:", "MyExpDate");
$form->addState("State:", "MyState");
$form->addCountry("Country:", "MyCountry");
$form->addYesNo("Yes/No:", "MyYesNo");
$form->addTrueFalse("True/False:", "MyTrueFalse");
$form->addSelect("Select Box:", "MySelect", "", array("Option #0", "Option #1", "Option #2"));
$form->addRadio("Radio Buttons:", "MyRadio", "", array("Option #0", "Option #1", "Option #2"));
$form->addCheckbox("Checkboxes:", "MyCheckbox", "", array("Option #0", "Option #1", "Option #2"));
$form->addLatLng("Latitude/Longitude:", "MyLatitudeLongitude");
$form->addSort("Sort:", "MySort", array("Option #0", "Option #1", "Option #2"));
$form->addCheckSort("Checksort:", "MyChecksort", "", array("Option #0", "Option #1", "Option #2"));
$form->addCaptcha("Captcha:");
$form->addSlider("Slider:", "MySlider");
$form->addHTML("HTML:");
$form->addColor("Color:", "MyColor");
$form->addEmail("Email:", "MyEmail");
$form->addHTMLExternal("External HTML:");
$form->addButton();
$form->render();
?>

<br/><br/>

<?php
$form = new form("formelements_1", 850);
$form->addHidden("cmd", "submit_1");
$form->addWebEditor("Web Editor - TinyMCE:", "MyWebEditor");
$form->addCKEditor("Web Editor - CKEditor:", "MyCKEditor");
$form->addButton();
$form->render();
?>', true), '</pre>';

	include("../footer.php");
}
?>

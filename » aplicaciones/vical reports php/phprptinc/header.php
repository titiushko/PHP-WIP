<?php if (@$gsExport == "email") ob_clean(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title></title>
<?php if (@$gsExport == "") { ?>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0/build/button/assets/skins/sam/button.css" />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0/build/container/assets/skins/sam/container.css" />
<?php } ?>
<?php if (@$gsExport == "" || @$gsExport == "print" || @$gsExport == "email") { ?>
<link rel="stylesheet" type="text/css" href="<?php echo EWRPT_PROJECT_STYLESHEET_FILENAME ?>" />
<?php } ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo ewrpt_ConvertFullUrl("vical.ico") ?>" /><link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo ewrpt_ConvertFullUrl("vical.ico") ?>" />
<meta name="generator" content="PHP Report Maker v4.0.0.2" />
</head>
<body class="yui-skin-sam">
<?php if (@$gsExport == "" || @$gsExport == "print" || @$gsExport == "email") { ?>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.0/build/utilities/utilities.js"></script>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.0/build/button/button-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.8.0/build/container/container-min.js"></script>
<script type="text/javascript">
<!--
var EWRPT_LANGUAGE_ID = "<?php echo $gsLanguage ?>";
var EWRPT_DATE_SEPARATOR = "-";
if (EWRPT_DATE_SEPARATOR == "") EWRPT_DATE_SEPARATOR = "/"; // Default date separator

//var EWRPT_EMAIL_EXPORT_BUTTON_SUBMIT_TEXT = "<?php echo ewrpt_EscapeJs(ewrpt_BtnCaption($ReportLanguage->Phrase("SendEmailBtn"))) ?>";
//var EWRPT_BUTTON_CANCEL_TEXT = "<?php echo ewrpt_EscapeJs(ewrpt_BtnCaption($ReportLanguage->Phrase("CancelBtn"))) ?>";

var EWRPT_MAX_EMAIL_RECIPIENT = <?php echo EWRPT_MAX_EMAIL_RECIPIENT ?>;

//-->
</script>
<?php } ?>
<?php if (@$gsExport == "" || @$gsExport == "print" || @$gsExport == "email") { ?>
<script type="text/javascript" src="phprptjs/ewrpt.js"></script>
<script src="phprptjs/x.js" type="text/javascript"></script>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript">
<!--
<?php echo $ReportLanguage->ToJSON() ?>

//-->
</script>
<script type="text/javascript">
var EWRPT_IMAGES_FOLDER = "phprptimages";
</script>
<div class="ewLayout">
	<!-- header (begin) --><!-- *** Note: Only licensed users are allowed to change the logo *** -->
	<div class="ewHeaderRow"><img src="phprptimages/phprptmkrlogo4.png" alt="" border="0" /></div>
	<!-- header (end) -->
	<!-- content (begin) -->
	<!-- navigation -->
	<table cellspacing="0" class="ewContentTable">
		<tr>	
			<td class="ewMenuColumn">
<?php include "menu.php"; ?>
			<!-- left column (end) -->
			</td>
			<td class="ewContentColumn">
<div class="ewLangForm"><form class="ewForm">
<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Language") ?></span>
<select id="language" name="language" class="phpreportmaker" onchange="ewrpt_SubmitLanguageForm(this.form);">
<?php foreach ($EWRPT_LANGUAGE_FILE as $langfile) { ?>
<option value="<?php echo $langfile[0] ?>"<?php if ($gsLanguage == $langfile[0]) echo " selected=\"selected\"" ?>><?php echo $langfile[1] ?></option>
<?php } ?>
</select>
</form></div>
<?php } ?>

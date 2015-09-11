<?php
session_start();
ob_start();
?>
<?php include "phprptinc/config.vical.php"; ?>
<?php include "phprptinc/ewmysql.php"; ?>
<?php include "phprptinc/ewrfn4.php"; ?>
<?php include "phprptinc/ewrusrfn.php"; ?>
<?php

// Global variable for table object
$vidrio = NULL;

//
// Table class for vidrio
//
class crvidrio {
	var $TableVar = 'vidrio';
	var $TableName = 'vidrio';
	var $TableType = 'TABLE';
	var $ShowCurrentFilter = EWRPT_SHOW_CURRENT_FILTER;
	var $FilterPanelOption = EWRPT_FILTER_PANEL_OPTION;
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type

	// Table caption
	function TableCaption() {
		global $ReportLanguage;
		return $ReportLanguage->TablePhrase($this->TableVar, "TblCaption");
	}

	// Session Group Per Page
	function getGroupPerPage() {
		return @$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_grpperpage"];
	}

	function setGroupPerPage($v) {
		@$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_grpperpage"] = $v;
	}

	// Session Start Group
	function getStartGroup() {
		return @$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_start"];
	}

	function setStartGroup($v) {
		@$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_start"] = $v;
	}

	// Session Order By
	function getOrderBy() {
		return @$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_orderby"];
	}

	function setOrderBy($v) {
		@$_SESSION[EWRPT_PROJECT_VAR . "_" . $this->TableVar . "_orderby"] = $v;
	}

//	var $SelectLimit = TRUE;
	var $CODIGO_VIDRIO;
	var $CODIGO_TIPO;
	var $CODIGO_COLOR;
	var $CODIGO_FACTURA;
	var $CANTIDAD_VIDRIO;
	var $PRECIO_VIDRIO;
	var $fields = array();
	var $Export; // Export
	var $ExportAll = TRUE;
	var $UseTokenInUrl = EWRPT_USE_TOKEN_IN_URL;
	var $RowType; // Row type
	var $RowTotalType; // Row total type
	var $RowTotalSubType; // Row total subtype
	var $RowGroupLevel; // Row group level
	var $RowAttrs = array(); // Row attributes

	// Reset CSS styles for table object
	function ResetCSS() {
    	$this->RowAttrs["style"] = "";
		$this->RowAttrs["class"] = "";
		foreach ($this->fields as $fld) {
			$fld->ResetCSS();
		}
	}

	//
	// Table class constructor
	//
	function crvidrio() {
		global $ReportLanguage;

		// CODIGO_VIDRIO
		$this->CODIGO_VIDRIO = new crField('vidrio', 'vidrio', 'x_CODIGO_VIDRIO', 'CODIGO_VIDRIO', '`CODIGO_VIDRIO`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->CODIGO_VIDRIO->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['CODIGO_VIDRIO'] =& $this->CODIGO_VIDRIO;
		$this->CODIGO_VIDRIO->DateFilter = "";
		$this->CODIGO_VIDRIO->SqlSelect = "";
		$this->CODIGO_VIDRIO->SqlOrderBy = "";

		// CODIGO_TIPO
		$this->CODIGO_TIPO = new crField('vidrio', 'vidrio', 'x_CODIGO_TIPO', 'CODIGO_TIPO', '`CODIGO_TIPO`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['CODIGO_TIPO'] =& $this->CODIGO_TIPO;
		$this->CODIGO_TIPO->DateFilter = "";
		$this->CODIGO_TIPO->SqlSelect = "";
		$this->CODIGO_TIPO->SqlOrderBy = "";

		// CODIGO_COLOR
		$this->CODIGO_COLOR = new crField('vidrio', 'vidrio', 'x_CODIGO_COLOR', 'CODIGO_COLOR', '`CODIGO_COLOR`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['CODIGO_COLOR'] =& $this->CODIGO_COLOR;
		$this->CODIGO_COLOR->DateFilter = "";
		$this->CODIGO_COLOR->SqlSelect = "";
		$this->CODIGO_COLOR->SqlOrderBy = "";

		// CODIGO_FACTURA
		$this->CODIGO_FACTURA = new crField('vidrio', 'vidrio', 'x_CODIGO_FACTURA', 'CODIGO_FACTURA', '`CODIGO_FACTURA`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['CODIGO_FACTURA'] =& $this->CODIGO_FACTURA;
		$this->CODIGO_FACTURA->DateFilter = "";
		$this->CODIGO_FACTURA->SqlSelect = "";
		$this->CODIGO_FACTURA->SqlOrderBy = "";

		// CANTIDAD_VIDRIO
		$this->CANTIDAD_VIDRIO = new crField('vidrio', 'vidrio', 'x_CANTIDAD_VIDRIO', 'CANTIDAD_VIDRIO', '`CANTIDAD_VIDRIO`', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->CANTIDAD_VIDRIO->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['CANTIDAD_VIDRIO'] =& $this->CANTIDAD_VIDRIO;
		$this->CANTIDAD_VIDRIO->DateFilter = "";
		$this->CANTIDAD_VIDRIO->SqlSelect = "";
		$this->CANTIDAD_VIDRIO->SqlOrderBy = "";

		// PRECIO_VIDRIO
		$this->PRECIO_VIDRIO = new crField('vidrio', 'vidrio', 'x_PRECIO_VIDRIO', 'PRECIO_VIDRIO', '`PRECIO_VIDRIO`', 4, EWRPT_DATATYPE_NUMBER, -1);
		$this->PRECIO_VIDRIO->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['PRECIO_VIDRIO'] =& $this->PRECIO_VIDRIO;
		$this->PRECIO_VIDRIO->DateFilter = "";
		$this->PRECIO_VIDRIO->SqlSelect = "";
		$this->PRECIO_VIDRIO->SqlOrderBy = "";
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
		} else {
			if ($ofld->GroupingFieldId == 0) $ofld->setSort("");
		}
	}

	// Get Sort SQL
	function SortSql() {
		$sDtlSortSql = "";
		$argrps = array();
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				if ($fld->GroupingFieldId > 0) {
					if ($fld->FldGroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fld->FldExpression, $fld->FldGroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fld->FldExpression . " " . $fld->getSort();
				} else {
					if ($sDtlSortSql <> "") $sDtlSortSql .= ", ";
					$sDtlSortSql .= $fld->FldExpression . " " . $fld->getSort();
				}
			}
		}
		$sSortSql = "";
		foreach ($argrps as $grp) {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $grp;
		}
		if ($sDtlSortSql <> "") {
			if ($sSortSql <> "") $sSortSql .= ",";
			$sSortSql .= $sDtlSortSql;
		}
		return $sSortSql;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`vidrio`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		return ;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	function SqlSelectAgg() {
		return "SELECT  FROM " . $this->SqlFrom();
	}

	function SqlAggPfx() {
		return "";
	}

	function SqlAggSfx() {
		return "";
	}

	function SqlSelectCount() {
		return "SELECT COUNT(*) FROM " . $this->SqlFrom();
	}

	// Sort URL
	function SortUrl(&$fld) {
		return "";
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = "";
		foreach ($this->RowAttrs as $k => $v) {
			if (trim($v) <> "")
				$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
		}
		return $sAtt;
	}

	// Field object by fldvar
	function &fields($fldvar) {
		return $this->fields[$fldvar];
	}

	// Table level events
	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Load Custom Filters event
	function CustomFilters_Load() {

		// Enter your code here	
		// ewrpt_RegisterCustomFilter($this-><Field>, 'LastMonth', 'Last Month', 'GetLastMonthFilter'); // Date example
		// ewrpt_RegisterCustomFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // String example

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//global $MyTable;
		//$MyTable->MyField1->SearchValue = "your search criteria"; // Search value

	}

	// Chart Rendering event
	function Chart_Rendering(&$chart) {

		// var_dump($chart);
	}

	// Chart Rendered event
	function Chart_Rendered($chart, &$chartxml) {

		//var_dump($chart);
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$vidrio_rpt = new crvidrio_rpt();
$Page =& $vidrio_rpt;

// Page init
$vidrio_rpt->Page_Init();

// Page main
$vidrio_rpt->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($vidrio->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php $vidrio_rpt->ShowPageHeader(); ?>
<?php $vidrio_rpt->ShowMessage(); ?>
<?php if ($vidrio->Export == "" || $vidrio->Export == "print" || $vidrio->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($vidrio->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($vidrio->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($vidrio->Export == "" || $vidrio->Export == "print" || $vidrio->Export == "email") { ?>
<?php } ?>
<?php echo $vidrio->TableCaption() ?>
<?php if ($vidrio->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $vidrio_rpt->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $vidrio_rpt->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $vidrio_rpt->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
&nbsp;&nbsp;<a name="emf_vidrio" id="emf_vidrio" href="javascript:void(0);" onclick="ewrpt_EmailDialogShow({lnk:'emf_vidrio',hdr:ewLanguage.Phrase('ExportToEmail')});"><?php echo $ReportLanguage->Phrase("ExportToEmail") ?></a>
<?php } ?>
<br /><br />
<?php if ($vidrio->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($vidrio->Export == "" || $vidrio->Export == "print" || $vidrio->Export == "email") { ?>
<?php } ?>
<?php if ($vidrio->Export == "") { ?>
	</div></td>
	<!-- Left Container (End) -->
	<!-- Center Container - Report (Begin) -->
	<td style="vertical-align: top;" class="ewPadding"><div id="ewCenter" class="phpreportmaker">
	<!-- center slot -->
<?php } ?>
<!-- summary report starts -->
<div id="report_summary">
<table class="ewGrid" cellspacing="0"><tr>
	<td class="ewGridContent">
<!-- Report Grid (Begin) -->
<div class="ewGridMiddlePanel">
<table class="ewTable ewTableSeparate" cellspacing="0">
<?php

// Set the last group to display if not export all
if ($vidrio->ExportAll && $vidrio->Export <> "") {
	$vidrio_rpt->StopGrp = $vidrio_rpt->TotalGrps;
} else {
	$vidrio_rpt->StopGrp = $vidrio_rpt->StartGrp + $vidrio_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($vidrio_rpt->StopGrp) > intval($vidrio_rpt->TotalGrps))
	$vidrio_rpt->StopGrp = $vidrio_rpt->TotalGrps;
$vidrio_rpt->RecCount = 0;

// Get first row
if ($vidrio_rpt->TotalGrps > 0) {
	$vidrio_rpt->GetRow(1);
	$vidrio_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $vidrio_rpt->GrpCount <= $vidrio_rpt->DisplayGrps) || $vidrio_rpt->ShowFirstHeader) {

	// Show header
	if ($vidrio_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
<?php if ($vidrio->Export <> "") { ?>
<?php echo $vidrio->CODIGO_VIDRIO->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($vidrio->SortUrl($vidrio->CODIGO_VIDRIO) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $vidrio->CODIGO_VIDRIO->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $vidrio->SortUrl($vidrio->CODIGO_VIDRIO) ?>',0);"><?php echo $vidrio->CODIGO_VIDRIO->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($vidrio->CODIGO_VIDRIO->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vidrio->CODIGO_VIDRIO->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($vidrio->Export <> "") { ?>
<?php echo $vidrio->CODIGO_TIPO->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($vidrio->SortUrl($vidrio->CODIGO_TIPO) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $vidrio->CODIGO_TIPO->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $vidrio->SortUrl($vidrio->CODIGO_TIPO) ?>',0);"><?php echo $vidrio->CODIGO_TIPO->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($vidrio->CODIGO_TIPO->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vidrio->CODIGO_TIPO->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($vidrio->Export <> "") { ?>
<?php echo $vidrio->CODIGO_COLOR->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($vidrio->SortUrl($vidrio->CODIGO_COLOR) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $vidrio->CODIGO_COLOR->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $vidrio->SortUrl($vidrio->CODIGO_COLOR) ?>',0);"><?php echo $vidrio->CODIGO_COLOR->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($vidrio->CODIGO_COLOR->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vidrio->CODIGO_COLOR->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($vidrio->Export <> "") { ?>
<?php echo $vidrio->CODIGO_FACTURA->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($vidrio->SortUrl($vidrio->CODIGO_FACTURA) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $vidrio->CODIGO_FACTURA->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $vidrio->SortUrl($vidrio->CODIGO_FACTURA) ?>',0);"><?php echo $vidrio->CODIGO_FACTURA->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($vidrio->CODIGO_FACTURA->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vidrio->CODIGO_FACTURA->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($vidrio->Export <> "") { ?>
<?php echo $vidrio->CANTIDAD_VIDRIO->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($vidrio->SortUrl($vidrio->CANTIDAD_VIDRIO) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $vidrio->CANTIDAD_VIDRIO->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $vidrio->SortUrl($vidrio->CANTIDAD_VIDRIO) ?>',0);"><?php echo $vidrio->CANTIDAD_VIDRIO->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($vidrio->CANTIDAD_VIDRIO->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vidrio->CANTIDAD_VIDRIO->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($vidrio->Export <> "") { ?>
<?php echo $vidrio->PRECIO_VIDRIO->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($vidrio->SortUrl($vidrio->PRECIO_VIDRIO) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $vidrio->PRECIO_VIDRIO->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $vidrio->SortUrl($vidrio->PRECIO_VIDRIO) ?>',0);"><?php echo $vidrio->PRECIO_VIDRIO->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($vidrio->PRECIO_VIDRIO->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($vidrio->PRECIO_VIDRIO->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$vidrio_rpt->ShowFirstHeader = FALSE;
	}
	$vidrio_rpt->RecCount++;

		// Render detail row
		$vidrio->ResetCSS();
		$vidrio->RowType = EWRPT_ROWTYPE_DETAIL;
		$vidrio_rpt->RenderRow();
?>
	<tr<?php echo $vidrio->RowAttributes(); ?>>
		<td<?php echo $vidrio->CODIGO_VIDRIO->CellAttributes() ?>>
<div<?php echo $vidrio->CODIGO_VIDRIO->ViewAttributes(); ?>><?php echo $vidrio->CODIGO_VIDRIO->ListViewValue(); ?></div>
</td>
		<td<?php echo $vidrio->CODIGO_TIPO->CellAttributes() ?>>
<div<?php echo $vidrio->CODIGO_TIPO->ViewAttributes(); ?>><?php echo $vidrio->CODIGO_TIPO->ListViewValue(); ?></div>
</td>
		<td<?php echo $vidrio->CODIGO_COLOR->CellAttributes() ?>>
<div<?php echo $vidrio->CODIGO_COLOR->ViewAttributes(); ?>><?php echo $vidrio->CODIGO_COLOR->ListViewValue(); ?></div>
</td>
		<td<?php echo $vidrio->CODIGO_FACTURA->CellAttributes() ?>>
<div<?php echo $vidrio->CODIGO_FACTURA->ViewAttributes(); ?>><?php echo $vidrio->CODIGO_FACTURA->ListViewValue(); ?></div>
</td>
		<td<?php echo $vidrio->CANTIDAD_VIDRIO->CellAttributes() ?>>
<div<?php echo $vidrio->CANTIDAD_VIDRIO->ViewAttributes(); ?>><?php echo $vidrio->CANTIDAD_VIDRIO->ListViewValue(); ?></div>
</td>
		<td<?php echo $vidrio->PRECIO_VIDRIO->CellAttributes() ?>>
<div<?php echo $vidrio->PRECIO_VIDRIO->ViewAttributes(); ?>><?php echo $vidrio->PRECIO_VIDRIO->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$vidrio_rpt->AccumulateSummary();

		// Get next record
		$vidrio_rpt->GetRow(2);
	$vidrio_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<?php if ($vidrio->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="vidriorpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($vidrio_rpt->StartGrp, $vidrio_rpt->DisplayGrps, $vidrio_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="vidriorpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="vidriorpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="vidriorpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="vidriorpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/lastdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpreportmaker">&nbsp;<?php echo $ReportLanguage->Phrase("of") ?> <?php echo $Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Record") ?> <?php echo $Pager->FromIndex ?> <?php echo $ReportLanguage->Phrase("To") ?> <?php echo $Pager->ToIndex ?> <?php echo $ReportLanguage->Phrase("Of") ?> <?php echo $Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($vidrio_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($vidrio_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($vidrio_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($vidrio_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($vidrio_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($vidrio_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($vidrio_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($vidrio_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($vidrio_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($vidrio_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($vidrio->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
</select>
		</span></td>
<?php } ?>
	</tr>
</table>
</form>
</div>
<?php } ?>
</td></tr></table>
</div>
<!-- Summary Report Ends -->
<?php if ($vidrio->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($vidrio->Export == "" || $vidrio->Export == "print" || $vidrio->Export == "email") { ?>
<?php } ?>
<?php if ($vidrio->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($vidrio->Export == "" || $vidrio->Export == "print" || $vidrio->Export == "email") { ?>
<?php } ?>
<?php if ($vidrio->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $vidrio_rpt->ShowPageFooter(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($vidrio->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$vidrio_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crvidrio_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = 'vidrio';

	// Page object name
	var $PageObjName = 'vidrio_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $vidrio;
		if ($vidrio->UseTokenInUrl) $PageUrl .= "t=" . $vidrio->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Export URLs
	var $ExportPrintUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EWRPT_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EWRPT_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EWRPT_SESSION_MESSAGE] .= "<br />" . $v;
		} else {
			$_SESSION[EWRPT_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EWRPT_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p><span class=\"phpreportmaker\">" . $sHeader . "</span></p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p><span class=\"phpreportmaker\">" . $sFooter . "</span></p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $vidrio;
		if ($vidrio->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($vidrio->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($vidrio->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crvidrio_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (vidrio)
		$GLOBALS["vidrio"] = new crvidrio();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'vidrio', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new crTimer();

		// Open connection
		$conn = ewrpt_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $ReportLanguage, $Security;
		global $vidrio;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$vidrio->Export = $_GET["export"];
	}
	$gsExport = $vidrio->Export; // Get export parameter, used in header
	$gsExportFile = $vidrio->TableVar; // Get export file, used in header
	if ($vidrio->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($vidrio->Export == "word") {
		header('Content-Type: application/vnd.ms-word;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;
		global $ReportLanguage;
		global $vidrio;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($vidrio->Export == "email") {
			$sContent = ob_get_contents();
			$this->ExportEmail($sContent);
			ob_end_clean();

			 // Close connection
			$conn->Close();
			header("Location: " . ewrpt_CurrentPage());
			exit();
		}

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			if (!EWRPT_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Initialize common variables
	// Paging variables

	var $RecCount = 0; // Record count
	var $StartGrp = 0; // Start group
	var $StopGrp = 0; // Stop group
	var $TotalGrps = 0; // Total groups
	var $GrpCount = 0; // Group count
	var $DisplayGrps = 3; // Groups per page
	var $GrpRange = 10;
	var $Sort = "";
	var $Filter = "";
	var $UserIDFilter = "";

	// Clear field for ext filter
	var $ClearExtFilter = "";
	var $FilterApplied;
	var $ShowFirstHeader;
	var $Cnt, $Col, $Val, $Smry, $Mn, $Mx, $GrandSmry, $GrandMn, $GrandMx;
	var $TotCount;

	//
	// Page main
	//
	function Page_Main() {
		global $vidrio;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 7;
		$nGrps = 1;
		$this->Val = ewrpt_InitArray($nDtls, 0);
		$this->Cnt = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Smry = ewrpt_Init2DArray($nGrps, $nDtls, 0);
		$this->Mn = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->Mx = ewrpt_Init2DArray($nGrps, $nDtls, NULL);
		$this->GrandSmry = ewrpt_InitArray($nDtls, 0);
		$this->GrandMn = ewrpt_InitArray($nDtls, NULL);
		$this->GrandMx = ewrpt_InitArray($nDtls, NULL);

		// Set up if accumulation required
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

		// Set up groups per page dynamically
		$this->SetUpDisplayGrps();

		// Set up popup filter
		$this->SetupPopup();

		// Extended filter
		$sExtendedFilter = "";

		// Build popup filter
		$sPopupFilter = $this->GetPopupFilter();

		//ewrpt_SetDebugMsg("popup filter: " . $sPopupFilter);
		if ($sPopupFilter <> "") {
			if ($this->Filter <> "")
				$this->Filter = "($this->Filter) AND ($sPopupFilter)";
			else
				$this->Filter = $sPopupFilter;
		}

		// No filter
		$this->FilterApplied = FALSE;

		// Get sort
		$this->Sort = $this->GetSort();

		// Get total count
		$sSql = ewrpt_BuildReportSql($vidrio->SqlSelect(), $vidrio->SqlWhere(), $vidrio->SqlGroupBy(), $vidrio->SqlHaving(), $vidrio->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($vidrio->ExportAll && $vidrio->Export <> "")
		    $this->DisplayGrps = $this->TotalGrps;
		else
			$this->SetUpStartGroup(); 

		// Get current page records
		$rs = $this->GetRs($sSql, $this->StartGrp, $this->DisplayGrps);
	}

	// Accummulate summary
	function AccumulateSummary() {
		$cntx = count($this->Smry);
		for ($ix = 0; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy]++;
				if ($this->Col[$iy]) {
					$valwrk = $this->Val[$iy];
					if (is_null($valwrk) || !is_numeric($valwrk)) {

						// skip
					} else {
						$this->Smry[$ix][$iy] += $valwrk;
						if (is_null($this->Mn[$ix][$iy])) {
							$this->Mn[$ix][$iy] = $valwrk;
							$this->Mx[$ix][$iy] = $valwrk;
						} else {
							if ($this->Mn[$ix][$iy] > $valwrk) $this->Mn[$ix][$iy] = $valwrk;
							if ($this->Mx[$ix][$iy] < $valwrk) $this->Mx[$ix][$iy] = $valwrk;
						}
					}
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = 1; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0]++;
		}
	}

	// Reset level summary
	function ResetLevelSummary($lvl) {

		// Clear summary values
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$cnty = count($this->Smry[$ix]);
			for ($iy = 1; $iy < $cnty; $iy++) {
				$this->Cnt[$ix][$iy] = 0;
				if ($this->Col[$iy]) {
					$this->Smry[$ix][$iy] = 0;
					$this->Mn[$ix][$iy] = NULL;
					$this->Mx[$ix][$iy] = NULL;
				}
			}
		}
		$cntx = count($this->Smry);
		for ($ix = $lvl; $ix < $cntx; $ix++) {
			$this->Cnt[$ix][0] = 0;
		}

		// Reset record count
		$this->RecCount = 0;
	}

	// Accummulate grand summary
	function AccumulateGrandSummary() {
		$this->Cnt[0][0]++;
		$cntgs = count($this->GrandSmry);
		for ($iy = 1; $iy < $cntgs; $iy++) {
			if ($this->Col[$iy]) {
				$valwrk = $this->Val[$iy];
				if (is_null($valwrk) || !is_numeric($valwrk)) {

					// skip
				} else {
					$this->GrandSmry[$iy] += $valwrk;
					if (is_null($this->GrandMn[$iy])) {
						$this->GrandMn[$iy] = $valwrk;
						$this->GrandMx[$iy] = $valwrk;
					} else {
						if ($this->GrandMn[$iy] > $valwrk) $this->GrandMn[$iy] = $valwrk;
						if ($this->GrandMx[$iy] < $valwrk) $this->GrandMx[$iy] = $valwrk;
					}
				}
			}
		}
	}

	// Get count
	function GetCnt($sql) {
		global $conn;
		$rscnt = $conn->Execute($sql);
		$cnt = ($rscnt) ? $rscnt->RecordCount() : 0;
		if ($rscnt) $rscnt->Close();
		return $cnt;
	}

	// Get rs
	function GetRs($sql, $start, $grps) {
		global $conn;
		$wrksql = $sql;
		if ($start > 0 && $grps > -1)
			$wrksql .= " LIMIT " . ($start-1) . ", " . ($grps);
		$rswrk = $conn->Execute($wrksql);
		return $rswrk;
	}

	// Get row values
	function GetRow($opt) {
		global $rs;
		global $vidrio;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$vidrio->CODIGO_VIDRIO->setDbValue($rs->fields('CODIGO_VIDRIO'));
			$vidrio->CODIGO_TIPO->setDbValue($rs->fields('CODIGO_TIPO'));
			$vidrio->CODIGO_COLOR->setDbValue($rs->fields('CODIGO_COLOR'));
			$vidrio->CODIGO_FACTURA->setDbValue($rs->fields('CODIGO_FACTURA'));
			$vidrio->CANTIDAD_VIDRIO->setDbValue($rs->fields('CANTIDAD_VIDRIO'));
			$vidrio->PRECIO_VIDRIO->setDbValue($rs->fields('PRECIO_VIDRIO'));
			$this->Val[1] = $vidrio->CODIGO_VIDRIO->CurrentValue;
			$this->Val[2] = $vidrio->CODIGO_TIPO->CurrentValue;
			$this->Val[3] = $vidrio->CODIGO_COLOR->CurrentValue;
			$this->Val[4] = $vidrio->CODIGO_FACTURA->CurrentValue;
			$this->Val[5] = $vidrio->CANTIDAD_VIDRIO->CurrentValue;
			$this->Val[6] = $vidrio->PRECIO_VIDRIO->CurrentValue;
		} else {
			$vidrio->CODIGO_VIDRIO->setDbValue("");
			$vidrio->CODIGO_TIPO->setDbValue("");
			$vidrio->CODIGO_COLOR->setDbValue("");
			$vidrio->CODIGO_FACTURA->setDbValue("");
			$vidrio->CANTIDAD_VIDRIO->setDbValue("");
			$vidrio->PRECIO_VIDRIO->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $vidrio;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$vidrio->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$vidrio->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $vidrio->getStartGroup();
			}
		} else {
			$this->StartGrp = $vidrio->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$vidrio->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$vidrio->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$vidrio->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $vidrio;

		// Initialize popup
		// Process post back form

		if (ewrpt_IsHttpPost()) {
			$sName = @$_POST["popup"]; // Get popup form name
			if ($sName <> "") {
				$cntValues = (is_array(@$_POST["sel_$sName"])) ? count($_POST["sel_$sName"]) : 0;
				if ($cntValues > 0) {
					$arValues = ewrpt_StripSlashes($_POST["sel_$sName"]);
					if (trim($arValues[0]) == "") // Select all
						$arValues = EWRPT_INIT_VALUE;
					$_SESSION["sel_$sName"] = $arValues;
					$_SESSION["rf_$sName"] = ewrpt_StripSlashes(@$_POST["rf_$sName"]);
					$_SESSION["rt_$sName"] = ewrpt_StripSlashes(@$_POST["rt_$sName"]);
					$this->ResetPager();
				}
			}

		// Get 'reset' command
		} elseif (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];
			if (strtolower($sCmd) == "reset") {
				$this->ResetPager();
			}
		}

		// Load selection criteria to array
	}

	// Reset pager
	function ResetPager() {

		// Reset start position (reset command)
		global $vidrio;
		$this->StartGrp = 1;
		$vidrio->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $vidrio;
		$sWrk = @$_GET[EWRPT_TABLE_GROUP_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayGrps = intval($sWrk);
			} else {
				if (strtoupper($sWrk) == "ALL") { // display all groups
					$this->DisplayGrps = -1;
				} else {
					$this->DisplayGrps = 3; // Non-numeric, load default
				}
			}
			$vidrio->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$vidrio->setStartGroup($this->StartGrp);
		} else {
			if ($vidrio->getGroupPerPage() <> "") {
				$this->DisplayGrps = $vidrio->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $rs, $Security;
		global $vidrio;
		if ($vidrio->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($vidrio->SqlSelectCount(), $vidrio->SqlWhere(), $vidrio->SqlGroupBy(), $vidrio->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$vidrio->Row_Rendering();

		//
		// Render view codes
		//

		if ($vidrio->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// CODIGO_VIDRIO
			$vidrio->CODIGO_VIDRIO->ViewValue = $vidrio->CODIGO_VIDRIO->Summary;

			// CODIGO_TIPO
			$vidrio->CODIGO_TIPO->ViewValue = $vidrio->CODIGO_TIPO->Summary;

			// CODIGO_COLOR
			$vidrio->CODIGO_COLOR->ViewValue = $vidrio->CODIGO_COLOR->Summary;

			// CODIGO_FACTURA
			$vidrio->CODIGO_FACTURA->ViewValue = $vidrio->CODIGO_FACTURA->Summary;

			// CANTIDAD_VIDRIO
			$vidrio->CANTIDAD_VIDRIO->ViewValue = $vidrio->CANTIDAD_VIDRIO->Summary;

			// PRECIO_VIDRIO
			$vidrio->PRECIO_VIDRIO->ViewValue = $vidrio->PRECIO_VIDRIO->Summary;
		} else {

			// CODIGO_VIDRIO
			$vidrio->CODIGO_VIDRIO->ViewValue = $vidrio->CODIGO_VIDRIO->CurrentValue;
			$vidrio->CODIGO_VIDRIO->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// CODIGO_TIPO
			$vidrio->CODIGO_TIPO->ViewValue = $vidrio->CODIGO_TIPO->CurrentValue;
			$vidrio->CODIGO_TIPO->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// CODIGO_COLOR
			$vidrio->CODIGO_COLOR->ViewValue = $vidrio->CODIGO_COLOR->CurrentValue;
			$vidrio->CODIGO_COLOR->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// CODIGO_FACTURA
			$vidrio->CODIGO_FACTURA->ViewValue = $vidrio->CODIGO_FACTURA->CurrentValue;
			$vidrio->CODIGO_FACTURA->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// CANTIDAD_VIDRIO
			$vidrio->CANTIDAD_VIDRIO->ViewValue = $vidrio->CANTIDAD_VIDRIO->CurrentValue;
			$vidrio->CANTIDAD_VIDRIO->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// PRECIO_VIDRIO
			$vidrio->PRECIO_VIDRIO->ViewValue = $vidrio->PRECIO_VIDRIO->CurrentValue;
			$vidrio->PRECIO_VIDRIO->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// CODIGO_VIDRIO
		$vidrio->CODIGO_VIDRIO->HrefValue = "";

		// CODIGO_TIPO
		$vidrio->CODIGO_TIPO->HrefValue = "";

		// CODIGO_COLOR
		$vidrio->CODIGO_COLOR->HrefValue = "";

		// CODIGO_FACTURA
		$vidrio->CODIGO_FACTURA->HrefValue = "";

		// CANTIDAD_VIDRIO
		$vidrio->CANTIDAD_VIDRIO->HrefValue = "";

		// PRECIO_VIDRIO
		$vidrio->PRECIO_VIDRIO->HrefValue = "";

		// Call Row_Rendered event
		$vidrio->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $vidrio;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $vidrio;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$vidrio->setOrderBy("");
				$vidrio->setStartGroup(1);
				$vidrio->CODIGO_VIDRIO->setSort("");
				$vidrio->CODIGO_TIPO->setSort("");
				$vidrio->CODIGO_COLOR->setSort("");
				$vidrio->CODIGO_FACTURA->setSort("");
				$vidrio->CANTIDAD_VIDRIO->setSort("");
				$vidrio->PRECIO_VIDRIO->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$vidrio->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$vidrio->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $vidrio->SortSql();
			$vidrio->setOrderBy($sSortSql);
			$vidrio->setStartGroup(1);
		}
		return $vidrio->getOrderBy();
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $ReportLanguage, $vidrio;
		$sSender = @$_GET["sender"];
		$sRecipient = @$_GET["recipient"];
		$sCc = @$_GET["cc"];
		$sBcc = @$_GET["bcc"];
		$sContentType = @$_GET["contenttype"];

		// Subject
		$sSubject = ewrpt_StripSlashes(@$_GET["subject"]);
		$sEmailSubject = $sSubject;

		// Message
		$sContent = ewrpt_StripSlashes(@$_GET["message"]);
		$sEmailMessage = $sContent;

		// Check sender
		if ($sSender == "") {
			$this->setMessage($ReportLanguage->Phrase("EnterSenderEmail"));
			return;
		}
		if (!ewrpt_CheckEmail($sSender)) {
			$this->setMessage($ReportLanguage->Phrase("EnterProperSenderEmail"));
			return;
		}

		// Check recipient
		if (!ewrpt_CheckEmailList($sRecipient, EWRPT_MAX_EMAIL_RECIPIENT)) {
			$this->setMessage($ReportLanguage->Phrase("EnterProperRecipientEmail"));
			return;
		}

		// Check cc
		if (!ewrpt_CheckEmailList($sCc, EWRPT_MAX_EMAIL_RECIPIENT)) {
			$this->setMessage($ReportLanguage->Phrase("EnterProperCcEmail"));
			return;
		}

		// Check bcc
		if (!ewrpt_CheckEmailList($sBcc, EWRPT_MAX_EMAIL_RECIPIENT)) {
			$this->setMessage($ReportLanguage->Phrase("EnterProperBccEmail"));
			return;
		}

		// Check email sent count
		$emailcount = ewrpt_LoadEmailCount();
		if (intval($emailcount) >= EWRPT_MAX_EMAIL_SENT_COUNT) {
			$this->setMessage($ReportLanguage->Phrase("ExceedMaxEmailExport"));
			return;
		}
		if ($sEmailMessage <> "") {
			if (EWRPT_REMOVE_XSS) $sEmailMessage = ewrpt_RemoveXSS($sEmailMessage);
			$sEmailMessage .= ($sContentType == "url") ? "\r\n\r\n" : "<br><br>";
		}
		$sAttachmentContent = $EmailContent;
		$sAppPath = ewrpt_FullUrl();
		$sAppPath = substr($sAppPath, 0, strrpos($sAppPath, "/")+1);
		if (strpos($sAttachmentContent, "<head>") !== FALSE)
			$sAttachmentContent = str_replace("<head>", "<head><base href=\"" . $sAppPath . "\" />", $sAttachmentContent); // Add <base href> statement inside the header
		else
			$sAttachmentContent = "<base href=\"" . $sAppPath . "\" />" . $sAttachmentContent; // Add <base href> statement as the first statement

		//$sAttachmentFile = $vidrio->TableVar . "_" . Date("YmdHis") . ".html";
		$sAttachmentFile = $vidrio->TableVar . "_" . Date("YmdHis") . "_" . ewrpt_Random() . ".html";
		if ($sContentType == "url") {
			ewrpt_SaveFile(EWRPT_UPLOAD_DEST_PATH, $sAttachmentFile, $sAttachmentContent);
			$sAttachmentFile = EWRPT_UPLOAD_DEST_PATH . $sAttachmentFile;
			$sUrl = $sAppPath . $sAttachmentFile;
			$sEmailMessage .= $sUrl; // send URL only
			$sAttachmentFile = "";
			$sAttachmentContent = "";
		}

		// Send email
		$Email = new crEmail();
		$Email->Sender = $sSender; // Sender
		$Email->Recipient = $sRecipient; // Recipient
		$Email->Cc = $sCc; // Cc
		$Email->Bcc = $sBcc; // Bcc
		$Email->Subject = $sEmailSubject; // Subject
		$Email->Content = $sEmailMessage; // Content
		$Email->AttachmentContent = $sAttachmentContent; // Attachment
		$Email->AttachmentFileName = $sAttachmentFile; // Attachment file name
		$Email->Format = ($sContentType == "url") ? "text" : "html";
		$Email->Charset = EWRPT_EMAIL_CHARSET;
		$EventArgs = array();
		$bEmailSent = FALSE;
		if ($vidrio->Email_Sending($Email, $EventArgs))
			$bEmailSent = $Email->Send();

		// Check email sent status
		if ($bEmailSent) {

			// Update email sent count and write log
			ewrpt_AddEmailLog($sSender, $sRecipient, $sEmailSubject, $sEmailMessage);

			// Sent email success
			$this->setMessage($ReportLanguage->Phrase("SendEmailSuccess"));
		} else {

			// Sent email failure
			$this->setMessage($Email->SendErrDescription);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>

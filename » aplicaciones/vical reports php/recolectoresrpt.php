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
$recolectores = NULL;

//
// Table class for recolectores
//
class crrecolectores {
	var $TableVar = 'recolectores';
	var $TableName = 'recolectores';
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
	var $CODIGO_RECOLECTOR;
	var $NOMBRE_RECOLECTOR;
	var $TELEFONO_RECOLECTOR;
	var $DUI_RECOLECTOR;
	var $NIT_RECOLECTOR;
	var $DIRECCION_RECOLECTOR;
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
	function crrecolectores() {
		global $ReportLanguage;

		// CODIGO_RECOLECTOR
		$this->CODIGO_RECOLECTOR = new crField('recolectores', 'recolectores', 'x_CODIGO_RECOLECTOR', 'CODIGO_RECOLECTOR', '`CODIGO_RECOLECTOR`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['CODIGO_RECOLECTOR'] =& $this->CODIGO_RECOLECTOR;
		$this->CODIGO_RECOLECTOR->DateFilter = "";
		$this->CODIGO_RECOLECTOR->SqlSelect = "";
		$this->CODIGO_RECOLECTOR->SqlOrderBy = "";

		// NOMBRE_RECOLECTOR
		$this->NOMBRE_RECOLECTOR = new crField('recolectores', 'recolectores', 'x_NOMBRE_RECOLECTOR', 'NOMBRE_RECOLECTOR', '`NOMBRE_RECOLECTOR`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['NOMBRE_RECOLECTOR'] =& $this->NOMBRE_RECOLECTOR;
		$this->NOMBRE_RECOLECTOR->DateFilter = "";
		$this->NOMBRE_RECOLECTOR->SqlSelect = "";
		$this->NOMBRE_RECOLECTOR->SqlOrderBy = "";

		// TELEFONO_RECOLECTOR
		$this->TELEFONO_RECOLECTOR = new crField('recolectores', 'recolectores', 'x_TELEFONO_RECOLECTOR', 'TELEFONO_RECOLECTOR', '`TELEFONO_RECOLECTOR`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['TELEFONO_RECOLECTOR'] =& $this->TELEFONO_RECOLECTOR;
		$this->TELEFONO_RECOLECTOR->DateFilter = "";
		$this->TELEFONO_RECOLECTOR->SqlSelect = "";
		$this->TELEFONO_RECOLECTOR->SqlOrderBy = "";

		// DUI_RECOLECTOR
		$this->DUI_RECOLECTOR = new crField('recolectores', 'recolectores', 'x_DUI_RECOLECTOR', 'DUI_RECOLECTOR', '`DUI_RECOLECTOR`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['DUI_RECOLECTOR'] =& $this->DUI_RECOLECTOR;
		$this->DUI_RECOLECTOR->DateFilter = "";
		$this->DUI_RECOLECTOR->SqlSelect = "";
		$this->DUI_RECOLECTOR->SqlOrderBy = "";

		// NIT_RECOLECTOR
		$this->NIT_RECOLECTOR = new crField('recolectores', 'recolectores', 'x_NIT_RECOLECTOR', 'NIT_RECOLECTOR', '`NIT_RECOLECTOR`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['NIT_RECOLECTOR'] =& $this->NIT_RECOLECTOR;
		$this->NIT_RECOLECTOR->DateFilter = "";
		$this->NIT_RECOLECTOR->SqlSelect = "";
		$this->NIT_RECOLECTOR->SqlOrderBy = "";

		// DIRECCION_RECOLECTOR
		$this->DIRECCION_RECOLECTOR = new crField('recolectores', 'recolectores', 'x_DIRECCION_RECOLECTOR', 'DIRECCION_RECOLECTOR', '`DIRECCION_RECOLECTOR`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['DIRECCION_RECOLECTOR'] =& $this->DIRECCION_RECOLECTOR;
		$this->DIRECCION_RECOLECTOR->DateFilter = "";
		$this->DIRECCION_RECOLECTOR->SqlSelect = "";
		$this->DIRECCION_RECOLECTOR->SqlOrderBy = "";
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
		return "`recolectores`";
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
$recolectores_rpt = new crrecolectores_rpt();
$Page =& $recolectores_rpt;

// Page init
$recolectores_rpt->Page_Init();

// Page main
$recolectores_rpt->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($recolectores->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php $recolectores_rpt->ShowPageHeader(); ?>
<?php $recolectores_rpt->ShowMessage(); ?>
<?php if ($recolectores->Export == "" || $recolectores->Export == "print" || $recolectores->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($recolectores->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($recolectores->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($recolectores->Export == "" || $recolectores->Export == "print" || $recolectores->Export == "email") { ?>
<?php } ?>
<?php echo $recolectores->TableCaption() ?>
<?php if ($recolectores->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $recolectores_rpt->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $recolectores_rpt->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $recolectores_rpt->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
&nbsp;&nbsp;<a name="emf_recolectores" id="emf_recolectores" href="javascript:void(0);" onclick="ewrpt_EmailDialogShow({lnk:'emf_recolectores',hdr:ewLanguage.Phrase('ExportToEmail')});"><?php echo $ReportLanguage->Phrase("ExportToEmail") ?></a>
<?php } ?>
<br /><br />
<?php if ($recolectores->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($recolectores->Export == "" || $recolectores->Export == "print" || $recolectores->Export == "email") { ?>
<?php } ?>
<?php if ($recolectores->Export == "") { ?>
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
if ($recolectores->ExportAll && $recolectores->Export <> "") {
	$recolectores_rpt->StopGrp = $recolectores_rpt->TotalGrps;
} else {
	$recolectores_rpt->StopGrp = $recolectores_rpt->StartGrp + $recolectores_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($recolectores_rpt->StopGrp) > intval($recolectores_rpt->TotalGrps))
	$recolectores_rpt->StopGrp = $recolectores_rpt->TotalGrps;
$recolectores_rpt->RecCount = 0;

// Get first row
if ($recolectores_rpt->TotalGrps > 0) {
	$recolectores_rpt->GetRow(1);
	$recolectores_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $recolectores_rpt->GrpCount <= $recolectores_rpt->DisplayGrps) || $recolectores_rpt->ShowFirstHeader) {

	// Show header
	if ($recolectores_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
<?php if ($recolectores->Export <> "") { ?>
<?php echo $recolectores->CODIGO_RECOLECTOR->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($recolectores->SortUrl($recolectores->CODIGO_RECOLECTOR) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $recolectores->CODIGO_RECOLECTOR->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $recolectores->SortUrl($recolectores->CODIGO_RECOLECTOR) ?>',0);"><?php echo $recolectores->CODIGO_RECOLECTOR->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($recolectores->CODIGO_RECOLECTOR->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($recolectores->CODIGO_RECOLECTOR->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($recolectores->Export <> "") { ?>
<?php echo $recolectores->NOMBRE_RECOLECTOR->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($recolectores->SortUrl($recolectores->NOMBRE_RECOLECTOR) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $recolectores->NOMBRE_RECOLECTOR->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $recolectores->SortUrl($recolectores->NOMBRE_RECOLECTOR) ?>',0);"><?php echo $recolectores->NOMBRE_RECOLECTOR->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($recolectores->NOMBRE_RECOLECTOR->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($recolectores->NOMBRE_RECOLECTOR->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($recolectores->Export <> "") { ?>
<?php echo $recolectores->TELEFONO_RECOLECTOR->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($recolectores->SortUrl($recolectores->TELEFONO_RECOLECTOR) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $recolectores->TELEFONO_RECOLECTOR->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $recolectores->SortUrl($recolectores->TELEFONO_RECOLECTOR) ?>',0);"><?php echo $recolectores->TELEFONO_RECOLECTOR->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($recolectores->TELEFONO_RECOLECTOR->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($recolectores->TELEFONO_RECOLECTOR->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($recolectores->Export <> "") { ?>
<?php echo $recolectores->DUI_RECOLECTOR->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($recolectores->SortUrl($recolectores->DUI_RECOLECTOR) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $recolectores->DUI_RECOLECTOR->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $recolectores->SortUrl($recolectores->DUI_RECOLECTOR) ?>',0);"><?php echo $recolectores->DUI_RECOLECTOR->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($recolectores->DUI_RECOLECTOR->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($recolectores->DUI_RECOLECTOR->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($recolectores->Export <> "") { ?>
<?php echo $recolectores->NIT_RECOLECTOR->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($recolectores->SortUrl($recolectores->NIT_RECOLECTOR) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $recolectores->NIT_RECOLECTOR->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $recolectores->SortUrl($recolectores->NIT_RECOLECTOR) ?>',0);"><?php echo $recolectores->NIT_RECOLECTOR->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($recolectores->NIT_RECOLECTOR->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($recolectores->NIT_RECOLECTOR->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($recolectores->Export <> "") { ?>
<?php echo $recolectores->DIRECCION_RECOLECTOR->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($recolectores->SortUrl($recolectores->DIRECCION_RECOLECTOR) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $recolectores->DIRECCION_RECOLECTOR->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $recolectores->SortUrl($recolectores->DIRECCION_RECOLECTOR) ?>',0);"><?php echo $recolectores->DIRECCION_RECOLECTOR->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($recolectores->DIRECCION_RECOLECTOR->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($recolectores->DIRECCION_RECOLECTOR->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$recolectores_rpt->ShowFirstHeader = FALSE;
	}
	$recolectores_rpt->RecCount++;

		// Render detail row
		$recolectores->ResetCSS();
		$recolectores->RowType = EWRPT_ROWTYPE_DETAIL;
		$recolectores_rpt->RenderRow();
?>
	<tr<?php echo $recolectores->RowAttributes(); ?>>
		<td<?php echo $recolectores->CODIGO_RECOLECTOR->CellAttributes() ?>>
<div<?php echo $recolectores->CODIGO_RECOLECTOR->ViewAttributes(); ?>><?php echo $recolectores->CODIGO_RECOLECTOR->ListViewValue(); ?></div>
</td>
		<td<?php echo $recolectores->NOMBRE_RECOLECTOR->CellAttributes() ?>>
<div<?php echo $recolectores->NOMBRE_RECOLECTOR->ViewAttributes(); ?>><?php echo $recolectores->NOMBRE_RECOLECTOR->ListViewValue(); ?></div>
</td>
		<td<?php echo $recolectores->TELEFONO_RECOLECTOR->CellAttributes() ?>>
<div<?php echo $recolectores->TELEFONO_RECOLECTOR->ViewAttributes(); ?>><?php echo $recolectores->TELEFONO_RECOLECTOR->ListViewValue(); ?></div>
</td>
		<td<?php echo $recolectores->DUI_RECOLECTOR->CellAttributes() ?>>
<div<?php echo $recolectores->DUI_RECOLECTOR->ViewAttributes(); ?>><?php echo $recolectores->DUI_RECOLECTOR->ListViewValue(); ?></div>
</td>
		<td<?php echo $recolectores->NIT_RECOLECTOR->CellAttributes() ?>>
<div<?php echo $recolectores->NIT_RECOLECTOR->ViewAttributes(); ?>><?php echo $recolectores->NIT_RECOLECTOR->ListViewValue(); ?></div>
</td>
		<td<?php echo $recolectores->DIRECCION_RECOLECTOR->CellAttributes() ?>>
<div<?php echo $recolectores->DIRECCION_RECOLECTOR->ViewAttributes(); ?>><?php echo $recolectores->DIRECCION_RECOLECTOR->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$recolectores_rpt->AccumulateSummary();

		// Get next record
		$recolectores_rpt->GetRow(2);
	$recolectores_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<?php if ($recolectores->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="recolectoresrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($recolectores_rpt->StartGrp, $recolectores_rpt->DisplayGrps, $recolectores_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="recolectoresrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="recolectoresrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="recolectoresrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="recolectoresrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($recolectores_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($recolectores_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($recolectores_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($recolectores_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($recolectores_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($recolectores_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($recolectores_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($recolectores_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($recolectores_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($recolectores_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($recolectores->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($recolectores->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($recolectores->Export == "" || $recolectores->Export == "print" || $recolectores->Export == "email") { ?>
<?php } ?>
<?php if ($recolectores->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($recolectores->Export == "" || $recolectores->Export == "print" || $recolectores->Export == "email") { ?>
<?php } ?>
<?php if ($recolectores->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $recolectores_rpt->ShowPageFooter(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($recolectores->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$recolectores_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crrecolectores_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = 'recolectores';

	// Page object name
	var $PageObjName = 'recolectores_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $recolectores;
		if ($recolectores->UseTokenInUrl) $PageUrl .= "t=" . $recolectores->TableVar . "&"; // Add page token
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
		global $recolectores;
		if ($recolectores->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($recolectores->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($recolectores->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crrecolectores_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (recolectores)
		$GLOBALS["recolectores"] = new crrecolectores();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'recolectores', TRUE);

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
		global $recolectores;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$recolectores->Export = $_GET["export"];
	}
	$gsExport = $recolectores->Export; // Get export parameter, used in header
	$gsExportFile = $recolectores->TableVar; // Get export file, used in header
	if ($recolectores->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($recolectores->Export == "word") {
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
		global $recolectores;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($recolectores->Export == "email") {
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
		global $recolectores;
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
		$sSql = ewrpt_BuildReportSql($recolectores->SqlSelect(), $recolectores->SqlWhere(), $recolectores->SqlGroupBy(), $recolectores->SqlHaving(), $recolectores->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($recolectores->ExportAll && $recolectores->Export <> "")
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
		global $recolectores;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$recolectores->CODIGO_RECOLECTOR->setDbValue($rs->fields('CODIGO_RECOLECTOR'));
			$recolectores->NOMBRE_RECOLECTOR->setDbValue($rs->fields('NOMBRE_RECOLECTOR'));
			$recolectores->TELEFONO_RECOLECTOR->setDbValue($rs->fields('TELEFONO_RECOLECTOR'));
			$recolectores->DUI_RECOLECTOR->setDbValue($rs->fields('DUI_RECOLECTOR'));
			$recolectores->NIT_RECOLECTOR->setDbValue($rs->fields('NIT_RECOLECTOR'));
			$recolectores->DIRECCION_RECOLECTOR->setDbValue($rs->fields('DIRECCION_RECOLECTOR'));
			$this->Val[1] = $recolectores->CODIGO_RECOLECTOR->CurrentValue;
			$this->Val[2] = $recolectores->NOMBRE_RECOLECTOR->CurrentValue;
			$this->Val[3] = $recolectores->TELEFONO_RECOLECTOR->CurrentValue;
			$this->Val[4] = $recolectores->DUI_RECOLECTOR->CurrentValue;
			$this->Val[5] = $recolectores->NIT_RECOLECTOR->CurrentValue;
			$this->Val[6] = $recolectores->DIRECCION_RECOLECTOR->CurrentValue;
		} else {
			$recolectores->CODIGO_RECOLECTOR->setDbValue("");
			$recolectores->NOMBRE_RECOLECTOR->setDbValue("");
			$recolectores->TELEFONO_RECOLECTOR->setDbValue("");
			$recolectores->DUI_RECOLECTOR->setDbValue("");
			$recolectores->NIT_RECOLECTOR->setDbValue("");
			$recolectores->DIRECCION_RECOLECTOR->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $recolectores;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$recolectores->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$recolectores->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $recolectores->getStartGroup();
			}
		} else {
			$this->StartGrp = $recolectores->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$recolectores->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$recolectores->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$recolectores->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $recolectores;

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
		global $recolectores;
		$this->StartGrp = 1;
		$recolectores->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $recolectores;
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
			$recolectores->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$recolectores->setStartGroup($this->StartGrp);
		} else {
			if ($recolectores->getGroupPerPage() <> "") {
				$this->DisplayGrps = $recolectores->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $rs, $Security;
		global $recolectores;
		if ($recolectores->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($recolectores->SqlSelectCount(), $recolectores->SqlWhere(), $recolectores->SqlGroupBy(), $recolectores->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$recolectores->Row_Rendering();

		//
		// Render view codes
		//

		if ($recolectores->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// CODIGO_RECOLECTOR
			$recolectores->CODIGO_RECOLECTOR->ViewValue = $recolectores->CODIGO_RECOLECTOR->Summary;

			// NOMBRE_RECOLECTOR
			$recolectores->NOMBRE_RECOLECTOR->ViewValue = $recolectores->NOMBRE_RECOLECTOR->Summary;

			// TELEFONO_RECOLECTOR
			$recolectores->TELEFONO_RECOLECTOR->ViewValue = $recolectores->TELEFONO_RECOLECTOR->Summary;

			// DUI_RECOLECTOR
			$recolectores->DUI_RECOLECTOR->ViewValue = $recolectores->DUI_RECOLECTOR->Summary;

			// NIT_RECOLECTOR
			$recolectores->NIT_RECOLECTOR->ViewValue = $recolectores->NIT_RECOLECTOR->Summary;

			// DIRECCION_RECOLECTOR
			$recolectores->DIRECCION_RECOLECTOR->ViewValue = $recolectores->DIRECCION_RECOLECTOR->Summary;
		} else {

			// CODIGO_RECOLECTOR
			$recolectores->CODIGO_RECOLECTOR->ViewValue = $recolectores->CODIGO_RECOLECTOR->CurrentValue;
			$recolectores->CODIGO_RECOLECTOR->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// NOMBRE_RECOLECTOR
			$recolectores->NOMBRE_RECOLECTOR->ViewValue = $recolectores->NOMBRE_RECOLECTOR->CurrentValue;
			$recolectores->NOMBRE_RECOLECTOR->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// TELEFONO_RECOLECTOR
			$recolectores->TELEFONO_RECOLECTOR->ViewValue = $recolectores->TELEFONO_RECOLECTOR->CurrentValue;
			$recolectores->TELEFONO_RECOLECTOR->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// DUI_RECOLECTOR
			$recolectores->DUI_RECOLECTOR->ViewValue = $recolectores->DUI_RECOLECTOR->CurrentValue;
			$recolectores->DUI_RECOLECTOR->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// NIT_RECOLECTOR
			$recolectores->NIT_RECOLECTOR->ViewValue = $recolectores->NIT_RECOLECTOR->CurrentValue;
			$recolectores->NIT_RECOLECTOR->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// DIRECCION_RECOLECTOR
			$recolectores->DIRECCION_RECOLECTOR->ViewValue = $recolectores->DIRECCION_RECOLECTOR->CurrentValue;
			$recolectores->DIRECCION_RECOLECTOR->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// CODIGO_RECOLECTOR
		$recolectores->CODIGO_RECOLECTOR->HrefValue = "";

		// NOMBRE_RECOLECTOR
		$recolectores->NOMBRE_RECOLECTOR->HrefValue = "";

		// TELEFONO_RECOLECTOR
		$recolectores->TELEFONO_RECOLECTOR->HrefValue = "";

		// DUI_RECOLECTOR
		$recolectores->DUI_RECOLECTOR->HrefValue = "";

		// NIT_RECOLECTOR
		$recolectores->NIT_RECOLECTOR->HrefValue = "";

		// DIRECCION_RECOLECTOR
		$recolectores->DIRECCION_RECOLECTOR->HrefValue = "";

		// Call Row_Rendered event
		$recolectores->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $recolectores;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $recolectores;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$recolectores->setOrderBy("");
				$recolectores->setStartGroup(1);
				$recolectores->CODIGO_RECOLECTOR->setSort("");
				$recolectores->NOMBRE_RECOLECTOR->setSort("");
				$recolectores->TELEFONO_RECOLECTOR->setSort("");
				$recolectores->DUI_RECOLECTOR->setSort("");
				$recolectores->NIT_RECOLECTOR->setSort("");
				$recolectores->DIRECCION_RECOLECTOR->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$recolectores->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$recolectores->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $recolectores->SortSql();
			$recolectores->setOrderBy($sSortSql);
			$recolectores->setStartGroup(1);
		}
		return $recolectores->getOrderBy();
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $ReportLanguage, $recolectores;
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

		//$sAttachmentFile = $recolectores->TableVar . "_" . Date("YmdHis") . ".html";
		$sAttachmentFile = $recolectores->TableVar . "_" . Date("YmdHis") . "_" . ewrpt_Random() . ".html";
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
		if ($recolectores->Email_Sending($Email, $EventArgs))
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

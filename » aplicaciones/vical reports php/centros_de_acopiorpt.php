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
$centros_de_acopio = NULL;

//
// Table class for centros_de_acopio
//
class crcentros_de_acopio {
	var $TableVar = 'centros_de_acopio';
	var $TableName = 'centros_de_acopio';
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
	var $CODIGO_CENTRO_ACOPIO;
	var $CODIGO_RECOLECTOR;
	var $NOMBRE_CENTRO_ACOPIO;
	var $DIRECCION;
	var $DEPARTAMENTO;
	var $TELEFONO;
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
	function crcentros_de_acopio() {
		global $ReportLanguage;

		// CODIGO_CENTRO_ACOPIO
		$this->CODIGO_CENTRO_ACOPIO = new crField('centros_de_acopio', 'centros_de_acopio', 'x_CODIGO_CENTRO_ACOPIO', 'CODIGO_CENTRO_ACOPIO', '`CODIGO_CENTRO_ACOPIO`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['CODIGO_CENTRO_ACOPIO'] =& $this->CODIGO_CENTRO_ACOPIO;
		$this->CODIGO_CENTRO_ACOPIO->DateFilter = "";
		$this->CODIGO_CENTRO_ACOPIO->SqlSelect = "";
		$this->CODIGO_CENTRO_ACOPIO->SqlOrderBy = "";

		// CODIGO_RECOLECTOR
		$this->CODIGO_RECOLECTOR = new crField('centros_de_acopio', 'centros_de_acopio', 'x_CODIGO_RECOLECTOR', 'CODIGO_RECOLECTOR', '`CODIGO_RECOLECTOR`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['CODIGO_RECOLECTOR'] =& $this->CODIGO_RECOLECTOR;
		$this->CODIGO_RECOLECTOR->DateFilter = "";
		$this->CODIGO_RECOLECTOR->SqlSelect = "";
		$this->CODIGO_RECOLECTOR->SqlOrderBy = "";

		// NOMBRE_CENTRO_ACOPIO
		$this->NOMBRE_CENTRO_ACOPIO = new crField('centros_de_acopio', 'centros_de_acopio', 'x_NOMBRE_CENTRO_ACOPIO', 'NOMBRE_CENTRO_ACOPIO', '`NOMBRE_CENTRO_ACOPIO`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['NOMBRE_CENTRO_ACOPIO'] =& $this->NOMBRE_CENTRO_ACOPIO;
		$this->NOMBRE_CENTRO_ACOPIO->DateFilter = "";
		$this->NOMBRE_CENTRO_ACOPIO->SqlSelect = "";
		$this->NOMBRE_CENTRO_ACOPIO->SqlOrderBy = "";

		// DIRECCION
		$this->DIRECCION = new crField('centros_de_acopio', 'centros_de_acopio', 'x_DIRECCION', 'DIRECCION', '`DIRECCION`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['DIRECCION'] =& $this->DIRECCION;
		$this->DIRECCION->DateFilter = "";
		$this->DIRECCION->SqlSelect = "";
		$this->DIRECCION->SqlOrderBy = "";

		// DEPARTAMENTO
		$this->DEPARTAMENTO = new crField('centros_de_acopio', 'centros_de_acopio', 'x_DEPARTAMENTO', 'DEPARTAMENTO', '`DEPARTAMENTO`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['DEPARTAMENTO'] =& $this->DEPARTAMENTO;
		$this->DEPARTAMENTO->DateFilter = "";
		$this->DEPARTAMENTO->SqlSelect = "";
		$this->DEPARTAMENTO->SqlOrderBy = "";

		// TELEFONO
		$this->TELEFONO = new crField('centros_de_acopio', 'centros_de_acopio', 'x_TELEFONO', 'TELEFONO', '`TELEFONO`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['TELEFONO'] =& $this->TELEFONO;
		$this->TELEFONO->DateFilter = "";
		$this->TELEFONO->SqlSelect = "";
		$this->TELEFONO->SqlOrderBy = "";
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
		return "`centros_de_acopio`";
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
$centros_de_acopio_rpt = new crcentros_de_acopio_rpt();
$Page =& $centros_de_acopio_rpt;

// Page init
$centros_de_acopio_rpt->Page_Init();

// Page main
$centros_de_acopio_rpt->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($centros_de_acopio->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php $centros_de_acopio_rpt->ShowPageHeader(); ?>
<?php $centros_de_acopio_rpt->ShowMessage(); ?>
<?php if ($centros_de_acopio->Export == "" || $centros_de_acopio->Export == "print" || $centros_de_acopio->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($centros_de_acopio->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($centros_de_acopio->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($centros_de_acopio->Export == "" || $centros_de_acopio->Export == "print" || $centros_de_acopio->Export == "email") { ?>
<?php } ?>
<?php echo $centros_de_acopio->TableCaption() ?>
<?php if ($centros_de_acopio->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $centros_de_acopio_rpt->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $centros_de_acopio_rpt->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $centros_de_acopio_rpt->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
&nbsp;&nbsp;<a name="emf_centros_de_acopio" id="emf_centros_de_acopio" href="javascript:void(0);" onclick="ewrpt_EmailDialogShow({lnk:'emf_centros_de_acopio',hdr:ewLanguage.Phrase('ExportToEmail')});"><?php echo $ReportLanguage->Phrase("ExportToEmail") ?></a>
<?php } ?>
<br /><br />
<?php if ($centros_de_acopio->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($centros_de_acopio->Export == "" || $centros_de_acopio->Export == "print" || $centros_de_acopio->Export == "email") { ?>
<?php } ?>
<?php if ($centros_de_acopio->Export == "") { ?>
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
if ($centros_de_acopio->ExportAll && $centros_de_acopio->Export <> "") {
	$centros_de_acopio_rpt->StopGrp = $centros_de_acopio_rpt->TotalGrps;
} else {
	$centros_de_acopio_rpt->StopGrp = $centros_de_acopio_rpt->StartGrp + $centros_de_acopio_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($centros_de_acopio_rpt->StopGrp) > intval($centros_de_acopio_rpt->TotalGrps))
	$centros_de_acopio_rpt->StopGrp = $centros_de_acopio_rpt->TotalGrps;
$centros_de_acopio_rpt->RecCount = 0;

// Get first row
if ($centros_de_acopio_rpt->TotalGrps > 0) {
	$centros_de_acopio_rpt->GetRow(1);
	$centros_de_acopio_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $centros_de_acopio_rpt->GrpCount <= $centros_de_acopio_rpt->DisplayGrps) || $centros_de_acopio_rpt->ShowFirstHeader) {

	// Show header
	if ($centros_de_acopio_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
<?php if ($centros_de_acopio->Export <> "") { ?>
<?php echo $centros_de_acopio->CODIGO_CENTRO_ACOPIO->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($centros_de_acopio->SortUrl($centros_de_acopio->CODIGO_CENTRO_ACOPIO) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $centros_de_acopio->CODIGO_CENTRO_ACOPIO->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $centros_de_acopio->SortUrl($centros_de_acopio->CODIGO_CENTRO_ACOPIO) ?>',0);"><?php echo $centros_de_acopio->CODIGO_CENTRO_ACOPIO->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($centros_de_acopio->CODIGO_CENTRO_ACOPIO->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($centros_de_acopio->CODIGO_CENTRO_ACOPIO->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($centros_de_acopio->Export <> "") { ?>
<?php echo $centros_de_acopio->CODIGO_RECOLECTOR->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($centros_de_acopio->SortUrl($centros_de_acopio->CODIGO_RECOLECTOR) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $centros_de_acopio->CODIGO_RECOLECTOR->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $centros_de_acopio->SortUrl($centros_de_acopio->CODIGO_RECOLECTOR) ?>',0);"><?php echo $centros_de_acopio->CODIGO_RECOLECTOR->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($centros_de_acopio->CODIGO_RECOLECTOR->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($centros_de_acopio->CODIGO_RECOLECTOR->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($centros_de_acopio->Export <> "") { ?>
<?php echo $centros_de_acopio->NOMBRE_CENTRO_ACOPIO->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($centros_de_acopio->SortUrl($centros_de_acopio->NOMBRE_CENTRO_ACOPIO) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $centros_de_acopio->NOMBRE_CENTRO_ACOPIO->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $centros_de_acopio->SortUrl($centros_de_acopio->NOMBRE_CENTRO_ACOPIO) ?>',0);"><?php echo $centros_de_acopio->NOMBRE_CENTRO_ACOPIO->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($centros_de_acopio->NOMBRE_CENTRO_ACOPIO->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($centros_de_acopio->NOMBRE_CENTRO_ACOPIO->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($centros_de_acopio->Export <> "") { ?>
<?php echo $centros_de_acopio->DIRECCION->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($centros_de_acopio->SortUrl($centros_de_acopio->DIRECCION) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $centros_de_acopio->DIRECCION->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $centros_de_acopio->SortUrl($centros_de_acopio->DIRECCION) ?>',0);"><?php echo $centros_de_acopio->DIRECCION->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($centros_de_acopio->DIRECCION->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($centros_de_acopio->DIRECCION->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($centros_de_acopio->Export <> "") { ?>
<?php echo $centros_de_acopio->DEPARTAMENTO->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($centros_de_acopio->SortUrl($centros_de_acopio->DEPARTAMENTO) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $centros_de_acopio->DEPARTAMENTO->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $centros_de_acopio->SortUrl($centros_de_acopio->DEPARTAMENTO) ?>',0);"><?php echo $centros_de_acopio->DEPARTAMENTO->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($centros_de_acopio->DEPARTAMENTO->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($centros_de_acopio->DEPARTAMENTO->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($centros_de_acopio->Export <> "") { ?>
<?php echo $centros_de_acopio->TELEFONO->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($centros_de_acopio->SortUrl($centros_de_acopio->TELEFONO) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $centros_de_acopio->TELEFONO->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $centros_de_acopio->SortUrl($centros_de_acopio->TELEFONO) ?>',0);"><?php echo $centros_de_acopio->TELEFONO->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($centros_de_acopio->TELEFONO->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($centros_de_acopio->TELEFONO->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$centros_de_acopio_rpt->ShowFirstHeader = FALSE;
	}
	$centros_de_acopio_rpt->RecCount++;

		// Render detail row
		$centros_de_acopio->ResetCSS();
		$centros_de_acopio->RowType = EWRPT_ROWTYPE_DETAIL;
		$centros_de_acopio_rpt->RenderRow();
?>
	<tr<?php echo $centros_de_acopio->RowAttributes(); ?>>
		<td<?php echo $centros_de_acopio->CODIGO_CENTRO_ACOPIO->CellAttributes() ?>>
<div<?php echo $centros_de_acopio->CODIGO_CENTRO_ACOPIO->ViewAttributes(); ?>><?php echo $centros_de_acopio->CODIGO_CENTRO_ACOPIO->ListViewValue(); ?></div>
</td>
		<td<?php echo $centros_de_acopio->CODIGO_RECOLECTOR->CellAttributes() ?>>
<div<?php echo $centros_de_acopio->CODIGO_RECOLECTOR->ViewAttributes(); ?>><?php echo $centros_de_acopio->CODIGO_RECOLECTOR->ListViewValue(); ?></div>
</td>
		<td<?php echo $centros_de_acopio->NOMBRE_CENTRO_ACOPIO->CellAttributes() ?>>
<div<?php echo $centros_de_acopio->NOMBRE_CENTRO_ACOPIO->ViewAttributes(); ?>><?php echo $centros_de_acopio->NOMBRE_CENTRO_ACOPIO->ListViewValue(); ?></div>
</td>
		<td<?php echo $centros_de_acopio->DIRECCION->CellAttributes() ?>>
<div<?php echo $centros_de_acopio->DIRECCION->ViewAttributes(); ?>><?php echo $centros_de_acopio->DIRECCION->ListViewValue(); ?></div>
</td>
		<td<?php echo $centros_de_acopio->DEPARTAMENTO->CellAttributes() ?>>
<div<?php echo $centros_de_acopio->DEPARTAMENTO->ViewAttributes(); ?>><?php echo $centros_de_acopio->DEPARTAMENTO->ListViewValue(); ?></div>
</td>
		<td<?php echo $centros_de_acopio->TELEFONO->CellAttributes() ?>>
<div<?php echo $centros_de_acopio->TELEFONO->ViewAttributes(); ?>><?php echo $centros_de_acopio->TELEFONO->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$centros_de_acopio_rpt->AccumulateSummary();

		// Get next record
		$centros_de_acopio_rpt->GetRow(2);
	$centros_de_acopio_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<?php if ($centros_de_acopio->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="centros_de_acopiorpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($centros_de_acopio_rpt->StartGrp, $centros_de_acopio_rpt->DisplayGrps, $centros_de_acopio_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="centros_de_acopiorpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="centros_de_acopiorpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="centros_de_acopiorpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="centros_de_acopiorpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($centros_de_acopio_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($centros_de_acopio_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($centros_de_acopio_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($centros_de_acopio_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($centros_de_acopio_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($centros_de_acopio_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($centros_de_acopio_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($centros_de_acopio_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($centros_de_acopio_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($centros_de_acopio_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($centros_de_acopio->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($centros_de_acopio->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($centros_de_acopio->Export == "" || $centros_de_acopio->Export == "print" || $centros_de_acopio->Export == "email") { ?>
<?php } ?>
<?php if ($centros_de_acopio->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($centros_de_acopio->Export == "" || $centros_de_acopio->Export == "print" || $centros_de_acopio->Export == "email") { ?>
<?php } ?>
<?php if ($centros_de_acopio->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $centros_de_acopio_rpt->ShowPageFooter(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($centros_de_acopio->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$centros_de_acopio_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crcentros_de_acopio_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = 'centros_de_acopio';

	// Page object name
	var $PageObjName = 'centros_de_acopio_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $centros_de_acopio;
		if ($centros_de_acopio->UseTokenInUrl) $PageUrl .= "t=" . $centros_de_acopio->TableVar . "&"; // Add page token
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
		global $centros_de_acopio;
		if ($centros_de_acopio->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($centros_de_acopio->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($centros_de_acopio->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crcentros_de_acopio_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (centros_de_acopio)
		$GLOBALS["centros_de_acopio"] = new crcentros_de_acopio();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'centros_de_acopio', TRUE);

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
		global $centros_de_acopio;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$centros_de_acopio->Export = $_GET["export"];
	}
	$gsExport = $centros_de_acopio->Export; // Get export parameter, used in header
	$gsExportFile = $centros_de_acopio->TableVar; // Get export file, used in header
	if ($centros_de_acopio->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($centros_de_acopio->Export == "word") {
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
		global $centros_de_acopio;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($centros_de_acopio->Export == "email") {
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
		global $centros_de_acopio;
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
		$sSql = ewrpt_BuildReportSql($centros_de_acopio->SqlSelect(), $centros_de_acopio->SqlWhere(), $centros_de_acopio->SqlGroupBy(), $centros_de_acopio->SqlHaving(), $centros_de_acopio->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($centros_de_acopio->ExportAll && $centros_de_acopio->Export <> "")
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
		global $centros_de_acopio;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$centros_de_acopio->CODIGO_CENTRO_ACOPIO->setDbValue($rs->fields('CODIGO_CENTRO_ACOPIO'));
			$centros_de_acopio->CODIGO_RECOLECTOR->setDbValue($rs->fields('CODIGO_RECOLECTOR'));
			$centros_de_acopio->NOMBRE_CENTRO_ACOPIO->setDbValue($rs->fields('NOMBRE_CENTRO_ACOPIO'));
			$centros_de_acopio->DIRECCION->setDbValue($rs->fields('DIRECCION'));
			$centros_de_acopio->DEPARTAMENTO->setDbValue($rs->fields('DEPARTAMENTO'));
			$centros_de_acopio->TELEFONO->setDbValue($rs->fields('TELEFONO'));
			$this->Val[1] = $centros_de_acopio->CODIGO_CENTRO_ACOPIO->CurrentValue;
			$this->Val[2] = $centros_de_acopio->CODIGO_RECOLECTOR->CurrentValue;
			$this->Val[3] = $centros_de_acopio->NOMBRE_CENTRO_ACOPIO->CurrentValue;
			$this->Val[4] = $centros_de_acopio->DIRECCION->CurrentValue;
			$this->Val[5] = $centros_de_acopio->DEPARTAMENTO->CurrentValue;
			$this->Val[6] = $centros_de_acopio->TELEFONO->CurrentValue;
		} else {
			$centros_de_acopio->CODIGO_CENTRO_ACOPIO->setDbValue("");
			$centros_de_acopio->CODIGO_RECOLECTOR->setDbValue("");
			$centros_de_acopio->NOMBRE_CENTRO_ACOPIO->setDbValue("");
			$centros_de_acopio->DIRECCION->setDbValue("");
			$centros_de_acopio->DEPARTAMENTO->setDbValue("");
			$centros_de_acopio->TELEFONO->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $centros_de_acopio;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$centros_de_acopio->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$centros_de_acopio->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $centros_de_acopio->getStartGroup();
			}
		} else {
			$this->StartGrp = $centros_de_acopio->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$centros_de_acopio->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$centros_de_acopio->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$centros_de_acopio->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $centros_de_acopio;

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
		global $centros_de_acopio;
		$this->StartGrp = 1;
		$centros_de_acopio->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $centros_de_acopio;
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
			$centros_de_acopio->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$centros_de_acopio->setStartGroup($this->StartGrp);
		} else {
			if ($centros_de_acopio->getGroupPerPage() <> "") {
				$this->DisplayGrps = $centros_de_acopio->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $rs, $Security;
		global $centros_de_acopio;
		if ($centros_de_acopio->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($centros_de_acopio->SqlSelectCount(), $centros_de_acopio->SqlWhere(), $centros_de_acopio->SqlGroupBy(), $centros_de_acopio->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$centros_de_acopio->Row_Rendering();

		//
		// Render view codes
		//

		if ($centros_de_acopio->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// CODIGO_CENTRO_ACOPIO
			$centros_de_acopio->CODIGO_CENTRO_ACOPIO->ViewValue = $centros_de_acopio->CODIGO_CENTRO_ACOPIO->Summary;

			// CODIGO_RECOLECTOR
			$centros_de_acopio->CODIGO_RECOLECTOR->ViewValue = $centros_de_acopio->CODIGO_RECOLECTOR->Summary;

			// NOMBRE_CENTRO_ACOPIO
			$centros_de_acopio->NOMBRE_CENTRO_ACOPIO->ViewValue = $centros_de_acopio->NOMBRE_CENTRO_ACOPIO->Summary;

			// DIRECCION
			$centros_de_acopio->DIRECCION->ViewValue = $centros_de_acopio->DIRECCION->Summary;

			// DEPARTAMENTO
			$centros_de_acopio->DEPARTAMENTO->ViewValue = $centros_de_acopio->DEPARTAMENTO->Summary;

			// TELEFONO
			$centros_de_acopio->TELEFONO->ViewValue = $centros_de_acopio->TELEFONO->Summary;
		} else {

			// CODIGO_CENTRO_ACOPIO
			$centros_de_acopio->CODIGO_CENTRO_ACOPIO->ViewValue = $centros_de_acopio->CODIGO_CENTRO_ACOPIO->CurrentValue;
			$centros_de_acopio->CODIGO_CENTRO_ACOPIO->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// CODIGO_RECOLECTOR
			$centros_de_acopio->CODIGO_RECOLECTOR->ViewValue = $centros_de_acopio->CODIGO_RECOLECTOR->CurrentValue;
			$centros_de_acopio->CODIGO_RECOLECTOR->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// NOMBRE_CENTRO_ACOPIO
			$centros_de_acopio->NOMBRE_CENTRO_ACOPIO->ViewValue = $centros_de_acopio->NOMBRE_CENTRO_ACOPIO->CurrentValue;
			$centros_de_acopio->NOMBRE_CENTRO_ACOPIO->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// DIRECCION
			$centros_de_acopio->DIRECCION->ViewValue = $centros_de_acopio->DIRECCION->CurrentValue;
			$centros_de_acopio->DIRECCION->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// DEPARTAMENTO
			$centros_de_acopio->DEPARTAMENTO->ViewValue = $centros_de_acopio->DEPARTAMENTO->CurrentValue;
			$centros_de_acopio->DEPARTAMENTO->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// TELEFONO
			$centros_de_acopio->TELEFONO->ViewValue = $centros_de_acopio->TELEFONO->CurrentValue;
			$centros_de_acopio->TELEFONO->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// CODIGO_CENTRO_ACOPIO
		$centros_de_acopio->CODIGO_CENTRO_ACOPIO->HrefValue = "";

		// CODIGO_RECOLECTOR
		$centros_de_acopio->CODIGO_RECOLECTOR->HrefValue = "";

		// NOMBRE_CENTRO_ACOPIO
		$centros_de_acopio->NOMBRE_CENTRO_ACOPIO->HrefValue = "";

		// DIRECCION
		$centros_de_acopio->DIRECCION->HrefValue = "";

		// DEPARTAMENTO
		$centros_de_acopio->DEPARTAMENTO->HrefValue = "";

		// TELEFONO
		$centros_de_acopio->TELEFONO->HrefValue = "";

		// Call Row_Rendered event
		$centros_de_acopio->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $centros_de_acopio;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $centros_de_acopio;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$centros_de_acopio->setOrderBy("");
				$centros_de_acopio->setStartGroup(1);
				$centros_de_acopio->CODIGO_CENTRO_ACOPIO->setSort("");
				$centros_de_acopio->CODIGO_RECOLECTOR->setSort("");
				$centros_de_acopio->NOMBRE_CENTRO_ACOPIO->setSort("");
				$centros_de_acopio->DIRECCION->setSort("");
				$centros_de_acopio->DEPARTAMENTO->setSort("");
				$centros_de_acopio->TELEFONO->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$centros_de_acopio->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$centros_de_acopio->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $centros_de_acopio->SortSql();
			$centros_de_acopio->setOrderBy($sSortSql);
			$centros_de_acopio->setStartGroup(1);
		}
		return $centros_de_acopio->getOrderBy();
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $ReportLanguage, $centros_de_acopio;
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

		//$sAttachmentFile = $centros_de_acopio->TableVar . "_" . Date("YmdHis") . ".html";
		$sAttachmentFile = $centros_de_acopio->TableVar . "_" . Date("YmdHis") . "_" . ewrpt_Random() . ".html";
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
		if ($centros_de_acopio->Email_Sending($Email, $EventArgs))
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

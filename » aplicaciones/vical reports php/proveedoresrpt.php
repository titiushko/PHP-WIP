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
$proveedores = NULL;

//
// Table class for proveedores
//
class crproveedores {
	var $TableVar = 'proveedores';
	var $TableName = 'proveedores';
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
	var $CODIGO_PROVEEDOR;
	var $CODIGO_TIPO_EMPRESA;
	var $NOMBRE_PROVEEDOR;
	var $DEPARTAMENTO;
	var $DIRECCION_PROVEEDOR;
	var $TELEFONO_PROVEEDOR1;
	var $TELEFONO_PROVEEDOR2;
	var $CONTACTO;
	var $ESTANON;
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
	function crproveedores() {
		global $ReportLanguage;

		// CODIGO_PROVEEDOR
		$this->CODIGO_PROVEEDOR = new crField('proveedores', 'proveedores', 'x_CODIGO_PROVEEDOR', 'CODIGO_PROVEEDOR', '`CODIGO_PROVEEDOR`', 3, EWRPT_DATATYPE_NUMBER, -1);
		$this->CODIGO_PROVEEDOR->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['CODIGO_PROVEEDOR'] =& $this->CODIGO_PROVEEDOR;
		$this->CODIGO_PROVEEDOR->DateFilter = "";
		$this->CODIGO_PROVEEDOR->SqlSelect = "";
		$this->CODIGO_PROVEEDOR->SqlOrderBy = "";

		// CODIGO_TIPO_EMPRESA
		$this->CODIGO_TIPO_EMPRESA = new crField('proveedores', 'proveedores', 'x_CODIGO_TIPO_EMPRESA', 'CODIGO_TIPO_EMPRESA', '`CODIGO_TIPO_EMPRESA`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['CODIGO_TIPO_EMPRESA'] =& $this->CODIGO_TIPO_EMPRESA;
		$this->CODIGO_TIPO_EMPRESA->DateFilter = "";
		$this->CODIGO_TIPO_EMPRESA->SqlSelect = "";
		$this->CODIGO_TIPO_EMPRESA->SqlOrderBy = "";

		// NOMBRE_PROVEEDOR
		$this->NOMBRE_PROVEEDOR = new crField('proveedores', 'proveedores', 'x_NOMBRE_PROVEEDOR', 'NOMBRE_PROVEEDOR', '`NOMBRE_PROVEEDOR`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['NOMBRE_PROVEEDOR'] =& $this->NOMBRE_PROVEEDOR;
		$this->NOMBRE_PROVEEDOR->DateFilter = "";
		$this->NOMBRE_PROVEEDOR->SqlSelect = "";
		$this->NOMBRE_PROVEEDOR->SqlOrderBy = "";

		// DEPARTAMENTO
		$this->DEPARTAMENTO = new crField('proveedores', 'proveedores', 'x_DEPARTAMENTO', 'DEPARTAMENTO', '`DEPARTAMENTO`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['DEPARTAMENTO'] =& $this->DEPARTAMENTO;
		$this->DEPARTAMENTO->DateFilter = "";
		$this->DEPARTAMENTO->SqlSelect = "";
		$this->DEPARTAMENTO->SqlOrderBy = "";

		// DIRECCION_PROVEEDOR
		$this->DIRECCION_PROVEEDOR = new crField('proveedores', 'proveedores', 'x_DIRECCION_PROVEEDOR', 'DIRECCION_PROVEEDOR', '`DIRECCION_PROVEEDOR`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['DIRECCION_PROVEEDOR'] =& $this->DIRECCION_PROVEEDOR;
		$this->DIRECCION_PROVEEDOR->DateFilter = "";
		$this->DIRECCION_PROVEEDOR->SqlSelect = "";
		$this->DIRECCION_PROVEEDOR->SqlOrderBy = "";

		// TELEFONO_PROVEEDOR1
		$this->TELEFONO_PROVEEDOR1 = new crField('proveedores', 'proveedores', 'x_TELEFONO_PROVEEDOR1', 'TELEFONO_PROVEEDOR1', '`TELEFONO_PROVEEDOR1`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['TELEFONO_PROVEEDOR1'] =& $this->TELEFONO_PROVEEDOR1;
		$this->TELEFONO_PROVEEDOR1->DateFilter = "";
		$this->TELEFONO_PROVEEDOR1->SqlSelect = "";
		$this->TELEFONO_PROVEEDOR1->SqlOrderBy = "";

		// TELEFONO_PROVEEDOR2
		$this->TELEFONO_PROVEEDOR2 = new crField('proveedores', 'proveedores', 'x_TELEFONO_PROVEEDOR2', 'TELEFONO_PROVEEDOR2', '`TELEFONO_PROVEEDOR2`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['TELEFONO_PROVEEDOR2'] =& $this->TELEFONO_PROVEEDOR2;
		$this->TELEFONO_PROVEEDOR2->DateFilter = "";
		$this->TELEFONO_PROVEEDOR2->SqlSelect = "";
		$this->TELEFONO_PROVEEDOR2->SqlOrderBy = "";

		// CONTACTO
		$this->CONTACTO = new crField('proveedores', 'proveedores', 'x_CONTACTO', 'CONTACTO', '`CONTACTO`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['CONTACTO'] =& $this->CONTACTO;
		$this->CONTACTO->DateFilter = "";
		$this->CONTACTO->SqlSelect = "";
		$this->CONTACTO->SqlOrderBy = "";

		// ESTANON
		$this->ESTANON = new crField('proveedores', 'proveedores', 'x_ESTANON', 'ESTANON', '`ESTANON`', 200, EWRPT_DATATYPE_STRING, -1);
		$this->fields['ESTANON'] =& $this->ESTANON;
		$this->ESTANON->DateFilter = "";
		$this->ESTANON->SqlSelect = "";
		$this->ESTANON->SqlOrderBy = "";
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
		return "`proveedores`";
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
$proveedores_rpt = new crproveedores_rpt();
$Page =& $proveedores_rpt;

// Page init
$proveedores_rpt->Page_Init();

// Page main
$proveedores_rpt->Page_Main();
?>
<?php include "phprptinc/header.php"; ?>
<?php if ($proveedores->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php $proveedores_rpt->ShowPageHeader(); ?>
<?php $proveedores_rpt->ShowMessage(); ?>
<?php if ($proveedores->Export == "" || $proveedores->Export == "print" || $proveedores->Export == "email") { ?>
<script src="FusionChartsFree/JSClass/FusionCharts.js" type="text/javascript"></script>
<?php } ?>
<?php if ($proveedores->Export == "") { ?>
<script src="phprptjs/popup.js" type="text/javascript"></script>
<script src="phprptjs/ewrptpop.js" type="text/javascript"></script>
<script type="text/javascript">

// popup fields
</script>
<?php } ?>
<?php if ($proveedores->Export == "") { ?>
<!-- Table Container (Begin) -->
<table id="ewContainer" cellspacing="0" cellpadding="0" border="0">
<!-- Top Container (Begin) -->
<tr><td colspan="3"><div id="ewTop" class="phpreportmaker">
<!-- top slot -->
<a name="top"></a>
<?php } ?>
<?php if ($proveedores->Export == "" || $proveedores->Export == "print" || $proveedores->Export == "email") { ?>
<?php } ?>
<?php echo $proveedores->TableCaption() ?>
<?php if ($proveedores->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $proveedores_rpt->ExportPrintUrl ?>"><?php echo $ReportLanguage->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $proveedores_rpt->ExportExcelUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $proveedores_rpt->ExportWordUrl ?>"><?php echo $ReportLanguage->Phrase("ExportToWord") ?></a>
&nbsp;&nbsp;<a name="emf_proveedores" id="emf_proveedores" href="javascript:void(0);" onclick="ewrpt_EmailDialogShow({lnk:'emf_proveedores',hdr:ewLanguage.Phrase('ExportToEmail')});"><?php echo $ReportLanguage->Phrase("ExportToEmail") ?></a>
<?php } ?>
<br /><br />
<?php if ($proveedores->Export == "") { ?>
</div></td></tr>
<!-- Top Container (End) -->
<tr>
	<!-- Left Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewLeft" class="phpreportmaker">
	<!-- Left slot -->
<?php } ?>
<?php if ($proveedores->Export == "" || $proveedores->Export == "print" || $proveedores->Export == "email") { ?>
<?php } ?>
<?php if ($proveedores->Export == "") { ?>
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
if ($proveedores->ExportAll && $proveedores->Export <> "") {
	$proveedores_rpt->StopGrp = $proveedores_rpt->TotalGrps;
} else {
	$proveedores_rpt->StopGrp = $proveedores_rpt->StartGrp + $proveedores_rpt->DisplayGrps - 1;
}

// Stop group <= total number of groups
if (intval($proveedores_rpt->StopGrp) > intval($proveedores_rpt->TotalGrps))
	$proveedores_rpt->StopGrp = $proveedores_rpt->TotalGrps;
$proveedores_rpt->RecCount = 0;

// Get first row
if ($proveedores_rpt->TotalGrps > 0) {
	$proveedores_rpt->GetRow(1);
	$proveedores_rpt->GrpCount = 1;
}
while (($rs && !$rs->EOF && $proveedores_rpt->GrpCount <= $proveedores_rpt->DisplayGrps) || $proveedores_rpt->ShowFirstHeader) {

	// Show header
	if ($proveedores_rpt->ShowFirstHeader) {
?>
	<thead>
	<tr>
<td class="ewTableHeader">
<?php if ($proveedores->Export <> "") { ?>
<?php echo $proveedores->CODIGO_PROVEEDOR->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($proveedores->SortUrl($proveedores->CODIGO_PROVEEDOR) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $proveedores->CODIGO_PROVEEDOR->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $proveedores->SortUrl($proveedores->CODIGO_PROVEEDOR) ?>',0);"><?php echo $proveedores->CODIGO_PROVEEDOR->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($proveedores->CODIGO_PROVEEDOR->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($proveedores->CODIGO_PROVEEDOR->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($proveedores->Export <> "") { ?>
<?php echo $proveedores->CODIGO_TIPO_EMPRESA->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($proveedores->SortUrl($proveedores->CODIGO_TIPO_EMPRESA) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $proveedores->CODIGO_TIPO_EMPRESA->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $proveedores->SortUrl($proveedores->CODIGO_TIPO_EMPRESA) ?>',0);"><?php echo $proveedores->CODIGO_TIPO_EMPRESA->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($proveedores->CODIGO_TIPO_EMPRESA->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($proveedores->CODIGO_TIPO_EMPRESA->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($proveedores->Export <> "") { ?>
<?php echo $proveedores->NOMBRE_PROVEEDOR->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($proveedores->SortUrl($proveedores->NOMBRE_PROVEEDOR) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $proveedores->NOMBRE_PROVEEDOR->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $proveedores->SortUrl($proveedores->NOMBRE_PROVEEDOR) ?>',0);"><?php echo $proveedores->NOMBRE_PROVEEDOR->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($proveedores->NOMBRE_PROVEEDOR->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($proveedores->NOMBRE_PROVEEDOR->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($proveedores->Export <> "") { ?>
<?php echo $proveedores->DEPARTAMENTO->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($proveedores->SortUrl($proveedores->DEPARTAMENTO) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $proveedores->DEPARTAMENTO->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $proveedores->SortUrl($proveedores->DEPARTAMENTO) ?>',0);"><?php echo $proveedores->DEPARTAMENTO->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($proveedores->DEPARTAMENTO->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($proveedores->DEPARTAMENTO->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($proveedores->Export <> "") { ?>
<?php echo $proveedores->DIRECCION_PROVEEDOR->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($proveedores->SortUrl($proveedores->DIRECCION_PROVEEDOR) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $proveedores->DIRECCION_PROVEEDOR->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $proveedores->SortUrl($proveedores->DIRECCION_PROVEEDOR) ?>',0);"><?php echo $proveedores->DIRECCION_PROVEEDOR->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($proveedores->DIRECCION_PROVEEDOR->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($proveedores->DIRECCION_PROVEEDOR->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($proveedores->Export <> "") { ?>
<?php echo $proveedores->TELEFONO_PROVEEDOR1->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($proveedores->SortUrl($proveedores->TELEFONO_PROVEEDOR1) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $proveedores->TELEFONO_PROVEEDOR1->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $proveedores->SortUrl($proveedores->TELEFONO_PROVEEDOR1) ?>',0);"><?php echo $proveedores->TELEFONO_PROVEEDOR1->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($proveedores->TELEFONO_PROVEEDOR1->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($proveedores->TELEFONO_PROVEEDOR1->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($proveedores->Export <> "") { ?>
<?php echo $proveedores->TELEFONO_PROVEEDOR2->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($proveedores->SortUrl($proveedores->TELEFONO_PROVEEDOR2) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $proveedores->TELEFONO_PROVEEDOR2->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $proveedores->SortUrl($proveedores->TELEFONO_PROVEEDOR2) ?>',0);"><?php echo $proveedores->TELEFONO_PROVEEDOR2->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($proveedores->TELEFONO_PROVEEDOR2->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($proveedores->TELEFONO_PROVEEDOR2->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($proveedores->Export <> "") { ?>
<?php echo $proveedores->CONTACTO->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($proveedores->SortUrl($proveedores->CONTACTO) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $proveedores->CONTACTO->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $proveedores->SortUrl($proveedores->CONTACTO) ?>',0);"><?php echo $proveedores->CONTACTO->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($proveedores->CONTACTO->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($proveedores->CONTACTO->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
<td class="ewTableHeader">
<?php if ($proveedores->Export <> "") { ?>
<?php echo $proveedores->ESTANON->FldCaption() ?>
<?php } else { ?>
	<table cellspacing="0" class="ewTableHeaderBtn"><tr>
<?php if ($proveedores->SortUrl($proveedores->ESTANON) == "") { ?>
		<td style="vertical-align: bottom;"><?php echo $proveedores->ESTANON->FldCaption() ?></td>
<?php } else { ?>
		<td class="ewPointer" onmousedown="ewrpt_Sort(event,'<?php echo $proveedores->SortUrl($proveedores->ESTANON) ?>',0);"><?php echo $proveedores->ESTANON->FldCaption() ?></td><td style="width: 10px;">
		<?php if ($proveedores->ESTANON->getSort() == "ASC") { ?><img src="phprptimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($proveedores->ESTANON->getSort() == "DESC") { ?><img src="phprptimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td>
<?php } ?>
	</tr></table>
<?php } ?>
</td>
	</tr>
	</thead>
	<tbody>
<?php
		$proveedores_rpt->ShowFirstHeader = FALSE;
	}
	$proveedores_rpt->RecCount++;

		// Render detail row
		$proveedores->ResetCSS();
		$proveedores->RowType = EWRPT_ROWTYPE_DETAIL;
		$proveedores_rpt->RenderRow();
?>
	<tr<?php echo $proveedores->RowAttributes(); ?>>
		<td<?php echo $proveedores->CODIGO_PROVEEDOR->CellAttributes() ?>>
<div<?php echo $proveedores->CODIGO_PROVEEDOR->ViewAttributes(); ?>><?php echo $proveedores->CODIGO_PROVEEDOR->ListViewValue(); ?></div>
</td>
		<td<?php echo $proveedores->CODIGO_TIPO_EMPRESA->CellAttributes() ?>>
<div<?php echo $proveedores->CODIGO_TIPO_EMPRESA->ViewAttributes(); ?>><?php echo $proveedores->CODIGO_TIPO_EMPRESA->ListViewValue(); ?></div>
</td>
		<td<?php echo $proveedores->NOMBRE_PROVEEDOR->CellAttributes() ?>>
<div<?php echo $proveedores->NOMBRE_PROVEEDOR->ViewAttributes(); ?>><?php echo $proveedores->NOMBRE_PROVEEDOR->ListViewValue(); ?></div>
</td>
		<td<?php echo $proveedores->DEPARTAMENTO->CellAttributes() ?>>
<div<?php echo $proveedores->DEPARTAMENTO->ViewAttributes(); ?>><?php echo $proveedores->DEPARTAMENTO->ListViewValue(); ?></div>
</td>
		<td<?php echo $proveedores->DIRECCION_PROVEEDOR->CellAttributes() ?>>
<div<?php echo $proveedores->DIRECCION_PROVEEDOR->ViewAttributes(); ?>><?php echo $proveedores->DIRECCION_PROVEEDOR->ListViewValue(); ?></div>
</td>
		<td<?php echo $proveedores->TELEFONO_PROVEEDOR1->CellAttributes() ?>>
<div<?php echo $proveedores->TELEFONO_PROVEEDOR1->ViewAttributes(); ?>><?php echo $proveedores->TELEFONO_PROVEEDOR1->ListViewValue(); ?></div>
</td>
		<td<?php echo $proveedores->TELEFONO_PROVEEDOR2->CellAttributes() ?>>
<div<?php echo $proveedores->TELEFONO_PROVEEDOR2->ViewAttributes(); ?>><?php echo $proveedores->TELEFONO_PROVEEDOR2->ListViewValue(); ?></div>
</td>
		<td<?php echo $proveedores->CONTACTO->CellAttributes() ?>>
<div<?php echo $proveedores->CONTACTO->ViewAttributes(); ?>><?php echo $proveedores->CONTACTO->ListViewValue(); ?></div>
</td>
		<td<?php echo $proveedores->ESTANON->CellAttributes() ?>>
<div<?php echo $proveedores->ESTANON->ViewAttributes(); ?>><?php echo $proveedores->ESTANON->ListViewValue(); ?></div>
</td>
	</tr>
<?php

		// Accumulate page summary
		$proveedores_rpt->AccumulateSummary();

		// Get next record
		$proveedores_rpt->GetRow(2);
	$proveedores_rpt->GrpCount++;
} // End while
?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
</div>
<?php if ($proveedores->Export == "") { ?>
<div class="ewGridLowerPanel">
<form action="proveedoresrpt.php" name="ewpagerform" id="ewpagerform" class="ewForm">
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style="white-space: nowrap;">
<?php if (!isset($Pager)) $Pager = new crPrevNextPager($proveedores_rpt->StartGrp, $proveedores_rpt->DisplayGrps, $proveedores_rpt->TotalGrps) ?>
<?php if ($Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($Pager->FirstButton->Enabled) { ?>
	<td><a href="proveedoresrpt.php?start=<?php echo $Pager->FirstButton->Start ?>"><img src="phprptimages/first.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/firstdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($Pager->PrevButton->Enabled) { ?>
	<td><a href="proveedoresrpt.php?start=<?php echo $Pager->PrevButton->Start ?>"><img src="phprptimages/prev.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phprptimages/prevdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo $Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($Pager->NextButton->Enabled) { ?>
	<td><a href="proveedoresrpt.php?start=<?php echo $Pager->NextButton->Start ?>"><img src="phprptimages/next.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phprptimages/nextdisab.gif" alt="<?php echo $ReportLanguage->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($Pager->LastButton->Enabled) { ?>
	<td><a href="proveedoresrpt.php?start=<?php echo $Pager->LastButton->Start ?>"><img src="phprptimages/last.gif" alt="<?php echo $ReportLanguage->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
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
	<?php if ($proveedores_rpt->Filter == "0=101") { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($proveedores_rpt->TotalGrps > 0) { ?>
		<td style="white-space: nowrap;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td align="right" style="vertical-align: top; white-space: nowrap;"><span class="phpreportmaker"><?php echo $ReportLanguage->Phrase("RecordsPerPage"); ?>&nbsp;
<select name="<?php echo EWRPT_TABLE_GROUP_PER_PAGE; ?>" onchange="this.form.submit();">
<option value="1"<?php if ($proveedores_rpt->DisplayGrps == 1) echo " selected=\"selected\"" ?>>1</option>
<option value="2"<?php if ($proveedores_rpt->DisplayGrps == 2) echo " selected=\"selected\"" ?>>2</option>
<option value="3"<?php if ($proveedores_rpt->DisplayGrps == 3) echo " selected=\"selected\"" ?>>3</option>
<option value="4"<?php if ($proveedores_rpt->DisplayGrps == 4) echo " selected=\"selected\"" ?>>4</option>
<option value="5"<?php if ($proveedores_rpt->DisplayGrps == 5) echo " selected=\"selected\"" ?>>5</option>
<option value="10"<?php if ($proveedores_rpt->DisplayGrps == 10) echo " selected=\"selected\"" ?>>10</option>
<option value="20"<?php if ($proveedores_rpt->DisplayGrps == 20) echo " selected=\"selected\"" ?>>20</option>
<option value="50"<?php if ($proveedores_rpt->DisplayGrps == 50) echo " selected=\"selected\"" ?>>50</option>
<option value="ALL"<?php if ($proveedores->getGroupPerPage() == -1) echo " selected=\"selected\"" ?>><?php echo $ReportLanguage->Phrase("AllRecords") ?></option>
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
<?php if ($proveedores->Export == "") { ?>
	</div><br /></td>
	<!-- Center Container - Report (End) -->
	<!-- Right Container (Begin) -->
	<td style="vertical-align: top;"><div id="ewRight" class="phpreportmaker">
	<!-- Right slot -->
<?php } ?>
<?php if ($proveedores->Export == "" || $proveedores->Export == "print" || $proveedores->Export == "email") { ?>
<?php } ?>
<?php if ($proveedores->Export == "") { ?>
	</div></td>
	<!-- Right Container (End) -->
</tr>
<!-- Bottom Container (Begin) -->
<tr><td colspan="3"><div id="ewBottom" class="phpreportmaker">
	<!-- Bottom slot -->
<?php } ?>
<?php if ($proveedores->Export == "" || $proveedores->Export == "print" || $proveedores->Export == "email") { ?>
<?php } ?>
<?php if ($proveedores->Export == "") { ?>
	</div><br /></td></tr>
<!-- Bottom Container (End) -->
</table>
<!-- Table Container (End) -->
<?php } ?>
<?php $proveedores_rpt->ShowPageFooter(); ?>
<?php if (EWRPT_DEBUG_ENABLED) echo ewrpt_DebugMsg(); ?>
<?php

// Close recordsets
if ($rsgrp) $rsgrp->Close();
if ($rs) $rs->Close();
?>
<?php if ($proveedores->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "phprptinc/footer.php"; ?>
<?php
$proveedores_rpt->Page_Terminate();
?>
<?php

//
// Page class
//
class crproveedores_rpt {

	// Page ID
	var $PageID = 'rpt';

	// Table name
	var $TableName = 'proveedores';

	// Page object name
	var $PageObjName = 'proveedores_rpt';

	// Page name
	function PageName() {
		return ewrpt_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ewrpt_CurrentPage() . "?";
		global $proveedores;
		if ($proveedores->UseTokenInUrl) $PageUrl .= "t=" . $proveedores->TableVar . "&"; // Add page token
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
		global $proveedores;
		if ($proveedores->UseTokenInUrl) {
			if (ewrpt_IsHttpPost())
				return ($proveedores->TableVar == @$_POST("t"));
			if (@$_GET["t"] <> "")
				return ($proveedores->TableVar == @$_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function crproveedores_rpt() {
		global $conn, $ReportLanguage;

		// Language object
		$ReportLanguage = new crLanguage();

		// Table object (proveedores)
		$GLOBALS["proveedores"] = new crproveedores();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";

		// Page ID
		if (!defined("EWRPT_PAGE_ID"))
			define("EWRPT_PAGE_ID", 'rpt', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EWRPT_TABLE_NAME"))
			define("EWRPT_TABLE_NAME", 'proveedores', TRUE);

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
		global $proveedores;

		// Security
		$Security = new crAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin(); // Auto login
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("rlogin.php");
		}

	// Get export parameters
	if (@$_GET["export"] <> "") {
		$proveedores->Export = $_GET["export"];
	}
	$gsExport = $proveedores->Export; // Get export parameter, used in header
	$gsExportFile = $proveedores->TableVar; // Get export file, used in header
	if ($proveedores->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($proveedores->Export == "word") {
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
		global $proveedores;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export to Email (use ob_file_contents for PHP)
		if ($proveedores->Export == "email") {
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
		global $proveedores;
		global $rs;
		global $rsgrp;
		global $gsFormError;

		// Aggregate variables
		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of fields

		$nDtls = 10;
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
		$this->Col = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);

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
		$sSql = ewrpt_BuildReportSql($proveedores->SqlSelect(), $proveedores->SqlWhere(), $proveedores->SqlGroupBy(), $proveedores->SqlHaving(), $proveedores->SqlOrderBy(), $this->Filter, $this->Sort);
		$this->TotalGrps = $this->GetCnt($sSql);
		if ($this->DisplayGrps <= 0) // Display all groups
			$this->DisplayGrps = $this->TotalGrps;
		$this->StartGrp = 1;

		// Show header
		$this->ShowFirstHeader = ($this->TotalGrps > 0);

		//$this->ShowFirstHeader = TRUE; // Uncomment to always show header
		// Set up start position if not export all

		if ($proveedores->ExportAll && $proveedores->Export <> "")
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
		global $proveedores;
		if (!$rs)
			return;
		if ($opt == 1) { // Get first row

	//		$rs->MoveFirst(); // NOTE: no need to move position
		} else { // Get next row
			$rs->MoveNext();
		}
		if (!$rs->EOF) {
			$proveedores->CODIGO_PROVEEDOR->setDbValue($rs->fields('CODIGO_PROVEEDOR'));
			$proveedores->CODIGO_TIPO_EMPRESA->setDbValue($rs->fields('CODIGO_TIPO_EMPRESA'));
			$proveedores->NOMBRE_PROVEEDOR->setDbValue($rs->fields('NOMBRE_PROVEEDOR'));
			$proveedores->DEPARTAMENTO->setDbValue($rs->fields('DEPARTAMENTO'));
			$proveedores->DIRECCION_PROVEEDOR->setDbValue($rs->fields('DIRECCION_PROVEEDOR'));
			$proveedores->TELEFONO_PROVEEDOR1->setDbValue($rs->fields('TELEFONO_PROVEEDOR1'));
			$proveedores->TELEFONO_PROVEEDOR2->setDbValue($rs->fields('TELEFONO_PROVEEDOR2'));
			$proveedores->CONTACTO->setDbValue($rs->fields('CONTACTO'));
			$proveedores->ESTANON->setDbValue($rs->fields('ESTANON'));
			$this->Val[1] = $proveedores->CODIGO_PROVEEDOR->CurrentValue;
			$this->Val[2] = $proveedores->CODIGO_TIPO_EMPRESA->CurrentValue;
			$this->Val[3] = $proveedores->NOMBRE_PROVEEDOR->CurrentValue;
			$this->Val[4] = $proveedores->DEPARTAMENTO->CurrentValue;
			$this->Val[5] = $proveedores->DIRECCION_PROVEEDOR->CurrentValue;
			$this->Val[6] = $proveedores->TELEFONO_PROVEEDOR1->CurrentValue;
			$this->Val[7] = $proveedores->TELEFONO_PROVEEDOR2->CurrentValue;
			$this->Val[8] = $proveedores->CONTACTO->CurrentValue;
			$this->Val[9] = $proveedores->ESTANON->CurrentValue;
		} else {
			$proveedores->CODIGO_PROVEEDOR->setDbValue("");
			$proveedores->CODIGO_TIPO_EMPRESA->setDbValue("");
			$proveedores->NOMBRE_PROVEEDOR->setDbValue("");
			$proveedores->DEPARTAMENTO->setDbValue("");
			$proveedores->DIRECCION_PROVEEDOR->setDbValue("");
			$proveedores->TELEFONO_PROVEEDOR1->setDbValue("");
			$proveedores->TELEFONO_PROVEEDOR2->setDbValue("");
			$proveedores->CONTACTO->setDbValue("");
			$proveedores->ESTANON->setDbValue("");
		}
	}

	//  Set up starting group
	function SetUpStartGroup() {
		global $proveedores;

		// Exit if no groups
		if ($this->DisplayGrps == 0)
			return;

		// Check for a 'start' parameter
		if (@$_GET[EWRPT_TABLE_START_GROUP] != "") {
			$this->StartGrp = $_GET[EWRPT_TABLE_START_GROUP];
			$proveedores->setStartGroup($this->StartGrp);
		} elseif (@$_GET["pageno"] != "") {
			$nPageNo = $_GET["pageno"];
			if (is_numeric($nPageNo)) {
				$this->StartGrp = ($nPageNo-1)*$this->DisplayGrps+1;
				if ($this->StartGrp <= 0) {
					$this->StartGrp = 1;
				} elseif ($this->StartGrp >= intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1) {
					$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps)*$this->DisplayGrps+1;
				}
				$proveedores->setStartGroup($this->StartGrp);
			} else {
				$this->StartGrp = $proveedores->getStartGroup();
			}
		} else {
			$this->StartGrp = $proveedores->getStartGroup();
		}

		// Check if correct start group counter
		if (!is_numeric($this->StartGrp) || $this->StartGrp == "") { // Avoid invalid start group counter
			$this->StartGrp = 1; // Reset start group counter
			$proveedores->setStartGroup($this->StartGrp);
		} elseif (intval($this->StartGrp) > intval($this->TotalGrps)) { // Avoid starting group > total groups
			$this->StartGrp = intval(($this->TotalGrps-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to last page first group
			$proveedores->setStartGroup($this->StartGrp);
		} elseif (($this->StartGrp-1) % $this->DisplayGrps <> 0) {
			$this->StartGrp = intval(($this->StartGrp-1)/$this->DisplayGrps) * $this->DisplayGrps + 1; // Point to page boundary
			$proveedores->setStartGroup($this->StartGrp);
		}
	}

	// Set up popup
	function SetupPopup() {
		global $conn, $ReportLanguage;
		global $proveedores;

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
		global $proveedores;
		$this->StartGrp = 1;
		$proveedores->setStartGroup($this->StartGrp);
	}

	// Set up number of groups displayed per page
	function SetUpDisplayGrps() {
		global $proveedores;
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
			$proveedores->setGroupPerPage($this->DisplayGrps); // Save to session

			// Reset start position (reset command)
			$this->StartGrp = 1;
			$proveedores->setStartGroup($this->StartGrp);
		} else {
			if ($proveedores->getGroupPerPage() <> "") {
				$this->DisplayGrps = $proveedores->getGroupPerPage(); // Restore from session
			} else {
				$this->DisplayGrps = 3; // Load default
			}
		}
	}

	function RenderRow() {
		global $conn, $rs, $Security;
		global $proveedores;
		if ($proveedores->RowTotalType == EWRPT_ROWTOTAL_GRAND) { // Grand total

			// Get total count from sql directly
			$sSql = ewrpt_BuildReportSql($proveedores->SqlSelectCount(), $proveedores->SqlWhere(), $proveedores->SqlGroupBy(), $proveedores->SqlHaving(), "", $this->Filter, "");
			$rstot = $conn->Execute($sSql);
			if ($rstot) {
				$this->TotCount = ($rstot->RecordCount()>1) ? $rstot->RecordCount() : $rstot->fields[0];
				$rstot->Close();
			} else {
				$this->TotCount = 0;
			}
		}

		// Call Row_Rendering event
		$proveedores->Row_Rendering();

		//
		// Render view codes
		//

		if ($proveedores->RowType == EWRPT_ROWTYPE_TOTAL) { // Summary row

			// CODIGO_PROVEEDOR
			$proveedores->CODIGO_PROVEEDOR->ViewValue = $proveedores->CODIGO_PROVEEDOR->Summary;

			// CODIGO_TIPO_EMPRESA
			$proveedores->CODIGO_TIPO_EMPRESA->ViewValue = $proveedores->CODIGO_TIPO_EMPRESA->Summary;

			// NOMBRE_PROVEEDOR
			$proveedores->NOMBRE_PROVEEDOR->ViewValue = $proveedores->NOMBRE_PROVEEDOR->Summary;

			// DEPARTAMENTO
			$proveedores->DEPARTAMENTO->ViewValue = $proveedores->DEPARTAMENTO->Summary;

			// DIRECCION_PROVEEDOR
			$proveedores->DIRECCION_PROVEEDOR->ViewValue = $proveedores->DIRECCION_PROVEEDOR->Summary;

			// TELEFONO_PROVEEDOR1
			$proveedores->TELEFONO_PROVEEDOR1->ViewValue = $proveedores->TELEFONO_PROVEEDOR1->Summary;

			// TELEFONO_PROVEEDOR2
			$proveedores->TELEFONO_PROVEEDOR2->ViewValue = $proveedores->TELEFONO_PROVEEDOR2->Summary;

			// CONTACTO
			$proveedores->CONTACTO->ViewValue = $proveedores->CONTACTO->Summary;

			// ESTANON
			$proveedores->ESTANON->ViewValue = $proveedores->ESTANON->Summary;
		} else {

			// CODIGO_PROVEEDOR
			$proveedores->CODIGO_PROVEEDOR->ViewValue = $proveedores->CODIGO_PROVEEDOR->CurrentValue;
			$proveedores->CODIGO_PROVEEDOR->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// CODIGO_TIPO_EMPRESA
			$proveedores->CODIGO_TIPO_EMPRESA->ViewValue = $proveedores->CODIGO_TIPO_EMPRESA->CurrentValue;
			$proveedores->CODIGO_TIPO_EMPRESA->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// NOMBRE_PROVEEDOR
			$proveedores->NOMBRE_PROVEEDOR->ViewValue = $proveedores->NOMBRE_PROVEEDOR->CurrentValue;
			$proveedores->NOMBRE_PROVEEDOR->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// DEPARTAMENTO
			$proveedores->DEPARTAMENTO->ViewValue = $proveedores->DEPARTAMENTO->CurrentValue;
			$proveedores->DEPARTAMENTO->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// DIRECCION_PROVEEDOR
			$proveedores->DIRECCION_PROVEEDOR->ViewValue = $proveedores->DIRECCION_PROVEEDOR->CurrentValue;
			$proveedores->DIRECCION_PROVEEDOR->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// TELEFONO_PROVEEDOR1
			$proveedores->TELEFONO_PROVEEDOR1->ViewValue = $proveedores->TELEFONO_PROVEEDOR1->CurrentValue;
			$proveedores->TELEFONO_PROVEEDOR1->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// TELEFONO_PROVEEDOR2
			$proveedores->TELEFONO_PROVEEDOR2->ViewValue = $proveedores->TELEFONO_PROVEEDOR2->CurrentValue;
			$proveedores->TELEFONO_PROVEEDOR2->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// CONTACTO
			$proveedores->CONTACTO->ViewValue = $proveedores->CONTACTO->CurrentValue;
			$proveedores->CONTACTO->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";

			// ESTANON
			$proveedores->ESTANON->ViewValue = $proveedores->ESTANON->CurrentValue;
			$proveedores->ESTANON->CellAttrs["class"] = ($this->RecCount % 2 <> 1) ? "ewTableAltRow" : "ewTableRow";
		}

		// CODIGO_PROVEEDOR
		$proveedores->CODIGO_PROVEEDOR->HrefValue = "";

		// CODIGO_TIPO_EMPRESA
		$proveedores->CODIGO_TIPO_EMPRESA->HrefValue = "";

		// NOMBRE_PROVEEDOR
		$proveedores->NOMBRE_PROVEEDOR->HrefValue = "";

		// DEPARTAMENTO
		$proveedores->DEPARTAMENTO->HrefValue = "";

		// DIRECCION_PROVEEDOR
		$proveedores->DIRECCION_PROVEEDOR->HrefValue = "";

		// TELEFONO_PROVEEDOR1
		$proveedores->TELEFONO_PROVEEDOR1->HrefValue = "";

		// TELEFONO_PROVEEDOR2
		$proveedores->TELEFONO_PROVEEDOR2->HrefValue = "";

		// CONTACTO
		$proveedores->CONTACTO->HrefValue = "";

		// ESTANON
		$proveedores->ESTANON->HrefValue = "";

		// Call Row_Rendered event
		$proveedores->Row_Rendered();
	}

	// Return poup filter
	function GetPopupFilter() {
		global $proveedores;
		$sWrk = "";
		return $sWrk;
	}

	//-------------------------------------------------------------------------------
	// Function GetSort
	// - Return Sort parameters based on Sort Links clicked
	// - Variables setup: Session[EWRPT_TABLE_SESSION_ORDER_BY], Session["sort_Table_Field"]
	function GetSort() {
		global $proveedores;

		// Check for a resetsort command
		if (strlen(@$_GET["cmd"]) > 0) {
			$sCmd = @$_GET["cmd"];
			if ($sCmd == "resetsort") {
				$proveedores->setOrderBy("");
				$proveedores->setStartGroup(1);
				$proveedores->CODIGO_PROVEEDOR->setSort("");
				$proveedores->CODIGO_TIPO_EMPRESA->setSort("");
				$proveedores->NOMBRE_PROVEEDOR->setSort("");
				$proveedores->DEPARTAMENTO->setSort("");
				$proveedores->DIRECCION_PROVEEDOR->setSort("");
				$proveedores->TELEFONO_PROVEEDOR1->setSort("");
				$proveedores->TELEFONO_PROVEEDOR2->setSort("");
				$proveedores->CONTACTO->setSort("");
				$proveedores->ESTANON->setSort("");
			}

		// Check for an Order parameter
		} elseif (@$_GET["order"] <> "") {
			$proveedores->CurrentOrder = ewrpt_StripSlashes(@$_GET["order"]);
			$proveedores->CurrentOrderType = @$_GET["ordertype"];
			$sSortSql = $proveedores->SortSql();
			$proveedores->setOrderBy($sSortSql);
			$proveedores->setStartGroup(1);
		}
		return $proveedores->getOrderBy();
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $ReportLanguage, $proveedores;
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

		//$sAttachmentFile = $proveedores->TableVar . "_" . Date("YmdHis") . ".html";
		$sAttachmentFile = $proveedores->TableVar . "_" . Date("YmdHis") . "_" . ewrpt_Random() . ".html";
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
		if ($proveedores->Email_Sending($Email, $EventArgs))
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

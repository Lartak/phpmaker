<?php
namespace PHPMaker2019\demo2019;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$employees_delete = new employees_delete();

// Run the page
$employees_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var femployeesdelete = currentForm = new ew.Form("femployeesdelete", "delete");

// Form_CustomValidate event
femployeesdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
femployeesdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
femployeesdelete.lists["x_Activated[]"] = <?php echo $employees_delete->Activated->Lookup->toClientList() ?>;
femployeesdelete.lists["x_Activated[]"].options = <?php echo JsonEncode($employees_delete->Activated->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $employees_delete->showPageHeader(); ?>
<?php
$employees_delete->showMessage();
?>
<form name="femployeesdelete" id="femployeesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($employees_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $employees_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($employees_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($employees->EmployeeID->Visible) { // EmployeeID ?>
		<th class="<?php echo $employees->EmployeeID->headerCellClass() ?>"><span id="elh_employees_EmployeeID" class="employees_EmployeeID"><?php echo $employees->EmployeeID->caption() ?></span></th>
<?php } ?>
<?php if ($employees->LastName->Visible) { // LastName ?>
		<th class="<?php echo $employees->LastName->headerCellClass() ?>"><span id="elh_employees_LastName" class="employees_LastName"><?php echo $employees->LastName->caption() ?></span></th>
<?php } ?>
<?php if ($employees->FirstName->Visible) { // FirstName ?>
		<th class="<?php echo $employees->FirstName->headerCellClass() ?>"><span id="elh_employees_FirstName" class="employees_FirstName"><?php echo $employees->FirstName->caption() ?></span></th>
<?php } ?>
<?php if ($employees->Title->Visible) { // Title ?>
		<th class="<?php echo $employees->Title->headerCellClass() ?>"><span id="elh_employees_Title" class="employees_Title"><?php echo $employees->Title->caption() ?></span></th>
<?php } ?>
<?php if ($employees->TitleOfCourtesy->Visible) { // TitleOfCourtesy ?>
		<th class="<?php echo $employees->TitleOfCourtesy->headerCellClass() ?>"><span id="elh_employees_TitleOfCourtesy" class="employees_TitleOfCourtesy"><?php echo $employees->TitleOfCourtesy->caption() ?></span></th>
<?php } ?>
<?php if ($employees->BirthDate->Visible) { // BirthDate ?>
		<th class="<?php echo $employees->BirthDate->headerCellClass() ?>"><span id="elh_employees_BirthDate" class="employees_BirthDate"><?php echo $employees->BirthDate->caption() ?></span></th>
<?php } ?>
<?php if ($employees->HireDate->Visible) { // HireDate ?>
		<th class="<?php echo $employees->HireDate->headerCellClass() ?>"><span id="elh_employees_HireDate" class="employees_HireDate"><?php echo $employees->HireDate->caption() ?></span></th>
<?php } ?>
<?php if ($employees->Address->Visible) { // Address ?>
		<th class="<?php echo $employees->Address->headerCellClass() ?>"><span id="elh_employees_Address" class="employees_Address"><?php echo $employees->Address->caption() ?></span></th>
<?php } ?>
<?php if ($employees->City->Visible) { // City ?>
		<th class="<?php echo $employees->City->headerCellClass() ?>"><span id="elh_employees_City" class="employees_City"><?php echo $employees->City->caption() ?></span></th>
<?php } ?>
<?php if ($employees->Region->Visible) { // Region ?>
		<th class="<?php echo $employees->Region->headerCellClass() ?>"><span id="elh_employees_Region" class="employees_Region"><?php echo $employees->Region->caption() ?></span></th>
<?php } ?>
<?php if ($employees->PostalCode->Visible) { // PostalCode ?>
		<th class="<?php echo $employees->PostalCode->headerCellClass() ?>"><span id="elh_employees_PostalCode" class="employees_PostalCode"><?php echo $employees->PostalCode->caption() ?></span></th>
<?php } ?>
<?php if ($employees->Country->Visible) { // Country ?>
		<th class="<?php echo $employees->Country->headerCellClass() ?>"><span id="elh_employees_Country" class="employees_Country"><?php echo $employees->Country->caption() ?></span></th>
<?php } ?>
<?php if ($employees->HomePhone->Visible) { // HomePhone ?>
		<th class="<?php echo $employees->HomePhone->headerCellClass() ?>"><span id="elh_employees_HomePhone" class="employees_HomePhone"><?php echo $employees->HomePhone->caption() ?></span></th>
<?php } ?>
<?php if ($employees->Extension->Visible) { // Extension ?>
		<th class="<?php echo $employees->Extension->headerCellClass() ?>"><span id="elh_employees_Extension" class="employees_Extension"><?php echo $employees->Extension->caption() ?></span></th>
<?php } ?>
<?php if ($employees->_Email->Visible) { // Email ?>
		<th class="<?php echo $employees->_Email->headerCellClass() ?>"><span id="elh_employees__Email" class="employees__Email"><?php echo $employees->_Email->caption() ?></span></th>
<?php } ?>
<?php if ($employees->Photo->Visible) { // Photo ?>
		<th class="<?php echo $employees->Photo->headerCellClass() ?>"><span id="elh_employees_Photo" class="employees_Photo"><?php echo $employees->Photo->caption() ?></span></th>
<?php } ?>
<?php if ($employees->ReportsTo->Visible) { // ReportsTo ?>
		<th class="<?php echo $employees->ReportsTo->headerCellClass() ?>"><span id="elh_employees_ReportsTo" class="employees_ReportsTo"><?php echo $employees->ReportsTo->caption() ?></span></th>
<?php } ?>
<?php if ($employees->Password->Visible) { // Password ?>
		<th class="<?php echo $employees->Password->headerCellClass() ?>"><span id="elh_employees_Password" class="employees_Password"><?php echo $employees->Password->caption() ?></span></th>
<?php } ?>
<?php if ($employees->UserLevel->Visible) { // UserLevel ?>
		<th class="<?php echo $employees->UserLevel->headerCellClass() ?>"><span id="elh_employees_UserLevel" class="employees_UserLevel"><?php echo $employees->UserLevel->caption() ?></span></th>
<?php } ?>
<?php if ($employees->Username->Visible) { // Username ?>
		<th class="<?php echo $employees->Username->headerCellClass() ?>"><span id="elh_employees_Username" class="employees_Username"><?php echo $employees->Username->caption() ?></span></th>
<?php } ?>
<?php if ($employees->Activated->Visible) { // Activated ?>
		<th class="<?php echo $employees->Activated->headerCellClass() ?>"><span id="elh_employees_Activated" class="employees_Activated"><?php echo $employees->Activated->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$employees_delete->RecCnt = 0;
$i = 0;
while (!$employees_delete->Recordset->EOF) {
	$employees_delete->RecCnt++;
	$employees_delete->RowCnt++;

	// Set row properties
	$employees->resetAttributes();
	$employees->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$employees_delete->loadRowValues($employees_delete->Recordset);

	// Render row
	$employees_delete->renderRow();
?>
	<tr<?php echo $employees->rowAttributes() ?>>
<?php if ($employees->EmployeeID->Visible) { // EmployeeID ?>
		<td<?php echo $employees->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_EmployeeID" class="employees_EmployeeID">
<span<?php echo $employees->EmployeeID->viewAttributes() ?>>
<?php echo $employees->EmployeeID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->LastName->Visible) { // LastName ?>
		<td<?php echo $employees->LastName->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_LastName" class="employees_LastName">
<span<?php echo $employees->LastName->viewAttributes() ?>>
<?php echo $employees->LastName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->FirstName->Visible) { // FirstName ?>
		<td<?php echo $employees->FirstName->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_FirstName" class="employees_FirstName">
<span<?php echo $employees->FirstName->viewAttributes() ?>>
<?php echo $employees->FirstName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->Title->Visible) { // Title ?>
		<td<?php echo $employees->Title->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_Title" class="employees_Title">
<span<?php echo $employees->Title->viewAttributes() ?>>
<?php echo $employees->Title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->TitleOfCourtesy->Visible) { // TitleOfCourtesy ?>
		<td<?php echo $employees->TitleOfCourtesy->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_TitleOfCourtesy" class="employees_TitleOfCourtesy">
<span<?php echo $employees->TitleOfCourtesy->viewAttributes() ?>>
<?php echo $employees->TitleOfCourtesy->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->BirthDate->Visible) { // BirthDate ?>
		<td<?php echo $employees->BirthDate->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_BirthDate" class="employees_BirthDate">
<span<?php echo $employees->BirthDate->viewAttributes() ?>>
<?php echo $employees->BirthDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->HireDate->Visible) { // HireDate ?>
		<td<?php echo $employees->HireDate->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_HireDate" class="employees_HireDate">
<span<?php echo $employees->HireDate->viewAttributes() ?>>
<?php echo $employees->HireDate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->Address->Visible) { // Address ?>
		<td<?php echo $employees->Address->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_Address" class="employees_Address">
<span<?php echo $employees->Address->viewAttributes() ?>>
<?php echo $employees->Address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->City->Visible) { // City ?>
		<td<?php echo $employees->City->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_City" class="employees_City">
<span<?php echo $employees->City->viewAttributes() ?>>
<?php echo $employees->City->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->Region->Visible) { // Region ?>
		<td<?php echo $employees->Region->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_Region" class="employees_Region">
<span<?php echo $employees->Region->viewAttributes() ?>>
<?php echo $employees->Region->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->PostalCode->Visible) { // PostalCode ?>
		<td<?php echo $employees->PostalCode->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_PostalCode" class="employees_PostalCode">
<span<?php echo $employees->PostalCode->viewAttributes() ?>>
<?php echo $employees->PostalCode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->Country->Visible) { // Country ?>
		<td<?php echo $employees->Country->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_Country" class="employees_Country">
<span<?php echo $employees->Country->viewAttributes() ?>>
<?php echo $employees->Country->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->HomePhone->Visible) { // HomePhone ?>
		<td<?php echo $employees->HomePhone->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_HomePhone" class="employees_HomePhone">
<span<?php echo $employees->HomePhone->viewAttributes() ?>>
<?php echo $employees->HomePhone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->Extension->Visible) { // Extension ?>
		<td<?php echo $employees->Extension->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_Extension" class="employees_Extension">
<span<?php echo $employees->Extension->viewAttributes() ?>>
<?php echo $employees->Extension->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->_Email->Visible) { // Email ?>
		<td<?php echo $employees->_Email->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees__Email" class="employees__Email">
<span<?php echo $employees->_Email->viewAttributes() ?>>
<?php echo $employees->_Email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->Photo->Visible) { // Photo ?>
		<td<?php echo $employees->Photo->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_Photo" class="employees_Photo">
<span<?php echo $employees->Photo->viewAttributes() ?>>
<?php echo $employees->Photo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->ReportsTo->Visible) { // ReportsTo ?>
		<td<?php echo $employees->ReportsTo->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_ReportsTo" class="employees_ReportsTo">
<span<?php echo $employees->ReportsTo->viewAttributes() ?>>
<?php echo $employees->ReportsTo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->Password->Visible) { // Password ?>
		<td<?php echo $employees->Password->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_Password" class="employees_Password">
<span<?php echo $employees->Password->viewAttributes() ?>>
<?php echo $employees->Password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->UserLevel->Visible) { // UserLevel ?>
		<td<?php echo $employees->UserLevel->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_UserLevel" class="employees_UserLevel">
<span<?php echo $employees->UserLevel->viewAttributes() ?>>
<?php echo $employees->UserLevel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->Username->Visible) { // Username ?>
		<td<?php echo $employees->Username->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_Username" class="employees_Username">
<span<?php echo $employees->Username->viewAttributes() ?>>
<?php echo $employees->Username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees->Activated->Visible) { // Activated ?>
		<td<?php echo $employees->Activated->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCnt ?>_employees_Activated" class="employees_Activated">
<span<?php echo $employees->Activated->viewAttributes() ?>>
<?php if (ConvertToBool($employees->Activated->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $employees->Activated->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $employees->Activated->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$employees_delete->Recordset->moveNext();
}
$employees_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employees_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$employees_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$employees_delete->terminate();
?>

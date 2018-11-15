<?php
namespace PHPMaker2019\demo2019;

/**
 * Table class for orders
 */
class orders extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $OrderID;
	public $CustomerID;
	public $EmployeeID;
	public $OrderDate;
	public $RequiredDate;
	public $ShippedDate;
	public $ShipVia;
	public $Freight;
	public $ShipName;
	public $ShipAddress;
	public $ShipCity;
	public $ShipRegion;
	public $ShipPostalCode;
	public $ShipCountry;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'orders';
		$this->TableName = 'orders';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`orders`";
		$this->Dbid = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// OrderID
		$this->OrderID = new DbField('orders', 'orders', 'x_OrderID', 'OrderID', '`OrderID`', '`OrderID`', 3, -1, FALSE, '`OrderID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->OrderID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->OrderID->IsPrimaryKey = TRUE; // Primary key field
		$this->OrderID->Sortable = TRUE; // Allow sort
		$this->OrderID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['OrderID'] = &$this->OrderID;

		// CustomerID
		$this->CustomerID = new DbField('orders', 'orders', 'x_CustomerID', 'CustomerID', '`CustomerID`', '`CustomerID`', 200, -1, FALSE, '`CustomerID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CustomerID->Sortable = TRUE; // Allow sort
		$this->fields['CustomerID'] = &$this->CustomerID;

		// EmployeeID
		$this->EmployeeID = new DbField('orders', 'orders', 'x_EmployeeID', 'EmployeeID', '`EmployeeID`', '`EmployeeID`', 3, -1, FALSE, '`EmployeeID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->EmployeeID->Sortable = TRUE; // Allow sort
		$this->EmployeeID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['EmployeeID'] = &$this->EmployeeID;

		// OrderDate
		$this->OrderDate = new DbField('orders', 'orders', 'x_OrderDate', 'OrderDate', '`OrderDate`', CastDateFieldForLike('`OrderDate`', 0, "DB"), 135, 0, FALSE, '`OrderDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->OrderDate->Sortable = TRUE; // Allow sort
		$this->OrderDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['OrderDate'] = &$this->OrderDate;

		// RequiredDate
		$this->RequiredDate = new DbField('orders', 'orders', 'x_RequiredDate', 'RequiredDate', '`RequiredDate`', CastDateFieldForLike('`RequiredDate`', 0, "DB"), 135, 0, FALSE, '`RequiredDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->RequiredDate->Sortable = TRUE; // Allow sort
		$this->RequiredDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['RequiredDate'] = &$this->RequiredDate;

		// ShippedDate
		$this->ShippedDate = new DbField('orders', 'orders', 'x_ShippedDate', 'ShippedDate', '`ShippedDate`', CastDateFieldForLike('`ShippedDate`', 0, "DB"), 135, 0, FALSE, '`ShippedDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ShippedDate->Sortable = TRUE; // Allow sort
		$this->ShippedDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['ShippedDate'] = &$this->ShippedDate;

		// ShipVia
		$this->ShipVia = new DbField('orders', 'orders', 'x_ShipVia', 'ShipVia', '`ShipVia`', '`ShipVia`', 3, -1, FALSE, '`ShipVia`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ShipVia->Sortable = TRUE; // Allow sort
		$this->ShipVia->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ShipVia'] = &$this->ShipVia;

		// Freight
		$this->Freight = new DbField('orders', 'orders', 'x_Freight', 'Freight', '`Freight`', '`Freight`', 5, -1, FALSE, '`Freight`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Freight->Sortable = TRUE; // Allow sort
		$this->Freight->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Freight'] = &$this->Freight;

		// ShipName
		$this->ShipName = new DbField('orders', 'orders', 'x_ShipName', 'ShipName', '`ShipName`', '`ShipName`', 200, -1, FALSE, '`ShipName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ShipName->Sortable = TRUE; // Allow sort
		$this->fields['ShipName'] = &$this->ShipName;

		// ShipAddress
		$this->ShipAddress = new DbField('orders', 'orders', 'x_ShipAddress', 'ShipAddress', '`ShipAddress`', '`ShipAddress`', 200, -1, FALSE, '`ShipAddress`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ShipAddress->Sortable = TRUE; // Allow sort
		$this->fields['ShipAddress'] = &$this->ShipAddress;

		// ShipCity
		$this->ShipCity = new DbField('orders', 'orders', 'x_ShipCity', 'ShipCity', '`ShipCity`', '`ShipCity`', 200, -1, FALSE, '`ShipCity`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ShipCity->Sortable = TRUE; // Allow sort
		$this->fields['ShipCity'] = &$this->ShipCity;

		// ShipRegion
		$this->ShipRegion = new DbField('orders', 'orders', 'x_ShipRegion', 'ShipRegion', '`ShipRegion`', '`ShipRegion`', 200, -1, FALSE, '`ShipRegion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ShipRegion->Sortable = TRUE; // Allow sort
		$this->fields['ShipRegion'] = &$this->ShipRegion;

		// ShipPostalCode
		$this->ShipPostalCode = new DbField('orders', 'orders', 'x_ShipPostalCode', 'ShipPostalCode', '`ShipPostalCode`', '`ShipPostalCode`', 200, -1, FALSE, '`ShipPostalCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ShipPostalCode->Sortable = TRUE; // Allow sort
		$this->fields['ShipPostalCode'] = &$this->ShipPostalCode;

		// ShipCountry
		$this->ShipCountry = new DbField('orders', 'orders', 'x_ShipCountry', 'ShipCountry', '`ShipCountry`', '`ShipCountry`', 200, -1, FALSE, '`ShipCountry`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ShipCountry->Sortable = TRUE; // Allow sort
		$this->fields['ShipCountry'] = &$this->ShipCountry;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`orders`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->OrderID->setDbValue($conn->insert_ID());
			$rs['OrderID'] = $this->OrderID->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('OrderID', $rs))
				AddFilter($where, QuotedName('OrderID', $this->Dbid) . '=' . QuotedValue($rs['OrderID'], $this->OrderID->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->OrderID->DbValue = $row['OrderID'];
		$this->CustomerID->DbValue = $row['CustomerID'];
		$this->EmployeeID->DbValue = $row['EmployeeID'];
		$this->OrderDate->DbValue = $row['OrderDate'];
		$this->RequiredDate->DbValue = $row['RequiredDate'];
		$this->ShippedDate->DbValue = $row['ShippedDate'];
		$this->ShipVia->DbValue = $row['ShipVia'];
		$this->Freight->DbValue = $row['Freight'];
		$this->ShipName->DbValue = $row['ShipName'];
		$this->ShipAddress->DbValue = $row['ShipAddress'];
		$this->ShipCity->DbValue = $row['ShipCity'];
		$this->ShipRegion->DbValue = $row['ShipRegion'];
		$this->ShipPostalCode->DbValue = $row['ShipPostalCode'];
		$this->ShipCountry->DbValue = $row['ShipCountry'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`OrderID` = @OrderID@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('OrderID', $row) ? $row['OrderID'] : NULL) : $this->OrderID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@OrderID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "orderslist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "ordersview.php")
			return $Language->phrase("View");
		elseif ($pageName == "ordersedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "ordersadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "orderslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("ordersview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("ordersview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "ordersadd.php?" . $this->getUrlParm($parm);
		else
			$url = "ordersadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("ordersedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("ordersadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("ordersdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "OrderID:" . JsonEncode($this->OrderID->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->OrderID->CurrentValue != NULL) {
			$url .= "OrderID=" . urlencode($this->OrderID->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("OrderID") !== NULL)
				$arKeys[] = Param("OrderID");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->OrderID->CurrentValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->OrderID->setDbValue($rs->fields('OrderID'));
		$this->CustomerID->setDbValue($rs->fields('CustomerID'));
		$this->EmployeeID->setDbValue($rs->fields('EmployeeID'));
		$this->OrderDate->setDbValue($rs->fields('OrderDate'));
		$this->RequiredDate->setDbValue($rs->fields('RequiredDate'));
		$this->ShippedDate->setDbValue($rs->fields('ShippedDate'));
		$this->ShipVia->setDbValue($rs->fields('ShipVia'));
		$this->Freight->setDbValue($rs->fields('Freight'));
		$this->ShipName->setDbValue($rs->fields('ShipName'));
		$this->ShipAddress->setDbValue($rs->fields('ShipAddress'));
		$this->ShipCity->setDbValue($rs->fields('ShipCity'));
		$this->ShipRegion->setDbValue($rs->fields('ShipRegion'));
		$this->ShipPostalCode->setDbValue($rs->fields('ShipPostalCode'));
		$this->ShipCountry->setDbValue($rs->fields('ShipCountry'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// OrderID
		// CustomerID
		// EmployeeID
		// OrderDate
		// RequiredDate
		// ShippedDate
		// ShipVia
		// Freight
		// ShipName
		// ShipAddress
		// ShipCity
		// ShipRegion
		// ShipPostalCode
		// ShipCountry
		// OrderID

		$this->OrderID->ViewValue = $this->OrderID->CurrentValue;
		$this->OrderID->ViewCustomAttributes = "";

		// CustomerID
		$this->CustomerID->ViewValue = $this->CustomerID->CurrentValue;
		$this->CustomerID->ViewCustomAttributes = "";

		// EmployeeID
		$this->EmployeeID->ViewValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->ViewValue = FormatNumber($this->EmployeeID->ViewValue, 0, -2, -2, -2);
		$this->EmployeeID->ViewCustomAttributes = "";

		// OrderDate
		$this->OrderDate->ViewValue = $this->OrderDate->CurrentValue;
		$this->OrderDate->ViewValue = FormatDateTime($this->OrderDate->ViewValue, 0);
		$this->OrderDate->ViewCustomAttributes = "";

		// RequiredDate
		$this->RequiredDate->ViewValue = $this->RequiredDate->CurrentValue;
		$this->RequiredDate->ViewValue = FormatDateTime($this->RequiredDate->ViewValue, 0);
		$this->RequiredDate->ViewCustomAttributes = "";

		// ShippedDate
		$this->ShippedDate->ViewValue = $this->ShippedDate->CurrentValue;
		$this->ShippedDate->ViewValue = FormatDateTime($this->ShippedDate->ViewValue, 0);
		$this->ShippedDate->ViewCustomAttributes = "";

		// ShipVia
		$this->ShipVia->ViewValue = $this->ShipVia->CurrentValue;
		$this->ShipVia->ViewValue = FormatNumber($this->ShipVia->ViewValue, 0, -2, -2, -2);
		$this->ShipVia->ViewCustomAttributes = "";

		// Freight
		$this->Freight->ViewValue = $this->Freight->CurrentValue;
		$this->Freight->ViewValue = FormatNumber($this->Freight->ViewValue, 2, -2, -2, -2);
		$this->Freight->ViewCustomAttributes = "";

		// ShipName
		$this->ShipName->ViewValue = $this->ShipName->CurrentValue;
		$this->ShipName->ViewCustomAttributes = "";

		// ShipAddress
		$this->ShipAddress->ViewValue = $this->ShipAddress->CurrentValue;
		$this->ShipAddress->ViewCustomAttributes = "";

		// ShipCity
		$this->ShipCity->ViewValue = $this->ShipCity->CurrentValue;
		$this->ShipCity->ViewCustomAttributes = "";

		// ShipRegion
		$this->ShipRegion->ViewValue = $this->ShipRegion->CurrentValue;
		$this->ShipRegion->ViewCustomAttributes = "";

		// ShipPostalCode
		$this->ShipPostalCode->ViewValue = $this->ShipPostalCode->CurrentValue;
		$this->ShipPostalCode->ViewCustomAttributes = "";

		// ShipCountry
		$this->ShipCountry->ViewValue = $this->ShipCountry->CurrentValue;
		$this->ShipCountry->ViewCustomAttributes = "";

		// OrderID
		$this->OrderID->LinkCustomAttributes = "";
		$this->OrderID->HrefValue = "";
		$this->OrderID->TooltipValue = "";

		// CustomerID
		$this->CustomerID->LinkCustomAttributes = "";
		$this->CustomerID->HrefValue = "";
		$this->CustomerID->TooltipValue = "";

		// EmployeeID
		$this->EmployeeID->LinkCustomAttributes = "";
		$this->EmployeeID->HrefValue = "";
		$this->EmployeeID->TooltipValue = "";

		// OrderDate
		$this->OrderDate->LinkCustomAttributes = "";
		$this->OrderDate->HrefValue = "";
		$this->OrderDate->TooltipValue = "";

		// RequiredDate
		$this->RequiredDate->LinkCustomAttributes = "";
		$this->RequiredDate->HrefValue = "";
		$this->RequiredDate->TooltipValue = "";

		// ShippedDate
		$this->ShippedDate->LinkCustomAttributes = "";
		$this->ShippedDate->HrefValue = "";
		$this->ShippedDate->TooltipValue = "";

		// ShipVia
		$this->ShipVia->LinkCustomAttributes = "";
		$this->ShipVia->HrefValue = "";
		$this->ShipVia->TooltipValue = "";

		// Freight
		$this->Freight->LinkCustomAttributes = "";
		$this->Freight->HrefValue = "";
		$this->Freight->TooltipValue = "";

		// ShipName
		$this->ShipName->LinkCustomAttributes = "";
		$this->ShipName->HrefValue = "";
		$this->ShipName->TooltipValue = "";

		// ShipAddress
		$this->ShipAddress->LinkCustomAttributes = "";
		$this->ShipAddress->HrefValue = "";
		$this->ShipAddress->TooltipValue = "";

		// ShipCity
		$this->ShipCity->LinkCustomAttributes = "";
		$this->ShipCity->HrefValue = "";
		$this->ShipCity->TooltipValue = "";

		// ShipRegion
		$this->ShipRegion->LinkCustomAttributes = "";
		$this->ShipRegion->HrefValue = "";
		$this->ShipRegion->TooltipValue = "";

		// ShipPostalCode
		$this->ShipPostalCode->LinkCustomAttributes = "";
		$this->ShipPostalCode->HrefValue = "";
		$this->ShipPostalCode->TooltipValue = "";

		// ShipCountry
		$this->ShipCountry->LinkCustomAttributes = "";
		$this->ShipCountry->HrefValue = "";
		$this->ShipCountry->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// OrderID
		$this->OrderID->EditAttrs["class"] = "form-control";
		$this->OrderID->EditCustomAttributes = "";
		$this->OrderID->EditValue = $this->OrderID->CurrentValue;
		$this->OrderID->ViewCustomAttributes = "";

		// CustomerID
		$this->CustomerID->EditAttrs["class"] = "form-control";
		$this->CustomerID->EditCustomAttributes = "";
		$this->CustomerID->EditValue = $this->CustomerID->CurrentValue;
		$this->CustomerID->PlaceHolder = RemoveHtml($this->CustomerID->caption());

		// EmployeeID
		$this->EmployeeID->EditAttrs["class"] = "form-control";
		$this->EmployeeID->EditCustomAttributes = "";
		$this->EmployeeID->EditValue = $this->EmployeeID->CurrentValue;
		$this->EmployeeID->PlaceHolder = RemoveHtml($this->EmployeeID->caption());

		// OrderDate
		$this->OrderDate->EditAttrs["class"] = "form-control";
		$this->OrderDate->EditCustomAttributes = "";
		$this->OrderDate->EditValue = FormatDateTime($this->OrderDate->CurrentValue, 8);
		$this->OrderDate->PlaceHolder = RemoveHtml($this->OrderDate->caption());

		// RequiredDate
		$this->RequiredDate->EditAttrs["class"] = "form-control";
		$this->RequiredDate->EditCustomAttributes = "";
		$this->RequiredDate->EditValue = FormatDateTime($this->RequiredDate->CurrentValue, 8);
		$this->RequiredDate->PlaceHolder = RemoveHtml($this->RequiredDate->caption());

		// ShippedDate
		$this->ShippedDate->EditAttrs["class"] = "form-control";
		$this->ShippedDate->EditCustomAttributes = "";
		$this->ShippedDate->EditValue = FormatDateTime($this->ShippedDate->CurrentValue, 8);
		$this->ShippedDate->PlaceHolder = RemoveHtml($this->ShippedDate->caption());

		// ShipVia
		$this->ShipVia->EditAttrs["class"] = "form-control";
		$this->ShipVia->EditCustomAttributes = "";
		$this->ShipVia->EditValue = $this->ShipVia->CurrentValue;
		$this->ShipVia->PlaceHolder = RemoveHtml($this->ShipVia->caption());

		// Freight
		$this->Freight->EditAttrs["class"] = "form-control";
		$this->Freight->EditCustomAttributes = "";
		$this->Freight->EditValue = $this->Freight->CurrentValue;
		$this->Freight->PlaceHolder = RemoveHtml($this->Freight->caption());
		if (strval($this->Freight->EditValue) <> "" && is_numeric($this->Freight->EditValue))
			$this->Freight->EditValue = FormatNumber($this->Freight->EditValue, -2, -2, -2, -2);

		// ShipName
		$this->ShipName->EditAttrs["class"] = "form-control";
		$this->ShipName->EditCustomAttributes = "";
		$this->ShipName->EditValue = $this->ShipName->CurrentValue;
		$this->ShipName->PlaceHolder = RemoveHtml($this->ShipName->caption());

		// ShipAddress
		$this->ShipAddress->EditAttrs["class"] = "form-control";
		$this->ShipAddress->EditCustomAttributes = "";
		$this->ShipAddress->EditValue = $this->ShipAddress->CurrentValue;
		$this->ShipAddress->PlaceHolder = RemoveHtml($this->ShipAddress->caption());

		// ShipCity
		$this->ShipCity->EditAttrs["class"] = "form-control";
		$this->ShipCity->EditCustomAttributes = "";
		$this->ShipCity->EditValue = $this->ShipCity->CurrentValue;
		$this->ShipCity->PlaceHolder = RemoveHtml($this->ShipCity->caption());

		// ShipRegion
		$this->ShipRegion->EditAttrs["class"] = "form-control";
		$this->ShipRegion->EditCustomAttributes = "";
		$this->ShipRegion->EditValue = $this->ShipRegion->CurrentValue;
		$this->ShipRegion->PlaceHolder = RemoveHtml($this->ShipRegion->caption());

		// ShipPostalCode
		$this->ShipPostalCode->EditAttrs["class"] = "form-control";
		$this->ShipPostalCode->EditCustomAttributes = "";
		$this->ShipPostalCode->EditValue = $this->ShipPostalCode->CurrentValue;
		$this->ShipPostalCode->PlaceHolder = RemoveHtml($this->ShipPostalCode->caption());

		// ShipCountry
		$this->ShipCountry->EditAttrs["class"] = "form-control";
		$this->ShipCountry->EditCustomAttributes = "";
		$this->ShipCountry->EditValue = $this->ShipCountry->CurrentValue;
		$this->ShipCountry->PlaceHolder = RemoveHtml($this->ShipCountry->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->OrderID);
					$doc->exportCaption($this->CustomerID);
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->OrderDate);
					$doc->exportCaption($this->RequiredDate);
					$doc->exportCaption($this->ShippedDate);
					$doc->exportCaption($this->ShipVia);
					$doc->exportCaption($this->Freight);
					$doc->exportCaption($this->ShipName);
					$doc->exportCaption($this->ShipAddress);
					$doc->exportCaption($this->ShipCity);
					$doc->exportCaption($this->ShipRegion);
					$doc->exportCaption($this->ShipPostalCode);
					$doc->exportCaption($this->ShipCountry);
				} else {
					$doc->exportCaption($this->OrderID);
					$doc->exportCaption($this->CustomerID);
					$doc->exportCaption($this->EmployeeID);
					$doc->exportCaption($this->OrderDate);
					$doc->exportCaption($this->RequiredDate);
					$doc->exportCaption($this->ShippedDate);
					$doc->exportCaption($this->ShipVia);
					$doc->exportCaption($this->Freight);
					$doc->exportCaption($this->ShipName);
					$doc->exportCaption($this->ShipAddress);
					$doc->exportCaption($this->ShipCity);
					$doc->exportCaption($this->ShipRegion);
					$doc->exportCaption($this->ShipPostalCode);
					$doc->exportCaption($this->ShipCountry);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->OrderID);
						$doc->exportField($this->CustomerID);
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->OrderDate);
						$doc->exportField($this->RequiredDate);
						$doc->exportField($this->ShippedDate);
						$doc->exportField($this->ShipVia);
						$doc->exportField($this->Freight);
						$doc->exportField($this->ShipName);
						$doc->exportField($this->ShipAddress);
						$doc->exportField($this->ShipCity);
						$doc->exportField($this->ShipRegion);
						$doc->exportField($this->ShipPostalCode);
						$doc->exportField($this->ShipCountry);
					} else {
						$doc->exportField($this->OrderID);
						$doc->exportField($this->CustomerID);
						$doc->exportField($this->EmployeeID);
						$doc->exportField($this->OrderDate);
						$doc->exportField($this->RequiredDate);
						$doc->exportField($this->ShippedDate);
						$doc->exportField($this->ShipVia);
						$doc->exportField($this->Freight);
						$doc->exportField($this->ShipName);
						$doc->exportField($this->ShipAddress);
						$doc->exportField($this->ShipCity);
						$doc->exportField($this->ShipRegion);
						$doc->exportField($this->ShipPostalCode);
						$doc->exportField($this->ShipCountry);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Lookup data from table
	public function lookup()
	{
		global $Language;
		if (!isset($Language))
			$Language = new Language(LANGUAGE_FOLDER, Post("language", ""));

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if (Post("keys") !== NULL) { // Selected records from modal
			$keys = Post("keys");
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>

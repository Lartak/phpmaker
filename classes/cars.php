<?php
namespace PHPMaker2019\demo2019;

/**
 * Table class for cars
 */
class cars extends DbTable
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
	public $ID;
	public $Trademark;
	public $Model;
	public $HP;
	public $Liter;
	public $Cyl;
	public $TransmissSpeedCount;
	public $TransmissAutomatic;
	public $MPG_City;
	public $MPG_Highway;
	public $Category;
	public $Description;
	public $Hyperlink;
	public $Price;
	public $Picture;
	public $PictureName;
	public $PictureSize;
	public $PictureType;
	public $PictureWidth;
	public $PictureHeight;
	public $Color;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'cars';
		$this->TableName = 'cars';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`cars`";
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

		// ID
		$this->ID = new DbField('cars', 'cars', 'x_ID', 'ID', '`ID`', '`ID`', 3, -1, FALSE, '`ID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->ID->IsPrimaryKey = TRUE; // Primary key field
		$this->ID->Sortable = TRUE; // Allow sort
		$this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ID'] = &$this->ID;

		// Trademark
		$this->Trademark = new DbField('cars', 'cars', 'x_Trademark', 'Trademark', '`Trademark`', '`Trademark`', 3, -1, FALSE, '`Trademark`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Trademark->Sortable = TRUE; // Allow sort
		$this->Trademark->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Trademark'] = &$this->Trademark;

		// Model
		$this->Model = new DbField('cars', 'cars', 'x_Model', 'Model', '`Model`', '`Model`', 3, -1, FALSE, '`Model`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Model->Sortable = TRUE; // Allow sort
		$this->Model->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Model'] = &$this->Model;

		// HP
		$this->HP = new DbField('cars', 'cars', 'x_HP', 'HP', '`HP`', '`HP`', 2, -1, FALSE, '`HP`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->HP->Sortable = TRUE; // Allow sort
		$this->HP->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['HP'] = &$this->HP;

		// Liter
		$this->Liter = new DbField('cars', 'cars', 'x_Liter', 'Liter', '`Liter`', '`Liter`', 5, -1, FALSE, '`Liter`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Liter->Sortable = TRUE; // Allow sort
		$this->Liter->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Liter'] = &$this->Liter;

		// Cyl
		$this->Cyl = new DbField('cars', 'cars', 'x_Cyl', 'Cyl', '`Cyl`', '`Cyl`', 16, -1, FALSE, '`Cyl`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Cyl->Sortable = TRUE; // Allow sort
		$this->Cyl->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['Cyl'] = &$this->Cyl;

		// TransmissSpeedCount
		$this->TransmissSpeedCount = new DbField('cars', 'cars', 'x_TransmissSpeedCount', 'TransmissSpeedCount', '`TransmissSpeedCount`', '`TransmissSpeedCount`', 16, -1, FALSE, '`TransmissSpeedCount`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TransmissSpeedCount->Sortable = TRUE; // Allow sort
		$this->TransmissSpeedCount->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['TransmissSpeedCount'] = &$this->TransmissSpeedCount;

		// TransmissAutomatic
		$this->TransmissAutomatic = new DbField('cars', 'cars', 'x_TransmissAutomatic', 'TransmissAutomatic', '`TransmissAutomatic`', '`TransmissAutomatic`', 200, -1, FALSE, '`TransmissAutomatic`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->TransmissAutomatic->Sortable = TRUE; // Allow sort
		$this->fields['TransmissAutomatic'] = &$this->TransmissAutomatic;

		// MPG_City
		$this->MPG_City = new DbField('cars', 'cars', 'x_MPG_City', 'MPG_City', '`MPG_City`', '`MPG_City`', 16, -1, FALSE, '`MPG_City`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MPG_City->Sortable = TRUE; // Allow sort
		$this->MPG_City->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['MPG_City'] = &$this->MPG_City;

		// MPG_Highway
		$this->MPG_Highway = new DbField('cars', 'cars', 'x_MPG_Highway', 'MPG_Highway', '`MPG_Highway`', '`MPG_Highway`', 16, -1, FALSE, '`MPG_Highway`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->MPG_Highway->Sortable = TRUE; // Allow sort
		$this->MPG_Highway->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['MPG_Highway'] = &$this->MPG_Highway;

		// Category
		$this->Category = new DbField('cars', 'cars', 'x_Category', 'Category', '`Category`', '`Category`', 200, -1, FALSE, '`Category`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Category->Sortable = TRUE; // Allow sort
		$this->fields['Category'] = &$this->Category;

		// Description
		$this->Description = new DbField('cars', 'cars', 'x_Description', 'Description', '`Description`', '`Description`', 201, -1, FALSE, '`Description`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Description->Sortable = TRUE; // Allow sort
		$this->fields['Description'] = &$this->Description;

		// Hyperlink
		$this->Hyperlink = new DbField('cars', 'cars', 'x_Hyperlink', 'Hyperlink', '`Hyperlink`', '`Hyperlink`', 200, -1, FALSE, '`Hyperlink`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Hyperlink->Sortable = TRUE; // Allow sort
		$this->fields['Hyperlink'] = &$this->Hyperlink;

		// Price
		$this->Price = new DbField('cars', 'cars', 'x_Price', 'Price', '`Price`', '`Price`', 5, -1, FALSE, '`Price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Price->Sortable = TRUE; // Allow sort
		$this->Price->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['Price'] = &$this->Price;

		// Picture
		$this->Picture = new DbField('cars', 'cars', 'x_Picture', 'Picture', '`Picture`', '`Picture`', 205, -1, TRUE, '`Picture`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->Picture->Sortable = TRUE; // Allow sort
		$this->fields['Picture'] = &$this->Picture;

		// PictureName
		$this->PictureName = new DbField('cars', 'cars', 'x_PictureName', 'PictureName', '`PictureName`', '`PictureName`', 200, -1, FALSE, '`PictureName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PictureName->Sortable = TRUE; // Allow sort
		$this->fields['PictureName'] = &$this->PictureName;

		// PictureSize
		$this->PictureSize = new DbField('cars', 'cars', 'x_PictureSize', 'PictureSize', '`PictureSize`', '`PictureSize`', 3, -1, FALSE, '`PictureSize`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PictureSize->Sortable = TRUE; // Allow sort
		$this->PictureSize->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PictureSize'] = &$this->PictureSize;

		// PictureType
		$this->PictureType = new DbField('cars', 'cars', 'x_PictureType', 'PictureType', '`PictureType`', '`PictureType`', 200, -1, FALSE, '`PictureType`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PictureType->Sortable = TRUE; // Allow sort
		$this->fields['PictureType'] = &$this->PictureType;

		// PictureWidth
		$this->PictureWidth = new DbField('cars', 'cars', 'x_PictureWidth', 'PictureWidth', '`PictureWidth`', '`PictureWidth`', 3, -1, FALSE, '`PictureWidth`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PictureWidth->Sortable = TRUE; // Allow sort
		$this->PictureWidth->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PictureWidth'] = &$this->PictureWidth;

		// PictureHeight
		$this->PictureHeight = new DbField('cars', 'cars', 'x_PictureHeight', 'PictureHeight', '`PictureHeight`', '`PictureHeight`', 3, -1, FALSE, '`PictureHeight`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PictureHeight->Sortable = TRUE; // Allow sort
		$this->PictureHeight->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PictureHeight'] = &$this->PictureHeight;

		// Color
		$this->Color = new DbField('cars', 'cars', 'x_Color', 'Color', '`Color`', '`Color`', 200, -1, FALSE, '`Color`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Color->Sortable = TRUE; // Allow sort
		$this->fields['Color'] = &$this->Color;
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
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`cars`";
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
			$this->ID->setDbValue($conn->insert_ID());
			$rs['ID'] = $this->ID->DbValue;
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
			if (array_key_exists('ID', $rs))
				AddFilter($where, QuotedName('ID', $this->Dbid) . '=' . QuotedValue($rs['ID'], $this->ID->DataType, $this->Dbid));
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
		$this->ID->DbValue = $row['ID'];
		$this->Trademark->DbValue = $row['Trademark'];
		$this->Model->DbValue = $row['Model'];
		$this->HP->DbValue = $row['HP'];
		$this->Liter->DbValue = $row['Liter'];
		$this->Cyl->DbValue = $row['Cyl'];
		$this->TransmissSpeedCount->DbValue = $row['TransmissSpeedCount'];
		$this->TransmissAutomatic->DbValue = $row['TransmissAutomatic'];
		$this->MPG_City->DbValue = $row['MPG_City'];
		$this->MPG_Highway->DbValue = $row['MPG_Highway'];
		$this->Category->DbValue = $row['Category'];
		$this->Description->DbValue = $row['Description'];
		$this->Hyperlink->DbValue = $row['Hyperlink'];
		$this->Price->DbValue = $row['Price'];
		$this->Picture->Upload->DbValue = $row['Picture'];
		$this->PictureName->DbValue = $row['PictureName'];
		$this->PictureSize->DbValue = $row['PictureSize'];
		$this->PictureType->DbValue = $row['PictureType'];
		$this->PictureWidth->DbValue = $row['PictureWidth'];
		$this->PictureHeight->DbValue = $row['PictureHeight'];
		$this->Color->DbValue = $row['Color'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`ID` = @ID@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('ID', $row) ? $row['ID'] : NULL) : $this->ID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "carslist.php";
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
		if ($pageName == "carsview.php")
			return $Language->phrase("View");
		elseif ($pageName == "carsedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "carsadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "carslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("carsview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("carsview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "carsadd.php?" . $this->getUrlParm($parm);
		else
			$url = "carsadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("carsedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("carsadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("carsdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "ID:" . JsonEncode($this->ID->CurrentValue, "number");
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
		if ($this->ID->CurrentValue != NULL) {
			$url .= "ID=" . urlencode($this->ID->CurrentValue);
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
			if (Param("ID") !== NULL)
				$arKeys[] = Param("ID");
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
			$this->ID->CurrentValue = $key;
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
		$this->ID->setDbValue($rs->fields('ID'));
		$this->Trademark->setDbValue($rs->fields('Trademark'));
		$this->Model->setDbValue($rs->fields('Model'));
		$this->HP->setDbValue($rs->fields('HP'));
		$this->Liter->setDbValue($rs->fields('Liter'));
		$this->Cyl->setDbValue($rs->fields('Cyl'));
		$this->TransmissSpeedCount->setDbValue($rs->fields('TransmissSpeedCount'));
		$this->TransmissAutomatic->setDbValue($rs->fields('TransmissAutomatic'));
		$this->MPG_City->setDbValue($rs->fields('MPG_City'));
		$this->MPG_Highway->setDbValue($rs->fields('MPG_Highway'));
		$this->Category->setDbValue($rs->fields('Category'));
		$this->Description->setDbValue($rs->fields('Description'));
		$this->Hyperlink->setDbValue($rs->fields('Hyperlink'));
		$this->Price->setDbValue($rs->fields('Price'));
		$this->Picture->Upload->DbValue = $rs->fields('Picture');
		$this->PictureName->setDbValue($rs->fields('PictureName'));
		$this->PictureSize->setDbValue($rs->fields('PictureSize'));
		$this->PictureType->setDbValue($rs->fields('PictureType'));
		$this->PictureWidth->setDbValue($rs->fields('PictureWidth'));
		$this->PictureHeight->setDbValue($rs->fields('PictureHeight'));
		$this->Color->setDbValue($rs->fields('Color'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// ID
		// Trademark
		// Model
		// HP
		// Liter
		// Cyl
		// TransmissSpeedCount
		// TransmissAutomatic
		// MPG_City
		// MPG_Highway
		// Category
		// Description
		// Hyperlink
		// Price
		// Picture
		// PictureName
		// PictureSize
		// PictureType
		// PictureWidth
		// PictureHeight
		// Color
		// ID

		$this->ID->ViewValue = $this->ID->CurrentValue;
		$this->ID->ViewCustomAttributes = "";

		// Trademark
		$this->Trademark->ViewValue = $this->Trademark->CurrentValue;
		$this->Trademark->ViewValue = FormatNumber($this->Trademark->ViewValue, 0, -2, -2, -2);
		$this->Trademark->ViewCustomAttributes = "";

		// Model
		$this->Model->ViewValue = $this->Model->CurrentValue;
		$this->Model->ViewValue = FormatNumber($this->Model->ViewValue, 0, -2, -2, -2);
		$this->Model->ViewCustomAttributes = "";

		// HP
		$this->HP->ViewValue = $this->HP->CurrentValue;
		$this->HP->ViewValue = FormatNumber($this->HP->ViewValue, 0, -2, -2, -2);
		$this->HP->ViewCustomAttributes = "";

		// Liter
		$this->Liter->ViewValue = $this->Liter->CurrentValue;
		$this->Liter->ViewValue = FormatNumber($this->Liter->ViewValue, 2, -2, -2, -2);
		$this->Liter->ViewCustomAttributes = "";

		// Cyl
		$this->Cyl->ViewValue = $this->Cyl->CurrentValue;
		$this->Cyl->ViewValue = FormatNumber($this->Cyl->ViewValue, 0, -2, -2, -2);
		$this->Cyl->ViewCustomAttributes = "";

		// TransmissSpeedCount
		$this->TransmissSpeedCount->ViewValue = $this->TransmissSpeedCount->CurrentValue;
		$this->TransmissSpeedCount->ViewValue = FormatNumber($this->TransmissSpeedCount->ViewValue, 0, -2, -2, -2);
		$this->TransmissSpeedCount->ViewCustomAttributes = "";

		// TransmissAutomatic
		$this->TransmissAutomatic->ViewValue = $this->TransmissAutomatic->CurrentValue;
		$this->TransmissAutomatic->ViewCustomAttributes = "";

		// MPG_City
		$this->MPG_City->ViewValue = $this->MPG_City->CurrentValue;
		$this->MPG_City->ViewValue = FormatNumber($this->MPG_City->ViewValue, 0, -2, -2, -2);
		$this->MPG_City->ViewCustomAttributes = "";

		// MPG_Highway
		$this->MPG_Highway->ViewValue = $this->MPG_Highway->CurrentValue;
		$this->MPG_Highway->ViewValue = FormatNumber($this->MPG_Highway->ViewValue, 0, -2, -2, -2);
		$this->MPG_Highway->ViewCustomAttributes = "";

		// Category
		$this->Category->ViewValue = $this->Category->CurrentValue;
		$this->Category->ViewCustomAttributes = "";

		// Description
		$this->Description->ViewValue = $this->Description->CurrentValue;
		$this->Description->ViewCustomAttributes = "";

		// Hyperlink
		$this->Hyperlink->ViewValue = $this->Hyperlink->CurrentValue;
		$this->Hyperlink->ViewCustomAttributes = "";

		// Price
		$this->Price->ViewValue = $this->Price->CurrentValue;
		$this->Price->ViewValue = FormatNumber($this->Price->ViewValue, 2, -2, -2, -2);
		$this->Price->ViewCustomAttributes = "";

		// Picture
		if (!EmptyValue($this->Picture->Upload->DbValue)) {
			$this->Picture->ViewValue = $this->ID->CurrentValue;
			$this->Picture->IsBlobImage = IsImageFile(ContentExtension($this->Picture->Upload->DbValue));
		} else {
			$this->Picture->ViewValue = "";
		}
		$this->Picture->ViewCustomAttributes = "";

		// PictureName
		$this->PictureName->ViewValue = $this->PictureName->CurrentValue;
		$this->PictureName->ViewCustomAttributes = "";

		// PictureSize
		$this->PictureSize->ViewValue = $this->PictureSize->CurrentValue;
		$this->PictureSize->ViewValue = FormatNumber($this->PictureSize->ViewValue, 0, -2, -2, -2);
		$this->PictureSize->ViewCustomAttributes = "";

		// PictureType
		$this->PictureType->ViewValue = $this->PictureType->CurrentValue;
		$this->PictureType->ViewCustomAttributes = "";

		// PictureWidth
		$this->PictureWidth->ViewValue = $this->PictureWidth->CurrentValue;
		$this->PictureWidth->ViewValue = FormatNumber($this->PictureWidth->ViewValue, 0, -2, -2, -2);
		$this->PictureWidth->ViewCustomAttributes = "";

		// PictureHeight
		$this->PictureHeight->ViewValue = $this->PictureHeight->CurrentValue;
		$this->PictureHeight->ViewValue = FormatNumber($this->PictureHeight->ViewValue, 0, -2, -2, -2);
		$this->PictureHeight->ViewCustomAttributes = "";

		// Color
		$this->Color->ViewValue = $this->Color->CurrentValue;
		$this->Color->ViewCustomAttributes = "";

		// ID
		$this->ID->LinkCustomAttributes = "";
		$this->ID->HrefValue = "";
		$this->ID->TooltipValue = "";

		// Trademark
		$this->Trademark->LinkCustomAttributes = "";
		$this->Trademark->HrefValue = "";
		$this->Trademark->TooltipValue = "";

		// Model
		$this->Model->LinkCustomAttributes = "";
		$this->Model->HrefValue = "";
		$this->Model->TooltipValue = "";

		// HP
		$this->HP->LinkCustomAttributes = "";
		$this->HP->HrefValue = "";
		$this->HP->TooltipValue = "";

		// Liter
		$this->Liter->LinkCustomAttributes = "";
		$this->Liter->HrefValue = "";
		$this->Liter->TooltipValue = "";

		// Cyl
		$this->Cyl->LinkCustomAttributes = "";
		$this->Cyl->HrefValue = "";
		$this->Cyl->TooltipValue = "";

		// TransmissSpeedCount
		$this->TransmissSpeedCount->LinkCustomAttributes = "";
		$this->TransmissSpeedCount->HrefValue = "";
		$this->TransmissSpeedCount->TooltipValue = "";

		// TransmissAutomatic
		$this->TransmissAutomatic->LinkCustomAttributes = "";
		$this->TransmissAutomatic->HrefValue = "";
		$this->TransmissAutomatic->TooltipValue = "";

		// MPG_City
		$this->MPG_City->LinkCustomAttributes = "";
		$this->MPG_City->HrefValue = "";
		$this->MPG_City->TooltipValue = "";

		// MPG_Highway
		$this->MPG_Highway->LinkCustomAttributes = "";
		$this->MPG_Highway->HrefValue = "";
		$this->MPG_Highway->TooltipValue = "";

		// Category
		$this->Category->LinkCustomAttributes = "";
		$this->Category->HrefValue = "";
		$this->Category->TooltipValue = "";

		// Description
		$this->Description->LinkCustomAttributes = "";
		$this->Description->HrefValue = "";
		$this->Description->TooltipValue = "";

		// Hyperlink
		$this->Hyperlink->LinkCustomAttributes = "";
		$this->Hyperlink->HrefValue = "";
		$this->Hyperlink->TooltipValue = "";

		// Price
		$this->Price->LinkCustomAttributes = "";
		$this->Price->HrefValue = "";
		$this->Price->TooltipValue = "";

		// Picture
		$this->Picture->LinkCustomAttributes = "";
		if (!empty($this->Picture->Upload->DbValue)) {
			$this->Picture->HrefValue = GetFileUploadUrl($this->Picture, $this->ID->CurrentValue);
			$this->Picture->LinkAttrs["target"] = "";
			if ($this->Picture->IsBlobImage && empty($this->Picture->LinkAttrs["target"]))
				$this->Picture->LinkAttrs["target"] = "_blank";
			if ($this->isExport())
				$this->Picture->HrefValue = FullUrl($this->Picture->HrefValue, "href");
		} else {
			$this->Picture->HrefValue = "";
		}
		$this->Picture->ExportHrefValue = GetFileUploadUrl($this->Picture, $this->ID->CurrentValue);
		$this->Picture->TooltipValue = "";

		// PictureName
		$this->PictureName->LinkCustomAttributes = "";
		$this->PictureName->HrefValue = "";
		$this->PictureName->TooltipValue = "";

		// PictureSize
		$this->PictureSize->LinkCustomAttributes = "";
		$this->PictureSize->HrefValue = "";
		$this->PictureSize->TooltipValue = "";

		// PictureType
		$this->PictureType->LinkCustomAttributes = "";
		$this->PictureType->HrefValue = "";
		$this->PictureType->TooltipValue = "";

		// PictureWidth
		$this->PictureWidth->LinkCustomAttributes = "";
		$this->PictureWidth->HrefValue = "";
		$this->PictureWidth->TooltipValue = "";

		// PictureHeight
		$this->PictureHeight->LinkCustomAttributes = "";
		$this->PictureHeight->HrefValue = "";
		$this->PictureHeight->TooltipValue = "";

		// Color
		$this->Color->LinkCustomAttributes = "";
		$this->Color->HrefValue = "";
		$this->Color->TooltipValue = "";

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

		// ID
		$this->ID->EditAttrs["class"] = "form-control";
		$this->ID->EditCustomAttributes = "";
		$this->ID->EditValue = $this->ID->CurrentValue;
		$this->ID->ViewCustomAttributes = "";

		// Trademark
		$this->Trademark->EditAttrs["class"] = "form-control";
		$this->Trademark->EditCustomAttributes = "";
		$this->Trademark->EditValue = $this->Trademark->CurrentValue;
		$this->Trademark->PlaceHolder = RemoveHtml($this->Trademark->caption());

		// Model
		$this->Model->EditAttrs["class"] = "form-control";
		$this->Model->EditCustomAttributes = "";
		$this->Model->EditValue = $this->Model->CurrentValue;
		$this->Model->PlaceHolder = RemoveHtml($this->Model->caption());

		// HP
		$this->HP->EditAttrs["class"] = "form-control";
		$this->HP->EditCustomAttributes = "";
		$this->HP->EditValue = $this->HP->CurrentValue;
		$this->HP->PlaceHolder = RemoveHtml($this->HP->caption());

		// Liter
		$this->Liter->EditAttrs["class"] = "form-control";
		$this->Liter->EditCustomAttributes = "";
		$this->Liter->EditValue = $this->Liter->CurrentValue;
		$this->Liter->PlaceHolder = RemoveHtml($this->Liter->caption());
		if (strval($this->Liter->EditValue) <> "" && is_numeric($this->Liter->EditValue))
			$this->Liter->EditValue = FormatNumber($this->Liter->EditValue, -2, -2, -2, -2);

		// Cyl
		$this->Cyl->EditAttrs["class"] = "form-control";
		$this->Cyl->EditCustomAttributes = "";
		$this->Cyl->EditValue = $this->Cyl->CurrentValue;
		$this->Cyl->PlaceHolder = RemoveHtml($this->Cyl->caption());

		// TransmissSpeedCount
		$this->TransmissSpeedCount->EditAttrs["class"] = "form-control";
		$this->TransmissSpeedCount->EditCustomAttributes = "";
		$this->TransmissSpeedCount->EditValue = $this->TransmissSpeedCount->CurrentValue;
		$this->TransmissSpeedCount->PlaceHolder = RemoveHtml($this->TransmissSpeedCount->caption());

		// TransmissAutomatic
		$this->TransmissAutomatic->EditAttrs["class"] = "form-control";
		$this->TransmissAutomatic->EditCustomAttributes = "";
		$this->TransmissAutomatic->EditValue = $this->TransmissAutomatic->CurrentValue;
		$this->TransmissAutomatic->PlaceHolder = RemoveHtml($this->TransmissAutomatic->caption());

		// MPG_City
		$this->MPG_City->EditAttrs["class"] = "form-control";
		$this->MPG_City->EditCustomAttributes = "";
		$this->MPG_City->EditValue = $this->MPG_City->CurrentValue;
		$this->MPG_City->PlaceHolder = RemoveHtml($this->MPG_City->caption());

		// MPG_Highway
		$this->MPG_Highway->EditAttrs["class"] = "form-control";
		$this->MPG_Highway->EditCustomAttributes = "";
		$this->MPG_Highway->EditValue = $this->MPG_Highway->CurrentValue;
		$this->MPG_Highway->PlaceHolder = RemoveHtml($this->MPG_Highway->caption());

		// Category
		$this->Category->EditAttrs["class"] = "form-control";
		$this->Category->EditCustomAttributes = "";
		$this->Category->EditValue = $this->Category->CurrentValue;
		$this->Category->PlaceHolder = RemoveHtml($this->Category->caption());

		// Description
		$this->Description->EditAttrs["class"] = "form-control";
		$this->Description->EditCustomAttributes = "";
		$this->Description->EditValue = $this->Description->CurrentValue;
		$this->Description->PlaceHolder = RemoveHtml($this->Description->caption());

		// Hyperlink
		$this->Hyperlink->EditAttrs["class"] = "form-control";
		$this->Hyperlink->EditCustomAttributes = "";
		$this->Hyperlink->EditValue = $this->Hyperlink->CurrentValue;
		$this->Hyperlink->PlaceHolder = RemoveHtml($this->Hyperlink->caption());

		// Price
		$this->Price->EditAttrs["class"] = "form-control";
		$this->Price->EditCustomAttributes = "";
		$this->Price->EditValue = $this->Price->CurrentValue;
		$this->Price->PlaceHolder = RemoveHtml($this->Price->caption());
		if (strval($this->Price->EditValue) <> "" && is_numeric($this->Price->EditValue))
			$this->Price->EditValue = FormatNumber($this->Price->EditValue, -2, -2, -2, -2);

		// Picture
		$this->Picture->EditAttrs["class"] = "form-control";
		$this->Picture->EditCustomAttributes = "";
		if (!EmptyValue($this->Picture->Upload->DbValue)) {
			$this->Picture->EditValue = $this->ID->CurrentValue;
			$this->Picture->IsBlobImage = IsImageFile(ContentExtension($this->Picture->Upload->DbValue));
		} else {
			$this->Picture->EditValue = "";
		}

		// PictureName
		$this->PictureName->EditAttrs["class"] = "form-control";
		$this->PictureName->EditCustomAttributes = "";
		$this->PictureName->EditValue = $this->PictureName->CurrentValue;
		$this->PictureName->PlaceHolder = RemoveHtml($this->PictureName->caption());

		// PictureSize
		$this->PictureSize->EditAttrs["class"] = "form-control";
		$this->PictureSize->EditCustomAttributes = "";
		$this->PictureSize->EditValue = $this->PictureSize->CurrentValue;
		$this->PictureSize->PlaceHolder = RemoveHtml($this->PictureSize->caption());

		// PictureType
		$this->PictureType->EditAttrs["class"] = "form-control";
		$this->PictureType->EditCustomAttributes = "";
		$this->PictureType->EditValue = $this->PictureType->CurrentValue;
		$this->PictureType->PlaceHolder = RemoveHtml($this->PictureType->caption());

		// PictureWidth
		$this->PictureWidth->EditAttrs["class"] = "form-control";
		$this->PictureWidth->EditCustomAttributes = "";
		$this->PictureWidth->EditValue = $this->PictureWidth->CurrentValue;
		$this->PictureWidth->PlaceHolder = RemoveHtml($this->PictureWidth->caption());

		// PictureHeight
		$this->PictureHeight->EditAttrs["class"] = "form-control";
		$this->PictureHeight->EditCustomAttributes = "";
		$this->PictureHeight->EditValue = $this->PictureHeight->CurrentValue;
		$this->PictureHeight->PlaceHolder = RemoveHtml($this->PictureHeight->caption());

		// Color
		$this->Color->EditAttrs["class"] = "form-control";
		$this->Color->EditCustomAttributes = "";
		$this->Color->EditValue = $this->Color->CurrentValue;
		$this->Color->PlaceHolder = RemoveHtml($this->Color->caption());

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
					$doc->exportCaption($this->ID);
					$doc->exportCaption($this->Trademark);
					$doc->exportCaption($this->Model);
					$doc->exportCaption($this->HP);
					$doc->exportCaption($this->Liter);
					$doc->exportCaption($this->Cyl);
					$doc->exportCaption($this->TransmissSpeedCount);
					$doc->exportCaption($this->TransmissAutomatic);
					$doc->exportCaption($this->MPG_City);
					$doc->exportCaption($this->MPG_Highway);
					$doc->exportCaption($this->Category);
					$doc->exportCaption($this->Description);
					$doc->exportCaption($this->Hyperlink);
					$doc->exportCaption($this->Price);
					$doc->exportCaption($this->Picture);
					$doc->exportCaption($this->PictureName);
					$doc->exportCaption($this->PictureSize);
					$doc->exportCaption($this->PictureType);
					$doc->exportCaption($this->PictureWidth);
					$doc->exportCaption($this->PictureHeight);
					$doc->exportCaption($this->Color);
				} else {
					$doc->exportCaption($this->ID);
					$doc->exportCaption($this->Trademark);
					$doc->exportCaption($this->Model);
					$doc->exportCaption($this->HP);
					$doc->exportCaption($this->Liter);
					$doc->exportCaption($this->Cyl);
					$doc->exportCaption($this->TransmissSpeedCount);
					$doc->exportCaption($this->TransmissAutomatic);
					$doc->exportCaption($this->MPG_City);
					$doc->exportCaption($this->MPG_Highway);
					$doc->exportCaption($this->Category);
					$doc->exportCaption($this->Hyperlink);
					$doc->exportCaption($this->Price);
					$doc->exportCaption($this->PictureName);
					$doc->exportCaption($this->PictureSize);
					$doc->exportCaption($this->PictureType);
					$doc->exportCaption($this->PictureWidth);
					$doc->exportCaption($this->PictureHeight);
					$doc->exportCaption($this->Color);
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
						$doc->exportField($this->ID);
						$doc->exportField($this->Trademark);
						$doc->exportField($this->Model);
						$doc->exportField($this->HP);
						$doc->exportField($this->Liter);
						$doc->exportField($this->Cyl);
						$doc->exportField($this->TransmissSpeedCount);
						$doc->exportField($this->TransmissAutomatic);
						$doc->exportField($this->MPG_City);
						$doc->exportField($this->MPG_Highway);
						$doc->exportField($this->Category);
						$doc->exportField($this->Description);
						$doc->exportField($this->Hyperlink);
						$doc->exportField($this->Price);
						$doc->exportField($this->Picture);
						$doc->exportField($this->PictureName);
						$doc->exportField($this->PictureSize);
						$doc->exportField($this->PictureType);
						$doc->exportField($this->PictureWidth);
						$doc->exportField($this->PictureHeight);
						$doc->exportField($this->Color);
					} else {
						$doc->exportField($this->ID);
						$doc->exportField($this->Trademark);
						$doc->exportField($this->Model);
						$doc->exportField($this->HP);
						$doc->exportField($this->Liter);
						$doc->exportField($this->Cyl);
						$doc->exportField($this->TransmissSpeedCount);
						$doc->exportField($this->TransmissAutomatic);
						$doc->exportField($this->MPG_City);
						$doc->exportField($this->MPG_Highway);
						$doc->exportField($this->Category);
						$doc->exportField($this->Hyperlink);
						$doc->exportField($this->Price);
						$doc->exportField($this->PictureName);
						$doc->exportField($this->PictureSize);
						$doc->exportField($this->PictureType);
						$doc->exportField($this->PictureWidth);
						$doc->exportField($this->PictureHeight);
						$doc->exportField($this->Color);
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
		global $COMPOSITE_KEY_SEPARATOR;

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'Picture') {
			$fldName = "Picture";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode($COMPOSITE_KEY_SEPARATOR, $key);
		if (count($ar) == 1) {
			$this->ID->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype <> "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld <> "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					if ($fileNameFld <> "" && !EmptyValue($rs->fields($fileNameFld)))
						AddHeader("Content-Disposition", "attachment; filename=\"" . $rs->fields($fileNameFld) . "\"");

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear any debug message
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
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

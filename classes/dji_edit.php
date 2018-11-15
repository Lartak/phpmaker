<?php
namespace PHPMaker2019\demo2019;

/**
 * Page class
 */
class dji_edit extends dji
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{DFB61542-7FFC-43AB-88E7-31D7F8D95066}";

	// Table name
	public $TableName = 'dji';

	// Page object name
	public $PageObjName = "dji_edit";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;
	public $CheckTokenFn;
	public $CreateTokenFn;
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = array();

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message <> "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage <> "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage <> "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage <> "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;

		//if ($this->CheckToken) { // Always create token, required by API file/lookup request
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$CurrentToken = $this->Token; // Save to global variable

		//}
	}

	// Constructor
	public function __construct()
	{
		global $Conn, $Language, $COMPOSITE_KEY_SEPARATOR;

		// Initialize
		$this->CheckTokenFn = PROJECT_NAMESPACE . "CheckToken";
		$this->CreateTokenFn = PROJECT_NAMESPACE . "CreateToken";
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (dji)
		if (!isset($GLOBALS["dji"]) || get_class($GLOBALS["dji"]) == PROJECT_NAMESPACE . "dji") {
			$GLOBALS["dji"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["dji"];
		}

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'dji');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($Conn))
			$Conn = GetConnection($this->Dbid);
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT, $dji;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($dji);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "djiview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = array();
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = array();
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {

								//$url = FullUrl($fld->TableVar . "/" . API_FILE_ACTION . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))); // URL rewrite format
								$url = FullUrl(GetPageName(API_URL) . "?" . API_OBJECT_NAME . "=" . $fld->TableVar . "&" . API_ACTION_NAME . "=" . API_FILE_ACTION . "&" . API_FIELD_NAME . "=" . $fld->Param . "&" . API_KEY_NAME . "=" . rawurlencode($this->getRecordKeyValue($ar))); // Query string format
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, MULTIPLE_UPLOAD_SEPARATOR)) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['ID'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->ID->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $DisplayRecs = 1;
	public $StartRec;
	public $StopRec;
	public $TotalRecs = 0;
	public $RecRange = 10;
	public $Pager;
	public $AutoHidePager = AUTO_HIDE_PAGER;
	public $RecCnt;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . "CheckToken";
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->ID->setVisibility();
		$this->Date->setVisibility();
		$this->Open->setVisibility();
		$this->High->setVisibility();
		$this->Low->setVisibility();
		$this->Close->setVisibility();
		$this->Volume->setVisibility();
		$this->Adj_Close->setVisibility();
		$this->Name->setVisibility();
		$this->Name2->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";

		// Load record by position
		$loadByPosition = FALSE;
		$returnUrl = "";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get action code
			if (!$this->isShow()) // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($CurrentForm->hasValue("x_ID")) {
				$this->ID->setFormValue($CurrentForm->getValue("x_ID"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("ID") !== NULL) {
				$this->ID->setQueryStringValue(Get("ID"));
				$loadByQuery = TRUE;
			} else {
				$this->ID->CurrentValue = NULL;
			}
			if (!$loadByQuery)
				$loadByPosition = TRUE;
		}

		// Load recordset
		$this->StartRec = 1; // Initialize start position
		if ($rs = $this->loadRecordset()) // Load records
			$this->TotalRecs = $rs->RecordCount(); // Get record count
		if ($this->TotalRecs <= 0) { // No record found
			if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$this->terminate("djilist.php"); // Return to list page
		} elseif ($loadByPosition) { // Load record by position
			$this->setupStartRec(); // Set up start record position

			// Point to current record
			if ($this->StartRec <= $this->TotalRecs) {
				$rs->move($this->StartRec - 1);
				$loaded = TRUE;
			}
		} else { // Match key values
			if ($this->ID->CurrentValue != NULL) {
				while (!$rs->EOF) {
					if (SameString($this->ID->CurrentValue, $rs->fields('ID'))) {
						$this->setStartRecordNumber($this->StartRec); // Save record position
						$loaded = TRUE;
						break;
					} else {
						$this->StartRec++;
						$rs->moveNext();
					}
				}
			}
		}

		// Load current row values
		if ($loaded)
			$this->loadRowValues($rs);

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) {
					if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
					$this->terminate("djilist.php"); // Return to list page
				} else {
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "djilist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Set up starting record parameters
	public function setupStartRec()
	{
		if ($this->DisplayRecs == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			if (Get(TABLE_START_REC) !== NULL) { // Check for "start" parameter
				$this->StartRec = Get(TABLE_START_REC);
				$this->setStartRecordNumber($this->StartRec);
			} elseif (Get(TABLE_PAGE_NO) !== NULL) {
				$pageNo = Get(TABLE_PAGE_NO);
				if (is_numeric($pageNo)) {
					$this->StartRec = ($pageNo - 1) * $this->DisplayRecs + 1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1) {
						$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->StartRec > $this->TotalRecs) { // Avoid starting record > total records
			$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
			$this->StartRec = (int)(($this->StartRec - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'ID' first before field var 'x_ID'
		$val = $CurrentForm->hasValue("ID") ? $CurrentForm->getValue("ID") : $CurrentForm->getValue("x_ID");
		if (!$this->ID->IsDetailKey)
			$this->ID->setFormValue($val);

		// Check field name 'Date' first before field var 'x_Date'
		$val = $CurrentForm->hasValue("Date") ? $CurrentForm->getValue("Date") : $CurrentForm->getValue("x_Date");
		if (!$this->Date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Date->Visible = FALSE; // Disable update for API request
			else
				$this->Date->setFormValue($val);
			$this->Date->CurrentValue = UnFormatDateTime($this->Date->CurrentValue, 0);
		}

		// Check field name 'Open' first before field var 'x_Open'
		$val = $CurrentForm->hasValue("Open") ? $CurrentForm->getValue("Open") : $CurrentForm->getValue("x_Open");
		if (!$this->Open->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Open->Visible = FALSE; // Disable update for API request
			else
				$this->Open->setFormValue($val);
		}

		// Check field name 'High' first before field var 'x_High'
		$val = $CurrentForm->hasValue("High") ? $CurrentForm->getValue("High") : $CurrentForm->getValue("x_High");
		if (!$this->High->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->High->Visible = FALSE; // Disable update for API request
			else
				$this->High->setFormValue($val);
		}

		// Check field name 'Low' first before field var 'x_Low'
		$val = $CurrentForm->hasValue("Low") ? $CurrentForm->getValue("Low") : $CurrentForm->getValue("x_Low");
		if (!$this->Low->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Low->Visible = FALSE; // Disable update for API request
			else
				$this->Low->setFormValue($val);
		}

		// Check field name 'Close' first before field var 'x_Close'
		$val = $CurrentForm->hasValue("Close") ? $CurrentForm->getValue("Close") : $CurrentForm->getValue("x_Close");
		if (!$this->Close->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Close->Visible = FALSE; // Disable update for API request
			else
				$this->Close->setFormValue($val);
		}

		// Check field name 'Volume' first before field var 'x_Volume'
		$val = $CurrentForm->hasValue("Volume") ? $CurrentForm->getValue("Volume") : $CurrentForm->getValue("x_Volume");
		if (!$this->Volume->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Volume->Visible = FALSE; // Disable update for API request
			else
				$this->Volume->setFormValue($val);
		}

		// Check field name 'Adj Close' first before field var 'x_Adj_Close'
		$val = $CurrentForm->hasValue("Adj Close") ? $CurrentForm->getValue("Adj Close") : $CurrentForm->getValue("x_Adj_Close");
		if (!$this->Adj_Close->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Adj_Close->Visible = FALSE; // Disable update for API request
			else
				$this->Adj_Close->setFormValue($val);
		}

		// Check field name 'Name' first before field var 'x_Name'
		$val = $CurrentForm->hasValue("Name") ? $CurrentForm->getValue("Name") : $CurrentForm->getValue("x_Name");
		if (!$this->Name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Name->Visible = FALSE; // Disable update for API request
			else
				$this->Name->setFormValue($val);
			$this->Name->CurrentValue = UnFormatDateTime($this->Name->CurrentValue, 0);
		}

		// Check field name 'Name2' first before field var 'x_Name2'
		$val = $CurrentForm->hasValue("Name2") ? $CurrentForm->getValue("Name2") : $CurrentForm->getValue("x_Name2");
		if (!$this->Name2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Name2->Visible = FALSE; // Disable update for API request
			else
				$this->Name2->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->ID->CurrentValue = $this->ID->FormValue;
		$this->Date->CurrentValue = $this->Date->FormValue;
		$this->Date->CurrentValue = UnFormatDateTime($this->Date->CurrentValue, 0);
		$this->Open->CurrentValue = $this->Open->FormValue;
		$this->High->CurrentValue = $this->High->FormValue;
		$this->Low->CurrentValue = $this->Low->FormValue;
		$this->Close->CurrentValue = $this->Close->FormValue;
		$this->Volume->CurrentValue = $this->Volume->FormValue;
		$this->Adj_Close->CurrentValue = $this->Adj_Close->FormValue;
		$this->Name->CurrentValue = $this->Name->FormValue;
		$this->Name->CurrentValue = UnFormatDateTime($this->Name->CurrentValue, 0);
		$this->Name2->CurrentValue = $this->Name2->FormValue;
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = &$this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->ID->setDbValue($row['ID']);
		$this->Date->setDbValue($row['Date']);
		$this->Open->setDbValue($row['Open']);
		$this->High->setDbValue($row['High']);
		$this->Low->setDbValue($row['Low']);
		$this->Close->setDbValue($row['Close']);
		$this->Volume->setDbValue($row['Volume']);
		$this->Adj_Close->setDbValue($row['Adj Close']);
		$this->Name->setDbValue($row['Name']);
		$this->Name2->setDbValue($row['Name2']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['ID'] = NULL;
		$row['Date'] = NULL;
		$row['Open'] = NULL;
		$row['High'] = NULL;
		$row['Low'] = NULL;
		$row['Close'] = NULL;
		$row['Volume'] = NULL;
		$row['Adj Close'] = NULL;
		$row['Name'] = NULL;
		$row['Name2'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("ID")) <> "")
			$this->ID->CurrentValue = $this->getKey("ID"); // ID
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Open->FormValue == $this->Open->CurrentValue && is_numeric(ConvertToFloatString($this->Open->CurrentValue)))
			$this->Open->CurrentValue = ConvertToFloatString($this->Open->CurrentValue);

		// Convert decimal values if posted back
		if ($this->High->FormValue == $this->High->CurrentValue && is_numeric(ConvertToFloatString($this->High->CurrentValue)))
			$this->High->CurrentValue = ConvertToFloatString($this->High->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Low->FormValue == $this->Low->CurrentValue && is_numeric(ConvertToFloatString($this->Low->CurrentValue)))
			$this->Low->CurrentValue = ConvertToFloatString($this->Low->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Close->FormValue == $this->Close->CurrentValue && is_numeric(ConvertToFloatString($this->Close->CurrentValue)))
			$this->Close->CurrentValue = ConvertToFloatString($this->Close->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Volume->FormValue == $this->Volume->CurrentValue && is_numeric(ConvertToFloatString($this->Volume->CurrentValue)))
			$this->Volume->CurrentValue = ConvertToFloatString($this->Volume->CurrentValue);

		// Convert decimal values if posted back
		if ($this->Adj_Close->FormValue == $this->Adj_Close->CurrentValue && is_numeric(ConvertToFloatString($this->Adj_Close->CurrentValue)))
			$this->Adj_Close->CurrentValue = ConvertToFloatString($this->Adj_Close->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// ID
		// Date
		// Open
		// High
		// Low
		// Close
		// Volume
		// Adj Close
		// Name
		// Name2

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// ID
			$this->ID->ViewValue = $this->ID->CurrentValue;
			$this->ID->ViewCustomAttributes = "";

			// Date
			$this->Date->ViewValue = $this->Date->CurrentValue;
			$this->Date->ViewValue = FormatDateTime($this->Date->ViewValue, 0);
			$this->Date->ViewCustomAttributes = "";

			// Open
			$this->Open->ViewValue = $this->Open->CurrentValue;
			$this->Open->ViewValue = FormatNumber($this->Open->ViewValue, 2, -2, -2, -2);
			$this->Open->ViewCustomAttributes = "";

			// High
			$this->High->ViewValue = $this->High->CurrentValue;
			$this->High->ViewValue = FormatNumber($this->High->ViewValue, 2, -2, -2, -2);
			$this->High->ViewCustomAttributes = "";

			// Low
			$this->Low->ViewValue = $this->Low->CurrentValue;
			$this->Low->ViewValue = FormatNumber($this->Low->ViewValue, 2, -2, -2, -2);
			$this->Low->ViewCustomAttributes = "";

			// Close
			$this->Close->ViewValue = $this->Close->CurrentValue;
			$this->Close->ViewValue = FormatNumber($this->Close->ViewValue, 2, -2, -2, -2);
			$this->Close->ViewCustomAttributes = "";

			// Volume
			$this->Volume->ViewValue = $this->Volume->CurrentValue;
			$this->Volume->ViewValue = FormatNumber($this->Volume->ViewValue, 2, -2, -2, -2);
			$this->Volume->ViewCustomAttributes = "";

			// Adj Close
			$this->Adj_Close->ViewValue = $this->Adj_Close->CurrentValue;
			$this->Adj_Close->ViewValue = FormatNumber($this->Adj_Close->ViewValue, 2, -2, -2, -2);
			$this->Adj_Close->ViewCustomAttributes = "";

			// Name
			$this->Name->ViewValue = $this->Name->CurrentValue;
			$this->Name->ViewValue = FormatDateTime($this->Name->ViewValue, 0);
			$this->Name->ViewCustomAttributes = "";

			// Name2
			$this->Name2->ViewValue = $this->Name2->CurrentValue;
			$this->Name2->ViewCustomAttributes = "";

			// ID
			$this->ID->LinkCustomAttributes = "";
			$this->ID->HrefValue = "";
			$this->ID->TooltipValue = "";

			// Date
			$this->Date->LinkCustomAttributes = "";
			$this->Date->HrefValue = "";
			$this->Date->TooltipValue = "";

			// Open
			$this->Open->LinkCustomAttributes = "";
			$this->Open->HrefValue = "";
			$this->Open->TooltipValue = "";

			// High
			$this->High->LinkCustomAttributes = "";
			$this->High->HrefValue = "";
			$this->High->TooltipValue = "";

			// Low
			$this->Low->LinkCustomAttributes = "";
			$this->Low->HrefValue = "";
			$this->Low->TooltipValue = "";

			// Close
			$this->Close->LinkCustomAttributes = "";
			$this->Close->HrefValue = "";
			$this->Close->TooltipValue = "";

			// Volume
			$this->Volume->LinkCustomAttributes = "";
			$this->Volume->HrefValue = "";
			$this->Volume->TooltipValue = "";

			// Adj Close
			$this->Adj_Close->LinkCustomAttributes = "";
			$this->Adj_Close->HrefValue = "";
			$this->Adj_Close->TooltipValue = "";

			// Name
			$this->Name->LinkCustomAttributes = "";
			$this->Name->HrefValue = "";
			$this->Name->TooltipValue = "";

			// Name2
			$this->Name2->LinkCustomAttributes = "";
			$this->Name2->HrefValue = "";
			$this->Name2->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// ID
			$this->ID->EditAttrs["class"] = "form-control";
			$this->ID->EditCustomAttributes = "";
			$this->ID->EditValue = $this->ID->CurrentValue;
			$this->ID->ViewCustomAttributes = "";

			// Date
			$this->Date->EditAttrs["class"] = "form-control";
			$this->Date->EditCustomAttributes = "";
			$this->Date->EditValue = HtmlEncode(FormatDateTime($this->Date->CurrentValue, 8));
			$this->Date->PlaceHolder = RemoveHtml($this->Date->caption());

			// Open
			$this->Open->EditAttrs["class"] = "form-control";
			$this->Open->EditCustomAttributes = "";
			$this->Open->EditValue = HtmlEncode($this->Open->CurrentValue);
			$this->Open->PlaceHolder = RemoveHtml($this->Open->caption());
			if (strval($this->Open->EditValue) <> "" && is_numeric($this->Open->EditValue))
				$this->Open->EditValue = FormatNumber($this->Open->EditValue, -2, -2, -2, -2);

			// High
			$this->High->EditAttrs["class"] = "form-control";
			$this->High->EditCustomAttributes = "";
			$this->High->EditValue = HtmlEncode($this->High->CurrentValue);
			$this->High->PlaceHolder = RemoveHtml($this->High->caption());
			if (strval($this->High->EditValue) <> "" && is_numeric($this->High->EditValue))
				$this->High->EditValue = FormatNumber($this->High->EditValue, -2, -2, -2, -2);

			// Low
			$this->Low->EditAttrs["class"] = "form-control";
			$this->Low->EditCustomAttributes = "";
			$this->Low->EditValue = HtmlEncode($this->Low->CurrentValue);
			$this->Low->PlaceHolder = RemoveHtml($this->Low->caption());
			if (strval($this->Low->EditValue) <> "" && is_numeric($this->Low->EditValue))
				$this->Low->EditValue = FormatNumber($this->Low->EditValue, -2, -2, -2, -2);

			// Close
			$this->Close->EditAttrs["class"] = "form-control";
			$this->Close->EditCustomAttributes = "";
			$this->Close->EditValue = HtmlEncode($this->Close->CurrentValue);
			$this->Close->PlaceHolder = RemoveHtml($this->Close->caption());
			if (strval($this->Close->EditValue) <> "" && is_numeric($this->Close->EditValue))
				$this->Close->EditValue = FormatNumber($this->Close->EditValue, -2, -2, -2, -2);

			// Volume
			$this->Volume->EditAttrs["class"] = "form-control";
			$this->Volume->EditCustomAttributes = "";
			$this->Volume->EditValue = HtmlEncode($this->Volume->CurrentValue);
			$this->Volume->PlaceHolder = RemoveHtml($this->Volume->caption());
			if (strval($this->Volume->EditValue) <> "" && is_numeric($this->Volume->EditValue))
				$this->Volume->EditValue = FormatNumber($this->Volume->EditValue, -2, -2, -2, -2);

			// Adj Close
			$this->Adj_Close->EditAttrs["class"] = "form-control";
			$this->Adj_Close->EditCustomAttributes = "";
			$this->Adj_Close->EditValue = HtmlEncode($this->Adj_Close->CurrentValue);
			$this->Adj_Close->PlaceHolder = RemoveHtml($this->Adj_Close->caption());
			if (strval($this->Adj_Close->EditValue) <> "" && is_numeric($this->Adj_Close->EditValue))
				$this->Adj_Close->EditValue = FormatNumber($this->Adj_Close->EditValue, -2, -2, -2, -2);

			// Name
			$this->Name->EditAttrs["class"] = "form-control";
			$this->Name->EditCustomAttributes = "";
			$this->Name->EditValue = HtmlEncode(FormatDateTime($this->Name->CurrentValue, 8));
			$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

			// Name2
			$this->Name2->EditAttrs["class"] = "form-control";
			$this->Name2->EditCustomAttributes = "";
			$this->Name2->EditValue = HtmlEncode($this->Name2->CurrentValue);
			$this->Name2->PlaceHolder = RemoveHtml($this->Name2->caption());

			// Edit refer script
			// ID

			$this->ID->LinkCustomAttributes = "";
			$this->ID->HrefValue = "";

			// Date
			$this->Date->LinkCustomAttributes = "";
			$this->Date->HrefValue = "";

			// Open
			$this->Open->LinkCustomAttributes = "";
			$this->Open->HrefValue = "";

			// High
			$this->High->LinkCustomAttributes = "";
			$this->High->HrefValue = "";

			// Low
			$this->Low->LinkCustomAttributes = "";
			$this->Low->HrefValue = "";

			// Close
			$this->Close->LinkCustomAttributes = "";
			$this->Close->HrefValue = "";

			// Volume
			$this->Volume->LinkCustomAttributes = "";
			$this->Volume->HrefValue = "";

			// Adj Close
			$this->Adj_Close->LinkCustomAttributes = "";
			$this->Adj_Close->HrefValue = "";

			// Name
			$this->Name->LinkCustomAttributes = "";
			$this->Name->HrefValue = "";

			// Name2
			$this->Name2->LinkCustomAttributes = "";
			$this->Name2->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->ID->Required) {
			if (!$this->ID->IsDetailKey && $this->ID->FormValue != NULL && $this->ID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ID->caption(), $this->ID->RequiredErrorMessage));
			}
		}
		if ($this->Date->Required) {
			if (!$this->Date->IsDetailKey && $this->Date->FormValue != NULL && $this->Date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Date->caption(), $this->Date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->Date->FormValue)) {
			AddMessage($FormError, $this->Date->errorMessage());
		}
		if ($this->Open->Required) {
			if (!$this->Open->IsDetailKey && $this->Open->FormValue != NULL && $this->Open->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Open->caption(), $this->Open->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Open->FormValue)) {
			AddMessage($FormError, $this->Open->errorMessage());
		}
		if ($this->High->Required) {
			if (!$this->High->IsDetailKey && $this->High->FormValue != NULL && $this->High->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->High->caption(), $this->High->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->High->FormValue)) {
			AddMessage($FormError, $this->High->errorMessage());
		}
		if ($this->Low->Required) {
			if (!$this->Low->IsDetailKey && $this->Low->FormValue != NULL && $this->Low->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Low->caption(), $this->Low->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Low->FormValue)) {
			AddMessage($FormError, $this->Low->errorMessage());
		}
		if ($this->Close->Required) {
			if (!$this->Close->IsDetailKey && $this->Close->FormValue != NULL && $this->Close->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Close->caption(), $this->Close->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Close->FormValue)) {
			AddMessage($FormError, $this->Close->errorMessage());
		}
		if ($this->Volume->Required) {
			if (!$this->Volume->IsDetailKey && $this->Volume->FormValue != NULL && $this->Volume->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Volume->caption(), $this->Volume->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Volume->FormValue)) {
			AddMessage($FormError, $this->Volume->errorMessage());
		}
		if ($this->Adj_Close->Required) {
			if (!$this->Adj_Close->IsDetailKey && $this->Adj_Close->FormValue != NULL && $this->Adj_Close->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Adj_Close->caption(), $this->Adj_Close->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->Adj_Close->FormValue)) {
			AddMessage($FormError, $this->Adj_Close->errorMessage());
		}
		if ($this->Name->Required) {
			if (!$this->Name->IsDetailKey && $this->Name->FormValue != NULL && $this->Name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Name->caption(), $this->Name->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->Name->FormValue)) {
			AddMessage($FormError, $this->Name->errorMessage());
		}
		if ($this->Name2->Required) {
			if (!$this->Name2->IsDetailKey && $this->Name2->FormValue != NULL && $this->Name2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Name2->caption(), $this->Name2->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($filter);
		$conn = &$this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// Date
			$this->Date->setDbValueDef($rsnew, UnFormatDateTime($this->Date->CurrentValue, 0), NULL, $this->Date->ReadOnly);

			// Open
			$this->Open->setDbValueDef($rsnew, $this->Open->CurrentValue, NULL, $this->Open->ReadOnly);

			// High
			$this->High->setDbValueDef($rsnew, $this->High->CurrentValue, NULL, $this->High->ReadOnly);

			// Low
			$this->Low->setDbValueDef($rsnew, $this->Low->CurrentValue, NULL, $this->Low->ReadOnly);

			// Close
			$this->Close->setDbValueDef($rsnew, $this->Close->CurrentValue, NULL, $this->Close->ReadOnly);

			// Volume
			$this->Volume->setDbValueDef($rsnew, $this->Volume->CurrentValue, NULL, $this->Volume->ReadOnly);

			// Adj Close
			$this->Adj_Close->setDbValueDef($rsnew, $this->Adj_Close->CurrentValue, NULL, $this->Adj_Close->ReadOnly);

			// Name
			$this->Name->setDbValueDef($rsnew, UnFormatDateTime($this->Name->CurrentValue, 0), NULL, $this->Name->ReadOnly);

			// Name2
			$this->Name2->setDbValueDef($rsnew, $this->Name2->CurrentValue, NULL, $this->Name2->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);
			if ($updateRow) {
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("djilist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
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

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
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
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>

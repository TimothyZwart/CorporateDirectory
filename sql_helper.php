<?php
     require 'conn.php';

        if (!mysqli_select_db($conn, $dbname)) { 
        $sql = "CREATE DATABASE $dbname";
        if (mysqli_query($conn, $sql)) {
            mysqli_select_db($conn, $dbname);
        } 
        else {
            echo "Error creating database: ".mysqli_error($conn);
            die;
        }
    }

    // Table variables. Add/subtract tables as necessary.
    $departmentsTable = "Departments";
	$locationsTable = "Locations";
    $passwordsTable = "Passwords";
	$requestsTable = "Requests";
	$rolesTable = "Roles";
	$usersTable = "Users";
	$auditTable = "Audit";
	$applicationsTable = "Applications";
	$teamsTable = "Teams";
	$permissionsTable = "Permissions";
	$hasPermissionsTable = "hasPermissions";
    
	/*Add foreign key constraints after all tables have been created.*/
	
    // Create a table called Departments if it does not exist.
    if (!departmentsTableExists($departmentsTable)) {
        createDepartmentsTable($departmentsTable, ["DepartmentID INT(6) AUTO_INCREMENT UNIQUE", "Name VARCHAR(255)"]);
    }
    
	// Create a table called Locations if it does not exist.
    if (!locationsTableExists($locationsTable)) {
        createLocationsTable($locationsTable, ["LocationID INT(6) AUTO_INCREMENT UNIQUE", "Country VARCHAR(255)", "City VARCHAR(255)"]);
    }
	
	// Create a table called Passwords if it does not exist.
    if (!passwordsTableExists($passwordsTable)) {
        createPasswordsTable($passwordsTable, ["PasswordID INT(6) AUTO_INCREMENT UNIQUE", "UserHash VARCHAR(32)", "Password VARCHAR(255)", "DateChanged DATETIME"]);
    }
	
	// Create a table called Requests if it does not exist.
    if (!requestsTableExists($requestsTable)) {
        createRequestsTable($requestsTable, ["RequestID INT(6) AUTO_INCREMENT UNIQUE", "Name VARCHAR(255)", "Timestamp DATETIME"]);
    }
	
    // Create a table called Roles if it does not exist.
    if (!rolesTableExists($rolesTable)) {
        createRolesTable($rolesTable, ["RoleID INT(6) AUTO_INCREMENT UNIQUE", "Name VARCHAR(255)"]);
    }
	
	// Create a table called Users if it does not exist.
    if (!usersTableExists($usersTable)) {
        createUsersTable($usersTable, ["UserID INT(6) AUTO_INCREMENT UNIQUE", "FirstName VARCHAR(255)", "LastName VARCHAR(255)", "Email VARCHAR(255)", "UserHash VARCHAR32(6)", "Phone VARCHAR(255)", "LocationID INT(6)", 
                                       "DepartmentID INT(6)", "RoleID INT(6)", "Team INT(6)", "Picture VARCHAR(1024)"]);
	}

	// Create a table called Audit if it does not exist.
    if (!auditTableExists($auditTable)) {
        createAuditTable($auditTable, ["AuditID INT(6) AUTO_INCREMENT UNIQUE", "UserID INT(6)", "ActionID(6)", "Timestamp DATETIME"]);
    }
	
	// Create a table called Applications if it does not exist.
    if (!applicationsTableExists($applicationsTable)) {
        createApplicationsTable($applicationsTable, ["ApplicationID INT(6) AUTO_INCREMENT UNIQUE", "Name VARCHAR(255)"]);
    }

	// Create a table called Permissions if it does not exist.
    if (!permissionsTableExists($permissionsTable)) {
        createPermissionsTable($permissionsTable, ["PermissionID INT(6) AUTO_INCREMENT UNIQUE", "Name VARCHAR(255)"]);
    }
	
	// Create a table called hasPermissions if it does not exist.
    if (!hasPermissionsTableExists($hasPermissionsTable)) {
        createHasPermissionsTable($hasPermissionsTable, ["UserID INT(6), PermissionID INT(6), ApplicationID INT(6)"]);
    }
	
	// Checks if a table named Departments exists in the database.
     function departmentsTableExists($departmentsTable) {
        $qry = "SELECT * FROM $departmentsTable";
        if (query($qry) !== FALSE) {
            return true;
            echo "Table exists.";
        }
        else { 
            return false;
        }
    }
	
	// Checks if a table named Locations exists in the database.
     function locationsTableExists($locationsTable) {
        $qry = "SELECT * FROM $locationsTable";
        if (query($qry) !== FALSE) {
            return true;
            echo "Table exists.";
        }
        else { 
            return false;
        }
    }
	
	// Checks if a table named Passwords exists in the database.
     function passwordsTableExists($passwordsTable) {
        $qry = "SELECT * FROM $passwordsTable";
        if (query($qry) !== FALSE) {
            return true;
            echo "Table exists.";
        }
        else { 
            return false;
        }
    }
   
	// Checks if a table named Requests exists in the database.
     function requestsTableExists($requestsTable) {
        $qry = "SELECT * FROM $requestsTable";
        if (query($qry) !== FALSE) {
            return true;
            echo "Table exists.";
        }
        else { 
            return false;
        }
    }
   
   // Checks if a table named Roles exists in the database.
     function rolesTableExists($rolesTable) {
        $qry = "SELECT * FROM $rolesTable";
        if (query($qry) !== FALSE) {
            return true;
            echo "Table exists.";
        }
        else { 
            return false;
        }
    }

    // Checks if a table named Users exists in the database.
    function usersTableExists($usersTable) {
        $qry = "SELECT * FROM $usersTable";
        if (query($qry) !== FALSE) {
            return true;
            echo "Table exists.";
        }
        else { 
            return false;
        }
    }
    
	// Checks if a table named Audit exists in the database.
    function auditTableExists($auditTable) {
        $qry = "SELECT * FROM $auditTable";
        if (query($qry) !== FALSE) {
            return true;
            echo "Table exists.";
        }
        else { 
            return false;
        }
    }
	
	// Checks if a table named Applications exists in the database.
    function applicationsTableExists($applicationsTable) {
        $qry = "SELECT * FROM $applicationsTable";
        if (query($qry) !== FALSE) {
            return true;
            echo "Table exists.";
        }
        else { 
            return false;
        }
    }
	
	// Checks if a table named Permissions exists in the database.
    function permissionsTableExists($permissionsTable) {
        $qry = "SELECT * FROM $permissionsTable";
        if (query($qry) !== FALSE) {
            return true;
            echo "Table exists.";
        }
        else { 
            return false;
        }
    }
	
	// Checks if a table named hasPermissions exists in the database.
    function hasPermissionsTableExists($hasPermissionsTable) {
        $qry = "SELECT * FROM $hasPermissionsTable";
        if (query($qry) !== FALSE) {
            return true;
            echo "Table exists.";
        }
        else { 
            return false;
        }
    }
	
	// Function to create the Departments table.
    function createDepartmentsTable($departmentsTable, $columns) {
        $qry = "CREATE TABLE $departmentsTable (" . implode(", ", $columns) . ")";
        echo "Creating table with SQL Statement: $qry\n<br>";
        return query($qry);
    }
	
	// Function to create the Locations table.
    function createLocationsTable($locationsTable, $columns) {
        $qry = "CREATE TABLE $locationsTable (" . implode(", ", $columns) . ")";
        echo "Creating table with SQL Statement: $qry\n<br>";
        return query($qry);
    }

	// Function to create the Passwords table.
    function createPasswordsTable($passwordsTable, $columns) {
        $qry = "CREATE TABLE $passwordsTable (" . implode(", ", $columns) . ")";
        echo "Creating table with SQL Statement: $qry\n<br>";
        return query($qry);
    }
	
	// Function to create the Requests table.
    function createRequestsTable($requestsTable, $columns) {
        $qry = "CREATE TABLE $requestsTable (" . implode(", ", $columns) . ")";
        echo "Creating table with SQL Statement: $qry\n<br>";
        return query($qry);
    }
	
    // Function to create the Roles table.
    function createRolesTable($rolesTable, $columns) {
        $qry = "CREATE TABLE $rolesTable (" . implode(", ", $columns) . ")";
        echo "Creating table with SQL Statement: $qry\n<br>";
        return query($qry);
    }
    
	// Function to create the Users table.
    function createUsersTable($usersTable, $columns) {
        $qry = "CREATE TABLE $usersTable (" . implode(", ", $columns) . ")";
        echo "Creating table with SQL Statement: $qry\n<br>";
        return query($qry);
    }
	
    // Function to create the Departments table.
    function createAuditTable($auditTable, $columns) {
        $qry = "CREATE TABLE $auditTable (" . implode(", ", $columns) . ")";
        echo "Creating table with SQL Statement: $qry\n<br>";
        return query($qry);
    }
	
	// Function to create the Users table.
    function createApplicationsTable($applicationsTable, $columns) {
        $qry = "CREATE TABLE $applicationsTable (" . implode(", ", $columns) . ")";
        echo "Creating table with SQL Statement: $qry\n<br>";
        return query($qry);
    }
	
	// Function to create the Permissions table.
    function createPermissionsTable($permissionsTable, $columns) {
        $qry = "CREATE TABLE $permissionsTable (" . implode(", ", $columns) . ")";
        echo "Creating table with SQL Statement: $qry\n<br>";
        return query($qry);
    }
	
	// Function to create the hasPermissions table.
    function createHasPermissionsTable($hasPermissionsTable, $columns) {
        $qry = "CREATE TABLE $hasPermissionsTable (" . implode(", ", $columns) . ")";
        echo "Creating table with SQL Statement: $qry\n<br>";
        return query($qry);
    }
	
    // Function used when we need to run SQL queries.
    function query($qry) {
        global $conn;
        return mysqli_query($conn, $qry);
    }
    
	// Create a sample department record, if necessary.
    function createDepartment($departmentsTable, $values) {
        return insertIntoDepartment($departmentsTable, ["Name"], $values);
    }
	
	// Create a sample location record, if necessary.
    function createLocation($locationsTable, $values) {
        return insertIntoLocation($locationsTable, ["Country", "City"], $values);
    }

	// Create a sample user record, if necessary.
    function createPassword($passwordsTable, $values) {
        return insertIntoPassword($passwordsTable, ["UserID", "Password", "DateChanged"], $values);
    }
	
	// Create a sample request record, if necessary.
    function createRequest($requestsTable, $values) {
        return insertIntoRequest($requestsTable, ["Name", "Timestamp"], $values);
    }
	
	// Create a sample role record, if necessary.
    function createRole($rolesTable, $values) {
        return insertIntoRole($rolesTable, ["Name"], $values);
    }

    // Create a sample user record, if necessary.
    function createUser($usersTable, $values) {
        return insertIntoUser($usersTable, ["FirstName", "LastName", "Email", "Phone", "Country", "City", "DID", "RID", "Username", "Password", "Team"], $values);
    }
	
	// Create a sample audit record, if necessary.
    function createAudit($auditTable, $values) {
        return insertIntoAudit($auditTable, ["UserID", "ActionID", "Timestamp"], $values);
    }

	// Create a sample audit record, if necessary.
    function createApplication($applicationsTable, $values) {
        return insertIntoApplication($applicationsTable, ["Name"], $values);
    }
	
	// Create a sample permission record, if necessary.
    function createPermission($permissionsTable, $values) {
        return insertIntoPermission($permissionsTable, ["Name"], $values);
    }
	
	// Create a sample hasPermission record, if necessary.
    function createHasPermission($hasPermissionsTable, $values) {
        return insertIntoHasPermission($hasPermissionsTable, ["UserID", "PermissionID", "ApplicationID"], $values);
    }
	
	// Insert a new department record into the database.
    function insertIntoDepartment($departmentsTable, $columns, $values) {
        $qry = "INSERT INTO $departmentsTable (" . implode(", ", $columns). ") VALUES (" . implode(", ", $values) . ")";
        echo "\n<br>Inserting a new record with SQL Statement: $qry\n<br>";
        return query($qry);
    }
	
	// Insert a new location record into the database.
    function insertIntoLocation($locationsTable, $columns, $values) {
        $qry = "INSERT INTO $locationsTable (" . implode(", ", $columns). ") VALUES (" . implode(", ", $values) . ")";
        echo "\n<br>Inserting a new record with SQL Statement: $qry\n<br>";
        return query($qry);
    }
	
	// Insert a new password record into the database.
    function insertIntoPassword($passwordsTable, $columns, $values) {
        $qry = "INSERT INTO $passwordsTable (" . implode(", ", $columns). ") VALUES (" . implode(", ", $values) . ")";
        echo "\n<br>Inserting a new record with SQL Statement: $qry\n<br>";
        return query($qry);
    }
	
	// Insert a new request record into the database.
    function insertIntoRequest($requestsTable, $columns, $values) {
        $qry = "INSERT INTO $requestsTable (" . implode(", ", $columns). ") VALUES (" . implode(", ", $values) . ")";
        echo "\n<br>Inserting a new record with SQL Statement: $qry\n<br>";
        return query($qry);
    }
	
	// Insert a new role record into the database.
    function insertIntoRole($rolesTable, $columns, $values) {
        $qry = "INSERT INTO $rolesTable (" . implode(", ", $columns). ") VALUES (" . implode(", ", $values) . ")";
        echo "\n<br>Inserting a new record with SQL Statement: $qry\n<br>";
        return query($qry);
    }
	
    // Insert a new user record into the database.
    function insertIntoUser($usersTable, $columns, $values) {
        $qry = "INSERT INTO $usersTable (" . implode(", ", $columns). ") VALUES (" . implode(", ", $values) . ")";
        echo "\n<br>Inserting a new record with SQL Statement: $qry\n<br>";
        return query($qry);
    }
	
	// Insert a new application record into the database.
    function insertIntoApplication($applicationsTable, $columns, $values) {
        $qry = "INSERT INTO $applicationsTable (" . implode(", ", $columns). ") VALUES (" . implode(", ", $values) . ")";
        echo "\n<br>Inserting a new record with SQL Statement: $qry\n<br>";
        return query($qry);
    }

	// Insert a new permission record into the database.
    function insertIntoPermission($permissionsTable, $columns, $values) {
        $qry = "INSERT INTO $permissionsTable (" . implode(", ", $columns). ") VALUES (" . implode(", ", $values) . ")";
        echo "\n<br>Inserting a new record with SQL Statement: $qry\n<br>";
        return query($qry);
    }
	
	// Insert a new hasPermission record into the database.
    function insertIntoHasPermission($hasPermissionsTable, $columns, $values) {
        $qry = "INSERT INTO $hasPermissionsTable (" . implode(", ", $columns). ") VALUES (" . implode(", ", $values) . ")";
        echo "\n<br>Inserting a new record with SQL Statement: $qry\n<br>";
        return query($qry);
    }
?>
<?php

class Database {
    
    private $host = __DB_HOST;
    private $user = __DB_USER;
    private $pass = __DB_PASS;
    private $dbname = __DB_NAME;
    
    //database handler
    private $dbh;
    
    //database errors
    private $error;
    
    //variable to hold the statement
    private $statement;
    
    //Construct
    public function __construct() {
        
        //set DNS
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        
        //set options
        //PDO::ATTR_PERSISTENT - this option sets the connection type to the database to be persistent.
        //Check to see if there is already an established connection to the database
        // PDO::ERRMODE_EXCEPTION - if throw an exception if an error occurs.
        
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        
        //create new PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        //catch any errors
        catch(PDOException $e) {
            $this->error = $e->getMessage();
        }
    }
    
    //Query method
    //PDO::prepare function - The prepare function allows you to bind values into your SQL statements.
    public function query ($query) {
        $this->statement = $this->dbh->prepare($query);
        
    }
    
    //bind method
    public function bind ($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->statement->bindValue($param, $value, $type);
    }
    
    //execute - execute the prepared statement
    public function execute() {
        return $this->statement->execute();
        
    }
    
    //result set - returns an array of the result set rows
    //fetchAll
    public function resultset () {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
        
    }
    //fetchAllAsoc
    public function resultset_asoc() {
        $this->execute();
        return $this->statement->fetchAllAsoc();
    }
    //fetchRow
    public function resultset_row() {
        $this->execute();
        return $this->statement->fetchRow();
    }
    
    //transaction - Transactions allows you to run multiple changes to a database all in one batch to ensure that 
    //your work will not be accessed incorrectly or there will be no outside interferences before you are finished. 
    //If you are running many queries that all rely upon each other, if one fails an exception will be thrown and 
    //you can roll back any previous changes to the start of the transaction.
    
    //to bbegin a transaction
    public function beginTransaction() {
        return $this->dbh->beginTransaction();
    }
    //to end a transaction and commit my changes
    public function endTransaction () {
        return $this->dbh->commit();
    }
    //to cancel a transaction and roll back your changes
    public function cancelTransaction() {
        return $this->dbh->rollBack();
    }
    
    //debug dump parameters - dump the information that was contained in the prepared statement
    public function debugDumpParams(){
        return $this->statement->debugDumpParams();
    }
    
}

?>

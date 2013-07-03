<?php

class Database {
    
    private $host = __DB_HOST;
    private $user = __DB_USER;
    private $pass = __DB_PASS;
    private $dbname = __DB_NAME;
    //private $dbtable = __DB_TABLE;
    
    //database handler &database errors
    private $dbh;
    private $error;
    
    //functions
    private $table;
    private $fields;
    private $condition;

    //Construct
    public function __construct() {
        
        $this->name = "MyDatabaseClass";
        
        //set DNS
        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        
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
            return $this->dbh = do_mysqli_connect();
            //return $this->dbh = new PDO($dns, $this->user, $this->pass, $options);
        }
        //catch any errors
        catch(Exception $e) {
            return $this->error = $e->getMessage();
        }
    }
    
    //Destructor
    public function __destruct() {
        return false;
        //return $this->dbh = do_mysqli_close();
        //print "Destroying".$this->name."\n";
    }
    
    //function db_select
    public function db_select ($tablename) {
        return $this->table = $tablename;
        //return $this->table;
    }
    
    //function fields
    public function fields($fieldname) {
        return $this->fields = $fieldname;
        //return $this->fields;
    }
    
    //function condition
    public function condition ($conditioname) {
        return $this->condition = $conditioname;
        //return $this->condition;
    }
    
    //execute - execute the prepared statement
    public function execute() {
        //echo 'OK';
        return $this->execute();
        
    }
    
    /*
    //Query method
    //PDO::prepare function - The prepare function allows you to bind values into your SQL statements.
    public function query ($query) {
        return $this->dbh->prepare($query);
        
    }
    
    //result set - returns an array of the result set rows
    //fetchAll
    public function resultset () {
        $this->execute();
        return $this->fetchAll(PDO::FETCH_ASSOC);
        
    }
    //fetchAllAsoc
    public function resultset_asoc() {
        $this->execute();
        return $this->fetchAllAsoc();
    }
    //fetchRow
    public function resultset_row() {
        $this->execute();
        return $this->fetchRow();
    }
    */
}

?>

<?php

error_reporting(E_ALL);

class Database {
    
    private $host = __DB_HOST;
    private $user = __DB_USER;
    private $pass = __DB_PASS;
    private $dbname = __DB_NAME;
    
    //database handler &database errors
    private $dbh;
    private $error;
    
    //functions
    private $table;
    private $fields;
    private $condition;

    //Construct
    public function __construct() {
        
        //$this->name = "MyDatabaseClass";
        
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
    /*
    public function db_select ($tablename) {
        return $this->table = $tablename;
        //return $this->table;
    }
     */
    
    //drupal db_select
    public function db_select($table, $alias = NULL, array $options = array()) {
        if (empty($options['target'])) {
            $options['target'] = 'default';
        }
        return Database::getConnection($options['target'])->select($table, $alias, $options);
    }
    //function fields
    public function fields($fieldname) {
        //logic 
        return $this->fields = $fieldname;
        //return $this->fields;
    }
    //function condition
    public function condition ($conditioname) {
        return $this->condition = $conditioname;
    }
    //function execute()
    public function execute () {
        //logic
        return $this->execute();
    }
    
    /*
    public function resultset () {
        //$this->execute();
        return $this->execute()->fetchAll(PDO::FETCH_ASSOC);
        
    }
     */
    
    public function fetchAllAssoc($key, $fetch_style = NULL) {
        
        $this->fetchStyle = isset($fetch_style) ? $fetch_style : $this->defaultFetchStyle;
        $this->fetchOptions = $this->defaultFetchOptions;

        $result = array();
        // Traverse the array as PHP would have done.
        while (isset($this->currentRow)) {
            // Grab the row in its raw PDO::FETCH_ASSOC format.
            $row = $this->currentRow;
            // Grab the row in the format specified above.
            $result_row = $this->current();
            $result[$this->currentRow[$key]] = $result_row;
            $this->next();
        }

        // Reset the fetch parameters to the value stored using setFetchMode().
        $this->fetchStyle = $this->defaultFetchStyle;
        $this->fetchOptions = $this->defaultFetchOptions;
        
        return $result;
    }
    
    
    public function fetchAll($fetch_style = NULL, $fetch_column = NULL, $constructor_args = NULL) {
        $this->fetchStyle = isset($fetch_style) ? $fetch_style : $this->defaultFetchStyle;
        $this->fetchOptions = $this->defaultFetchOptions;
        if (isset($fetch_column)) {
            $this->fetchOptions['column'] = $fetch_column;
        }
        if (isset($constructor_args)) {
            $this->fetchOptions['constructor_args'] = $constructor_args;
        }

        $result = array();
        // Traverse the array as PHP would have done.
        while (isset($this->currentRow)) {
            // Grab the row in the format specified above.
            $result[] = $this->current();
            $this->next();
        }

        // Reset the fetch parameters to the value stored using setFetchMode().
        $this->fetchStyle = $this->defaultFetchStyle;
        $this->fetchOptions = $this->defaultFetchOptions;
        return $result;
      }
}

?>

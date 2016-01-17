<?php

/**
 *  An advanced, compact and lightweight MySQL database wrapper library, built around PHP's
 *  {@link http://www.php.net/manual/en/book.mysqli.php MySQLi extension}. It provides methods for interacting with MySQL
 *  databases that are more secure, powerful and intuitive than PHP's default ones.
 *
 *  It encourages developers to write maintainable code and provides a better default security layer by encouraging the
 *  use of prepared statements, where arguments are escaped automatically.
 *
 *  Visit {@link http://dhtml.github.io/dhtmlsql} for full documentation.
 *
 *  For more resources visit {@link http://github.com/dhtml}
 *
 *  @author     Anthony Ogundipe a.k.a dhtml <diltony@yahoo.com>
 *  @author url     http://www.dhtmlextreme.com , http://www.africoders.com
 *  @version    1.0.0 (last revision: January 01, 2016)
 *  @copyright  (c) 2016 Anthony Ogundipe
 *  @license    http://www.gnu.org/licenses/lgpl-3.0.txt GNU LESSER GENERAL PUBLIC LICENSE
 *  @package    DHTMLSQL
 */

class DHTMLSQL {

    /**
     *  MySQL link identifier.
     *
     *  @access private
     *
     *  @var  object
     *
     */
	private $connection=null;

    /**
     *  MySQL result set.
     *
     *  @access private
     *
     *  @var  object
     *
     */
	private $result;
	
    /**
     *  Static library class
     *
     *  @access private
     *
     *  @var  resource
     *
     */
	private static $Instance;
	
    /**
     *  Current library version
     *
     *  @access private
     *
     *  @var  string
     *
     */
	private $version="1.0.0";
	
    /**
     *  Number of rows returned by query
     *
     *  Default is 0.
     *
     *  @var  integer
     *
     */
	public $returned_rows;
	
    /**
     *  Logs the connection error if there is one
     *
     *
     *  Default is an empty string.
     *
     *  @var  string
     *
     */
	private $connect_error="";

    /**
     *  Last sql statement issues internally
     *
     *  Default is an empty string.
     *
     *  @access private
     *
     *  @var  string
     *
     */
	private $last_sql="";

    /**
     *  Last database result resource
     *
     *  Default is null.
     *
     *  @var  resource
     *
     */
	public $last_result=null;
	
    /**
     *  Determines if application should halt whenever there is a database error
     *
     *  Default is TRUE.
     *
     *  @var  boolean
     *
     */
	public $halt_on_error=true;
	
    /**
     *  Prints error log to screen whenever an error occurs while executing a statement
     *
     *  Default is TRUE.
     *
     *  @var  boolean
     *
     */
	public $print_error=true;
	
	
    /**
     *  Configures library database query logging
     *  When set to true, each query executed is logged to dbase.log
     *
     *  Default is FALSE.
     *
     *  @var  boolean
     *
     */
	public $session_logging=false; 


    /**
     *  Configures the path where database queries will be logged if session_logging is set to true
     *  It can be a path that is writeable
     *  If this is not specified and session_logging=true then dbase.log will be used for logging by default
     *
     *  Default is an empty string.
     *
     *  @var  string
     *
     */
	public $session_logger='';
	

    /**
     *  Configures the special preview mode
     *  When set to true, each query meant to be executed will be printed and on screen and not executed 
     *  This is useful in development mode for testing the library
     *
     *  Default is FALSE.
     *
     *  @var  boolean
     *
     *  @access private
     *
     */
	private $preview_mode=false;


    /**
    *  Static constructor of class
    *  You can instantiate the class object in a dynamic manner via $db=new DHTMLSQL();
    *  You can instantiate the class object in a static manner via $db=DHTMLSQL::load();
     *
	*/
	public static function load() {
		if ( self::$Instance === null )
		{
			self::$Instance = new self();
		}
		return self::$Instance;
	}

    /**
	* Class constructor
     *
	*/
	public function __construct() {
		self::$Instance=$this;
	}	
	
	
	
    /**
     *  Enables internal logging of SQL queries to file
     *
     *  <code>
     *	$db->session_logger="sql.log";
     *	$db->session_logging=true;
     *	$db->query("select 1");
     *  </code>
	 *
     *  @param  string  $log	(Optional) The string to be logged
	 *
     *  @access private
	 *
     *  @return void
     *
	*/
	private function session_log($log='') {
		if($this->session_logging!=true) {return;}
		if(empty($this->session_logger)) {$this->session_logger=__DIR__.'/dbase.log';}

		$time=date("d/m/Y h:i:a");
		$report="[$time]"."\n$log\n\n";

		error_log($report, 3, $this->session_logger);
	}
	
    /**
     *  Empties the session_log output file
     *
     *  <code>
     *	$db->session_logger="sql.log";
     *	$db->reset_session_logger();
     *  </code>
	 *
	 *
     *  @return boolean		true if successful (or file does not exist), false if no output file was specified
     *
	*/
	public function reset_session_logger() {
		if(empty($this->session_logger)) {return false;}
		@file_put_contents($this->session_logger,'');
		return true;
	}

    /**
     *  Allows you prefix your table names in curly braces in an sql statement
     *
	 *
     *  @param  string  $stmt		sql statements to be processed
	 *
     *  @param  string  $table_prefix		prefix to add for names of tables
	 *
     *  <code>
     *	$db->db_prefix_tables("select * from {users} where 1",'ow_');
     *  </code>
     *  <output>
     *	select * from ow_users where 1
     *  </output>
	 *
     *  @return string		Returns sql statement with table names (in curly braces) prefixed
     *
	*/
	public function db_prefix_tables($stmt,$table_prefix) 
	{
		return strtr($sql, array('{' => $table_prefix, '}' => ''));
	}


    /**
     *  Statical way of instantiating the class
     *
     *  <code>
     *	$db=DHTMLSQL::get();
     *  </code>
     *
     * Since it is chainable, so we can also use it to connect to the database
     *  <code>
     *	$db=DHTMLSQL::get()->connect('localhost','admin','pass','dbtest');
     *  </code>
	 *
     *  @return object		DHTMLSQL class object is returned
     *
	*/
	public static function get() {return self::load();}

    /**
     *  Opens a connection to a MySQL Server and selects a database.
     *
     *
     *
     *  <code>
     *  // create the database object
     *  $db = DHTMLSQL::connect();
     *  </code>
     *
     *
     *
     *  @param  mixed   $host       The address of the MySQL server to connect to (i.e. localhost).
     *
     *                              Prepending host by <b>p:</b> opens a persistent connection.
     *								
     *								If the host is an already existing mysqli connection, then it shall be re-used
     *
     *  @param  string  $username   (Optional) The user name used for authentication when connecting to the MySQL server.
     *
     *  @param  string  $password   (Optional) The password used for authentication when connecting to the MySQL server.
     *
     *  @param  string  $dbname     (Optional) The database to be selected after the connection is established.
     *
     *  @param  string  $port       (Optional) The port number to attempt to connect to the MySQL server.
     *
     *                              Leave as empty string to use the default as returned by ini_get("mysqli.default_port").
     *
     *  @param  string  $socket     (Optional) The socket or named pipe that should be used.
     *
     *                              Leave as empty string to use the default as returned by ini_get("mysqli.default_socket").
     *
     *                              Specifying the socket parameter will not explicitly determine the type of connection
     *                              to be used when connecting to the MySQL server. How the connection is made to the MySQL
     *                              database is determined by the <i>host</i> argument.
     *
     *
     *  @return object				DHTMLSQL object is returned
     *
     */
	public static function connect($host = null,$username = null,$password = null,$dbname = null,$port=null,$socket=null) {
		return self::get()->_connect($host,$username,$password,$dbname,$port,$socket);
	}

    /**
     *  Opens a connection to a MySQL Server and selects a database.
     *
     *
     *
     *  <code>
     *  // create the database object
     *  $db = new DHTMLSQL();
     *
     *  $db->connect('host', 'username', 'password', 'database');
     *  </code>
     *
     *
     *  @param  mixed   $host       The address of the MySQL server to connect to (i.e. localhost).
     *
     *                              Prepending host by <b>p:</b> opens a persistent connection.
     *								
     *								If the host is an already existing mysqli connection, then it shall be re-used
     *
     *  @param  string  $username   (Optional) The user name used for authentication when connecting to the MySQL server.
     *
     *  @param  string  $password   (Optional) The password used for authentication when connecting to the MySQL server.
     *
     *  @param  string  $dbname     (Optional) The database to be selected after the connection is established.
     *
     *  @param  string  $port       (Optional) The port number to attempt to connect to the MySQL server.
     *
     *                              Leave as empty string to use the default as returned by ini_get("mysqli.default_port").
     *
     *  @param  string  $socket     (Optional) The socket or named pipe that should be used.
     *
     *                              Leave as empty string to use the default as returned by ini_get("mysqli.default_socket").
     *
     *                              Specifying the socket parameter will not explicitly determine the type of connection
     *                              to be used when connecting to the MySQL server. How the connection is made to the MySQL
     *                              database is determined by the <i>host</i> argument.
     *
     *
     *  @return object				DHTMLSQL object is returned
     *
     */
	public function _connect($host = null,$username = null,$password = null,$dbname = null,$port=null,$socket=null) {
		$this->host=$host;
		$this->username=$username;
		$this->password=$password;
		$this->dbname=$dbname;
		
		if(is_object($host) && get_class($host)=='mysqli') {
		$this->connection=$host;
		} else {
		$this->connection = @new mysqli($host, $username, $password, $dbname,$port,$socket);
		}
		
		if (mysqli_connect_errno()) {
			$this->connection=null;
			$this->connect_error=mysqli_connect_error();
		} 
		
		return $this;
	}
	
    /**
     *  Retrieves connection error after calling the connect method
     *
     *  <code>
     *	echo $db->connect_error();
     *  </code>
	 *
	 *
     *  @return string		sql connection error in case of unsuccessful connection otherwise empty string
     *
	*/
	public function connect_error() {return $this->connect_error;}

    /**
     *  Confirms if a successful connection has been made to the database
     *  It is meant to be called after the connect method
     *
     *  <code>
     *	 if(!$db->connected()) {
     *		exit("Unable to connect to database. Reason: ".$db->connect_error());
     *	 }
     *  </code>
	 *
	 *
     *  @return boolean		returns true if a successful connection has been made otherwise returns false
     *
	*/
	public function connected() {return !is_null($this->connection);}

    /**
     *  Gets the number of rows returned in a select statement
     *
     *  <code>
     *	 $db->query("show tables");
     *	 echo $db->num_rows();
     *  </code>
	 *
	 *
     *  @return int		the number of rows returned otherwise 0
     *
	*/
	public function num_rows() {return (isset($this->returned_rows) ? $this->returned_rows : 0);}
	
	
    /**
     *  Turns on and off the preview mode.
     *  When preview mode is on, SQL statements are displayed on screen rather than executed
     *
     *  <code>
     *	 $db->preview(true);
     *	 $db->query("show tables");
     *	 echo $db->num_rows();
     *  </code>
	 *
	 *
     *  @return void
     *
	*/
	public function preview($mode) {
		$this->preview_mode=$mode;
	}

    /**
     *  Runs a MySQL query.
     *
     *  After a SELECT query you can get the number of returned rows by reading the {@link returned_rows} property.
     *
     *  After an UPDATE, INSERT or DELETE query you can get the number of affected rows by reading the
     *  {@link affected_rows} property.
     *
     *  <code>
     *  // run a query
     *  $db->query('
     *      SELECT
     *          *
     *      FROM
     *          users
     *      WHERE
     *          gender = ?
     *  ', array($gender));
     *
     *  // array as replacement, for use with WHERE-IN conditions
     *  $db->query('
     *      SELECT
     *          *
     *      FROM
     *          users
     *      WHERE
     *          gender = ? AND
     *          id IN (?)
     *  ', array('f', array(1, 2, 3)));
     *  </code>
     *
     *  @param  string  $sql            MySQL statement to execute.
     *
     *  @param  array   $replacements   (Optional) An array with as many items as the total parameter markers ("?", question
     *                                  marks) in <i>$sql</i>. Each item will be automatically {@link escape()}-ed and
     *                                  will replace the corresponding "?". Can also include an array as an item, case in
     *                                  which each value from the array will automatically {@link escape()}-ed and then
     *                                  concatenated with the other elements from the array - useful when using <i>WHERE
     *                                  column IN (?)</i> conditions.
     *
     *                                  Default is "" (an empty string).
     *
     *
     *  @return mixed                   On success, returns a resource 
     *                                  or FALSE on error.
     *
     */
	function query($sql, $replacements = '')
	{
		// if an active connection exists
		if (!$this->connected()) {                
			$this->_log(array(
			'query' =>  $sql,
			'error' =>  'No active database connection'
			));
		}
		
		// remove spaces used for indentation (if any)
		$sql = preg_replace(array("/^\s+/m", "/\r\n/"), array('', ' '), $sql);

		// if $replacements is specified but it's not an array
		if ($replacements != '' && !is_array($replacements)) {

			$this->_log(array(
			'query' =>  $sql,
			'error' =>  'replacements not an array'
			));
		} else if ($replacements != '' && is_array($replacements) && !empty($replacements)) {

			// found how many items to replace are there in the query string
			preg_match_all('/\?/', $sql, $matches, PREG_OFFSET_CAPTURE);

			// if the number of items to replace is different than the number of items specified in $replacements
			if (!empty($matches[0]) && count($matches[0]) != count($replacements)) {

				// save debug information
				$this->_log(array(
				'query' => $sql,
				'error' => 'wrong number of replacements variables'
				));
			}
			// if the number of items to replace is the same as the number of items specified in $replacements
			else {

				// make preparations for the replacement
				$pattern1 = $pattern2 = $replacements1 = $replacements2 = array();

				// prepare parameter markers for replacement
				foreach ($matches[0] as $match) $pattern1[] = '/\\' . $match[0] . '/';

				foreach ($replacements as $key => $replacement) {

					// generate a string
					$randomstr = md5(microtime()) . $key;

					// prepare the replacements for the parameter markers
					$replacements1[] = $randomstr;

					// if the replacement is NULL, leave it like it is
					if ($replacement === NULL) $replacements2[$key] = 'NULL';

					// if the replacement is an array, implode and escape it for use in WHERE ? IN ? statement
					elseif (is_array($replacement)) $replacements2[$key] = preg_replace(array('/\\\\/', '/\$([0-9]*)/'), array('\\\\\\\\', '\\\$$1'), $this->implode($replacement));

					// otherwise, mysqli_real_escape_string the items in replacements
					// also, replace anything that looks like $45 to \$45 or else the next preg_replace-s will treat
					// it as references
					else $replacements2[$key] = '\'' . preg_replace(array('/\\\\/', '/\$([0-9]*)/'), array('\\\\\\\\', '\\\$$1'), $this->escape($replacement)) . '\'';

					// and also, prepare the new pattern to be replaced afterwards
					$pattern2[$key] = '/' . $randomstr . '/';

				}

				// replace each question mark with something new
				// (we do this intermediary step so that we can actually have question marks in the replacements)
				$sql = preg_replace($pattern1, $replacements1, $sql, 1);

				// perform the actual replacement
				$sql = preg_replace($pattern2, $replacements2, $sql, 1);

			}
		}
				
		if($this->preview_mode) {echo $sql."<br/>";return;}

		$this->session_log($sql);
		
		$this->last_sql=$sql;
		$this->result=@$this->connection->query($sql);
		$this->last_result=$this->result;
		$this->returned_rows=isset($this->result->num_rows) ? $this->result->num_rows : 0;
		if(!$this->result) {$this->_log(array('query'=>$sql,'error'=>$this->connection->error));}
		return $this;
	}
	
    /**
     *  Gets the last SQL statement executed
     *
     *  <code>
     *	 $db->query("show tables");
     *	 echo $db->fetch_sql();
     *  </code>
	 *
	 *
     *  @return string		the last sql statement executed
     *
 	 */
	public function fetch_sql() {
		return $this->last_sql;
	}

    /**
     *  Get number of affected rows in previous MySQL operation
	 *
     *  @return int		number of affected rows otherwise -1 if last result fails
     *
	*/
	public function affected_rows() {return isset($this->connection->affected_rows) ? $this->connection->affected_rows:-1;}

    /**
     *  Get the ID generated from the previous INSERT operation
	 *
     *  @return int		returns generated ID otherwise 0 (if no ID was generated or autoincrement was not set)
     *
	*/
	public function insert_id() {return isset($this->connection->insert_id) ? $this->connection->insert_id:0;}


	 /**
     *  Shorthand for simple SELECT queries.
     *
     *  For complex queries (using UNION, JOIN, etc) use the {@link query()} method.
     *
     *  When using this method, column names will be enclosed in grave accents " ` " (thus, allowing seamless usage of
     *  reserved words as column names) and values will be automatically {@link escape()}d in order to prevent SQL injections.
     *
     *  <code>
     *  $db->select(
     *      'column1, column2',
     *      'table',
     *      'criteria = ?',
     *      array($criteria)
     *  );
     *
     *  // or
     *
     *  $db->select(
     *      array('column1', 'column2'),
     *      'table',
     *      'criteria = ?',
     *      array($criteria)
     *  );
     *
     *  // or
     *
     *  $db->select(
     *      '*',
     *      'table',
     *      'criteria = ?',
     *      array($criteria)
     *  );
     *  </code>
     *
     *  @param  mixed  $columns         A string with comma separated values or an array representing valid column names
     *                                  as used in a SELECT statement.
     *
     *                                  <samp>These will be enclosed in grave accents, so make sure you are only using
     *                                  column names and not things like "tablename.*"! You may also use "*" instead
     *                                  of column names to select all columns from a table.</samp>
     *
     *  @param  string  $table          Table in which to search.
     *
     *                                  <i>Note that table name will be enclosed in grave accents " ` " and thus only
     *                                  one table name should be used! For anything but a simple select query use the
     *                                  {@link query()} method.</i>
     *
     *  @param  string  $where          (Optional) A MySQL WHERE clause (without the WHERE keyword).
     *
     *                                  Default is "" (an empty string).
     *
     *  @param  array   $replacements   (Optional) An array with as many items as the total parameter markers ("?", question
     *                                  marks) in <i>$where</i>. Each item will be automatically {@link escape()}-ed and
     *                                  will replace the corresponding "?". Can also include an array as an item, case in
     *                                  which each value from the array will automatically {@link escape()}-ed and then
     *                                  concatenated with the other elements from the array - useful when using <i>WHERE
     *                                  column IN (?)</i> conditions. See second example {@link query here}.
     *
     *                                  Default is "" (an empty string).
     *
     *  @param  string  $order          (Optional) A MySQL ORDER BY clause (without the ORDER BY keyword).
     *
     *                                  Default is "" (an empty string).
     *
     *  @param  mixed   $limit          (Optional) A MySQL LIMIT clause (without the LIMIT keyword).
     *
     *                                  Default is "" (an empty string).
     *
     *
     *  @return mixed                   On success, returns a resource
     *                                  or FALSE on error.
     *
     */
	function select($columns, $table, $where = '', $replacements = '', $order = '', $limit = '')
	{

		// run the query
		return $this->query('

			SELECT
				' . (is_string($columns) ? $columns : $this->_build_columns($columns)) . '
			FROM
				' . $table . '' .

		($where != '' ? ' WHERE ' . $where : '') .

		($order != '' ? ' ORDER BY ' . $order : '') .

		($limit != '' ? ' LIMIT ' . $limit : '')

		, $replacements);
	}

    /**
     *  Returns one or more columns from ONE row of a table.
     *
     *  <code>
     *  // get name, surname and age of all male users
     *  $result = $db->dlookup('name, surname, age', 'users', 'gender = "M"');
     *
     *  // when working with variables you should use the following syntax
     *  // this way you will stay clear of SQL injections
     *  $result = $db->dlookup('name, surname, age', 'users', 'gender = ?', array($gender));
     *  </code>
     *
     *  @param  string  $column         One or more columns to return data from.
     *
     *                                  <i>If only one column is specified the returned result will be the specified
     *                                  column's value. If more columns are specified the returned result will be an
     *                                  associative array!</i>
     *
     *                                  <i>You may use "*" (without the quotes) to return all the columns from the
     *                                  row.</i>
     *
     *  @param  string  $table          Name of the table in which to search.
     *
     *  @param  string  $where          (Optional) A MySQL WHERE clause (without the WHERE keyword).
     *
     *                                  Default is "" (an empty string).
     *
     *  @param  array   $replacements   (Optional) An array with as many items as the total parameter markers ("?", question
     *                                  marks) in <i>$where</i>. Each item will be automatically {@link escape()}-ed and
     *                                  will replace the corresponding "?". Can also include an array as an item, case in
     *                                  which each value from the array will automatically {@link escape()}-ed and then
     *                                  concatenated with the other elements from the array - useful when using <i>WHERE
     *                                  column IN (?)</i> conditions. See second example {@link query here}.
     *
     *                                  Default is "" (an empty string).
     *
     *
     *  @return mixed                   Found value/values or FALSE if no records matching the given criteria (if any)
     *                                  were found. It also returns FALSE if there are no records in the table or if there
     *                                  was an error.
     *
     */
	function dlookup($column, $table, $where = '', $replacements = '')
	{

		// run the query
		$this->query('

			SELECT
				' . $column . '
			FROM
				`'. $table . '`' .
		($where != '' ? ' WHERE ' . $where : '') . '
			LIMIT 1

		', $replacements);

		// if query was executed successfully and one or more records were returned
		if ($this->last_result !== false && $this->returned_rows > 0) {

			// fetch the result
			$row = $this->fetch_assoc();

			// if there is only one column in the returned set
			// return as a single value
			if (count($row) == 1) return array_pop($row);

			// if more than one columns, return as an array
			else return $row;

		}

		// if error or no records
		return false;
	}
	
	
	/**
	*  Shorthand for deleting some or all items in a table.
	*
	*
	*  <code>
	*  $db->del('users','id>?',array(16));
	*  </code>
	*
	*  @param  string  $table          Table to delete from.
	*
    *  @param  string  $where          (Optional) A MySQL WHERE clause (without the WHERE keyword).
    *
    *                                  Default is "" (an empty string).
    *
    *  @param  array   $replacements   (Optional) An array with as many items as the total parameter markers ("?", question
    *                                  marks) in <i>$where</i>. Each item will be automatically {@link escape()}-ed and
    *                                  will replace the corresponding "?". Can also include an array as an item, case in
    *                                  which each value from the array will automatically {@link escape()}-ed and then
    *                                  concatenated with the other elements from the array - useful when using <i>WHERE
    *                                  column IN (?)</i> conditions. See second example {@link query here}.
    *
    *                                  Default is "" (an empty string).
    *
	*
	*
    *  @return mixed                   On success, returns a resource
    *                                  or FALSE on error.
    *
	*/
	function del($table, $where = '', $replacements = '')
	{

		// run the query
		return $this->query('

			DELETE
			FROM
				' . $table . '' .

		($where != '' ? ' WHERE ' . $where : '') 
		, $replacements);
	}


    /**
     *  Shorthand for INSERT queries.
     *
     *  When using this method column names will be enclosed in grave accents " ` " (thus, allowing seamless usage of
     *  reserved words as column names) and values will be automatically {@link escape()}d in order to prevent SQL injections.
     *
     *  <code>
     *  $db->insert(
     *      'table',
     *      array(
     *          'column1'   =>  'value1',
     *          'column2'   =>  'value2',
     *  ));
     *  </code>
     *
     *  @param  string  $table          Table in which to insert.
     *
     *  @param  array   $columns        An associative array where the array's keys represent the columns names and the
     *                                  array's values represent the values to be inserted in each respective column.
     *
     *                                  Column names will be enclosed in grave accents " ` " (thus, allowing seamless
     *                                  usage of reserved words as column names) and values will be automatically
     *                                  {@link escape()}d in order to prevent SQL injections.
     *
     *  @param  boolean $ignore         (Optional) By default trying to insert a record that would cause a duplicate
     *                                  entry for a primary key would result in an error. If you want these errors to be
     *                                  skipped set this argument to TRUE.
     *									If $ignore is an array, then insert_update method is triggered automatically
     *
     *                                  For more information see {@link http://dev.mysql.com/doc/refman/5.5/en/insert.html MySQL's INSERT IGNORE syntax}.
     *
     *                                  Default is FALSE.
     *
     *  @return boolean                 Returns TRUE on success of FALSE on error.
     *
     */
	function insert($table, $columns, $ignore = false)
	{
		if(is_array($ignore)) {return $this->insert_update($table, $columns,$ignore);}
		
		// enclose the column names in grave accents
		$cols = '`' . implode('`,`', array_keys($columns)) . '`';

		// parameter markers for escaping values later on
		$values = rtrim(str_repeat('?,', count($columns)), ',');

		// run the query
		$this->query('

			INSERT' . ($ignore ? ' IGNORE' : '') . ' INTO
				`' . $table . '`
				(' . $cols . ')
			VALUES
				(' . $values . ')'

		, array_values($columns));


		return $this;
	}

	
    /**
     *  Shorthand for REPLACE queries.
     *
     *  When using this method column names will be enclosed in grave accents " ` " (thus, allowing seamless usage of
     *  reserved words as column names) and values will be automatically {@link escape()}d in order to prevent SQL injections.
     *
     *  <code>
     *  $db->replace(
     *      'table',
     *      array(
     *          'column1'   =>  'value1',
     *          'column2'   =>  'value2',
     *  ));
     *  </code>
     *
     *  @param  string  $table          Table in which to replace into.
     *
     *  @param  array   $columns        An associative array where the array's keys represent the columns names and the
     *                                  array's values represent the values to be inserted in each respective column.
     *
     *                                  Column names will be enclosed in grave accents " ` " (thus, allowing seamless
     *                                  usage of reserved words as column names) and values will be automatically
     *                                  {@link escape()}d in order to prevent SQL injections.
     *
     *
     *  @return boolean                 Returns TRUE on success of FALSE on error.
     *
     */
	function replace($table, $columns)
	{
		
		// enclose the column names in grave accents
		$cols = '`' . implode('`,`', array_keys($columns)) . '`';

		// parameter markers for escaping values later on
		$values = rtrim(str_repeat('?,', count($columns)), ',');

		// run the query
		$this->query('

			REPLACE INTO
				`' . $table . '`
				(' . $cols . ')
			VALUES
				(' . $values . ')'

		, array_values($columns));


		return $this;
	}

    /**
     *  Given an associative array or a string with comma separated values where the values represent column names, this
     *  method will enclose column names in grave accents " ` " (thus, allowing seamless usage of reserved words as column
     *  names) and automatically {@link escape()} value.
     *
     *  @access private
     *
     *  @return string
     *
     */
	private function _build_columns($columns)
	{
		$sql = '';

		// if the argument is not an array
		if (!is_array($columns))

		// transform it to an array
		$columns = explode(',', $columns);

		// loop through each column
		foreach($columns as &$col)

		// wrap in grave accents " ` "
		$col = '`' . trim(trim($col), '`') . '`';

		// create string from array
		$sql = join(', ', $columns);

		return $sql;

	}
	
    
    /**
     *  Given an associative array where the array's keys represent column names and the array's values represent the
     *  values to be associated with each respective column, this method will enclose column names in grave accents " ` "
     *  (thus, allowing seamless usage of reserved words as column names) and automatically {@link escape()} value.
     *
     *  It will also take care of particular cases where the INC keyword is used in the values, where the INC keyword is
     *  used with a parameter marker ("?", question mark) or where a value is a single question mark - which throws an
     *  error message.
     *
     *  This method may also alter the original variable given as argument, as it is passed by reference!
     *
     *  @access private
     *
     */
	private function _build_sql(&$columns)
	{

		$sql = '';

		// start creating the SQL string and enclose field names in `
		foreach ($columns as $column_name => $value)

		// if value is just a parameter marker ("?", question mark)
		if (trim($value) == '?')

		// throw an error
		$this->_log(array(
		'error' =>  sprintf('cannot_use_parameter_marker', print_r($columns, true)),
		));

		// if special INC() keyword is used
		elseif (preg_match('/INC\((\-{1})?(.*?)\)/i', $value, $matches) > 0) {

			// translate to SQL
			$sql .= ($sql != '' ? ', ' : '') . '`' . $column_name . '` = `' . $column_name . '` ' . ($matches[1] == '-' ? '-' : '+') . ' ?';

			// if INC() contains an actual value and not a parameter marker ("?", question mark)
			// add the actual value to the array with the replacement values
			if ($matches[2] != '?') $columns[$column_name] = $matches[2];

			// if we have a parameter marker ("?", question mark) instead of a value, it means the replacement value
			// is already in the array with the replacement values, and that we don't need it here anymore
			else unset($columns[$column_name]);

			// the usual way
		} else $sql .= ($sql != '' ? ', ' : '') . '`' . $column_name . '` = ?';

		// return the built sql
		return $sql;

	}

    /**
     *  When using this method, if a row is inserted that would cause a duplicate value in a UNIQUE index or PRIMARY KEY,
     *  an UPDATE of the old row is performed.
     *
     *  Read more at {@link http://dev.mysql.com/doc/refman/5.0/en/insert-on-duplicate.html}.
     *
     *  When using this method, column names will be enclosed in grave accents " ` " (thus, allowing seamless usage of
     *  reserved words as column names) and values will be automatically {@link escape()}d in order to prevent SQL injections.
     *
     *  <code>
     *  // presuming article_id is a UNIQUE index or PRIMARY KEY, the statement below will insert a new row for given
     *  // $article_id and set the "votes" to 0. But, if $article_id is already in the database, increment the votes'
     *  // numbers.
     *  $db->insert_update(
     *      'table',
     *      array(
     *          'article_id'    =>  $article_id,
     *          'votes'         =>  0,
     *      ),
     *      array(
     *          'votes'         =>  'INC(1)',
     *      )
     *  );
     *  </code>
     *
     *  @param  string  $table          Table in which to insert/update.
     *
     *  @param  array   $columns        An associative array where the array's keys represent the columns names and the
     *                                  array's values represent the values to be inserted in each respective column.
     *
     *                                  Column names will be enclosed in grave accents " ` " (thus, allowing seamless
     *                                  usage of reserved words as column names) and values will be automatically
     *                                  {@link escape()}d.
     *
     *  @param  array   $update         (Optional) An associative array where the array's keys represent the columns names
     *                                  and the array's values represent the values to update the columns' values to.
     *
     *                                  This array represents the columns/values to be updated if the inserted row would
     *                                  cause a duplicate value in a UNIQUE index or PRIMARY KEY.
     *
     *                                  If an empty array is given, the values in <i>$columns</i> will be used.
     *
     *                                  Column names will be enclosed in grave accents " ` " (thus, allowing seamless
     *                                  usage of reserved words as column names) and values will be automatically
     *                                  {@link escape()}d.
     *
     *                                  A special value may also be used for when a column's value needs to be
     *                                  incremented or decremented. In this case, use <i>INC(value)</i> where <i>value</i>
     *                                  is the value to increase the column's value with. Use <i>INC(-value)</i> to decrease
     *                                  the column's value. See {@link update()} for an example.
     *
     *                                  Default is an empty array.
     *
     *  @return boolean                 Returns TRUE on success of FALSE on error.
     *
     */
	function insert_update($table, $columns, $update = array())
	{

		// if $update is not given as an array, make it an empty array
		if (!is_array($update)) $update = array();

		// enclose the column names in grave accents
		$cols = '`' . implode('`,`', array_keys($columns)) . '`';

		// parameter markers for escaping values later on
		$values = rtrim(str_repeat('?,', count($columns)), ',');

		// if no $update specified
		if (empty($update)) {

			// use the columns specified in $columns
			$update_cols = '`' . implode('` = ?,`', array_keys($columns)) . '` = ?';

			// use the same column for update as for insert
			$update = $columns;

			// if $update is specified
			// generate the SQL from the $update array
		} else $update_cols = $this->_build_sql($update);

		// run the query
		$this->query('

			INSERT INTO
				`' . $table . '`
				(' . $cols . ')
			VALUES
				(' . $values . ')
			ON DUPLICATE KEY UPDATE
				' . $update_cols

		, array_merge(array_values($columns), array_values($update)));

		return $this;
	}

	/**
	*  Shorthand for inserting multiple rows in a single query.
	*
	*  When using this method column names will be enclosed in grave accents " ` " (thus, allowing seamless usage of
	*  reserved words as column names) and values will be automatically {@link escape()}d in order to prevent SQL injections.
	*
	*  <code>
	*  $db->insert_bulk(
	*      'table',
	*      array('column1', 'column2'),
	*      array(
	*          array('value1', 'value2'),
	*          array('value3', 'value4'),
	*          array('value5', 'value6'),
	*          array('value7', 'value8'),
	*          array('value9', 'value10')
	*      )
	*  ));
	*  </code>
	*
	*  @param  string  $table          Table in which to insert.
	*
	*  @param  array   $columns        An array with columns to insert values into.
	*
	*                                  Column names will be enclosed in grave accents " ` " (thus, allowing seamless
	*                                  usage of reserved words as column names).
	*
	*  @param  array  $data           An array of an unlimited number of arrays containing values to be inserted.
	*
	*                                  Values will be automatically {@link escape()}d in order to prevent SQL injections.
	*
	*  @param  boolean $ignore         (Optional) By default, trying to insert a record that would cause a duplicate
	*                                  entry for a primary key would result in an error. If you want these errors to be
	*                                  skipped set this argument to TRUE.
	*
	*                                  For more information see {@link http://dev.mysql.com/doc/refman/5.5/en/insert.html MySQL's INSERT IGNORE syntax}.
	*
	*                                  Default is FALSE.
	*
	*  @return boolean                 Returns TRUE on success of FALSE on error.
     *
	*/
	function insert_bulk($table, $columns, $data, $ignore = false)
	{

		// we can't do array_values(array_pop()) since PHP 5.3+ as will trigger a "strict standards" error
		$values = array_values($data);

		// if $data is not an array of arrays
		if (!is_array(array_pop($values)))

		// save debug information
		$this->_log( array(
		'message'   => 'the data is not an array',
		));

		// if arguments are ok
		else {

			// start preparing the INSERT statement
			$sql = '
				INSERT' . ($ignore ? ' IGNORE' : '') . ' INTO
					`' . $table . '`
					(' . '`' . implode('`,`', $columns) . '`' . ')
				VALUES
			';

			// iterate through the arrays and escape values
			foreach ($data as $values) {
			$sql .= '(' . $this->implode($values) . '),';
			} 
			

			// run the query
			$this->query(rtrim($sql, ','));

			// return true if query was executed successfully
			if ($this->last_result) return true;

		}

		// if script gets this far, return false as something must've been wrong
		return false;

	}

	
	/**
	*  Optimizes all tables that have overhead (unused, lost space)
	*
	*  <code>
	*  // optimize all tables in the database
	*  $db->optimize();
	*  </code>
	*
	*
	*  @return void
     *
	*/
	function optimize()
	{

		// fetch information on all the tables in the database
		$tables = $this->get_table_status();

		// iterate through the database's tables, and if it has overhead (unused, lost space), optimize it
		foreach ($tables as $table) if ($table['Data_free'] > 0) $this->query('OPTIMIZE TABLE `' . $table['Name'] . '`');

	}

	/**
     *  Works similarly to PHP's implode() function with the difference that the "glue" is always the comma, and that
     *  this method {@link escape()}'s arguments.
     *
     *  <i>This was useful for escaping an array's values used in SQL statements with the "IN" keyword, before adding
     *  arrays directly in the replacement array became possible in version 2.8.6</i>
     *
     *  <code>
     *  $array = array(1,2,3,4);
     *
     *  //  this would work as the WHERE clause in the SQL statement would become
     *  //  WHERE column IN ('1','2','3','4')
     *  $db->query('
     *      SELECT
     *          column
     *      FROM
     *          table
     *      WHERE
     *          column IN (' . $db->implode($array) . ')
     *  ');
     *
     *
     *  $db->query('
     *      SELECT
     *          column
     *      FROM
     *          table
     *      WHERE
     *          column IN (?)
     *  ', array($array));
     *  </code>
     *
     *
     *  @param  array   $pieces     An array with items to be "glued" together
     *
     *
     *  @return string              Returns the string representation of all the array elements in the same order,
     *                              escaped and with commas between each element.
     *
     */
    function implode($pieces)
    {
        $result = '';
        // iterate through the array's items and "glue" items together
        foreach ($pieces as $piece) $result .= ($result != '' ? ',' : '') . '\'' . $this->escape($piece) . '\'';
        return $result;
    }

	/**
	*  Checks whether a table exists in the current database.
	*
	*  <code>
	*  // checks whether table "users" exists
	*  table_exists('users');
	*  </code>
	*
	*  @param  string  $table      The name of the table to check if it exists in the database.
	*
	*
	*  @return boolean             Returns TRUE if table given as argument exists in the database or FALSE if not.
	*
	*
	*/
	function table_exists($table)
	{
		// check if table exists in the database
		$this->query('SHOW TABLES LIKE ?', array($table));
		return $this->result->num_rows>0 ? true : false;

	}

	/**
	*  Shorthand for truncating tables.
	*
	*  <i>Truncating a table is quicker then deleting all rows, as stated in the MySQL documentation at
	*  {@link http://dev.mysql.com/doc/refman/4.1/en/truncate-table.html}. Truncating a table also resets the value of
	*  the AUTO INCREMENT column.</i>
	*
	*  <code>
	*  $db->truncate('table');
	*  </code>
	*
	*  @param  string  $table          Table to truncate.
	*
	*  @param  boolean $highlight      (Optional) If set to TRUE the debugging console will be opened automatically
	*                                  and the query will be shown - really useful for quick and easy debugging.
	*
	*                                  Default is FALSE.
	*
	*
	*  @return boolean                 Returns TRUE on success of FALSE on error.
    *
	*/
	function truncate($table)
	{

		// run the query
		$this->query('

			TRUNCATE
				`' . $table . '`'

		);

		// returns TRUE, if query was executed successfully
		if ($this->last_result) return true;

		return false;
	}

	/**
	*  Shorthand for UPDATE queries.
	*
	*  When using this method column names will be enclosed in grave accents " ` " (thus, allowing seamless usage of
	*  reserved words as column names) and values will be automatically {@link escape()}d in order to prevent SQL injections.
	*
	*  After an update check {@link affected_rows} to find out how many rows were affected.
	*
	*  <code>
	*  $db->update(
	*      'table',
	*      array(
	*          'column1'   =>  'value1',
	*          'column2'   =>  'value2',
	*      ),
	*      'criteria = ?',
	*      array($criteria)
	*  );
	*  </code>
	*
	*  @param  string  $table          Table in which to update.
	*
	*  @param  array   $columns        An associative array where the array's keys represent the columns names and the
	*                                  array's values represent the values to be inserted in each respective column.
	*
	*                                  Column names will be enclosed in grave accents " ` " (thus, allowing seamless
	*                                  usage of reserved words as column names) and values will be automatically
	*                                  {@link escape()}d.
	*
	*                                  A special value may also be used for when a column's value needs to be
	*                                  incremented or decremented. In this case, use <i>INC(value)</i> where <i>value</i>
	*                                  is the value to increase the column's value with. Use <i>INC(-value)</i> to decrease
	*                                  the column's value:
	*
	*                                  <code>
	*                                  $db->update(
	*                                      'table',
	*                                      array(
	*                                          'column'    =>  'INC(?)',
	*                                      ),
	*                                      'criteria = ?',
	*                                      array(
	*                                          $value,
	*                                          $criteria
	*                                      )
	*                                  );
	*                                  </code>
	*
	*                                  ...is equivalent to
	*
	*                                  <code>
	*                                  $db->query('UPDATE table SET column = colum + ? WHERE criteria = ?', array($value, $criteria));
	*                                  </code>
	*
	*  @param  string  $where          (Optional) A MySQL WHERE clause (without the WHERE keyword).
	*
	*                                  Default is "" (an empty string).
	*
	*  @param  array   $replacements   (Optional) An array with as many items as the total parameter markers ("?", question
	*                                  marks) in <i>$where</i>. Each item will be automatically {@link escape()}-ed and
	*                                  will replace the corresponding "?". Can also include an array as an item, case in
	*                                  which each value from the array will automatically {@link escape()}-ed and then
	*                                  concatenated with the other elements from the array - useful when using <i>WHERE
	*                                  column IN (?)</i> conditions. See second example {@link query here}.
	*
	*                                  Default is "" (an empty string).
	*
	*
	*  @return boolean                 Returns TRUE on success of FALSE on error
    *
	*/
	function update($table, $columns, $where = '', $replacements = '')
	{

		// if $replacements is specified but it's not an array
		if ($replacements != '' && !is_array($replacements)) {

			// save debug information
			$this->_log(array(
			'query' =>  '',
			'error' => 'replacements not array'
			));

			return false;

		}

		// generate the SQL from the $columns array
		$cols = $this->_build_sql($columns);

		// run the query
		$this->query('

			UPDATE
				`' . $table . '`
			SET
				' . $cols .

		($where != '' ? ' WHERE ' . $where : '')

		, array_merge(array_values($columns), $replacements == '' ? array() : $replacements));

		// returns TRUE if query was executed successfully
		if ($this->last_result) return true;

		return false;

	}

	
	/**
	*  Checks is a value is a valid result set obtained from a query against the database
	*
	*  @access private
    *
	*/
	private function _is_result($value)
	{

		// check whether a value is a valid result set obtained from a query against the database
		return is_object($value) && strtolower(get_class($value)) == 'mysqli_result';

	}

	
    /**
     *  Escapes special characters in a string that's to be used in an SQL statement in order to prevent SQL injections.
     *
     *  <i>This method also encloses given string in single quotes!</i>
     *
     *  <i>Works even if {@link http://www.php.net/manual/en/info.configuration.php#ini.magic-quotes-gpc magic_quotes}
     *  is ON.</i>
     *
     *  <code>
     *  // use the method in a query
     *  // THIS IS NOT THE RECOMMENDED METHOD!
     *  $db->query('
     *      SELECT
     *          *
     *      FROM
     *          users
     *      WHERE
     *          gender = "' . $db->escape($gender) . '"
     *  ');
     *
     *  // the recommended method
     *  // (variable are automatically escaped this way)
     *  $db->query('
     *      SELECT
     *          *
     *      FROM
     *          users
     *      WHERE
     *          gender = ?
     *  ', array($gender));
     *  </code>
     *
     *  @param  string  $string     String to be quoted and escaped.
     *
     *  @return string              Returns the quoted string with special characters escaped in order to prevent SQL
     *                              injections.     .
     *
     */
	public function escape($string)
	{
		if ($this->connected()) {
			// if "magic quotes" are on, strip slashes
			if (get_magic_quotes_gpc()) $string = stripslashes($string);

			// escape and return the string
			return mysqli_real_escape_string($this->connection, $string);
		}
		return false;
	}
	
    /**
     *  Returns an associative array containing all the rows from the resource created by the previous query or from the
     *  resource given as argument and moves the internal pointer to the end.
     *
     *  <code>
     *  // run a query
     *  $db->query('SELECT * FROM table WHERE criteria = ?', array($criteria));
     *
     *  // fetch all the rows as an associative array
     *  $records = $db->fetch_assoc_all();
     *  </code>
     *
     *
     *  @return mixed                   Returns an associative array containing all the rows from the resource created
     *                                  by the previous query or from the resource given as argument and moves the
     *                                  internal pointer to the end. Returns FALSE on error.
     *
     */
	public function fetch_assoc_all() {
		$this->reset_result();
		
		$result=array();
		if ($this->connected() && is_object($this->result)) {
			while($row=$this->result->fetch_assoc()) {
				$result[]=$row;	
			}
		}
		$this->reset_result();
		return $result;
	}
	
	
     /**
	 *  Reset the internal pointer back to zero
	 * 
     *  <code>
	 * $db->query("show tables");
	 *  while($row=$db->fetch_assoc()) {
	 *    var_dump($row);	
	 * }
	 * 
	 * //we reset the result pointer here
	 * 
	 * $db->reset_result();
	 * 
	 * //so that we can loop through the results again
	 * 
	 * while($row=$db->fetch_assoc()) {
	 *   var_dump($row);	
	 * }
	 * 
	 */
	public function reset_result() {
		if ($this->connected() && is_object($this->result)) {
			@mysqli_data_seek($this->result,0);
		}
		return $this;
	}

    /**
     *  Allows you to export entire database or specified tables to file or trigger download via browser
     *
     *  saves entire database to output.sql
     *  <code>
     *  $db->export('*','output.sql');
     *  </code>
     *
     *  saves a single table to output.sql
     *  <code>
     *  $db->export(array('users'),'output.sql');
     *  </code>
     *
     *  saves 2 tables to output.sql
     *  <code>
     *  $db->export(array('users','country'),'output.sql');
     *  </code>
     *
     *  downloads entire database via browser
     *  <code>
     *  $db->export('*');
     *  </code>
     *
     *  downloads a single table via browser
     *  <code>
     *  $db->export(array('users'));
     *  </code>
     *
     *  downloads 2 tables via browser
     *  <code>
     *  $db->export(array('users','country'));
     *  </code>
     *
     *  @param  mixed      $tables      (Optional) An array containing tables for export, or 
     *									A string containing '*' to process all tables in the database (default)
     *
     *
     *  @param  string    $file   		(Optional) The file to backup database to.
     *
     *                                  <i>If not specified, a browser download will be triggered.</i>
     *
     *
     *  @return void 
     *
     */
	function export($tables='*',$file=null) {
		if(!is_array($tables)) {
		$tables=array();
		$this->query("show tables");
		while($row=$this->fetch_array()) {
			$tables[]=$row['0'];
		}
		}

$now=date("m/d/Y h:i:a");		
		//grab each table
$output=<<<end
-- DHTMLSQL Dump
-- http://dhtml.github.io/dhtmlsql
--
-- Host: {$this->host}
-- Generation Time: $now

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `$this->dbname`
--

end;
		
		foreach($tables as $table) {
			$output.=$this->fetch_table($table);
		}

$output.=<<<end

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
end;

	if(is_null($file)) {
		$fn=$this->dbname.".sql";
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers 		
 header("Content-type: application/octet-stream");
 header("Content-Disposition: attachment; filename=\"$fn\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".strlen($output));		
echo $output;
	}	else {
		file_put_contents($file,$output);
	}	
	
	}
	
	
    /**
     *  Generates an export of a table
     *
     *  // saves entire database to output.sql
     *  <code>
     *  $db->fetch_table('users');
     *  </code>
     *
     *
     *  @param  string      $t      name of table to export
     *
     *
     *
     *  @return string		the entire export sql statements for the table
     *
     */
	function fetch_table($t) {
	$output="";

	$result=$this->query("show create table `$t`");
	while($row=$result->fetch_array()) {
$output.=<<<end

--
-- Table structure for table `$t`
--

DROP TABLE IF EXISTS `$t`;

end;
	$output.=$row[1].";\n\n";
	
	
	

  $sth=$this->query("select * from `$t`");
  if($sth->num_rows>0) {
$output.=<<<end

--
-- Export data for table `$t`
--


end;
}

   while($row=$this->fetch_row()){
	  
	$values='';
    foreach($row as $v) $values.=(($values)?',':'')."'".$this->escape($v)."'";
	$output.="INSERT INTO `$t` VALUES ($values);\n";
	}
	
	}
		
	return $output;
	}

	
    /**
     *  Allows you to parse an entire sql file 
     *
     *  // downloads a single table via browser
     *  $db->import("database.sql");
     *  </code>
     *
     *
     *  @param  string    $path   		The file containing the sql query.
     *
     *
     *  @return boolean 				True for success, false for failure 
     *
     */
	function import($path)
	{

		// if an active connection exists
		if ($this->connected() && file_exists($path)) {

			// read file into an array
			$file_content = file($path);

			// if file was successfully opened
			if ($file_content) {

				$query = '';

				// iterates through every line of the file
				foreach ($file_content as $sql_line) {

					// trims whitespace from both beginning and end of line
					$tsql = trim($sql_line);

					// if line content is not empty and is the line does not represent a comment
					if ($tsql != '' && substr($tsql, 0, 2) != '--' && substr($tsql, 0, 1) != '#') {

						// add to query string
						$query .= $sql_line;

						// if line ends with ';'
						if (preg_match('/;\s*$/', $sql_line)) {

							// run the query
							$this->query($query);

							// empties the query string
							$query = '';

						}

					}

				}

				return true;

				// if file could not be opened
			} else

			// save debug info
			$this->_log('errors', array(
			'message'   =>  'file could not be opened',
			));
		}

		// we don't have to report any error as connected() method already did or checking for file returned FALSE
		return false;
	}



    /**
     *  Sets MySQL character set and collation.
     *
     *  The ensure that data is both properly saved and retrieved from the database you should call this method first
     *  thing after connecting to the database.
     *
     *  If this method is not called a warning message will be displayed in the debugging console.
     *
     *  Warnings can be disabled by setting the {@link disable_warnings} property.
     *
     *  @param  string  $charset    (Optional) The character set to be used by the database.
     *
     *                              Default is 'utf8'.
     *
     *                              For a list of possible values see:
     *                              {@link http://dev.mysql.com/doc/refman/5.1/en/charset-charsets.html}
     *
     *  @param  string  $collation  (Optional) The collation to be used by the database.
     *
     *                              Default is 'utf8_general_ci'.
     *
     *                              For a list of possible values see:
     *                              {@link http://dev.mysql.com/doc/refman/5.1/en/charset-charsets.html}
     *
     *
     *  @return void
     *
     */
	function set_charset($charset = 'utf8', $collation = 'utf8_general_ci')
	{
		// set MySQL character set
		$this->query('SET NAMES "' . $this->escape($charset) . '" COLLATE "' . $this->escape($collation) . '"');
		return $this;
	}
	
	/**
	*  Retrieves the current version information of library
	*
	*
	*  @return string
	*/
	public function version() {
		return $this->version;
	}

	/**
	*  Frees the memory associated with the last result.
	*
	*
	*  @access private
	*/
	function __destruct()
	{

		// if the last result is a mysqli result set (it can also be a boolean or not set)
		if (isset($this->last_result) && $this->last_result instanceof mysqli_result)

		// frees the memory associated with the last result
		mysqli_free_result($this->last_result);

	}

	
    /**
     *  Enables processing of database errors
     *
     *  The following code is used internally when database connection does not exist
     *  <code>
     *   if (!$this->connected()) {                
     *			$this->_log(array(
     *			'query' =>  $sql,
     *			'error' =>  'No active database connection'
     *			));
     *		}
     *  </code>
     * A full error error message will be produced internally similar to:
     * Error: select * from users => No active database connection
     *
     * The internally generated error message is passed on to the internal halt function
     *
     *  @param  array    $data   		An associative array with 2 keys: query and error
     *
     *
     *  @return void 
     *
     */
	public function _log($data) {
		if(!is_null($data['query']) && !is_null($data['error'])) {
			$error="Error: ".$data['query'].' => '. $data['error'];
		} else if (!is_null($data['query'])) {
			$error="Error: ".$data['query'];
		} else if (!is_null($data['error'])) {
			$error="Error: ".$data['error'];
		}
		
		$this->halt($error);
	}

    /**
     *  This is a routine meant to handle MySQLi query errors 
     *  If you try to select data from a table that does not exist
     *  An error message explaining the problem will be passed to _log and finally to halt
     *  halt acts in various ways depending on certain conditions
     *  1. If you have any halt function defined in the general scope, that function will be called with a message parameter
     *  2. If the print_error configuration variable is true (default), then the error will be printed on screen
     *	3. If halt_on_error configuration variable is set to true (default) then execution of the script is stopped 
     *	
     *
     *  @param  string    $message   Error message explaining why execution should be stopped
     *
     *
     *  @return void 
     */
	public function halt($message) {
		if(function_exists('halt')) {halt($message);}
		if($this->print_error) {echo("$message\n");}
		if($this->halt_on_error) {exit();}
	}	

    /**
     *  Whenever you call a method that does not exist in this library 
     *  This routine is executed.
     *  
     *  If the method called can be found in mysqli, then it falls back to that
     *  Otherwise, if the method can be found in the last result object, then a fallback to this is executed
     *  Otherwise null is returned
     *  
     *	An example of using prepared statements is shown below:
     *  <code>
     *   $stmt = $db->prepare("INSERT INTO users (first, last) VALUES (?, ?)");
     *   $stmt->bind_param("ss", $first, $last);
     *   // set parameters and execute
     *   $first = "John";
     *   $last = "Doe";
     *   $stmt->execute();
     *  </code>
     * 
     *  prepare and bind_param are standard MySQLi methods but are not defined in this library
     *  but as a result of this fallback technique, such methods and others like fetch_object, fetch_count etc will work 
     *
     *
     *  @return mixed
     */
	public function __call($name, $arguments)
	{
		if($name=='connect') {$result=call_user_func_array(array($this, 'connect'),$arguments);}
		else if(method_exists($this->connection,$name)) {$result=call_user_func_array(array($this->connection, $name),$arguments);}
		else if(method_exists($this->result,$name)) {$result=call_user_func_array(array($this->result, $name),$arguments);}
		else {$result=null;}
		if($name=='query') {$this->result=$result;}
		
		return $result;
	}
	
    /**
     *  Whenever you attempt to retrieve a property that does not exist in this library 
     *  This routine is executed.
     *  
     *  If the property belongs to the result object, it shall be retrieved
     *  otherwise, if it belongs to the connection object, it shall be subsequently retrieved
     *  otherwise null shall be returned
     *  
     *	An example is getting the host information:
     *  <code>
     *   echo $db->host_info;
     *  </code>
     * 
     * As well as retrieving values like insert_id, affected_rows
     *  <code>
     *   echo $db->insert_id;
     *  </code>
     *  <code>
     *   echo $db->affected_rows;
     *  </code>
     * 
     *
     *  @return mixed
     */
	public function __get($name) {
		if(isset($this->result->$name)) {return $this->result->$name;}
		else if(isset($this->connection->$name)) {return $this->connection->$name;}
		else return null;
	}

}
?>
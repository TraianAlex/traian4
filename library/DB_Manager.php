<?php
 
class DB_Manager extends PDO {
	/**
	 * Chave primária
	 * @var string
	 */
	public $primaryKey = 'id';
	/**
	 * Tabela da base de dados.
	 * @var void
	 */
	public $table;
	/**
	 * Query.
	 * @var void
	 */
	private $_query;
	/**
	 * SELECT.
	 * @var void
	 */
	private $_select;
	/**
	 * Alias - usado para renomear uma tabela.
	 * @var void
	 */
	private $_alias;
	/**
	 * Relação entre tabelas.
	 * @var void
	 */
	private $_join;
	/**
	 * UPDATE.
	 * @var void
	 */
	private $_update;
	/**
	 * Colunas que receberam valores para
	 * posteriomente serem atualizados/inseridas.
	 * @var void
	 */
	private $_data_set;
	/**
	 * DELETE.
	 * @var void
	 */
	private $_delete;
	/**
	 * INSERT.
	 * @var array
	 */
	private $_insert = array();
	/**
	 * Códigos de vinculação dos
	 * dados inseridos.
	 * @var array
	 */
	private $_insert_binds = array();
	/**
	 * Condições.
	 * @var void
	 */
	private $_where;
	/**
	 * Dados armazenados.
	 * @var array
	 */
	private $_data = array();
	/**
	 * Grupo de resultados.
	 * @var void
	 */
	private $_group_by;
	/**
	 * Ordem dos resultados.
	 * @var void
	 */
	private $_order_by;
	/**
	 * Ponto de partida dos dados.
	 * @var integer
	 */
	private $_offset = 0;
	/**
	 * Limite dos dados.
	 * @var integer
	 */
	private $_limit = 100;
	/**
	 * Resultado da query.
	 * @var array
	 */
	private $_result = array();
	/**
	 * Total de resultados retornados.
	 * @var integer
	 */
	private $_count = 0;
	/**
	 * Instância.
	 * @var void
	 */
	public static $instance;
        /**
         * @var type array
         */
        protected $data = array();
	/**
	 * Método construtor da classe.
	 * @return void
	 */
    public function __construct($data) {
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $this->data)){
                $this->data[$key] = htmlentities($value);
            }
        }
    }
    
    private function __clone(){}

    public function __call($name, $field){
        
        $first = isset($field[0]) ? $field[0] : null;

        switch ($name){

            case "setValue":
                $this->data = $first;
                return $this;

            case "getValue":
                if (array_key_exists($field[0], $this->data)) {
                    return $this->data[$field[0]];
                } else {
                    die("Field not found");
                }

            case "getValueEncoded":
                if (array_key_exists($field[0], $this->data)) {
                    return htmlspecialchars($this->data[$field[0]]);
                }
        }
    }
    /**
     * Singleton da classe.
     * 
     * @return object Objeto da clase atual.
     */
    public static function get_instance($data) {
        
        $class = __CLASS__;
        if ( ! self::$instance )
                self::$instance = new $class($data);
        return self::$instance;
    }
    /**
     * Instância da base de dados
     * 
     * @return object Instância da classe.
     */
    public function database() {
        try{
            $config = Config_ini::getConfig("db");
            $pdo_errconf = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];//PDO::ERRMODE_WARNING
            parent::__construct($config['dsn'], $config['username'], $config['password'], $pdo_errconf);
            return $this;
        }catch(Exception $e){
            Errors::handle_error2(null, $e->getMessage());
        }
    }
    /**
     * Contrução de colunas para consultas.
     * 
     * @param  string|array $columns Nome das colunas, pode ser string ou array.
     * @return object                Instância da classe.
     */
    public function select($columns = '*') {
        
        if ( is_null($this->table) )
                return false;

        $this->_alias = explode(' ', $this->table);

        $this->_count = 0;

        if (count($this->_alias) > 1 )
                $this->_alias = $this->_alias[1];
        else
                $this->_alias = $this->_alias[0];

        if ( is_array($columns) )
                $columns = implode(',', $columns);

        $this->_select = "{$columns}";

        return $this;
    }
    /**
     * Atualiza os daddos na base de dados.
     * 
     * @param  string|array $columns Valores a serem atualizados.
     * @return object 				 Instância da classe.
     */
    public function set($columns = null) {
        
        if ( is_null($this->table) )
                return false;

        if ( ! is_array($columns) )
                return false;

        if ( is_null($this->_data_set) )
                if ( $this->_where )
                        return false;

        $update_values = array();

        foreach ( $columns as $key => $value ) {
                array_push($update_values, "{$key} = ?");
                array_push($this->_data, $value);
        }

        var_dump($this->_data);

        $this->_update = TRUE;

        $update_values  = implode(',', $update_values);
        $this->_data_set = "{$update_values}";

        return $this;
    }
    /**
     * Valores que serão definidos para inserção
     * na base de dados.
     * 
     * @param  array $columns  Colunas com seus respetivos valores.
     * @return object          Instância da classe.
     */
    public function values($columns) {

        if ( ! is_array($columns) )
                return false;

        foreach ( $columns as $key => $value ) {
                array_push($this->_insert, $key);
                array_push($this->_data, $value);
                array_push($this->_insert_binds, '?');
        }

        $this->_insert       = implode(',', $this->_insert);
        $this->_insert_binds = implode(',', $this->_insert_binds);

        return $this;
    }
    /**
     * Cria um novo registro na base de dados.
     * 
     * @return object Ordem de execução.
     */
    public function insert() {
        
        if ( is_null($this->table) )
                return false;

        if ( is_null($this->_insert) && is_null($this->_insert_binds))
                return false;

        return $this->_execute($this->query_builder(), $this->_data);

    }
    /**
     * Atualiza um registro na base de dados.
     * 
     * @return object Ordem de execução.
     */
    public function update() {
        
        if ( is_null($this->table) )
                return false;

        if ( is_null($this->_where) )
                        return false;

        return $this->_execute($this->query_builder(), $this->_data);
    }
    /**
     * Remove um registro na base de dados.
     * 
     * @param  string|array $set_select Valores a serem atualizados.
     * @return object Ordem de execução.
     */
    public function delete() {
        
        if ( is_null($this->table) )
                return false;

        if ( is_null($this->_where) )
                        return false;

        $this->_delete = TRUE;

        return $this->_execute($this->query_builder(), $this->_data);
    }
    /**
     * Cria uma relação entre uma ou mais tabelas.
     *
     * @param  string $table   Tabela que irá ser relacionada.
     * @param  string $columns Coluna a ser comparada.
     * @param  string $side    Lado da relação.
     * @return object          Instância da classe.
     */
    public function join($table = '', $columns = null, $side = 'INNER') {
        
        if ( is_null($this->table) )
                return false;

        $sql_code = "          " .
        "	{$side}            " .
        "JOIN                  " .
        "	{$table}           " .
        "ON {$columns}         " ;

        if ( $this->_join )
                $this->_join .= $sql_code;
        else
                $this->_join = $sql_code;

        return $this;
    }
    /**
     * Condições da Query SQL.
     * 
     * @param  string     $column Colunas
     * @param  string|int $value  Valor da condicional
     * @return object     		  Instância da classe
     */
    public function where($column = null, $value = null) {
        
        if ( is_null($column) && is_null($value) )
                return false;

        $column = explode(' ', $column);
        $count  = count($column);

        if ( $count == 1 )
                $content = '= ?';

        if ( $count == 2 )
                $content = "{$column[1]} ?";

        if ( $count >= 3 )
                $content = trim(strstr(implode( ' ' , $column) , ' ' ));

        $column = $column[0];

        array_push($this->_data, $value);

        if ( !is_null($this->_where) )
                $this->_where .= " AND {$column} {$content}";

        if ( is_null($this->_where) )
                $this->_where = "WHERE {$column} {$content}";

        return $this;
    }
    /**
     * Condição where para lista.
     * 
     * @param  string     $column  Coluna
     * @param  string|int $values  Valor da condicional
     * @return object     		   Instância da classe
     */
    public function where_in($column = null, $values = null) {
        
        if ( is_null($column) && is_null($values) )
                return false;

        array_push($this->_data, $values);

        if ( !is_null($this->_where) )
                $this->_where .= " AND {$column} IN (?)";

        if ( is_null($this->_where) )
                $this->_where = "WHERE {$column} IN (?)";

        return $this;
    }
    /**
     * Separa por grupos.
     * 
     * @param  string $columns Colunas
     * @return object          Instância da classe
     */
    public function group_by($columns = '') {
        
            if ( is_array($columns) )
                    $columns = implode(',', $columns);

            $this->_group_by = "GROUP BY {$columns}";
            return $this;
    }
    /**
     * Condição where entre intervalos.
     * 
     * @param  string $column Coluna.
     * @param  string $left   Valor esquerdo.
     * @param  string $right  Valor direito.
     * @return object         Instância da classe
     */
    public function where_between($column = null, $left = null, $right = null) {
        
        if ( is_null($column) && is_null($left) && is_null($right) )
                return false;

        array_push($this->_data, $left);
        array_push($this->_data, $right);

        if ( !is_null($this->_where) )
                $this->_where .= " AND ( {$column} BETWEEN ? AND ? )";

        if ( is_null($this->_where) )
                $this->_where = "WHERE ( {$column} BETWEEN ? AND ? )";

        return $this;
    }
    /**
     * Retorna um tipo de ordem, DES ou ASC.
     * 
     * @param  string $columns Colunas
     * @param  string $sort    Tipo de ordem
     * @return object          Instância da classe
     */
    public function order_by($columns = '', $sort = 'ASC') {
        
            if ( is_array($columns) )
                    $columns = implode(',', $columns);

            $this->_order_by = "ORDER BY {$columns} {$sort}";
            return $this;
    }
    /**
     * Retorna todos os valores de uma consulta.
     * 
     * @param  int   $limit  Limite de dados retornados
     * @param  int   $offset Deslocamento das consultas.
     * @return array         Retorno dos dados solicitados.
     */
    public function getAll($limit = null, $offset = null) {
        
            if ( !is_null($limit) )
                    $this->_limit  = $limit;

            if ( !is_null($offset) )
                    $this->_offset = $offset;

            return $this->_execute($this->query_builder(), $this->_data);
    }
    /**
     * Retorna apenas uma consulta.
     * 
     * @return array   Retorno dos dados solicitados.
     */
    public function get() {
            return $this->_execute($this->query_builder(), $this->_data, 'assoc');
    }
    
    public function get_obj() {
            return $this->_execute($this->query_builder(), $this->_data, 'obj');
    }
    /**
     * Faz a execução de uma query passada
     * como parâmetro de entrada.
     * 
     * @param  string $query  Query SQL.
     * @param  array  $values Valores da query.
     * @param  string $fetch  Tipo de retorno de dados.
     * @return mixed          Resultado da consulta.
     */
    private function _execute($query = null, $values = array(), $fetch = 'All') {
        
        if ( is_null($query) )
                return false;

        $result = array();
        $sth    = $this->prepare($query);

        if ( $sth->execute(array_values(array_filter($values, 'strlen'))) ){
            if ( $this->_insert || $this->_update || $this->_delete ){
                $this->clear();
                return TRUE;
            }

            if ( $fetch == 'All' ){
                $result = $sth->fetchAll();
            }else if( $fetch == 'assoc' ){
                $result = $sth->fetch(PDO::FETCH_ASSOC);
            }else if( $fetch == 'obj' ){
                $result = $sth->fetchAll(PDO::FETCH_OBJ);
            }
        }

        if ( $result )
                array_map(array($this, 'map_count'), $result);

        $this->clear();

        return $result;
    }
    /**
     * Método CALL - Especialmente para stored precedure.
     * 
     * @param  string $name Nome da rotina.
     * @return void
     */
    public function call($name = '') {}
    /**
     * Callback que conta os resultados
     * retornados da consulta.
     * 
     * @param  array $rows Resultado da consulta.
     * @return int         Número de resultados.
     */
    private function map_count($rows) {
        $this->_count += 1;
    }
    /**
     * Retorna a quantidade resultados de uma consulta.
     * 
     * @return int Total dee resultados retornados.
     */
    public function get_result_count() {
        return $this->_count;
    }
    /**
     * Depuração
     * 
     * @param  mixed $vars Conteúdo a ser depurado.
     * @return void
     */
    private function debug_query($vars = null) {
        
        if ( is_null($vars) )
                return false;

        echo '<!-- SQL - DEBUG -->';
        echo '<pre>';
                var_export($vars);
        echo '</pre>';
        echo '<!-- SQL - DEBUG -->';
    }
    /**
     * Depuração SQL.
     * 
     * @return void
     */
    public function check_query() {
        return $this->debug_query($this->query_builder());
    }
    /**
     * Contrução de uma estrutura SQL.
     * 
     * @return string
     */
    private function query_builder() {

        if ( is_null($this->table) )
                return $this;

        $sql = NULL;

        if ( $this->_select ){
            $sql = "SELECT                               " .
                       "    {$this->_select}                 " .
                       "FROM                                 " .
                       "    {$this->table}                   " .
                       "    {$this->_join}                   " .
                       "    {$this->_where}                  " .
                       "    {$this->_group_by}               " .
                       "    {$this->_order_by}               " .
                       "LIMIT                                " .
                       "    {$this->_offset},{$this->_limit} " ;
        }

        if ( $this->_insert ){
            $sql = "INSERT INTO                          " .
                       "	{$this->table}                   " .
                       "    ({$this->_insert})               " .
                       "VALUES                               " .
                       "    ({$this->_insert_binds})         " ;
        }

        if ( $this->_update ){
            $sql = "UPDATE                               " .
                       "    {$this->table}                   " .
                       "SET                                  " .
                       "    {$this->_data_set}               " .
                       "    {$this->_where}                  " ;
        }

        if ( $this->_delete ){
            $sql = "DELETE FROM                          " .
                       "    {$this->table}                   " .
                       "    {$this->_where}                  " ;
        }

        if ( $sql )
                return preg_replace("!\s+!", " ", trim($sql));
    }
    /**
     * Limpa as variáveis para que futuras novas queries
     * sejam usadas.
     * 
     * @return void
     */
    private function clear() {
        
        $clear_null = [
                '_query',    '_select', '_alias', '_join',     '_update',
                '_data_set', '_delete', '_where', '_group_by', '_order_by'];

        $clear_array = [
                '_data', '_insert', '_result', '_insert_binds'];

        foreach ( $clear_null as $v )
                $this->{$v} = NULL;

        foreach ( $clear_array as $v )
                $this->{$v} = array();
    }
    
     public function __destruct() {
        self::$instance = null;
    }
}
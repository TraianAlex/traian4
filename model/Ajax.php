<?php

class Ajax extends DB_Manager{
    
    protected $data = [
        "text" => "",
        "name" => "",
       "email" => "",
     "message" => "",
    "feedback" => ""
        ];
    public function post_data_ajax() {
        self::$instance = DB_Manager::get_instance($_POST)->database();
        self::$instance->table = 'test';
        $result = self::$instance->values(array('name' => $this->data['text'],
                                        'feedback' => $this->data['feedback']))->insert();
        if($result) return true;
        $result->closeCursor();
        return false;
    }
    
    public function post_data_form() {
        self::$instance = DB_Manager::get_instance($_POST)->database();
        self::$instance->table = 'test';
        $result = self::$instance->values(array('name' => $this->data['name'],
                                          'email' => $this->data['email'],
                                        'feedback' => $this->data['message']))->insert();
        if($result) return true;
        $result->closeCursor();
        return false;
    }
/*
 * check if a name is taken in Validate
 */
    public static function get_name($p) {

        self::$instance = DB_Manager::get_instance($_POST)->database();
        self::$instance->table = 'test';
        $res = self::$instance->select('*')->where('name', $p)->get();
        return $res ? $res : false;
    }
/*
 * predition word or autosuggest
 */   
    public function extract($search_text) {
    
        if(!empty($search_text)){

            $objDb = new PDO('mysql:host=localhost;dbname=remb4372_traian', 'remb4372_victor', 'naiart92');
            $objDb->exec('SET CHARACTER SET utf8');

            $sql = "SELECT * FROM `dictionary` WHERE `word` LIKE ?";
            $statement = $objDb->prepare($sql);
            $statement->execute(array($search_text.'%'));
            $search = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $search;
        }
    }
/*
 * added c.user_id in select to detect the user_id length name for users who logged with google or fb.
 */
    public function fetchMessages() {
        
        self::$instance = DB_Manager::get_instance($_POST)->database();
        self::$instance->table = 'chat c';
        $res = self::$instance->select('c.user_id, c.message, users.id_user, users.username')->join('users', 'c.user_id = users.id_user', 'LEFT')->order_by('c.timestamp', 'DESC')->getAll();
        return $res ?: false;
    }
    
    public function throwMessage($arrData) {
        
        self::$instance = DB_Manager::get_instance($_POST)->database();
        self::$instance->table = 'chat';
        self::$instance->values(array('user_id' => $arrData['user'],
                                 'message' => $arrData['message'],
                               'timestamp' => time()))->insert();
    }
}
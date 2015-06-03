<?php

class PHP extends DB_Manager{
    
    public function extract_dic($word) {
        
        $objDb = new PDO('mysql:host=localhost;dbname=remb4372_traian', 'remb4372_victor', 'naiart92');
        $objDb->exec('SET CHARACTER SET utf8');

        $sql = "SELECT * FROM dictionary WHERE SUBSTRING(word, 1, 1) = ?";
        $statement = $objDb->prepare($sql);
        $statement->execute(array(substr($word, 0, 1)));
        $search = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $search ?: false;
    }
    
    public function word_exist($word) {
        
        self::$instance = DB_Manager::get_instance($_POST)->database();
        self::$instance->table = 'dictionary';
        $count = self::$instance->select('word')->where('word', $word)->getAll();
        return $count ?: false;
//        $objDb = new PDO('mysql:host=localhost;dbname=remb4372_traian', 'remb4372_victor', 'naiart92');
//        $objDb->exec('SET CHARACTER SET utf8');
//
//        $sql = "SELECT word FROM dictionary WHERE word = :w ";
//        $statement = $objDb->prepare($sql);
//        $statement->execute(array(':w' => $word));
//        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
//        if($result){
//           return $result;
//        }
//        return false;
    }
}
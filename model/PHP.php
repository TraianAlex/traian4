<?php

class PHP extends DB_Manager
{
    public function extract_dic($word)
    {
        //$objDb->exec('SET CHARACTER SET utf8');
        self::$instance = DB_Manager::get_instance($_POST)->database();
        $sql = "SELECT * FROM dictionary WHERE SUBSTRING(word, 1, 1) = ?";
        $statement = self::$instance->prepare($sql);
        $statement->execute(array(substr($word, 0, 1)));
        $search = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $search ?: false;
    }

    public function word_exist($word)
    {
        self::$instance = DB_Manager::get_instance($_POST)->database();
        self::$instance->table = 'dictionary';
        $count = self::$instance->select('word')->where('word', $word)->get();
        return $count ?: false;
    }
}

<?php
class DAO{
    public function __construct(){
        $this->db = new PDO(
            'mysql:host=localhost;
            dbname=cinema;
            charset=utf8',
            'root',
            ''
        );
    }

    public function getBdd(){
        return $this->db;
    }
    
    public function executeRequest($sql, $params = NULL){
        if ($params == NULL){
            $result = $this->db->query($sql);
        }else{
            $result = $this->db->prepare($sql);
            $result->execute($params);
        }
        return $result;
    }
}
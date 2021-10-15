<?php
    namespace Src\Gateway;

    class AnimeGateway{

        private $db = null;

        public function __construct($db){

            $this->db = $db;
        }

        function findAll(){
            
            $statement = "
            SELECT 
                ID, name, original, cover, description, tags
            FROM
                Anime;
            ";

            try {
                $statement = $this->db->query($statement);
                $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
                return $result;
            } catch (\PDOException $e) {
                exit($e->getMessage());
            }
        }

        function find($id){
            $statement = "
            SELECT 
                ID, name, original, cover, description, tags
            FROM
                Anime
            WHERE
                ID = ?
            ";

            try {
                $statement = $this->db->prepare($statement);
                $statement->execute(array($id));
                $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
                return $result;
            } catch (\PDOException $e) {                
                exit($e->getMessage());
            }
        }
    }
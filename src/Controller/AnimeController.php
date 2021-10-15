<?php
    namespace Src\Controller;
    use Src\Gateway\AnimeGateway;

    class AnimeController{

        private $db = null;
        private $gateway = null;

        public function __construct($db){

            $this->db = $db;
            $this->gateway = new AnimeGateway($this->db);

        }

        public function findAll(){
            $response = $this->gateway->findAll();
            echo json_encode($response);
            die;
        }

        public function find($id){
            $response = $this->gateway->find($id);
            echo json_encode($response);
            die;
        }

    }
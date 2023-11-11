<?php
class Connection{
    
    private $db ;
    private $host = "129.146.130.43";
    private $user="ccs_630_final_project_user";
    private $password = "O_RJho5AWfQjU[p4" ;
    private $database =  "ccs_630_final_project";

    public function connect(){
        $this->db = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
        return $this->db;
    }
}

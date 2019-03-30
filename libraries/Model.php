<?php
    require_once "Database.php";
    
    class Model extends Database{
        public function all(){
            $sql = "SELECT * FROM " . $this->table;

            $query = $this->conn->query($sql);

            $rows = $query->fetchAll();
            return $rows;
        }

        public function where($column, $value){
            $sql = "SELECT * FROM " . $this->table . " WHERE $column = '$value'";
            
            $query = $this->conn->query($sql);

            if($query->rowCount() == 1){
                $rows = $query->fetch(PDO::FETCH_ASSOC);
            }
            else{
                $rows = [];
            }

            return $rows;
        }

        public function delete($column, $value){
            $sql = "DELETE FROM " . $this->table . " WHERE $column = '$value'";
            
            $query = $this->conn->query($sql);

            if($query){
                return true;
            }
            else{
                return false;
            }
        }

        public function insert($data){
            $sql = "INSERT INTO " . $this->table . " (";

            $index = 1;
            foreach($data as $key => $val){
                $sql .= $key;

                if(count($data) > $index){
                    $sql .= ", ";   
                    $index++;
                }
                else{
                    $sql .= ") VALUES (";
                }
            }

            $index = 1;
            foreach($data as $key => $val){
                $sql .= "'$val'";

                if(count($data) > $index){
                    $sql .= ", ";   
                    $index++;
                }
                else{
                    $sql .= ")";
                }
            }

            $query = $this->conn->query($sql);

            if($query){
                return true;
            }
            else{
                return false;
            }
        }

        public function update($data, $column, $value){
            $sql = "UPDATE " . $this->table . " SET ";

            $index = 1;
            foreach($data as $key => $val){
                $sql .= "$key = '$val'";

                if(count($data) > $index){
                    $sql .= ", ";   
                    $index++;
                }
            }

            $sql .= " WHERE $column = '$value'";

            $query = $this->conn->query($sql);

            if($query){
                return true;
            }
            else{
                return false;
            }
        }
        
    }

    // $model = new Model();
    // var_dump($model->all());

    // $model = new Model();
    // var_dump($model->all());
?>
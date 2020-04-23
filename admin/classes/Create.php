<?php

class Create{

    public function insert_data($table_name, $data ) {
        $key = array_keys($data);  //get key( column name)
        $value = array_values($data);  //get values (values to be inserted)
        $query ="INSERT INTO $table_name ( ". implode(',' , $key) .") VALUES('". implode("','" , $value) ."')";

        return $query;
    }

    
}

?>
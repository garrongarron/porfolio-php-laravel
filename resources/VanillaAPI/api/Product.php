<?php

class Product extends Model implements ModelInterface
{
    private $table = 'product';

    public function __construct($db)
    {
        $this->db = $db;
        $db->query("CREATE TABLE IF NOT EXISTS $this->table (
            id INT AUTO_INCREMENT PRIMARY KEY,
            description TINYTEXT NOT NULL,
            price INTEGER NOT NULL,
            create_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        )");
    }

    public function get($id = null)
    {
        $query = "Select * from $this->table";
        if ($id) {
            $query = "Select * from $this->table 
            where id = '$id';";
        }
        $resutl = $this->db->query($query);
        if ($resutl->num_rows === 0) {
            http_response_code(404);
            return $this->toJson();
        }
        http_response_code(302);
        return $this->toJson($resutl);
    }

    public function del($id)
    {
        if ($id) {
            $query = "delete from $this->table where id = '$id'";
            http_response_code(204);
            return $this->toJson($this->db->query($query));
        }
        return $this->toJson();
    }

    public function scape($data)
    {
        return mysqli_real_escape_string($this->db, (string)$data);
    }
    public function patch($id, $data)
    {
        $description = $this->scape($data->description);
        $price = $this->scape($data->price);
        if ($id) {
            $query = "update $this->table 
                set 
                price = '$price',
                description = '$description'
                where id = '$id'";
            $this->db->query($query);
            http_response_code(204);
            return $this->toJson($this->db->query($query));
        }
        http_response_code(400);
        return $this->toJson();
    }

    public function post($data)
    {
        $description = $this->scape($data->description);
        $price = $this->scape($data->price);
        if ($data) {
            $query = "insert into $this->table 
            (price, description)
            values (
                '$price',
                '$description'
            )";
            http_response_code(201);
            return $this->toJson($this->db->query($query));
        }
        return $this->toJson();
    }
}

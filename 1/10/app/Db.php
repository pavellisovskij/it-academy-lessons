<?php

namespace app;

class Db
{
    protected $db;
    private $config;
//    protected $db_name;

    public function __construct()
    {
        $this->config = require 'config/db.php';
        $this->db = new \mysqli(
            $this->config['host'],
            $this->config['user'],
            $this->config['password']
        );

        if ($this->db->connect_errno) {
            throw new \Exception($this->db->connect_error);
        }

        if (!$this->is_database()) {
            $this->create_database();
            $this->db->select_db($this->config['db_name']);
            $this->create_tables();
            $this->fill_tables(10);
        }
        else {
            $this->db->select_db($this->config['db_name']);
        }
    }

    public function data_for_page($page, $limit) {
        try {
            if ($page == 1) $start = 0;
            else $start = ($page - 1) * $limit;

            $sql = "
                SELECT id, user, message_text, message_time 
                FROM messages
                ORDER BY id DESC
                LIMIT $start, $limit;
            ";
            $result = $this->db->query($sql);

            if ($result === false) {
                throw new \Exception($this->db->error);
            }

            $data = $result->fetch_all(MYSQLI_ASSOC);
            $result_data = [];

            for ($i = 0; $i < count($data); $i++) {
                $id = $data[$i]['id'];
                $sql = "
                    SELECT image 
                    FROM images
                    WHERE message_id = $id 
                ";
                $result = $this->db->query($sql);
                $images = $result->fetch_all(MYSQLI_ASSOC);
                $images = array_transform($images);
                $result_data[$i] = $data[$i];
                $result_data[$i]['images'] = $images;
            }

            $result->free();

            return $result_data;
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function count() {
        try {
            $sql = "SELECT COUNT(*) FROM messages";
            $result = $this->db->query($sql);

            if ($result === false) {
                throw new \Exception($this->db->error);
            }

            $data = $result->fetch_row();
            $result->free();

            return $data[0];
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    private function fill_tables($number) {
        for ($i = 0; $i < $number; $i++) {
            $message_id = $this->add_message();
            $this->add_image($message_id);
        }
    }

    public function add_message($user = 'test_user', $message = 'test message') {
        try {
            $sql = "INSERT INTO messages (user, message_text) VALUES ('$user', '$message')";

            $result = $this->db->query($sql);

            if ($result === false) {
                throw new \Exception($this->db->error);
            }

            return $this->db->insert_id;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function set_new_image_name(int $image_id, string $name) {
        try {
            $sql = "UPDATE images SET image = '$name' WHERE id = $image_id";

            $result = $this->db->query($sql);

            if ($result === false) {
                throw new \Exception($this->db->error);
            }

            return $result;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function add_image(int $message_id, string $image = "standart.jpg") {
        try {
            $sql = "INSERT INTO images (image, message_id) VALUES ('$image', $message_id)";

            $result = $this->db->query($sql);

            if ($result === false) {
                throw new \Exception($this->db->error);
            }

            return $this->db->insert_id;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    private function create_tables() {
        try {
            $sql = "
                CREATE TABLE messages (
                    id int(11) NOT NULL AUTO_INCREMENT,
                    user varchar(25) NOT NULL,
                    message_text text NOT NULL,
                    message_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
                    ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (id)
                )
                ENGINE = InnoDB,
                CHARACTER SET utf8,
                COLLATE utf8_general_ci
            ";
            $result = $this->db->query($sql);

            if ($result === false) {
                throw new \Exception($this->db->error);
            }
            else {
                $sql = "
                CREATE TABLE images (
                    id int(11) NOT NULL AUTO_INCREMENT,
                    image varchar(255) NOT NULL,
                    message_id int(11) NOT NULL,
                    PRIMARY KEY (id)
                )
                ENGINE = InnoDB,
                CHARACTER SET utf8,
                COLLATE utf8_general_ci
            ";
                $result = $this->db->query($sql);

                if ($result === false) {
                    throw new \Exception($this->db->error);
                }
            }

            return $result;
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    private function create_database() {
        try {
            $table_name = $this->config['db_name'];
            $sql = "
                CREATE DATABASE $table_name
                CHARACTER SET utf8
                COLLATE utf8_general_ci
            ";

            $result = $this->db->query($sql);
            if ($result === false) {
                throw new \Exception($this->db->error);
            }

            return $result;
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    private function is_database() {
        try {
            $sql = "SHOW DATABASES";
            $result = $this->db->query($sql);
            if ($result === false) {
                throw new \Exception($this->db->error);
            }
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();

            foreach ($data as $database) {
                $databases[] = $database['Database'];
            }

            return in_array($this->config['db_name'], $databases);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }
}
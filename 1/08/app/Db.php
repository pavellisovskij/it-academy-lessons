<?php

namespace app;

class Db
{
    protected $db;
    protected $db_name;

    public function __construct()
    {
        $db_config = require 'config/db.php';
        $this->db_name = $db_config['db_name'];
        $this->db = new \mysqli(
            $db_config['host'],
            $db_config['user'],
            $db_config['password'],
            $db_config['db_name'],
            $db_config['port']
        );
    }

    public function data_for_page($table_name, $page, $limit) {
        try {
            if ($page == 1) $start = 0;
            else $start = ($page - 1) * $limit;

            $sql = "
                SELECT id, user, message_text, message_time 
                FROM $table_name 
                ORDER BY id DESC
                LIMIT $start, $limit;
            ";
            $result = $this->db->query($sql);

            if ($result == false) {
                throw new \Exception($this->db->error);
            }

            $data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();

            return $data;
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function count($table_name) {
        try {
            $sql = "SELECT COUNT(*) FROM $table_name";
            $result = $this->db->query($sql);

            if ($result == false) {
                throw new \Exception($this->db->error);
            }

            $data = $result->fetch_row();
            $result->free();

            return $data[0];
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function fill_table($table_name, $number) {
        try {
            $sql = "
                INSERT INTO $table_name
                (user, message_text, message_time)
                VALUES ('user0', 'Lorem ipsum 0', " . time() . ")
            ";

            for ($i = 1; $i < $number; $i++) {
                $user = "'" . "user$i" . "'";
                $message = "'" . "Lorem ipsum $i" . "'";
                $timestamp = time();
                $sql .= ", ($user, $message, $timestamp)";
            }
            $sql .= ";";

            $result = $this->db->query($sql);
            if ($result == false) {
                throw new \Exception($this->db->error);
            }

            return $result;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function create_table($table_name) {
        try {
            $sql = "
                CREATE TABLE $table_name (
                    id int(11) NOT NULL AUTO_INCREMENT,
                    user varchar(25) NOT NULL,
                    message_text text NOT NULL,
                    message_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
                    ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (id)
                )
                ENGINE = InnoDB,
                CHARACTER SET utf8,
                COLLATE utf8_general_ci;
            ";
            $result = $this->db->query($sql);

            if ($result == false) {
                throw new \Exception($this->db->error);
            }

            return $result;
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function is_table($table_name) {
        try {
            $sql = "SHOW TABLES";
            $result = $this->db->query($sql);

            $array = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();

            if (empty($array)) {
                return false;
            }
            else {
                foreach ($array as $item) {
                    $tables[] = $item['Tables_in_guestbook'];
                }
                return in_array($table_name, $tables);
            }
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function create_database() {
        try {
            $connection = self::if_no_db_connection();
            $db = $connection['db'];

            if ($db->connect_errno) {
                throw new \Exception($db->connect_error);
            }

            $db_name = $connection['db_name'];
            $sql = "
                CREATE DATABASE $db_name
                CHARACTER SET utf8
                COLLATE utf8_general_ci
            ";

            $result = $db->query($sql);
            if ($result == false) {
                throw new \Exception($db->error);
            }

            return $result;
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    private static function if_no_db_connection() {
        $db_config = require 'config/db.php';
        $db = new \mysqli(
            $db_config['host'],
            $db_config['user'],
            $db_config['password']
        );
        return [
            'db' => $db,
            'db_name' => $db_config['db_name']
        ];
    }

    public static function is_database() {
        try {
            $connection = self::if_no_db_connection();
            $db = $connection['db'];

            if ($db->connect_errno) {
                throw new \Exception($db->connect_error);
            }

            $sql = "SHOW DATABASES";
            $result = $db->query($sql);
            if ($result == false) {
                throw new \Exception($db->error);
            }
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();

            foreach ($data as $database) {
                $databases[] = $database['Database'];
            }

            return in_array($connection['db_name'], $databases);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }
}
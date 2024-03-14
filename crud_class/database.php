<?php

class Database
{
    private $db_host = 'localhost';
    private $db_username = 'root';
    private $db_password = '';
    private $db_name = 'oop_php';

    private $mysqli = '';
    private $result = array();
    private $conn = false;

    public function __construct()
    {
        if (!$this->conn) {
            $this->mysqli = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);
            $this->conn = true;
            if ($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
            // else {
            //     echo "we are connected";
            // }
        } else {
            return true;
        }
    }

    public function insert($table, $param = array())
    {
        if ($this->tableExists($table)) {
            $table_columns = implode(', ', array_keys($param));
            $table_value = implode("', '", $param);

            $sql = "INSERT INTO $table ($table_columns) VALUES ('$table_value')";

            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->insert_id);
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public function update($table, $params = array(), $where = null)
    {
        if ($this->tableExists($table)) {
            $args = array();
            foreach ($params as $key => $value) {
                $args[] = "$key = '$value'";
            }
            $sql = "UPDATE $table SET " . implode(', ', $args);
            if ($where != null) {
                $sql .= " WHERE $where";
            }

            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public function delete($table, $where = null)
    {
        if ($this->tableExists($table)) {
            $sql = "DELETE FROM $table";
            if ($where != null) {
                $sql .= " WHERE $where";
            }
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public function select()
    {
    }

    private function tableExists($table)
    {
        $sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
        $tableInDb = $this->mysqli->query($sql);
        if ($tableInDb && $tableInDb->num_rows == 1) {
            return true;
        } else {
            array_push($this->result, $table . "does not exist in this database");
            return false;
        }
    }

    public function getResult()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    public function __destruct()
    {
        if ($this->conn) {
            if ($this->mysqli->close()) {
                $this->conn = false;
                return true;
            }
        } else {
            return false;
        }
    }
}

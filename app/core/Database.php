<?php

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $conn;
    private $stmt;
    private $lastAffectedRows = 0; 

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db_name);

        if ($this->conn->connect_error) {
            Log::error("Koneksi database gagal: " . $this->conn->connect_error);
            throw new Exception("Koneksi database gagal: " . $this->conn->connect_error);
        }
    }

    public function prepare($query, $params = []) {
        
        $parsed_query = $query;
        $bound_values = [];
        $bound_types = '';

        if (!empty($params)) {
            preg_match_all('/:[a-zA-Z0-9_]+/', $query, $matches);
            $found_named_params = $matches[0];

            if (!empty($found_named_params)) {
                $unique_named_params = array_unique($found_named_params);
                foreach ($unique_named_params as $param_name) {
                    $key = substr($param_name, 1);
                    $value = null;

                    if (isset($params[$param_name])) {
                        $value = $params[$param_name];
                    } elseif (isset($params[$key])) {
                        $value = $params[$key];
                    } else {
                        
                        
                        
                    }
                    
                    $parsed_query = str_replace($param_name, '?', $parsed_query);
                    $bound_values[] = $value;
                }
            } else {
                $bound_values = array_values($params);
            }

            foreach ($bound_values as $value) {
                if (is_int($value)) {
                    $bound_types .= 'i';
                } elseif (is_float($value)) {
                    $bound_types .= 'd';
                } elseif (is_string($value)) {
                    $bound_types .= 's';
                } else {
                    $bound_types .= 'b'; 
                }
            }
        }
        
        $this->stmt = $this->conn->prepare($parsed_query);

        if ($this->stmt === false) {
            Log::error('Error preparing statement: ' . $this->conn->error . ' Query: ' . $query);
            return false;
        }

        if (!empty($bound_values)) {
            $refs = [];
            foreach ($bound_values as $key => $value) {
                $refs[$key] = &$bound_values[$key];
            }
            
            if (!empty($bound_types)) {
                array_unshift($refs, $bound_types);
                if (!call_user_func_array([$this->stmt, 'bind_param'], $refs)) {
                    Log::error("Error binding parameters: " . $this->stmt->error . " Query: " . $parsed_query . " Types: " . $bound_types);
                    $this->closeStmt($this->stmt);
                    return false;
                }
            }
        }

        return $this->stmt;
    }

    public function execute($stmt = null) {
        $current_stmt = $stmt ?: $this->stmt;

        if ($current_stmt === null) {
            Log::error('Error: No statement prepared or provided for execution.');
            return false;
        }

        $result = $current_stmt->execute();
        
        
        
        if ($result) {
            $this->lastAffectedRows = $this->conn->affected_rows;
        } else {
            $this->lastAffectedRows = 0; 
            Log::error("MySQLi execute error: " . $current_stmt->error . " | Error Code: " . $current_stmt->errno . " | Query: " . $current_stmt->sqlstate);
        }

        return $result; 
    }

    public function resultSet($stmt = null) {
        $current_stmt = $stmt ?: $this->stmt;
        if ($current_stmt === null) {
            Log::error('Error: No statement prepared or provided for result set.');
            return [];
        }
        $result = $current_stmt->get_result();
        if ($result === false) {
            Log::error("MySQLi get_result error: " . $current_stmt->error);
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function single($stmt = null) {
        $current_stmt = $stmt ?: $this->stmt;
        if ($current_stmt === null) {
            Log::error('Error: No statement prepared or provided for single result.');
            return null;
        }
        $result = $current_stmt->get_result();
        if ($result === false) {
            Log::error("MySQLi get_result error: " . $current_stmt->error);
            return null;
        }
        return $result->fetch_assoc();
    }

    public function rowCount($stmt = null) {
        $current_stmt = $stmt ?: $this->stmt;

        if ($current_stmt && $current_stmt instanceof mysqli_stmt) {
            
            
            if ($current_stmt->field_count > 0 && $current_stmt->num_rows !== null) { 
                return $current_stmt->num_rows;
            }
        }
        
        
        return $this->lastAffectedRows;
    }

    public function lastInsertId() {
        return $this->conn->insert_id;
    }

    public function closeStmt($stmt = null) {
        $current_stmt = $stmt ?: $this->stmt;
        if ($current_stmt && $current_stmt instanceof mysqli_stmt) {
            $current_stmt->close();
        }
        if ($current_stmt === $this->stmt) {
            $this->stmt = null;
        }
    }
}
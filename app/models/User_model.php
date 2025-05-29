<?php

class User_model
{
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    
    public function getUserByUsername($username)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->db->prepare($query, [':username' => $username]);
        $this->db->execute($stmt);
        $user = $this->db->single($stmt);
        $this->db->closeStmt($stmt);
        return $user;
    }

    
    public function registerUser($data)
    {
        $query = "INSERT INTO " . $this->table . " (username, password, nama_lengkap) VALUES (:username, :password, :nama_lengkap)";
        $stmt = $this->db->prepare($query, [
            ':username' => $data['username'],
            ':password' => $data['password'],
            ':nama_lengkap' => $data['nama_lengkap']
        ]);

        if ($stmt === false) {
            Log::error("Failed to prepare statement for user registration.");
            return 0; 
        }

        $result = $this->db->execute($stmt); 
        
        $rowCount = 0;
        if ($result) { 
            $rowCount = $this->db->rowCount($stmt);
        } else {
            
            if ($stmt->errno == 1062) { 
                Log::warning("Attempted to register duplicate username: " . $data['username']);
                $rowCount = -1; 
            } else {
                Log::error("MySQLi execute failed for user registration: " . $stmt->error . " | Query: " . $query);
            }
        }
        
        $this->db->closeStmt($stmt);
        return $rowCount;
    }

    
    public function getUserById($id)
    {
        $query = "SELECT id, username, nama_lengkap FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->db->prepare($query, [':id' => $id]);
        $this->db->execute($stmt);
        $user = $this->db->single($stmt);
        $this->db->closeStmt($stmt);
        return $user;
    }
}

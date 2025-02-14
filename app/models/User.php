<?php

class User
{
  private $table = 'users';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAllUser()
  {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function getUserById($id)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
    $this->db->bind('id', $id);
    return $this->db->single();
  }

  public function tambahDataUser($data)
  {
    $query = "INSERT INTO " . $this->table . "
                    VALUES
                  ('', :fullname, :email, :password)";

    $this->db->query($query);
    $this->db->bind('nama', $data['fullname']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('password', $data['password']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function hapusDataUser($id)
  {
    $query = "DELETE FROM " . $this->table . " WHERE id = :id";

    $this->db->query($query);
    $this->db->bind('id', $id);

    $this->db->execute();

    return $this->db->rowCount();
  }


  public function ubahDataUser($data)
  {
    $query = "UPDATE " . $this->table . " SET
                    fullname = :fullname,
                    email = :email,
                    password = :password
                  WHERE id = :id";

    $this->db->query($query);
    $this->db->bind('fullname', $data['fullname']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('password', $data['password']);
    $this->db->bind('id', $data['id']);

    $this->db->execute();

    return $this->db->rowCount();
  }


  public function cariDataUser()
  {
    $keyword = $_POST['keyword'];
    $query = "SELECT * FROM " . $this->table . " WHERE fullname LIKE :keyword";
    $this->db->query($query);
    $this->db->bind('keyword', "%$keyword%");
    return $this->db->resultSet();
  }
}
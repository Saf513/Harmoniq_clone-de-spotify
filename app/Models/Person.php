

<?php
namespace app\Models;
abstract class Person
{
    protected int $id;
    protected string $username;
    protected string $email;
    protected string $password;
    protected string $role;
    protected string $created_at;
    protected string $updated_at;

    public function __construct(string $username, string $email, string $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

   
    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getEmail() { return $this->email; }
    public function getRole() { return $this->role; }

    public function setId($id) { $this->id = $id; }
    public function setUsername($username) { $this->username = $username; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { 
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function setRole($role) { $this->role = $role; }

}

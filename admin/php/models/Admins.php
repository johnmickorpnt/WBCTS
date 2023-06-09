<?php
include_once("BaseModel.php");
class Admins extends BaseModel
{
    protected $conn;
    protected $table = "admin_users";
    protected $id, $firstname, $lastname, $role, $username, $password, $is_archived, $created_at, $updated_at, $columns;

    public function save()
    {
        $data = [
            "id" => $this->getId(),
            "firstname" => $this->getFirstname(),
            "lastname" => $this->getLastname(),
            "role" => $this->getRole(),
            "username" => $this->getUsername(),
            "password" => $this->getPassword(),
        ];
        // Check if the record already exists in the database
        if ($this->id) {
            // Perform an update operation
            $this->update($this->id, $data);
        } else {

            // Perform an insert operation
            $this->insert($data);
        }
    }

    public function login($username, $password)
    {
        $q = "SELECT * FROM {$this->table} WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($q);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $role = $user['role'];
            return ['user' => $user, 'role' => $role];
        }

        return null;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    //     ALTER TABLE admin_users
    // ADD CONSTRAINT FK_User_roles
    // FOREIGN KEY (role) REFERENCES admin_roles(id)
    // ON DELETE CASCADE;

    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of columns
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Set the value of columns
     *
     * @return  self
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * Get the value of is_archived
     */ 
    public function getIs_archived()
    {
        return $this->is_archived;
    }

    /**
     * Set the value of is_archived
     *
     * @return  self
     */ 
    public function setIs_archived($is_archived)
    {
        $this->is_archived = $is_archived;

        return $this;
    }
}

<?php
include_once("BaseModel.php");
class User extends BaseModel
{
    protected $conn;
    protected $table = "users";
    protected $id, $firstname, $lastname, $email, $contact_number, $address, $password, $is_archived, $created_at, $updated_at, $columns;

    public function save()
    {
        $data = [
            "id" => $this->getId(),
            "firstname" => $this->getFirstname(),
            "lastname" => $this->getLastname(),
            "email" => $this->getEmail(),
            "contact_number" => $this->getContact_number(),
            "address" => $this->getAddress(),
            "password" => $this->getPassword(),
            "is_archived" => $this->getIs_archived(),
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
        $q = "SELECT * FROM {$this->table} WHERE username = '{$username}' AND password = '{$password}'";
        $stmt = $this->conn->prepare($q);
        $stmt->execute();
        return $stmt;
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
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of contact_number
     */
    public function getContact_number()
    {
        return $this->contact_number;
    }

    /**
     * Set the value of contact_number
     *
     * @return  self
     */
    public function setContact_number($contact_number)
    {
        $this->contact_number = $contact_number;

        return $this;
    }

    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */
    public function setAddress($address)
    {
        $this->address = $address;

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

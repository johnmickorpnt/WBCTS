<?php
class User
{
    private $table = 'users';
    private $id, $first_name, $last_name, $email,
        $contact_number, $address, $pass, $is_archived, $created_at, $updated_at;
    private $conn;


    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function read($id)
    {
        $c = $id != null ? "WHERE id = '{$id}'" : "";
        $query = "SELECT * FROM {$this->table} {$c};";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function login($email, $password)
    {
        $q = "SELECT * FROM {$this->table} WHERE email = :email";
        $stmt = $this->conn->prepare($q);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        return $stmt;
    }

    public function save()
    {
        $query = "INSERT INTO {$this->table} (firstname, lastname, email, contact_number, address, password) 
					VALUES (:firstname, :lastname, 
                    :email, :contact_number, :address, :pass)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":firstname", $this->first_name);
        $stmt->bindParam(":lastname", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":contact_number", $this->contact_number);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":pass",  $this->pass);
        $stmt->execute();
        return $stmt;

        // $result = mysqli_query($db, $query);
    }

    public function is_email_unique($email)
    {
        // Check if the email already exists in the table
        $stmt = $this->conn->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();
        return $count > 0 ? true : false;
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
     * Get the value of first_name
     */
    public function getFirst_name()
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     *
     * @return  self
     */
    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of last_name
     */
    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     *
     * @return  self
     */
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

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
     * Get the value of pass
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set the value of pass
     *
     * @return  self
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

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

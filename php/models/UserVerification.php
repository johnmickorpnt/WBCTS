<?php
class UserVerification
{
    private $id, $user_id, $token, $expiration_token, $verified;
    private $table = "user_verification";
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function save()
    {

        $expirationTimestamp = date('Y-m-d H:i:s', strtotime('+30 minutes'));

        $query = "INSERT INTO {$this->table} (id, user_id, token, expiration_timestamp) 
					VALUES (NULL, :user_id, 
                    :token, :expiration_timestamp)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":token", $this->token);
        $stmt->bindParam(":expiration_timestamp", $expirationTimestamp);
        $stmt->execute();

        $this->setId($this->conn->lastInsertId());
        return $stmt;

        // $result = mysqli_query($db, $query);
    }

    public function validate($id, $token)
    {
        $currentDate = date("Y-m-d H:i:s"); // Get the current date in YYYY-MM-DD format

        $q = "SELECT * FROM {$this->table} WHERE id = :id AND token = :token AND expiration_timestamp >= :currentDate";

        $stmt = $this->conn->prepare($q);
        $stmt->bindParam(":id", $id); // Use the function parameter $id
        $stmt->bindParam(":token", $token); // Use the function parameter $token
        $stmt->bindParam(":currentDate", $currentDate);
        $stmt->execute();

        // Check if a row was found
        if ($stmt->rowCount() > 0) {
            $res = $this->setUserVerified($id);
            if ($res) return true;
        } else return false;
    }


    public function setUserVerified($id)
    {
        $query = "UPDATE {$this->table} SET verified = '1' WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id); // Use the function parameter $id
        $stmt->execute();
        return $stmt;
    }

    function generateToken($length = 32)
    {
        return bin2hex(random_bytes($length));
    }

    public function read($id)
    {
        $c = $id != null ? "WHERE id = '{$id}'" : "";
        $query = "SELECT * FROM {$this->table} {$c};";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
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
     * Get the value of user_id
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of expiration_token
     */
    public function getExpiration_token()
    {
        return $this->expiration_token;
    }

    /**
     * Set the value of expiration_token
     *
     * @return  self
     */
    public function setExpiration_token($expiration_token)
    {
        $this->expiration_token = $expiration_token;

        return $this;
    }

    /**
     * Get the value of verified
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Set the value of verified
     *
     * @return  self
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;

        return $this;
    }
}

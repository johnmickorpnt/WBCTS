<?php
include_once("BaseModel.php");

class AuditTrail extends BaseModel
{
    protected $table = 'audit_trail';
    protected $id, $user_id, $action, $created_at;
    protected $conn;

    public function save()
    {
        $query = "INSERT INTO {$this->table} (user_id, action, created_at) 
            VALUES (:user_id, :action, :created_at)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":action", $this->action);
        $stmt->bindParam(":created_at", $this->created_at);

        $stmt->execute();
        return $stmt;
    }

    public function search($term, $archived)
    {
        $q = "SELECT * FROM {$this->table}
        WHERE id LIKE :term OR user_id LIKE :term OR action LIKE :term;";

        $stmt = $this->conn->prepare($q);
        $term = '%' . $term . '%';  // Add wildcards for LIKE operator

        // Bind values using prepared statements
        $stmt->bindValue(':term', $term, PDO::PARAM_STR);
        // $stmt->bindValue(':archived', $archived, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch all rows as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return self
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * Get the value of action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set the value of action
     *
     * @return self
     */
    public function setAction($action)
    {
        $this->action = $action;
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
}

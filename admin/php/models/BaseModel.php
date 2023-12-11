<?php
class BaseModel
{
    protected $conn;
    protected $table;
    protected $columns;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Insert a new record
    public function insert($data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);

        return $stmt->rowCount();
    }

    // Update a record
    public function update($id, $data)
    {
        $setColumns = [];
        foreach ($data as $key => $value) {
            $setColumns[] = "$key = :$key";
        }
        $setColumns = implode(', ', $setColumns);

        $sql = "UPDATE {$this->table} SET $setColumns WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute($data);

        return $stmt->rowCount();
    }
    // Archive a row by ID
    public function archiveRow($id)
    {
        $sql = "UPDATE {$this->table} SET is_archived = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->rowCount();
    }

    // Delete a record
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->rowCount();
    }

    // Get a single record by ID
    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get all records
    public function getAll()
    {
        // $columns = $this->columns != null ? $this->format_columns() : '*';
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllWhere($conditions = [], $orderBy = null)
    {
        $sql = "SELECT * FROM {$this->table}";
        $values = [];

        if (!empty($conditions)) {
            $sql .= " WHERE ";
            $conditionsArr = [];

            foreach ($conditions as $key => $value) {
                $conditionsArr[] = "$key = :$key";
                $values[":$key"] = $value;
            }

            $sql .= implode(" AND ", $conditionsArr);
        }

        if ($orderBy) {
            $sql .= " ORDER BY $orderBy";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($values);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Get all records
    public function where()
    {
        // $columns = $this->columns != null ? $this->format_columns() : '*';
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function is_exists($id)
    {
        $q = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($q);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function get($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            foreach ($data as $key => $value) {
                $setter = 'set' . ucfirst($key);
                if (method_exists($this, $setter)) {
                    $this->$setter($value);
                }
            }
        }

        return $this;
    }

    public function format_columns()
    {
        $columnString = "";
        foreach ($this->columns as $index => $column) {
            $columnString .=  "$column";
            // Add commas
            $columnString .= $index >= 0 &&
                $index < sizeof($this->columns) - 1 ? "," : "";
        }
        return $columnString;
    }
}

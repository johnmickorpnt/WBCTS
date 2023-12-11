<?php
include_once("BaseModel.php");
class Settlements extends BaseModel
{
    protected $conn;
    protected $table = "settlements";
    protected $id, $blotter_id, $resolution, $settlement_details, $settled_by, $remarks,
        $date_settled, $is_archived, $updated_at, $columns;
    public function save()
    {
        $data = [
            "id" => $this->getId(),
            "blotter_id" => $this->getBlotter_id(),
            "resolution" => $this->getResolution(),
            "settlement_details" => $this->getSettlement_details(),
            "settled_by" => $this->getSettled_by(),
            "remarks" => $this->getRemarks(),
            "date_settled" => $this->getDate_settled(),
            "is_archived" => $this->getIs_archived(),
        ];

        // Check if the record already exists in the database
        if ($this->id != null) {
            // Perform an update operation
            $this->update($this->id, $data);
        } else {
            // Perform an insert operation
            $this->insert($data);
        }
    }
    public function search($term, $archived)
    {
        $q = "SELECT * FROM `{$this->table}` 
                        WHERE (id LIKE :term OR blotter_id LIKE :term OR resolution LIKE :term OR settlement_details LIKE :term OR settled_by LIKE :term
                        OR remarks LIKE :term OR date_settled LIKE :term) 
                        AND is_archived = :archived";
        $stmt = $this->conn->prepare($q);
        $term = '%' . $term . '%';  // Add wildcards for LIKE operator
        $stmt->bindValue(':term', $term);
        $stmt->bindValue(':archived', $archived);

        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($data, $row);
        }
        return $data;
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
     * Get the value of date_settled
     */
    public function getDate_settled()
    {
        return $this->date_settled;
    }

    /**
     * Set the value of date_settled
     *
     * @return  self
     */
    public function setDate_settled($date_settled)
    {
        $this->date_settled = $date_settled;

        return $this;
    }

    /**
     * Get the value of remarks
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * Set the value of remarks
     *
     * @return  self
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get the value of settled_by
     */
    public function getSettled_by()
    {
        return $this->settled_by;
    }

    /**
     * Set the value of settled_by
     *
     * @return  self
     */
    public function setSettled_by($settled_by)
    {
        $this->settled_by = $settled_by;

        return $this;
    }

    /**
     * Get the value of settlement_details
     */
    public function getSettlement_details()
    {
        return $this->settlement_details;
    }

    /**
     * Set the value of settlement_details
     *
     * @return  self
     */
    public function setSettlement_details($settlement_details)
    {
        $this->settlement_details = $settlement_details;

        return $this;
    }

    /**
     * Get the value of resolution
     */
    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * Set the value of resolution
     *
     * @return  self
     */
    public function setResolution($resolution)
    {
        $this->resolution = $resolution;

        return $this;
    }

    /**
     * Get the value of blotter_id
     */
    public function getBlotter_id()
    {
        return $this->blotter_id;
    }

    /**
     * Set the value of blotter_id
     *
     * @return  self
     */
    public function setBlotter_id($blotter_id)
    {
        $this->blotter_id = $blotter_id;

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

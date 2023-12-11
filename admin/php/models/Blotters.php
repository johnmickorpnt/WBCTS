<?php
include_once("BaseModel.php");
class Blotters extends BaseModel
{
    protected $table = "blotter_records";
    protected $id, $complainant_id, $respondent_name, $respondent_address, $incident_location,
        $incident_details, $incident_type, $blotter_status, $investigating_officer, $remarks, $is_archived, $created_at, $updated_at, $columns;

    public function blotter_statistics($num_interval, $interval_indicator)
    {

        $interval = (isset($num_interval) && $num_interval !== "null") && (isset($interval_indicator) && $interval_indicator !== "null") ? "{$num_interval} {$interval_indicator}" : "1 YEAR";

        $q = "CREATE TEMPORARY TABLE Numbers (n INT);";
        $stmt = $this->conn->prepare($q);
        $stmt->execute();

        $q = "INSERT INTO Numbers VALUES (1), (2), (3), (4), (5), (6), (7), (8), (9), (10), (11), (12);";
        $stmt = $this->conn->prepare($q);
        $stmt->execute();

        $q = "SELECT
            DATE_FORMAT(DATE_ADD('2023-01-01', INTERVAL n MONTH), '%M') AS date,
            IFNULL(COUNT(blotter_records.id), 0) AS count
        FROM Numbers
        LEFT JOIN blotter_records
            ON MONTH(DATE_ADD('2023-01-01', INTERVAL n MONTH)) = MONTH(blotter_records.created_at)
            AND blotter_records.created_at >= DATE_SUB(CURDATE(), INTERVAL $interval)
            AND blotter_records.created_at < CURDATE()
        GROUP BY n
        ORDER BY n;";
        $stmt = $this->conn->prepare($q);
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) array_push($data, $row);
        return $data;
    }

    public function search($term, $archived)
    {
        $q = "SELECT * FROM `{$this->table}` 
            WHERE (id LIKE :term OR complainant_id LIKE :term OR respondent_name LIKE :term OR respondent_address LIKE :term OR incident_location LIKE :term
            OR incident_details LIKE :term OR incident_type LIKE :term OR blotter_status LIKE :term OR investigating_officer LIKE :term OR remarks LIKE :term) 
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


    public function save()
    {
        $data = [
            'id' => $this->getId(),
            'complainant_id' => $this->getComplainant_id(),
            'respondent_name' => $this->getRespondent_name(),
            'respondent_address' => $this->getRespondent_address(),
            'incident_location' => $this->getIncident_location(),
            'incident_details' => $this->getIncident_details(),
            'incident_type' => $this->getIncident_type(),
            'blotter_status' => $this->getBlotter_status(),
            'investigating_officer' => $this->getInvestigating_officer(),
            'remarks' => $this->getRemarks(),
            'is_archived' => $this->getIs_archived(),

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
     * Get the value of respondent_name
     */
    public function getRespondent_name()
    {
        return $this->respondent_name;
    }

    /**
     * Set the value of respondent_name
     *
     * @return  self
     */
    public function setRespondent_name($respondent_name)
    {
        $this->respondent_name = $respondent_name;

        return $this;
    }

    /**
     * Get the value of respondent_address
     */
    public function getRespondent_address()
    {
        return $this->respondent_address;
    }

    /**
     * Set the value of respondent_address
     *
     * @return  self
     */
    public function setRespondent_address($respondent_address)
    {
        $this->respondent_address = $respondent_address;

        return $this;
    }

    /**
     * Get the value of incident_location
     */
    public function getIncident_location()
    {
        return $this->incident_location;
    }

    /**
     * Set the value of incident_location
     *
     * @return  self
     */
    public function setIncident_location($incident_location)
    {
        $this->incident_location = $incident_location;

        return $this;
    }

    /**
     * Get the value of incident_details
     */
    public function getIncident_details()
    {
        return $this->incident_details;
    }

    /**
     * Set the value of incident_details
     *
     * @return  self
     */
    public function setIncident_details($incident_details)
    {
        $this->incident_details = $incident_details;

        return $this;
    }

    /**
     * Get the value of incident_type
     */
    public function getIncident_type()
    {
        return $this->incident_type;
    }

    /**
     * Set the value of incident_type
     *
     * @return  self
     */
    public function setIncident_type($incident_type)
    {
        $this->incident_type = $incident_type;

        return $this;
    }

    /**
     * Get the value of blotter_status
     */
    public function getBlotter_status()
    {
        return $this->blotter_status;
    }

    /**
     * Set the value of blotter_status
     *
     * @return  self
     */
    public function setBlotter_status($blotter_status)
    {
        $this->blotter_status = $blotter_status;

        return $this;
    }

    /**
     * Get the value of investigating_officer
     */
    public function getInvestigating_officer()
    {
        return $this->investigating_officer;
    }

    /**
     * Set the value of investigating_officer
     *
     * @return  self
     */
    public function setInvestigating_officer($investigating_officer)
    {
        $this->investigating_officer = $investigating_officer;

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
     * Get the value of complainant_id
     */
    public function getComplainant_id()
    {
        return $this->complainant_id;
    }

    /**
     * Set the value of complainant_id
     *
     * @return  self
     */
    public function setComplainant_id($complainant_id)
    {
        $this->complainant_id = $complainant_id;

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

<?php
class Blotter
{
    private $table = 'blotter_records';
    private $id, $respondent_name, $complainant_id, $respondent_address, $incident_location,
        $incident_details, $incident_type, $blotter_status, $investigating_officer, $remarks;
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

    public function save()
    {
        $query = "INSERT INTO {$this->table} (complainant_id, respondent_name, 
        respondent_address, incident_location, 
        incident_details, incident_type, blotter_status, investigating_officer, remarks) 
					VALUES (:complainant_id, :respondent_name, 
                    :respondent_address, :incident_location, :incident_details, :incident_type,
                    :blotter_status, :investigating_officer, :remarks)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":complainant_id", $this->complainant_id);
        $stmt->bindParam(":respondent_name", $this->respondent_name);
        $stmt->bindParam(":respondent_address", $this->respondent_address);
        $stmt->bindParam(":incident_location", $this->incident_location);
        $stmt->bindParam(":incident_details", $this->incident_details);
        $stmt->bindParam(":incident_type",  $this->incident_type);
        $stmt->bindParam(":blotter_status",  $this->blotter_status);
        $stmt->bindParam(":investigating_officer",  $this->investigating_officer);
        $stmt->bindParam(":remarks",  $this->remarks);


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
}

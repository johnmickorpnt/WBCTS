<?php
include_once("BaseModel.php");
class Blotters extends BaseModel
{
    protected $table = "blotter_records";
    protected $id, $complaint_id, $respondent_name, $respondent_address, $incident_location,
        $incident_details, $incident_type, $blotter_status, $investigating_officer, $remarks, $created_at, $updated_at, $columns;

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
     * Get the value of complaint_id
     */
    public function getComplaint_id()
    {
        return $this->complaint_id;
    }

    /**
     * Set the value of complaint_id
     *
     * @return  self
     */
    public function setComplaint_id($complaint_id)
    {
        $this->complaint_id = $complaint_id;

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
}

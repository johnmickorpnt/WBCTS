<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user'])) {
    // Redirect to the login page
    header('Location: auth/login');
    exit;
}
class Table
{
    private $tbl, $header, $content, $id, $styles, $attributes, $columns,
        $hasActions, $tblName, $columnTypes, $columnAttributes, $updateAction, $addAction, $isArchiveTable;

    public function __construct($tbl)
    {
        $this->tbl = $tbl;
        $this->columnTypes = []; // Initialize the array for column types
    }

    public function build_header()
    {
        $header = "";
        $keys = array_keys($this->tbl[0]);
        foreach ($keys as $index => $th) {
            $newTh = str_replace("_", " ", $th);
            $dataType = isset($this->columnTypes[$index]) ? $this->columnTypes[$index] : 'input'; // Set the column type based on the array value
            $attributes = isset($this->columnAttributes[$index]) ? $this->columnAttributes[$index] : ''; // Set the attributes based on the array value
            $header .= "<th data-type='$dataType' col-name='$th' $attributes>$newTh</th>";
        }
        $header .= $this->hasActions ? "<th>Actions</th>" : "";
        $this->setHeader($header);
    }

    public function build_rows()
    {
        $rows = "";
        foreach ($this->tbl as $key => $row) {
            if (gettype($row) != "array") break;
            $rows .= "<tr>";
            $id = 0;
            $count = 0;
            foreach ($row as $subKey => $subRow) {
                $attributes = isset($this->columnAttributes[$count]) ? $this->columnAttributes[$count] : ''; // Set the attributes based on the array value
                $rows .= "<td $attributes>$subRow</td>";
                if ($subKey === "id") $id = $subRow;
                $count++;
            }
            $deleteBtn  = $this->isArchiveTable ? <<<BTN
                <button class="action-button" data-id="{$id}" target-table="{$this->getTblName()}" onclick="delete_row('{$id}','{$this->getTblName()}')">Delete</button>
            BTN : <<<BTN
                <button class="action-button" data-id="{$id}" target-table="{$this->getTblName()}" onclick="archive_row('{$id}','{$this->getTblName()}')">Archive</button>
            BTN;
            $rows .= $this->hasActions && $_SESSION["role"] == 1 ? <<<ACTIONS
        <td class="row-action-buttons">
            <button class="action-button edit-button" target-table="{$this->getId()}">Edit</button>
            {$deleteBtn}
            <button class="action-button view-button">View</button>
        </td>

        ACTIONS : ($this->hasActions && $_SESSION["role"] == 2 ? <<<ACTIONS
        <td class="row-action-buttons">
            <button class="action-button view-button">View</button>
        </td>
        ACTIONS : "");
            $rows .= "</tr>";
        }
        $this->setContent($rows);
    }


    function build_table()
    {
        $this->build_header();
        $this->build_rows();
        return <<<TBL
            <table class="tbl" {$this->get_formatted_id()} form-update-action={$this->updateAction} form-add-action="{$this->addAction}">
                <thead>
                    {$this->getHeader()}
                </thead>
                <tbody>
                    {$this->getContent()}
                </tbody>
            </table>
            TBL;
    }

    public function setColumnType($columnIndex, $columnType)
    {
        $this->columnTypes[$columnIndex] = $columnType;
    }

    /**
     * Get the value of tbl
     */
    public function getTbl()
    {
        return $this->tbl;
    }

    /**
     * Set the value of tbl
     *
     * @return  self
     */
    public function setTbl($tbl)
    {
        $this->tbl = $tbl;

        return $this;
    }

    /**
     * Get the value of header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set the value of header
     *
     * @return  self
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    public function get_formatted_id()
    {
        $id = "id='{$this->id}'";
        return $id;
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
     * Get the value of styles
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * Set the value of styles
     *
     * @return  self
     */
    public function setStyles($styles)
    {
        $this->styles = $styles;

        return $this;
    }

    /**
     * Get the value of attributes
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Set the value of attributes
     *
     * @return  self
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

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
     * Get the value of hasActions
     */
    public function getHasActions()
    {
        return $this->hasActions;
    }

    /**
     * Set the value of hasActions
     *
     * @return  self
     */
    public function setHasActions($hasActions)
    {
        $this->hasActions = $hasActions;

        return $this;
    }

    /**
     * Get the value of tblName
     */
    public function getTblName()
    {
        return $this->tblName;
    }

    /**
     * Set the value of tblName
     *
     * @return  self
     */
    public function setTblName($tblName)
    {
        $this->tblName = $tblName;

        return $this;
    }

    /**
     * Get the value of columnAttributes
     */
    public function getColumnAttributes()
    {
        return $this->columnAttributes;
    }

    /**
     * Set the value of columnAttributes
     *
     * @return  self
     */
    public function setColumnAttributes($columnIndex, $columnAttributes)
    {
        $this->columnAttributes[$columnIndex] = $columnAttributes;

        return $this;
    }


    /**
     * Get the value of updateAction
     */
    public function getUpdateAction()
    {
        return $this->updateAction;
    }

    /**
     * Set the value of updateAction
     *
     * @return  self
     */
    public function setUpdateAction($updateAction)
    {
        $this->updateAction = $updateAction;

        return $this;
    }

    /**
     * Get the value of addAction
     */
    public function getAddAction()
    {
        return $this->addAction;
    }

    /**
     * Set the value of addAction
     *
     * @return  self
     */
    public function setAddAction($addAction)
    {
        $this->addAction = $addAction;

        return $this;
    }

    /**
     * Get the value of isArchiveTable
     */
    public function getIsArchiveTable()
    {
        return $this->isArchiveTable;
    }

    /**
     * Set the value of isArchiveTable
     *
     * @return  self
     */
    public function setIsArchiveTable($isArchiveTable)
    {
        $this->isArchiveTable = $isArchiveTable;

        return $this;
    }
}

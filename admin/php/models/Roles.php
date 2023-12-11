<?php
include_once("BaseModel.php");
class Roles extends BaseModel
{
        protected $conn;
        protected $table = "admin_roles";
        protected $id, $role, $permission_create, $permission_read,
                $permission_write, $permission_delete, $is_archived, $created_at, $updated_at, $columns;

        public function search($term, $archived)
        {
                $q = "SELECT * FROM `{$this->table}` 
                        WHERE (id LIKE :term OR lastname LIKE :term OR email LIKE :term OR contact_number LIKE :term OR address LIKE :term) 
                        AND archived = :archived";
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
         * Get the value of role
         */
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of role
         *
         * @return  self
         */
        public function setRole($role)
        {
                $this->role = $role;

                return $this;
        }

        /**
         * Get the value of permission_create
         */
        public function getPermission_create()
        {
                return $this->permission_create;
        }

        /**
         * Set the value of permission_create
         *
         * @return  self
         */
        public function setPermission_create($permission_create)
        {
                $this->permission_create = $permission_create;

                return $this;
        }

        /**
         * Get the value of permission_read
         */
        public function getPermission_read()
        {
                return $this->permission_read;
        }

        /**
         * Set the value of permission_read
         *
         * @return  self
         */
        public function setPermission_read($permission_read)
        {
                $this->permission_read = $permission_read;

                return $this;
        }

        /**
         * Get the value of permission_write
         */
        public function getPermission_write()
        {
                return $this->permission_write;
        }

        /**
         * Set the value of permission_write
         *
         * @return  self
         */
        public function setPermission_write($permission_write)
        {
                $this->permission_write = $permission_write;

                return $this;
        }

        /**
         * Get the value of permission_delete
         */
        public function getPermission_delete()
        {
                return $this->permission_delete;
        }

        /**
         * Set the value of permission_delete
         *
         * @return  self
         */
        public function setPermission_delete($permission_delete)
        {
                $this->permission_delete = $permission_delete;

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

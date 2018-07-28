<?php
    class Test
    {
        public $id;
        public $name;
        public $description;
        public $username;

        public function __construct($id, $name, $description, $username)
        {
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->username = $username;
        }
    }
?>
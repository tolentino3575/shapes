<?php

    class Circle
    {
        private $circle_name;
        private $circle_radius;
        private $id;

        function __construct($circle_name, $circle_radius, $id=null)
        {
            $this->circle_name = $circle_name;
            $this->circle_radius = $circle_radius;
            $this->id = $id;
        }

        function setCircleName($new_circle_name)
        {
            $this->brand_name = (string) $new_circle_name;
        }


    }

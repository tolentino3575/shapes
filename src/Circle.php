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
            $this->circle_name = (string) $new_circle_name;
        }

        function getCircleName()
        {
            return $this->circle_name;
        }

        function setCircleRadius($new_circle_radius)
        {
            $this->circle_radius = $new_circle_radius;
        }

        function getCircleRadius()
        {
            return $this->circle_radius;
        }

        function getCircleId()
        {
            return $this->id;
        }

        function saveCircle()
        {
            $GLOBALS['DB']->exec("INSERT INTO circles (circle_name, circle_radius)
            VALUES ('{$this->getCircleName()}', '{$this->getCircleRadius()}');");
            $this->id=$GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_circle = $GLOBALS['DB']->query("SELECT * FROM circles");
            $circles = array();
            foreach($returned_circle as $circle) {
                $circle_name = $circle['circle_name'];
                $circle_radius = $circle['circle_radius'];
                $id = $circle['id'];
                $new_circle = new Circle($circle_name, $circle_radius, $id);
                array_push($circles, $new_circle);
            }
            return $circles;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM circles");
        }

        static function findCircle($search_id)
        {
            $found_circle = null;
            $circles = Circle::getAll();
            foreach ($circles as $circle)
            {
                $circle_id = $circle->getCircleId();
                if ($circle_id == $search_id)
                {
                    $found_circle = $circle;
                }
            }
            return $found_circle;
        }

        function updateCircle($new_circle_name, $new_circle_radius)
        {
            $GLOBALS['DB']->exec("UPDATE circles SET
                circle_name = '{$new_circle_name}',
                circle_radius = '{$new_circle_radius}'
                WHERE id = {$this->getCircleId()};");
            $this->setCircleName($new_circle_name);
            $this->setCircleRadius($new_circle_radius);
        }

    }
?>

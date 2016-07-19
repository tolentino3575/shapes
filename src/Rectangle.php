<?php
    class Rectangle
    {
        private $rectangle_name;
        private $rectangle_length;
        private $rectangle_width;
        private $id;

        function __construct($rectangle_name, $rectangle_length, $rectangle_width, $id=null)
        {
            $this->rectangle_name = $rectangle_name;
            $this->rectangle_length = $rectangle_length;
            $this->rectangle_width = $rectangle_width;
            $this->id = $id;
        }

        function setRectangleName($new_rectangle_name)
        {
            $this->rectangle_name = (string) $new_rectangle_name;
        }

        function getRectangleName()
        {
            return $this->rectangle_name;
        }

        function setRectangleLength($new_rectangle_length)
        {
            $this->rectangle_length = $new_rectangle_length;
        }

        function getRectangleLength()
        {
            return $this->rectangle_length;
        }

        function setRectangleWidth($new_rectangle_width)
        {
            $this->rectangle_width = $new_rectangle_width;
        }

        function getRectangleWidth()
        {
            return $this->rectangle_width;
        }

        function getRectangleId()
        {
            return $this->id;
        }

        function saveRectangle()
        {
            $GLOBALS['DB']->exec("INSERT INTO rectangles (rectangle_name, rectangle_length, rectangle_width)
            VALUES ('{$this->getRectangleName()}',
            '{$this->getRectangleLength()}',
            '{$this->getRectangleWidth()}');");
            $this->id=$GLOBALS['DB']->lastInsertId();
        }

        function getAll()
        {
            $returned_rectangle = $GLOBALS['DB']->query("SELECT * FROM rectangles");
            $rectangles = array();
            foreach($returned_rectangle as $rectangle)
            {
                $rectangle_name = $rectangle['rectangle_name'];
                $rectangle_length = $rectangle['rectangle_length'];
                $rectangle_width = $rectangle['rectangle_width'];
                $id = $rectangle['id'];
                $new_rectangle = new Rectangle($rectangle_name, $rectangle_length, $rectangle_width, $id);
                array_push($rectangles, $new_rectangle);
            }
            return $rectangles;
        }

        function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM rectangles");
        }

        function findRectangle($search_id)
        {
            $found_rectangle = null;
            $rectangles = Rectangle::getAll();
            foreach ($rectangles as $rectangle)
            {
                $rectangle_id = $rectangle->getRectangleId();
                if ($rectangle_id == $search_id)
                {
                    $found_rectangle = $rectangle;
                }
            }
            return $found_rectangle;
        }

        function updateRectangle($new_rectangle_name, $new_rectangle_length, $new_rectangle_width)
        {
            $GLOBALS['DB']->exec("UPDATE rectangles SET
                rectangle_name = '{$new_rectangle_name}',
                rectangle_length = '{$new_rectangle_length}',
                rectangle_width = '{$new_rectangle_width}'
                WHERE id = {$this->getRectangleId()};");
            $this->setRectangleName($new_rectangle_name);
            $this->setRectangleLength($new_rectangle_length);
            $this->setRectangleWidth($new_rectangle_width);
        }
    }



 ?>

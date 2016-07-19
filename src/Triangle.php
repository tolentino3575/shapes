<?php
    class Triangle
    {
        private $triangle_name;
        private $triangle_base;
        private $triangle_height;
        private $id;

        function __construct($triangle_name, $triangle_base, $triangle_height, $id=null)
        {
            $this->triangle_name = $triangle_name;
            $this->triangle_base = $triangle_base;
            $this->triangle_height = $triangle_height;
            $this->id = $id;
        }

        function setTriangleName($new_triangle_name)
        {
            $this->triangle_name = (string) $new_triangle_name;
        }

        function getTriangleName()
        {
            return $this->triangle_name;
        }

        function setTriangleBase($new_triangle_base)
        {
            $this->triangle_base = $new_triangle_base;
        }

        function getTriangleBase()
        {
            return $this->triangle_base;
        }

        function setTriangleHeight($new_triangle_height)
        {
            $this->triangle_height = $new_triangle_height;
        }

        function getTriangleHeight()
        {
            return $this->triangle_height;
        }

        function getTriangleId()
        {
            return $this->id;
        }

        function saveTriangle()
        {
            $GLOBALS['DB']->exec("INSERT INTO triangles (triangle_name, triangle_base, triangle_height)
            VALUES ('{$this->getTriangleName()}',
            '{$this->getTriangleBase()}',
            '{$this->getTriangleHeight()}');");
            $this->id=$GLOBALS['DB']->lastInsertId();
        }

        function getAll()
        {
            $returned_triangle = $GLOBALS['DB']->query("SELECT * FROM triangles");
            $triangles = array();
            foreach($returned_triangle as $triangle)
            {
                $triangle_name = $triangle['triangle_name'];
                $triangle_base = $triangle['triangle_base'];
                $triangle_height = $triangle['triangle_height'];
                $id = $triangle['id'];
                $new_triangle = new Triangle($triangle_name, $triangle_base, $triangle_height, $id);
                array_push($triangles, $new_triangle);
            }
            return $triangles;
        }

        function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM triangles");
        }

        function findTriangle($search_id)
        {
            $found_triangle = null;
            $triangles = Triangle::getAll();
            foreach ($triangles as $triangle)
            {
                $triangle_id = $triangle->getTriangleId();
                if ($triangle_id == $search_id)
                {
                    $found_triangle = $triangle;
                }
            }
            return $found_triangle;
        }

        function updateTriangle($new_triangle_name, $new_triangle_base, $new_triangle_height)
        {
            $GLOBALS['DB']->exec("UPDATE triangles SET
                triangle_name = '{$new_triangle_name}',
                triangle_base = '{$new_triangle_base}',
                triangle_height = '{$new_triangle_height}'
                WHERE id = {$this->getTriangleId()};");
            $this->setTriangleName($new_triangle_name);
            $this->setTriangleBase($new_triangle_base);
            $this->setTriangleHeight($new_triangle_height);
        }
    }




?>

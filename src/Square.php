<?php

    class Square
    {
        private $square_name;
        private $square_width;
        private $id;

        function __construct($square_name, $square_width, $id=null)
        {
            $this->square_name = $square_name;
            $this->square_width = $square_width;
            $this->id = $id;
        }

        function setSquareName($new_square_name)
        {
            $this->square_name = (string) $new_square_name;
        }

        function getSquareName()
        {
            return $this->square_name;
        }

        function setSquareWidth($new_square_width)
        {
            $this->square_width = $new_square_width;
        }

        function getSquareWidth()
        {
            return $this->square_width;
        }

        function getSquareId()
        {
            return $this->id;
        }

        function saveSquare()
        {
            $GLOBALS['DB']->exec("INSERT INTO squares (square_name, square_width)
            VALUES ('{$this->getSquareName()}', '{$this->getSquareWidth()}');");
            $this->id=$GLOBALS['DB']->lastInsertId();
        }

        function getAll()
        {
            $returned_square = $GLOBALS['DB']->query("SELECT * FROM squares");
            $squares = array();
            foreach($returned_square as $square)
            {
                $square_name = $square['square_name'];
                $square_width = $square['square_width'];
                $id = $square['id'];
                $new_square = new Square($square_name, $square_width, $id);
                array_push($squares, $new_square);
            }
            return $squares;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM squares");
        }

        function findSquare($search_id)
        {
            $found_square = null;
            $squares = Square::getAll();
            foreach($squares as $square)
            {
                $square_id = $square->getSquareId();
                if ($square_id == $search_id)
                {
                    $found_square = $square;
                }
            }
            return $found_square;
        }

        function updateSquare($new_square_name, $new_square_width)
        {
            $GLOBALS['DB']->exec("UPDATE squares SET
            square_name = '{$new_square_name}',
            square_width = '{$new_square_width}'
            WHERE id = {$this->getSquareId()};");
            $this->setSquareName($new_square_name);
            $this->setSquareWidth($new_square_width);
        }
    }





?>

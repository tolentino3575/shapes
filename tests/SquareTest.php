<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once 'src/Square.php';

$server = 'mysql:host=localhost:8889;dbname=shapes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class SquareTest extends PHPUnit_Framework_TestCase
{
    protected function TearDown()
    {
        Square::deleteAll();
    }

    function test_getSquareName()
    {
        $square_name = 'SquareOne';
        $square_width = 3;
        $id = 1;
        $test_square_name = new Square($square_name, $square_width, $id);

        $result = $test_square_name->getSquareName();

        $this->assertEquals($square_name, $result);
    }

    function test_getSquareWidth()
    {
        $square_name = 'SquareOne';
        $square_width = 3;
        $id = 1;
        $test_square_width = new Square($square_name, $square_width, $id);

        $result = $test_square_width->getSquareWidth();

        $this->assertEquals($square_width, $result);
    }

    function test_getSquareId()
    {
        $square_name = 'SquareOne';
        $square_width = 3;
        $id = 1;
        $test_square_id = new Square($square_name, $square_width, $id);

        $result = $test_square_id->getSquareId();

        $this->assertEquals($id, $result);
    }

    function test_saveSquare()
    {
        $square_name = 'SquareOne';
        $square_width = 3;
        $id = 1;
        $test_square = new Square($square_name, $square_width, $id);
        $test_square->saveSquare();

        $result = Square::getAll();

        $this->assertEquals([$test_square], $result);
    }

    function test_getAll()
    {
        $square_name1 = 'SquareOne';
        $square_width1 = 3;
        $id1 = 1;
        $test_square1 = new Square($square_name1, $square_width1, $id1);
        $test_square1->saveSquare();

        $square_name2 = 'SquareTwo';
        $square_width2 = 4;
        $id2 = 2;
        $test_square2 = new Square($square_name2, $square_width2, $id2);
        $test_square2->saveSquare();

        $result = Square::getAll();

        $this->assertEquals([$test_square1, $test_square2], $result);
    }

    function test_findSquare()
    {
        $square_name = 'SquareOne';
        $square_width = 3;
        $id = 1;
        $test_square = new Square($square_name, $square_width, $id);
        $test_square->saveSquare();

        $result = Square::findSquare($test_square->getSquareId());

        $this->assertEquals($test_square, $result);
    }

    function test_updateSquare()
    {
        $square_name = "SquareOne";
        $square_width = 3;
        $id = 1;
        $test_square = new Square($square_name, $square_width, $id);
        $test_square->saveSquare();

        $new_square_name = 'SquareTwo';
        $new_square_width = 4;
        $test_square->updateSquare($new_square_name, $new_square_width);

        $result = $test_square->getSquareName();
        $result2 = $test_square->getSquareWidth();

        $this->assertEquals($new_square_name, $result);
        $this->assertEquals($new_square_width, $result2);
    }
}

 ?>

<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once 'src/Rectangle.php';

$server = 'mysql:host=localhost:8889;dbname=shapes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class RectangleTest extends PHPUnit_Framework_TestCase
{
    protected function TearDown()
    {
        Rectangle::deleteAll();
    }

    function test_getRectangleName()
    {
        $rectangle_name = 'RectangleOne';
        $rectangle_length = 6;
        $rectangle_width = 3;
        $id = 1;
        $test_rectangle_name = new Rectangle($rectangle_name, $rectangle_length, $rectangle_width, $id);

        $result = $test_rectangle_name->getRectangleName();

        $this->assertEquals($rectangle_name, $result);
    }

    function test_getRectangleLength()
    {
        $rectangle_name = 'RectangleOne';
        $rectangle_length = 6;
        $rectangle_width = 3;
        $id = 1;
        $test_rectangle_length = new Rectangle($rectangle_name, $rectangle_length, $rectangle_width, $id);

        $result = $test_rectangle_length->getRectangleLength();

        $this->assertEquals($rectangle_length, $result);
    }

    function test_getRectangleWidth()
    {
        $rectangle_name = 'RectangleOne';
        $rectangle_length = 6;
        $rectangle_width = 3;
        $id = 1;
        $test_rectangle_width = new Rectangle($rectangle_name, $rectangle_length, $rectangle_width, $id);

        $result = $test_rectangle_width->getRectangleWidth();

        $this->assertEquals($rectangle_width, $result);
    }

    function test_getRectangleId()
    {
        $rectangle_name = 'RectangleOne';
        $rectangle_length = 6;
        $rectangle_width = 3;
        $id = 1;
        $test_rectangle_id = new Rectangle($rectangle_name, $rectangle_length, $rectangle_width, $id);

        $result = $test_rectangle_id->getRectangleId();

        $this->assertEquals($id, $result);
    }

    function test_saveRectangle()
    {
        $rectangle_name = 'RectangleOne';
        $rectangle_length = 6;
        $rectangle_width = 3;
        $id = 1;
        $test_rectangle = new Rectangle($rectangle_name, $rectangle_length, $rectangle_width, $id);
        $test_rectangle->saveRectangle();

        $result = Rectangle::getAll();

        $this->assertEquals([$test_rectangle], $result);
    }

    function test_getAll()
    {
        $rectangle_name1 = 'RectangleOne';
        $rectangle_length1 = 6;
        $rectangle_width1 = 3;
        $id = 1;
        $test_rectangle1 = new Rectangle($rectangle_name1, $rectangle_length1, $rectangle_width1, $id);
        $test_rectangle1->saveRectangle();

        $rectangle_name2 = 'RectangleTwo';
        $rectangle_length2 = 12;
        $rectangle_width2 = 6;
        $id2 = 2;
        $test_rectangle2 = new Rectangle($rectangle_name2, $rectangle_length2, $rectangle_width2, $id2);
        $test_rectangle2->saveRectangle();

        $result = Rectangle::getAll();

        $this->assertEquals([$test_rectangle1, $test_rectangle2], $result);
    }

    function test_findRectangle()
    {
        $rectangle_name = 'RectangleOne';
        $rectangle_length = 6;
        $rectangle_width = 3;
        $id = 1;
        $test_rectangle = new Rectangle($rectangle_name, $rectangle_length, $rectangle_width, $id);
        $test_rectangle->saveRectangle();

        $result = Rectangle::findRectangle($test_rectangle->getRectangleId());

        $this->assertEquals($test_rectangle, $result);
    }

    function test_updateRectangle()
    {
        $rectangle_name = 'RectangleOne';
        $rectangle_length = 6;
        $rectangle_width = 3;
        $id = 1;
        $test_rectangle = new Rectangle($rectangle_name, $rectangle_length, $rectangle_width, $id);
        $test_rectangle->saveRectangle();

        $new_rectangle_name = 'RectangleTwo';
        $new_rectangle_length = 12;
        $new_rectangle_width = 6;
        $test_rectangle->updateRectangle($new_rectangle_name, $new_rectangle_length, $new_rectangle_width);

        $result = $test_rectangle->getRectangleName();
        $result2 = $test_rectangle->getRectangleLength();
        $result3 = $test_rectangle->getRectangleWidth();

        $this->assertEquals($new_rectangle_name, $result);
        $this->assertEquals($new_rectangle_length, $result2);
        $this->assertEquals($new_rectangle_width, $result3);
    }
}

?>

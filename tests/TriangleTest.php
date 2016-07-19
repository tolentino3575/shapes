<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once 'src/Triangle.php';

$server = 'mysql:host=localhost:8889;dbname=shapes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class TriangleTest extends PHPUnit_Framework_TestCase
{
    protected function TearDown()
    {
        Triangle::deleteAll();
    }

    function test_getTriangleName()
    {
        $triangle_name = 'TriangleOne';
        $triangle_base = 3;
        $triangle_height = 5;
        $id = 1;
        $test_triangle_name = new Triangle($triangle_name, $triangle_base, $triangle_height, $id);

        $result = $test_triangle_name->getTriangleName();

        $this->assertEquals($triangle_name, $result);
    }

    function test_getTriangleBase()
    {
        $triangle_name = 'TriangleOne';
        $triangle_base = 3;
        $triangle_height = 5;
        $id = 1;
        $test_triangle_base = new Triangle($triangle_name, $triangle_base, $triangle_height, $id);

        $result = $test_triangle_base->getTriangleBase();

        $this->assertEquals($triangle_base, $result);
    }

    function test_getTriangleHeight()
    {
        $triangle_name = 'TriangleOne';
        $triangle_base = 3;
        $triangle_height = 5;
        $id = 1;
        $test_triangle_height = new Triangle($triangle_name, $triangle_base, $triangle_height, $id);

        $result = $test_triangle_height->getTriangleHeight();

        $this->assertEquals($triangle_height, $result);
    }

    function test_getTriangleId()
    {
        $triangle_name = 'TriangleOne';
        $triangle_base = 3;
        $triangle_height = 5;
        $id = 1;
        $test_triangle_id = new Triangle($triangle_name, $triangle_base, $triangle_height, $id);

        $result = $test_triangle_id->getTriangleId();

        $this->assertEquals($id, $result);
    }

    function test_saveTriangle()
    {
        $triangle_name = 'TriangleOne';
        $triangle_base = 3;
        $triangle_height = 5;
        $id = 1;
        $test_triangle = new Triangle($triangle_name, $triangle_base, $triangle_height, $id);
        $test_triangle->saveTriangle();

        $result = Triangle::getAll();

        $this->assertEquals([$test_triangle], $result);
    }

    function test_getAll()
    {
        $triangle_name1 = 'TriangleOne';
        $triangle_base1 = 3;
        $triangle_height1 = 5;
        $id1 = 1;
        $test_triangle1 = new Triangle($triangle_name1, $triangle_base1, $triangle_height1, $id1);
        $test_triangle1->saveTriangle();

        $triangle_name2 = 'TriangleTwo';
        $triangle_base2 = 6;
        $triangle_height2  = 10;
        $id2 = 2;
        $test_triangle2 = new Triangle($triangle_name2, $triangle_base2, $triangle_height2, $id2);
        $test_triangle2->saveTriangle();

        $result = Triangle::getAll();

        $this->assertEquals([$test_triangle1, $test_triangle2], $result);
    }

    function test_findTriangle()
    {
        $triangle_name = 'TriangleOne';
        $triangle_base = 3;
        $triangle_height = 5;
        $id = 1;
        $test_triangle = new Triangle($triangle_name, $triangle_base, $triangle_height, $id);
        $test_triangle->saveTriangle();

        $result = Triangle::findTriangle($test_triangle->getTriangleId());

        $this->assertEquals($test_triangle, $result);
    }

    function test_updateTriangle()
    {
        $triangle_name = 'TriangleOne';
        $triangle_base = 3;
        $triangle_height = 5;
        $id = 1;
        $test_triangle = new Triangle($triangle_name, $triangle_base, $triangle_height, $id);
        $test_triangle->saveTriangle();

        $new_triangle_name = 'TriangleTwo';
        $new_triangle_base = 6;
        $new_triangle_height = 10;
        $test_triangle->updateTriangle($new_triangle_name, $new_triangle_base, $new_triangle_height);

        $result = $test_triangle->getTriangleName();
        $result2 = $test_triangle->getTriangleBase();
        $result3 = $test_triangle->getTriangleHeight();

        $this->assertEquals($new_triangle_name, $result);
        $this->assertEquals($new_triangle_base, $result2);
        $this->assertEquals($new_triangle_height, $result3);
    }
}





?>

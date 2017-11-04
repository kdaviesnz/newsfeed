<?php

require_once("vendor/autoload.php");
require_once("src/INewsfeed.php");
require_once("src/Newsfeed.php");

class NewsfeedTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {

    }

    public function tearDown()
    {

    }


    public function testNewsfeed()
    {
        $newsfeed = new \kdaviesnz\newsfeed\Newsfeed();
        var_dump(json_decode($newsfeed));

    }
}

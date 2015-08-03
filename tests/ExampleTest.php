<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_if_it_displays_home_page()
    {
        $this->visit('/')
             ->see('goto.tm')
             ->see('New URL')
             ->see('URL');
    }


    public function testPost()
    {
        $this->visit('/');
    }
}

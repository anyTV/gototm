<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RedirectionTest extends TestCase
{

    protected $headers = [
        'HTTP_USER_AGENT'
            => 'Mozilla\/4.0 (compatible; MSIE 7.0; Windows Phone OS 7.0; Trident\/3.1; IEMobile\/7.0) Asus;Galaxy6"',
        ];
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

    public function test_redirect()
    {
        $this->call('GET', '/freedom');
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('https://www.freedom.tm/');
    }

    public function test_redirect_with_slash()
    {
        $this->call('GET', '/freedom/dashboard');
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('https://www.freedom.tm/dashboard');
    }

    public function test_redirect_with_port()
    {
        $this->call('GET', '/port/page');
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('https://www.freedom.tm:8000/page');
    }

    public function test_redirect_with_headers()
    {
        $this->call('GET', '/freedom',
            [], [], [], $this->headers);

        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('https://www.freedom.tm/');
    }

    public function test_not_found()
    {
        $this->call('GET', '/thereisnourl');
        $this->assertResponseStatus(404);
    }

}

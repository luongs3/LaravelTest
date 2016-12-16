<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LogoutTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLogout()
    {
        $this->assertFalse($this->assertSessionHas('use'));
        $this->assertRedirectedToRoute('users.get-login');
    }

    public function setData()
    {
        session_start();
        $_SESSION = [
            'email' => 'test5@gmail.com',
            'name' => 'test5'
        ];
    }
}

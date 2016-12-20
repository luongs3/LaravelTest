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
        $this->setData();
        $this->get('/logout')
            ->assertSessionMissing('user')
            ->assertRedirectedToRoute('users.get-login');
    }

    public function setData()
    {
        Session::put([
            'email' => 'test5@gmail.com',
            'name' => 'test5'
        ]);
    }
}

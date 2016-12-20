<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function postLogin($data)
    {
        $this->post('/login', $data)
            ->assertRedirectedToRoute('users.get-register')
            ->assertSessionHas('success', trans('messages.login_successfully'))
            ->assertSessionHas('user');
    }

    public function postLoginFail($data)
    {
        $this->post('/login', $data)
            ->assertRedirectedToRoute('users.get-register')
            ->assertSessionHas('error', trans('messages.item_not_exist'))
            ->assertSessionMissing('user');
    }

    public function testPostLogin()
    {
        $data = $this->getData();

        $this->postLogin($data[0]);
        Session::flush();
        $this->postLoginFail($data[1]);
        $this->postLoginFail($data[2]);
        $this->postLoginFail($data[3]);
    }

    public function getData()
    {
        return [
            [
                'email' => 'test1@gmail.com',
                'password' => 'test1'
            ],
            [
                'email' => 'test6@gmail.com',
                'password' => 'test5'
            ],
            [
                'email' => 'test7@gmail.com',
                'password' => ''
            ],
            [
                'email' => '',
                'password' => 'test7'
            ]
        ];
    }
}

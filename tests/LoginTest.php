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
            ->assertRedirectedToRoute('users.get-login')
            ->assertSessionHas('success', trans('messages.login_successfully'))
            ->assertSessionHas('user', $data);
    }

    public function testPostLogin()
    {
        $data = $this->getData();

        $this->postLogin($data[0]);
    }

    public function getData()
    {
        return [
            [
                'email' => 'test5@gmail.com',
                'password' => 'test4'
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

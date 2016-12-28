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
            ->assertSessionMissing('success')
            ->assertSessionMissing('user');
    }

    public function testPostLogin()
    {
        $data = $this->getData();
        $this->createFakeUserData();

        $this->postLogin($data[0]);
        Session::flush();
        $this->postLoginFail($data[1]);
        Session::flush();
        $this->postLoginFail($data[2]);
    }

    public function createFakeUserData()
    {
        \App\Models\User::insert([
            [
                'name' => 'test1',
                'email' => 'test1@gmail.com',
                'password' => bcrypt('test1'),
            ],
            [
                'name' => 'test2',
                'email' => 'test2@gmail.com',
                'password' => bcrypt('test2'),
            ]
        ]);
    }

    public function getData()
    {
        return [
            [
                'email' => 'test1@gmail.com',
                'password' => 'test1'
            ],
            [
                'email' => 'test2@gmail.com',
                'password' => 'abc54545454'
            ],
            [
                'email' => 'test1@gmail.com',
                'password' => 'test2'
            ],
        ];
    }
}

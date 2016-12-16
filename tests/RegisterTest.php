<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function postRegister($data)
    {
        $this->post('/register', $data)
            ->assertRedirectedToRoute('users.get-login')
            ->assertSessionHas('success', trans('messages.register_successfully'));
        $this->seeInDatabase('users', $data);
    }

    public function testPostRegister()
    {
        $data = $this->getData();
        $this->postRegister($data[0]);
    }

    public function getData()
    {
        return [
            [
                'name' => 'test5',
                'email' => 'test5@gmail.com',
                'password' => 'test4'
            ],
            [
                'name' => '',
                'email' => 'test5@gmail.com',
                'password' => 'test5'
            ],
            [
                'name' => 'test6',
                'email' => 'test4@gmail.com',
                'password' => ''
            ],
            [
                'name' => 'test7',
                'email' => '',
                'password' => 'test7'
            ]
        ];
    }
}

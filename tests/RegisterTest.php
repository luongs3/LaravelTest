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

    public function postRegisterFail($data)
    {
        $this->post('/register', $data)
            ->assertSessionMissing('success');
        $this->dontSeeInDatabase('users', $data);
    }

    public function testPostRegister()
    {
        $data = $this->getData();

        $this->postRegister($data[0]);
        $this->postRegisterFail($data[1]);
        $this->postRegisterFail($data[2]);
        $this->postRegisterFail($data[3]);
    }

    public function getData()
    {
        return [
            [
                'name' => 'test1',
                'email' => 'test1@gmail.com',
                'password' => 'test1'
            ],
            [
                'name' => '',
                'email' => 'test2@gmail.com',
                'password' => 'test2'
            ],
            [
                'name' => 'test3',
                'email' => 'test3@gmail.com',
                'password' => ''
            ],
            [
                'name' => 'test4',
                'email' => '',
                'password' => 'test4'
            ]
        ];
    }
}

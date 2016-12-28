<?php

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private $userRepository;
    private $user;

    public function __construct(
        $name = null,
        array $data = [],
        $dataName = ''
    )
    {
        $this->user = new \App\Models\User();
        parent::__construct($name, $data, $dataName);
    }

    public function testConstruct()
    {
        $this->userRepository = new \App\Repositories\User\UserRepository($this->user);
        $this->assertTrue($this->userRepository instanceof \App\Repositories\User\UserRepository);

        return $this->userRepository;
    }

    public function getUserByEmail($data)
    {
        $user = $this->userRepository
            ->getUserByEmail($data);

        $this->assertEquals(typeOf($this->user->find($user['id'])), typeOf($user));
    }

    public function getUserByEmailFail($data)
    {
        $user = $this->userRepository
            ->getUserByEmail($data);

        $this->assertArrayHasKey('error', $user);
    }

    /**
     * A basic test example.
     * @depends testConstruct
     * @return void
     */
    public function testGetUserByEmail($userRepository)
    {
        $this->userRepository = $userRepository;
        $data = $this->getData();
        $this->createFakeUserData();

        $this->getUserByEmail($data[0]);
        $this->getUserByEmailFail($data[1]);
        $this->getUserByEmailFail($data[2]);
        $this->getUserByEmailFail($data[3]);
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
            ],
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
                'email' => 'test3@gmail.com',
                'password' => bcrypt('test2'),
            ],
            [

            ],
        ];
    }
}

<?php

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BaseRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    private $baseRepository;
    private $user;

    public function __construct(
        $name = null,
        array $data = [],
        $dataName = ''
    )
    {
        $this->user = new \App\Models\User();
//        $this->baseRepository = $this->createMock(\App\Repositories\User\UserRepository::class);
        parent::__construct($name, $data, $dataName);
    }

    public function testConstruct()
    {
        $this->baseRepository = new \App\Repositories\BaseRepository();
        $this->baseRepository->setModel($this->user);

        return $this->baseRepository;
    }

    public function store($data)
    {
        $user = $this->baseRepository
            ->store($data);

        $this->assertArrayHasKey('email', json_decode($user, true));
    }

    public function storeFail($data)
    {
        $user = $this->baseRepository
            ->store($data);

        $this->assertArrayHasKey('error', $user);
    }

    /**
     * A basic test example.
     * @depends testConstruct
     * @return void
     */
    public function testStore($baseRepository)
    {
        $this->baseRepository = $baseRepository;
        $data = $this->getData();
        $this->store($data[0]);
        $this->storeFail($data[1]);
    }

    public function getData()
    {
        return [
            [
                'name' => 'test1',
                'email' => 'test1@gmail.com',
                'password' => bcrypt('test1'),
            ],
            [
                'name' => 'test1',
                'email' => 'test1@gmail.com',
                'password' => bcrypt('test2'),
            ]
        ];
    }
}

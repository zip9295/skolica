<?php
namespace Controller;
use Repository\User as UserRepository;
class UserController extends \Controller\BaseController
{
    private $userRepository;

    /**
     * UserController constructor.
     */
    public function __construct(UserRepository $userRepository,array $config)
    {
        $this->userRepository = $userRepository;
        parent:: __construct($config);
    }

    public function getList()
    {
        $users = $this->userRepository->getList();
        require (APP_PATH . '../templates/user/userList.phtml');
    }
}
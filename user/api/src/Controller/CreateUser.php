<?php


namespace App\Controller;


use App\Events\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateUser extends AbstractController
{
    /**
     * @var UserManager
     */
    protected $userManager;

    /**
     * CreateUser constructor.
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function __invoke($data)
    {
        return $this->userManager->registerAccount($data);
    }
}

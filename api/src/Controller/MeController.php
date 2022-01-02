<?php


namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MeController extends AbstractController
{
    private Security $security;

    private TokenStorageInterface $tokenStorage;

    public function __construct(Security $security, TokenStorageInterface  $tokenStorage){
        $this->security = $security;
        $this->tokenStorage= $tokenStorage;
    }
    /**
     * @Route(
     *     name="get_me",
     *     path="/me",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=User::class,
     *         "_api_collection_operation_name"="user_read"
     *     }
     * )
     */
    public function __invoke(Request $request) : ?User
    {
        return $this->getUser();
    }

}

<?php


namespace App\Authorizations;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Events\UserSubscriber;

class UserAuthorizationChecker
{
    private array $methodNotAllowed = [
        Request::METHOD_PUT,
        Request::METHOD_PATCH,
        Request::METHOD_DELETE
    ];
    private ?UserInterface $user;

    public function __construct(Security $security) {
        $this->user = $security->getUser();
    }

    public function check(UserInterface $user, string $method): void {
        $this->isAuthenticated();

        if($this->isMethodAllowed($method) && $user->getId() !== $this->user->getId()) {
            $errorMessage = "C'est pas à toi ça !";
            throw new UnauthorizedHttpException($errorMessage, $errorMessage);

        }
    }

    public function isAuthenticated(): void {
        if(null == $this->user) {
            $errorMessage = "Tu n'est pas connecté";
            throw new UnauthorizedHttpException($errorMessage, $errorMessage);
        }
    }

    public function isMethodAllowed(string $method): bool {
        return in_array($method, $this->methodNotAllowed, true);
    }
}

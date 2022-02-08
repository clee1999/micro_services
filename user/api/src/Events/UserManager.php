<?php


namespace App\Events;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Events\PasswordEncoderSubscriber;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var PasswordEncoderSubscriber
     */
    protected $passwordService;

    private UserPasswordEncoderInterface $encoder;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserManager constructor.
     * @param EntityManagerInterface $entityManager
     * @param PasswordEncoderSubscriber $passwordService
     * @param UserRepository $userRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        PasswordEncoderSubscriber $passwordService,
        UserRepository $userRepository, UserPasswordEncoderInterface $encoder
    ) {
        $this->em = $entityManager;
        $this->passwordService = $passwordService;
        $this->userRepository = $userRepository;
        $this->encoder = $encoder;
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function findByEmail(string $email)
    {
        $user = $this->userRepository->findByEmail($email);

        if ($user) {
            return $user[0];
        }

        return null;
    }

    /**
     * @param int $id
     */
    public function remove(int $id)
    {
        $user = $this->userRepository->find($id);

        if ($user instanceof User) {
            $user->setEmail('***********************');
            $this->em->persist($user);
            $this->em->flush();
        }
    }

    /**
     * @param User $user
     * @return array|string
     * @throws \Exception
     */
    public function registerAccount(User $user)
    {
        if ($this->findByEmail($user->getEmail())) {
            throw new BadRequestHttpException('Cette adresse email a déjà été utilisé.');
        }
        $passHash = $this->encoder->encodePassword($user, $user->getPassword());
        $user->setPassword($passHash);
        $user->getEmail();
        $this->em->persist($user);
        $this->em->flush();

        return [
            'message' => 'Création de compte enregistrée.',
            'user' => $user
        ];
    }
}

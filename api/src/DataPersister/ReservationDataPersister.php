<?php
// src/DataPersister/UserDataPersister.php

namespace App\DataPersister;

use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


/**
 *
 */
class ReservationDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var Security
     */
    private $security;
    private $_entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        Security $security,
    ) {
        $this->security = $security;
        $this->_entityManager = $entityManager;
    }


    public function supports($data, array $context = []): bool
    {
                return $data instanceof Reservation;
    }


    public function persist($data, array $context = [])
    {
        if($data instanceof Reservation && ($this->security->getUser()->getId() == $data->getPatient()->getId()))
        {
            if($data->getPatient()->getRoles()[0] != "ROLE_USER")
            {
                $errorMessage = "You're not a user";
                throw new UnauthorizedHttpException($errorMessage, $errorMessage);

            }else{
            if($data->getSlot()->getAvailable() == true)
            {
            $data->getSlot()->setAvailable(false);
            $this->_entityManager->persist($data);
            $this->_entityManager->flush();

            }else{
                $errorMessage = "Unavailable slot";
                throw new UnauthorizedHttpException($errorMessage, $errorMessage);

            }
            }

        }
          else{
            $errorMessage = "Access denied";
            throw new UnauthorizedHttpException($errorMessage, $errorMessage);
        }
        


    }

 public function remove($data, array $context = [])
    {
        $data->getSlot()->setAvailable(true);
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}
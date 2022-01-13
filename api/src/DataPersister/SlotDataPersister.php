<?php
// src/DataPersister/UserDataPersister.php

namespace App\DataPersister;

use App\Entity\TimeSlot;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;


/**
 *
 */
class SlotDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var Security
     */
    private $security;
    private $_entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        Security $security
    ) {
               $this->security = $security;
        $this->_entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof TimeSlot;
    }

    /**
     * @param TimeSlot $data
     */
    public function persist($data, array $context = [])
    {
        if($data instanceof TimeSlot)
        {
            // if($data->getDoctor()->getId() ==  $this->security->getUser()->getId()){

            // }
        }
       $this->entityManager->persist($data);
        $this->entityManager->flush();


    }

    /**
     * {@inheritdoc}
     */
    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}

<?php
// src/DataPersister/UserDataPersister.php

namespace App\DataPersister;

use App\Entity\TimeSlot;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


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
    private $decorated;

    public function __construct(
        EntityManagerInterface $entityManager,
        Security $security,
        ContextAwareDataPersisterInterface $decorated
    ) {
        $this->decorated = $decorated;
        $this->security = $security;
        $this->_entityManager = $entityManager;
    }


    public function supports($data, array $context = []): bool
    {
        return $this->decorated->supports($data, $context);
    }


    public function persist($data, array $context = [])
    {
       
        // $result = $this->decorated->persist($data, $context);
        if($data instanceof TimeSlot && ($this->security->getUser()->getId() == $data->getDoctor()->getId()))
        {
             $st = $data->getSlotStart();
            $se = $data->getSlotEnd();
            $interval = $st->diff($se);
            foreach($interval as $key=>$val)
            {
                if($key != "i" && $val != 0)
                {
                    $errorMessage = "Invalid Slots";
                    throw new UnauthorizedHttpException($errorMessage, $errorMessage);
                }
                else if($key == "i" && $val != 30)
                {
                    $errorMessage = "Invalid Slots";
                    throw new UnauthorizedHttpException($errorMessage, $errorMessage);

                }
                else{
                    $slots = $this->_entityManager->getRepository(TimeSlot::class)->findBy(['doctor' => $this->security->getUser()->getId()]);
                    foreach($slots as $val)
                    {
                        if($st->format('Y-m-d H:i') == $val->getSlotStart()->format('Y-m-d H:i') && $val != $data)
                        {
                            $errorMessage = "Slot already set";
                            throw new UnauthorizedHttpException($errorMessage, $errorMessage);
                        }
                    }
                    $this->_entityManager->persist($data);
                    $this->_entityManager->flush();
                }
            }

        }
      



    }

 public function remove($data, array $context = [])
    {
        return $this->decorated->remove($data, $context);
    }
}

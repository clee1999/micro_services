<?php
// api/src/Controller/CreateAvatarAction.php

namespace App\Controller;

use App\Entity\Avatar;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final class CreateAvatarAction extends AbstractController
{
    public function __invoke(Request $request): Avatar
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $avatar = new Avatar();
        $avatar->file = $uploadedFile;

        return $avatar;
    }
}

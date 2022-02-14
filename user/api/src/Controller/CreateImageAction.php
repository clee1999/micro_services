<?php
// api/src/Controller/CreateImageAction.php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class CreateImageAction
{
    public function __invoke(Request $request)
    {
        $user = $request->attributes->get('data');
        if (!($user instanceof User)) {
            throw new \RuntimeException('Utilisateur non renseigné');
        }
        $file = $request->files->get('file');
        $user->setFile($request->files->get('file'));
        return $user;
    }
}

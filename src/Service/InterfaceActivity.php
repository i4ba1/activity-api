<?php

namespace App\Service;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

interface InterfaceActivity
{
    public function createActivity(Request $activityDTO, ObjectManager $entityManager): ?int;
}
<?php

namespace App\Service;

use App\DTO\ActivityDTO;
use App\Entity\Activity;
use App\Util\DateUtil;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;


class ActivityService implements InterfaceActivity
{
    public function createActivity(Request $activityDTO, ObjectManager $entityManager): ?int
    {

        try {
            $activity = new Activity();
            //echo "name=====> ".$activityDTO->get("name");
            $activity->setName($activityDTO->get("name"));
            $activity->setCreatedAt(DateUtil::dateTimeWithTimeZone());
            $activity->setUpdatedAt(DateUtil::dateTimeWithTimeZone());// tell Doctrine you want to (eventually) save the Product (no queries yet)

            $entityManager->persist($activity);// actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
            return $activity->getId();
        } catch (OptimisticLockException $e) {
            echo("OptimisticLockException on createActivity=======> " . $e->getTraceAsString());
        } catch (ORMException $e) {
            echo("ORMException on createActivity=======> " . $e->getTraceAsString());
        }
        return null;
    }
}
<?php

namespace App\Controller;

use App\Service\ActivityService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/activity/v1', name: 'create_activity')]
class ActivityController extends AbstractController
{
    private ActivityService $activityService;

    public function __construct(ActivityService $activityService){
        $this->activityService = $activityService;
    }

    #[Route('/createActivity', name: 'create_activity', methods: 'POST')]
    public function createActivity(Request $activityDTO, EntityManagerInterface $entityManager): JsonResponse
    {
        $result = $this->activityService->createActivity($activityDTO, $entityManager);
        if($result){
            return $this->json([
                'message' => 'Successfully create a new activity!',
                'status' => Response::HTTP_OK,
                'data' => $result
            ]);
        }

        return $this->json([
            'message' => 'Failed to create a new activity!',
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'data' => null
        ]);
    }
}
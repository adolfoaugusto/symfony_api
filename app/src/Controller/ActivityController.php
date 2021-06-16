<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Repository\ActivityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActivityController extends AbstractController
{
    protected $activity;

    public function __construct(ActivityRepository $activity)
    {
        $this->activity = $activity;
    }

    /**
     * @Route("/activities", name="activities")
     */
    public function index(): Response
    {
        return $this->json([
            'data' => $this->activity->findAll(),
        ]);
    }

    /**
     * @Route("/activity/create", name="activity.create")
     */
    public function create(Request $request)
    {
        $serializer = $ths->get('serializer');

        $activity = $serializer->deserialize($request->getContent(), Activity::class, 'json');

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($activity);
        $manager->flush();

        return $this->json($activity);
    }
}

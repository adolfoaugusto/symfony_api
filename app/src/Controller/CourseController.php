<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Course;

/**
 * @Route("/courses", name="course_")
 */
class CourseController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        $courses = $this->getDoctrine()->getRepository(Course::class)->findAll();

        return $this->json([
            'data' => $courses,
        ]);
    }
    
    /**
     * @Route("/{courseId}", name="show", methods={"GET"})
     */
    public function show($courseId): Response
    {
        return $this->json([
            'data' => $this->getDoctrine()->getRepository(Course::class)->find($courseId),
        ]);
    }

    /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $data = $request->request->all();

        $course = new Course();
        
        $course->setName($data['name']);
        $course->setDescription($data['description']);
        $course->setSlug($data['slug']);
        $course->setCreatedAt(new \DateTime('now', new \DateTimezone('America/Sao_Paulo')));
        $course->setUpdatedAt(new \DateTime('now', new \DateTimezone('America/Sao_Paulo')));
        $doctrine = $this->getDoctrine()->getManager();

        $doctrine->persist($course);
        $doctrine->flush();

        return $this->json([
            'data' => 'Json criado com sucesso!'
        ]);
    }

    /**
     * @Route("/{courseId}", name="update", methods={"PUT", "PATCH"})
     */
    public function update($courseId, Request $request): Response
    {
        $data = $request->request->all();

        $course = $this->getDoctrine()->getRepository(Course::class)->find($courseId);
        
        if($request->request->has('name'))
            $course->setName($data['name']);
        if($request->request->has('description'))
            $course->setDescription($data['description']);
        if($request->request->has('slug'))
            $course->setSlug($data['slug']);
        
        $course->setUpdatedAt(new \DateTime('now', new \DateTimezone('America/Sao_Paulo')));
        
        $doctrine = $this->getDoctrine()->getManager();

        $doctrine->flush();

        return $this->json([
            'data' => 'Json Atualizado com sucesso!'
        ]);
    }

    /**
     * @Route("/{courseId}", name="delete", methods={"DELETE"})
     */
    public function delete($courseId): Response
    {
        $course = $this->getDoctrine()->getRepository(Course::class)->find($courseId);

        $manager = $this->getDoctrine()->getManager();

        $manager->remove($course);
        $manager->flush();

        return $this->json([
            'data' => 'Deletado com sucesso',
        ]);
    }

}

<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    /**
     * @Route("/categories", name="categories")
     */
    public function index(): Response
    {
        return $this->json([
            'data' => $this->category->findAll(),
        ]);
    }

    /**
     * @Route("/category/create", name="category.create")
     */
    public function create(Request $request)
    {
        $serializer = $ths->get('serializer');

        $category = $serializer->deserialize($request->getContent(), Category::class, 'json');

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($category);
        $manager->flush();

        return $this->json($category);
    }
}

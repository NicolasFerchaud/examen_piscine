<?php


namespace App\Controller\Front\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;

class FairePartController extends AbstractController
{
    /**
     * @Route("/faire_part/wedding", name="public/faire_part/wedding")
     */
    public function FairePartWedding(ProductRepository $productRepository)
    {
        $wedding = $productRepository->findBy(
            ['category' => 92]
        );

        return $this->render('Public/faire_part/wedding.html.twig',[
            'faire_parts' => $wedding,
            'current_menu' => 'faire_part'
        ]);
    }

    /**
     * @Route("/faire_part/birth", name="public/faire_part/birth")
     */
    public function FairePartBirth(ProductRepository $productRepository)
    {
        $birth = $productRepository->findBy(
            ['category' => 93]
        );

        return $this->render('Public/faire_part/birth.html.twig',[
            'faire_parts' => $birth,
            'current_menu' => 'faire_part'
        ]);
    }

    /**
     * @Route("/faire_part/baptism", name="public/faire_part/baptism")
     */
    public function FairePartBaptism(ProductRepository $productRepository)
    {
        $baptism = $productRepository->findBy(
            ['category' => 94]
        );

        return $this->render('Public/faire_part/baptism.html.twig',[
            'faire_parts' => $baptism,
            'current_menu' => 'faire_part'
        ]);
    }

    /**
     * @Route("/faire_part/{id}", name="public/faire_part/show")
     */
    public function show($id, ProductRepository $productRepository)
    {
        $detail = $productRepository->find($id);
        return $this->render('Public/faire_part/detail.html.twig',[
            'faire_part' => $detail,
            'current_menu' => 'faire_part'
        ]);
    }
}
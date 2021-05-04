<?php


namespace App\Controller\Front\Product;


use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SupportEntrepriseController extends AbstractController
{
    /**
     * @Route("/support_entreprise/planches_tarifaire", name="public/support_entreprise/planches_tarifaire")
     */
    public function Planches_tarifaire(ProductRepository $productRepository)
    {
        $planche = $productRepository->findBy(
            ['category' => 108]
        );

        return $this->render('Public/support_entreprise/planches_tarifaire.html.twig',[
            'support_entreprise' => $planche,
            'current_menu' => 'support_entreprise'
        ]);
    }

    /**
     * @Route("/support_entreprise/carte_de_visite", name="public/support_entreprise/carte_de_visite")
     */
    public function Carte_visite(ProductRepository $productRepository)
    {
        $carte = $productRepository->findBy(
            ['category' => 109]
        );

        return $this->render('Public/support_entreprise/carte_de_visite.html.twig',[
            'support_entreprise' => $carte,
            'current_menu' => 'support_entreprise'
        ]);
    }

    /**
     * @Route("/support_entreprise/annonces_publicitaire", name="public/support_entreprise/annonces_publicitaire")
     */
    public function Annonces_publicitaire(ProductRepository $productRepository)
    {
        $annonce = $productRepository->findBy(
            ['category' => 110]
        );

        return $this->render('Public/support_entreprise/annonces_publicitaire.html.twig',[
            'support_entreprise' => $annonce,
            'current_menu' => 'support_entreprise'
        ]);
    }

    /**
     * @Route("/support_entreprise/flyers", name="public/support_entreprise/flyers")
     */
    public function Flyers(ProductRepository $productRepository)
    {
        $flyer = $productRepository->findBy(
            ['category' => 111]
        );

        return $this->render('Public/support_entreprise/flyers.html.twig',[
            'support_entreprise' => $flyer,
            'current_menu' => 'support_entreprise'
        ]);
    }

    /**
     * @Route("/support_entreprise/{id}", name="public/support_entreprise/show")
     */
    public function show($id, ProductRepository $productRepository)
    {
        $detail = $productRepository->find($id);
        return $this->render('Public/support_entreprise/detail.html.twig',[
            'support_entreprise' => $detail,
            'current_menu' => 'support_entreprise'
        ]);
    }
}
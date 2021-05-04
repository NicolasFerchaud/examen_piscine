<?php


namespace App\Controller\Front\Product;


use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarteController extends AbstractController
{
    /**
     * @Route("/cartes/anniversaire", name="public/cartes/anniversaire")
     */
    public function Anniversaire(ProductRepository $productRepository)
    {
        $anniversaire = $productRepository->findBy(
            ['category' => 112]
        );

        return $this->render('Public/cartes/anniversaire.html.twig',[
            'cartes' => $anniversaire,
            'current_menu' => 'cartes'
        ]);
    }

    /**
     * @Route("/cartes/babyshower", name="public/cartes/babyshower")
     */
    public function Babyshower(ProductRepository $productRepository)
    {
        $babyshower = $productRepository->findBy(
            ['category' => 113]
        );

        return $this->render('Public/cartes/babyshower.html.twig',[
            'cartes' => $babyshower,
            'current_menu' => 'cartes'
        ]);
    }

    /**
     * @Route("/cartes/noel", name="public/cartes/noel")
     */
    public function Noël(ProductRepository $productRepository)
    {
        $noel = $productRepository->findBy(
            ['category' => 114]
        );

        return $this->render('Public/cartes/noel.html.twig',[
            'cartes' => $noel,
            'current_menu' => 'cartes'
        ]);
    }

    /**
     * @Route("/cartes/nouvel_an", name="public/cartes/nouvel_an")
     */
    public function Nouvel_an(ProductRepository $productRepository)
    {
        $nouvel_an = $productRepository->findBy(
            ['category' => 115]
        );

        return $this->render('Public/cartes/nouvel_an.html.twig',[
            'cartes' => $nouvel_an,
            'current_menu' => 'cartes'
        ]);
    }

    /**
     * @Route("/cartes/felicitation", name="public/cartes/felicitation")
     */
    public function Felicitation(ProductRepository $productRepository)
    {
        $felicitation = $productRepository->findBy(
            ['category' => 116]
        );

        return $this->render('Public/cartes/felicitation.html.twig',[
            'cartes' => $felicitation,
            'current_menu' => 'cartes'
        ]);
    }

    /**
     * @Route("/cartes/remerciement", name="public/cartes/remerciement")
     */
    public function Remerciement(ProductRepository $productRepository)
    {
        $remerciement = $productRepository->findBy(
            ['category' => 117]
        );

        return $this->render('Public/cartes/remerciement.html.twig',[
            'cartes' => $remerciement,
            'current_menu' => 'cartes'
        ]);
    }

    /**
     * @Route("/cartes/{id}", name="public/cartes/show")
     */
    public function show($id, ProductRepository $productRepository)
    {
        $detail = $productRepository->find($id);
        return $this->render('Public/cartes/detail.html.twig',[
            'cartes' => $detail,
            'current_menu' => 'cartes'
        ]);
    }
}
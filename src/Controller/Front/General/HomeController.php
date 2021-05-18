<?php


namespace App\Controller\Front\General;


use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function accueil(ProductRepository $productRepository)//ArticleRepository est une class instanciée dans la methode accueil
    {
        $products = $productRepository->findBy(//récupère tous les éléments de la table en fonction de certain paramètre (requête native)
            ['id' => true],
            ['id' => 'DESC'],
            2
        );
        return $this->render('Public/home.html.twig',[//fait un rendu de homeController .twig en .html pour être lu par le navigateur
            'products'=> $products//je créé une variable qui à pour valeur le contenu de $products
        ]);
    }
}
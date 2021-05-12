<?php


namespace App\Controller\Front\General;



use App\Repository\ArticleRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search/product", name="search")
     */
    public function search(Request $request, ProductRepository $productRepository)
    {
        // je récupère la valeur du parametre d'url "search" envoyé depuis le formulaire
        $search = $request->query->get('search');
        // je créé une requête en bdd pour récupérer les articles dont le contenu est similaire à la valeur de $search
        $research = $productRepository->searchByTerm($search);

        //je return le tout à ma page search_articles
        return $this->render('Public/search.html.twig',[
            'search' => $research
        ]);
    }

    /**
     * @Route("product/{id}", name="product")
     */
    public function article(ProductRepository $productRepository, $id)//ArticleRepository est une class instanciée dans la methode accueil + wildcard
    {
        $product = $productRepository->find($id);//recupère un éléments de la table grace à son id (requête native)
        return $this->render('Public/product/show.html.twig',[//fait un rendu de homeController .twig en .html pour être lu par le navigateur
            'product' => $product//je créé une variable qui à pour valeur le contenu de $articles
        ]);
    }
}
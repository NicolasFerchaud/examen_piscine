<?php


namespace App\Controller\Front\Product;


use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlbumNaissanceController extends AbstractController
{
    /**
     * @Route("/album_naissance/unique", name="album_naissance_unique")
     */
    public function AlbumNaissanceUnique(ProductRepository $productRepository)
    {
        $naissanceU = $productRepository->findBy(
            ['category' => 98]
        );

        return $this->render('Public/album_naissance/unique.html.twig',[
            'naissances' => $naissanceU,
            'current_menu' => 'album_naissance'
        ]);
    }

    /**
     * @Route("/album_naissance/gemellaire", name="album_naissance_gemellaire")
     */
    public function AlbumNaissanceGemellaire(ProductRepository $productRepository)
    {
        $naissanceG = $productRepository->findBy(
            ['category' => 99]
        );

        return $this->render('Public/album_naissance/gemellaire.html.twig',[
            'naissances' => $naissanceG,
            'current_menu' => 'album_naissance'
        ]);
    }

    /**
     * @Route("/album_naissance/{id}", name="public/album_naissance/show")
     */
    public function show($id, ProductRepository $productRepository)
    {
        $detail = $productRepository->find($id);
        return $this->render('Public/album_naissance/detail.html.twig',[
            'naissances' => $detail,
            'current_menu' => 'album_naissance'
        ]);
    }
}
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

        return $this->render('Public/album_grossesse/unique.html.twig',[
            'faire_parts' => $grosesseU,
            'current_menu' => 'album_grossesse'
        ]);
    }

    /**
     * @Route("/album_grossesse/gemellaire", name="album_grossesse_gemellaire")
     */
    public function AlbumGrossesseGemellaire(ProductRepository $productRepository)
    {
        $grosesseG = $productRepository->findBy(
            ['category' => 97]
        );

        return $this->render('Public/album_grossesse/gemellaire.html.twig',[
            'faire_parts' => $grosesseG,
            'current_menu' => 'album_grossesse'
        ]);
    }

    /**
     * @Route("/album_grossese/{id}", name="public/album_grossesse/show")
     */
    public function show($id, ProductRepository $productRepository)
    {
        $detail = $productRepository->find($id);
        return $this->render('Public/album_grossesse/detail.html.twig',[
            'faire_part' => $detail,
            'current_menu' => 'album_grossesse'
        ]);
    }
}
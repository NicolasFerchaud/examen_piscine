<?php


namespace App\Controller\Front\Product;


use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AlbumGrossesseController extends AbstractController
{
    /**
     * @Route("/album_grossesse/unique", name="album_grossesse_unique")
     */
    public function AlbumGrossesseUnique(ProductRepository $productRepository)
    {
        $grosesseU = $productRepository->findBy(
            ['category' => 96]
        );

        return $this->render('Public/album_grossesse/unique.html.twig',[
            'grossesses' => $grosesseU,
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
            'grossesses' => $grosesseG,
            'current_menu' => 'album_grossesse'
        ]);
    }

    /**
     * @Route("/album_grossesse/{id}", name="public/album_grossesse/show")
     */
    public function show($id, ProductRepository $productRepository)
    {
        $detail = $productRepository->find($id);
        return $this->render('Public/album_grossesse/detail.html.twig',[
            'grossesses' => $detail,
            'current_menu' => 'album_grossesse'
        ]);
    }
}
<?php


namespace App\Controller\Front\Product;


use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ImpressionPhotoController extends AbstractController
{
    /**
     * @Route("/impression_photo/photo", name="public/impression_photo/photo")
     */
    public function Photo(ProductRepository $productRepository)
    {
        $photo = $productRepository->findBy(
            ['category' => 100]
        );

        return $this->render('Public/impression_photo/photo.html.twig',[
            'impression_photos' => $photo,
            'current_menu' => 'impression_photo'
        ]);
    }

    /**
     * @Route("/impression_photo/poster", name="public/impression_photo/poster")
     */
    public function Poster(ProductRepository $productRepository)
    {
        $poster = $productRepository->findBy(
            ['category' => 101]
        );

        return $this->render('Public/impression_photo/poster.html.twig',[
            'impression_photos' => $poster,
            'current_menu' => 'impression_photo'
        ]);
    }

    /**
     * @Route("/impression_photo/boule", name="public/impression_photo/boule")
     */
    public function Boule(ProductRepository $productRepository)
    {
        $boule = $productRepository->findBy(
            ['category' => 102]
        );

        return $this->render('Public/impression_photo/boule.html.twig',[
            'impression_photos' => $boule,
            'current_menu' => 'impression_photo'
        ]);
    }

    /**
     * @Route("/impression_photo/hexagone", name="public/impression_photo/hexagone")
     */
    public function Hexagone(ProductRepository $productRepository)
    {
        $hexagone = $productRepository->findBy(
            ['category' => 103]
        );

        return $this->render('Public/impression_photo/hexagone.html.twig',[
            'impression_photos' => $hexagone,
            'current_menu' => 'impression_photo'
        ]);
    }

    /**
     * @Route("/impression_photo/{id}", name="public/impression_photo/show")
     */
    public function show($id, ProductRepository $productRepository)
    {
        $detail = $productRepository->find($id);
        return $this->render('Public/impression_photo/detail.html.twig',[
            'impression_photos' => $detail,
            'current_menu' => 'impression_photo'
        ]);
    }
}
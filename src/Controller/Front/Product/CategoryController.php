<?php


namespace App\Controller\Front\Product;

use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route ("/categories/list", name="public/categories/list")
     */
    public function categoryList(categoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findBy(
            array("parent" => null)
        );

        return $this->render('Public/Category/categoryList.html.twig', [
            'categoryList' => $categories
        ]);
    }
}
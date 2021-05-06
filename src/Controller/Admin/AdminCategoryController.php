<?php


namespace App\Controller\Admin;


use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminCategoryController extends AbstractController
{
    /**
     * @Route ("/admin/categoryList", name="categoryList")
     */
    public function categoryList(categoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findBy(
            array("parent" => null)
        );

        return $this->render('Admin/Category/categoryList.html.twig',[
            'categoryList' => $categories,
            'current_menu' => 'categories'
        ]);
    }

    /**
     * @Route ("/admin/categoryInsert", name="categoryInsert")
     */
    public function categoryInsert(
        EntityManagerInterface $entityManager,
        Request $request
    )
    {
        $category = new Category();
        $categoryForm = $this->createForm(CategoryType::class, $category);
        $categoryForm->handleRequest($request);
        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $category = $categoryForm->getData();

            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash("success", "La catégorie " . $category->getName() . " à bien était créée");
            return $this->redirectToRoute('categoryList');
        }
        return $this->render('Admin/Category/categoryInsert.html.twig',[
           'categoryInsert' => $categoryForm->createView(),
            'current_menu' => 'categories'
        ]);
    }

    /**
     * @Route ("/admin/categoryUpdate/{id}", name="categoryUpdate")
     */
    public function categoryUpdate(
        categoryRepository $categoryRepository,
        EntityManagerInterface $entityManager,
        Request $request,
        $id
        )
    {
        $category = $categoryRepository->find($id);
        if (is_null($category)) {
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        $categoryForm = $this->createForm(CategoryType::class, $category);
        $categoryForm->handleRequest($request);
        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $category = $categoryForm->getData();

            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash("success", "La catégorie " . $category->getName() . " à bien était modifiée");
            return $this->redirectToRoute('categoryList');
        }
        return $this->render('Admin/Category/categoryUpdate.html.twig',[
            'categoryUpdate' => $categoryForm->createView(),
            'current_menu' => 'categories'
        ]);
    }

    /**
     * @Route("/admin/categoryDelete/{id}", name="categoryDelete")
     */
    public function categoryDelete(
        categoryRepository $categoryRepository,
        EntityManagerInterface $entityManager,
        $id
    )
    {
       $category = $categoryRepository->find($id);
       if (is_null($category)){
           throw $this->createNotFoundException('Catégorie non trouvée');
       }
       $entityManager->remove($category);
       $entityManager->flush();

        $this->addFlash("success", "La catégorie " . $category->getName() . " à bien était supprimée");
        return $this->redirectToRoute('categoryList');
    }
}
<?php


namespace App\Controller\Admin;


use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminProductController extends AbstractController
{
    /**
     * @Route ("/admin/productList", name="productList")
     */
    public function productList(productRepository $productRepository)
    {
        $productList = $productRepository->findAll();

        return $this->render('Admin/Product/productList.html.twig',[
            'productList' => $productList,
            'current_menu' => 'products'
        ]);
    }

    /**
     * @Route ("/admin/productInsert", name="productInsert")
     */
    public function productInsert(
        EntityManagerInterface $entityManager,
        Request $request
    )
    {
        $product = new Product();
        $productForm = $this->createForm(ProductType::class, $product);
        $productForm->handleRequest($request);
        if ($productForm->isSubmitted() && $productForm->isValid()) {
            $product = $productForm->getData();

            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash("success", "Le produit " . $product->getName() . " à bien était créé");
            return $this->redirectToRoute('productList');
        }
        return $this->render('Admin/Product/productInsert.html.twig',[
            'productInsert' => $productForm->createView()
        ]);
    }

    /**
     * @Route ("/admin/productUpdate/{id}", name="productUpdate")
     */
    public function productUpdate(
        productRepository $productRepository,
        EntityManagerInterface $entityManager,
        Request $request,
        $id
    )
    {
        $product = $productRepository->find($id);
        if (is_null($product)) {
            throw $this->createNotFoundException('Produit non trouvé');
        }

        $productForm = $this->createForm(ProductType::class, $product);
        $productForm->handleRequest($request);
        if ($productForm->isSubmitted() && $productForm->isValid()) {
            $product = $productForm->getData();

            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash("success", "Le produit " . $product->getName() . " à bien était modifié");
            return $this->redirectToRoute('productList');
        }
        return $this->render('Admin/Product/productUpdate.html.twig',[
            'productUpdate' => $productForm->createView()
        ]);
    }

    /**
     * @Route("/admin/productDelete/{id}", name="productDelete")
     */
    public function productDelete(
        productRepository $productRepository,
        EntityManagerInterface $entityManager,
        $id
    )
    {
        $product = $productRepository->find($id);
        if (is_null($product)){
            throw $this->createNotFoundException('Produit non trouvé');
        }
        $entityManager->remove($product);
        $entityManager->flush();

        $this->addFlash("success", "Le produit " . $product->getName() . " à bien était supprimé");
        return $this->redirectToRoute('productList');
    }
}
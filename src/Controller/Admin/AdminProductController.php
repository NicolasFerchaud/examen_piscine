<?php


namespace App\Controller\Admin;


use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;

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
        SluggerInterface $slugger,
        Request $request
    )
    {
        $product = new Product();
        $productForm = $this->createForm(ProductType::class, $product);
        $productForm->handleRequest($request);
        if ($productForm->isSubmitted() && $productForm->isValid()) {
            $product = $productForm->getData();

            //je récupère les donnée de mon images
            $imageFile = $productForm->get('media')->getData();
            //si j'ai une image
            if ($imageFile) {
                //$imageFilename est un chemin vers le dossier temporaire de l'image
                //je récupère son nom d'origine
                $originalImage = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                //J'enlève les caractère spéciaux avec slug et je la renomme de facon unique grace à une extension
                $safeFilename = $slugger->slug($originalImage);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                try {//vérifie que tout ce passe bien (image bien renommé, bien déplacé etc...)
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {//sinon on retourne une erreur
                    throw $this->createNotFoundException("erreur lors de l'envoi de l'image");
                }
                //j'enregistre mon image avec le nouveau nom dans une variable
                $product->setMedia($newFilename);

            }

            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash("success", "Le produit " . $product->getName() . " à bien était créé");
            return $this->redirectToRoute('productList');
        }
        return $this->render('Admin/Product/productInsert.html.twig',[
            'productInsert' => $productForm->createView(),
            'current_menu' => 'products'
        ]);
    }

    /**
     * @Route ("/admin/productUpdate/{id}", name="productUpdate")
     */
    public function productUpdate(
        productRepository $productRepository,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger,
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

            //récupère les images
            $imageFile = $productForm->get('media')->getData();
            //Si j'ai une image je récupère son nom d'origine
            if ($imageFile) {
                $originalImage = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                //J'enlève les caractère spéciaux avec slug et je la renomme de facon unique grace à une extension
                $safeFilename = $slugger->slug($originalImage);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                try {//vérifie que tout ce passe bien
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {//sinon on retourne une erreur
                    throw $this->createNotFoundException("erreur lors de l'envoi de l'image");
                }

                $product->setMedia($newFilename);

            }

            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash("success", "Le produit " . $product->getName() . " à bien était modifié");
            return $this->redirectToRoute('productList');
        }
        return $this->render('Admin/Product/productUpdate.html.twig',[
            'productUpdate' => $productForm->createView(),
            'current_menu' => 'products'
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
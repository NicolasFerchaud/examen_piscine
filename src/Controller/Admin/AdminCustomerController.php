<?php


namespace App\Controller\Admin;


use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminCustomerController extends AbstractController
{
    /**
     * @Route ("/admin/customerList", name="customerList")
     */
    public function customerList(customerRepository $customerRepository)
    {
        $customerList = $customerRepository->findAll();

        return $this->render('Admin/Customer/customerList.html.twig',[
            'customerList' => $customerList
        ]);
    }

    /**
     * @Route ("/admin/customerInsert", name="customerInsert")
     */
    public function customerInsert(
        EntityManagerInterface $entityManager,
        Request $request
    )
    {
        $customer = new Customer();
        $customerForm = $this->createForm(CustomerType::class, $customer);
        $customerForm->handleRequest($request);
        if ($customerForm->isSubmitted() && $customerForm->isValid()) {
            $customer = $customerForm->getData();

            $entityManager->persist($customer);
            $entityManager->flush();

            $this->addFlash("success", "L'utilisateur " . $customer->getName() . " à bien était créé");
            return $this->redirectToRoute('customerList');
        }
        return $this->render('Admin/Customer/customerInsert.html.twig',[
            'customerInsert' => $customerForm->createView()
        ]);
    }

    /**
     * @Route ("/admin/customerUpdate/{id}", name="customerUpdate")
     */
    public function customerUpdate(
        customerRepository $customerRepository,
        EntityManagerInterface $entityManager,
        Request $request,
        $id
    )
    {
        $customer = $customerRepository->find($id);
        if (is_null($customer)) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }

        $customerForm = $this->createForm(CustomerType::class, $customer);
        $customerForm->handleRequest($request);
        if ($customerForm->isSubmitted() && $customerForm->isValid()) {
            $customer = $customerForm->getData();

            $entityManager->persist($customer);
            $entityManager->flush();

            $this->addFlash("success", "L'utilisateur " . $customer->getName() . " à bien était modifié");
            return $this->redirectToRoute('customerList');
        }
        return $this->render('Admin/Customer/customerUpdate.html.twig',[
            'customerInsert' => $customerForm->createView()
        ]);
    }

    /**
     * @Route("/admin/customerDelete/{id}", name="customerDelete")
     */
    public function customerDelete(
        customerRepository $customerRepository,
        EntityManagerInterface $entityManager,
        $id
    )
    {
        $customer = $customerRepository->find($id);
        if (is_null($customer)){
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }
        $entityManager->remove($customer);
        $entityManager->flush();

        $this->addFlash("success", "L'utilisateur " . $customer->getName() . " à bien était supprimé");
        return $this->redirectToRoute('customerList');
    }
}
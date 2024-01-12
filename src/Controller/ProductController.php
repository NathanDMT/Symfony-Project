<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    /** Contrôleur qui sert une page contenant la liste de tous les produits */
    #[Route(path: '/product/show-all', name: 'product_show_all')]
    public function showAll(ProductRepository $productRepository): Response
    {

        // Récupérer tous les produits de la bdd

        $products = $productRepository->findAll();

        // Construire une page HTML avec les produits récupérés

        // Retourner la page
    return $this->render('product/product_show_all.html.twig',['products'=>$products]);
    }

    #[Route(path: '/product/show/{id}', name: 'product_show', requirements: ['id'=>'\d+'])]
    public function show(int $id, ProductRepository $productRepository) : Response
    {
        // Récupération de l'id passé au contrôleur
        $product = $productRepository->find($id);

        if(null === $product) {
            throw new NotFoundHttpException('Ce produit n\'existe pas');
        }

        // Construction de la page HTML avec le produit
        return $this->render('product/product_show.html.twig', [
            'product'=>$product
        ]);
    }

    /**
     * Recherche des produits à partir d'un mot clef
     * @return Response
     */
    #[Route('/product/search', name: 'product_search', methods:['POST'])]
    public function searchProduct(Request $request, ProductRepository $productRepository): Response {
        $keywordSearch = $request->request->get('searchProduct');
        $products = $productRepository->search($keywordSearch);
        return $this->render('product/product_show_all.html.twig', ['products'=>$products]);
    }
}
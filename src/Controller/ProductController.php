<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AbstractAdapter;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    /** Contrôleur qui sert une page contenant la liste de tous les produits */
    #[Route(path: '/product/show-all', name: 'product_show_all')]
    public function showAll(ProductRepository $productRepository){

        // Récupérer tous les produits de la bdd

        $products = $productRepository->findAll();

        // Construire une page HTML avec les produits récupérés

        // Retourner la page
    return $this->render('base.html.twig',['products'=>$products]);
    }

}
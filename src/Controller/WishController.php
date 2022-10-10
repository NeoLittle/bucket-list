<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish", name="wish_list")
     */
    public function list():Response{
        return $this->render('wish/list.html.twig');
    }
    /**
     * @Route("/wish/details/{id}", name="wish_details")
     */
    public function details(int $id):Response{
        return $this->render('wish/details.html.twig');
    }
    public function create(Request $request):Response{
        $wish = new Wish();
        $wishform = $this->createForm(WishType::class, $wish);
        //Todo: Faire la page Create (pas le mod minecraft)

        return $this->render('');
    }
}
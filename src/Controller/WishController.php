<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;

use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wish", name="wish_")
 */
class WishController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function list(WishRepository $wishRepository):Response{
        $wishes = $wishRepository -> findBy(['isPublished'=>true],['dateCreated'=>'DESC']);

        return $this->render('wish/list.html.twig',["wishes"=>$wishes]);
    }
    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(int $id, WishRepository $wishRepository):Response{
        $wish=$wishRepository->find($id);

        if (!$wish){
            throw $this->createNotFoundException('Error, Data not found');
        }

        return $this->render('wish/details.html.twig');
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager):Response{
        $wish = new Wish();

        $wish->setTitle('');
        $wish->setDescription('');
        $wish->setAuthor('');
        $wish->setIsPublished('');
        $wish->setDateCreated(new \DateTime());

        $entityManager->persist($wish);
        $entityManager->flush();

        $wishForm = $this->createForm(WishType::class, $wish);

        $wishForm->handleRequest($request);

        if($wishForm->isSubmitted()&&$wishForm->isValid()){

            $entityManager->persist($wish);
            $entityManager->flush();

            $this->addFlash('success', 'Moi, Shenron, a entendu votre Souhait !');

            return $this->redirectToRoute('main_home');
        }

        return $this->render('wish/create.html.twig', [
            'wishForm' => $wishForm->createView()
        ]);
    }

}
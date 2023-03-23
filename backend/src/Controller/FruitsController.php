<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Fruits;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class FruitsController extends AbstractController
{
    /**
     * @Route("/fruits", name="app_fruits", methods={"GET"})
     */
    public function index(ManagerRegistry $doctrine): Response
    {

        $products = $doctrine
            ->getRepository(Fruits::class)
            ->findAll();
  
        $data = [];
  
        foreach ($products as $product) {
           $data[] = $product;
        }
  
  
        return $this->json($data);
        // return $this->render('fruits/index.html.twig', [
        //     'controller_name' => 'FruitsController',
        // ]);
    }
    /**
     * @Route("/fruits/addfavorites", name="app_add_favorite", methods={"POST"})
     */

    public function addfavorites(Request $request, MailerInterface $mailer): Response
    {   
        $data = json_decode($request->getContent(), true);
        $id = $data['id'];
        $favorite = $data['favorite'];
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
            FROM App\Entity\Fruits p
            WHERE p.favorite = 1
            ORDER BY p.id ASC'
        );
         if(count($query->getResult()) < 10){
            $fruits = $em->getRepository(Fruits::class)->find($id);
            if (!$fruits) {
                throw $this->createNotFoundException(
                    'No fruit found for id '.$id
                );
            }
            $fruits->setFavorite($favorite);
            $em->flush();

            if($favorite == 1){
                $email = (new Email())
                ->from('udeshrathour7@gmail.com')
                ->to('fullstackdeveloper44@gmail.com')
                ->subject('Favorite Fruit Added!')
                ->text('Hi')
                ->html('<p>A New Fruit is added into your Favorite List!</p>');

                $mailer->send($email);
            }
            return $this->json(array("data"=>"Done"));
        }else{
            return $this->json(array("data"=>"You can only add 10 fruits to your faqvorite list."));
        }
        
    }

    /**
     * @Route("/fruits/getfavorites", name="app_get_favorite", methods={"GET"})
     */

     public function getfavorites(ManagerRegistry $doctrine): Response
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
            FROM App\Entity\Fruits p
            WHERE p.favorite = 1
            ORDER BY p.id ASC'
        );
        return $this->json($query->getResult());

    }
}

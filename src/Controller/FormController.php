<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 24/03/2019
 * Time: 23:28
 */

namespace App\Controller;


use App\Entity\Contact;
use App\Entity\Personne;
use App\Entity\Departement;
use App\Repository\PersonneRepository;
use App\Form\ContactType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormTypeInterface;

class FormController extends AbstractController
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        //verifications
        if ($form->isSubmitted() && $form->isValid()
            && ($form->get('nom')->isEmpty()==false)
            && ($form->get('prenom')->isEmpty()==false)
            && ($form->get('mail')->isEmpty()==false )
            && ($form->get('message')->isEmpty()==false ))
        {
            $personne = $this->getDoctrine()
                            ->getRepository(Personne::class)->findRespDep($form->get('departement')->getData());


        //Envoie du mail
           $message= (new \Swift_Message('Hello'))->setFrom($personne->getMail())
                ->setTo($personne->getMail())->setBody("Message de : ".$form->get('prenom')->getData()." "
                   .$form->get('nom')->getData()."\n email : "
                   .$form->get('mail')->getData().
                   "\n message : ".$form->get('message')->getData());
            $mailer->send($message);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($form->getData());
            $entityManager->flush();

           // return $request->getUri();
            return new Response('Votre fiche contact a été envoyée à '.$personne->getMail());
        }

        return $this->render('formulaire.html.twig', ['form' => $form->createView()
        ]);
    }
}
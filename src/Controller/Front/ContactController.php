<?php

namespace App\Controller\Front;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact", methods={"GET", "POST"})
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new TemplatedEmail())
                ->from(new Address($contact->getEmail(), $contact->getFirstname()))
                ->to('devmailer90@gmail.com')
                ->subject($contact->getSubject())
                ->htmlTemplate('mails/contact.html.twig')
                ->context([
                    'name' => $contact->getFirstname() . ' ' . $contact->getLastname(),
                    'address' => $contact->getEmail(),
                    'phone' => $contact->getPhone(),
                    'message' => $contact->getMessage()
                ])
            ;

            $mailer->send($email);

            $this->addFlash('success', 'Your email has been sent properly !');

            // $this->redirectToRoute('contact');
        }

        return $this->render('front/contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

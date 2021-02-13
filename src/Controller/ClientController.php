<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\SerializerInterface;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     * @param SerializerInterface $serializer
     * @return Response
     * @throws CircularReferenceException
     * @throws InvalidArgumentException
     * @throws LogicException
     */
    public function index(SerializerInterface $serializer): Response
    {
        // Je vais chercher le fichier WSDL en créant une nouvelle requete côté client
        $soapClient = new \SoapClient('http://localhost:8000/hello.wsdl');

        // Je lance la méthode hello correspondante au fichier WSDL et au Service HelloService
        $result = $soapClient->hello("Ced");

        // Je normaize le résultat afin de pouvoir l'afficher
        $data = $serializer->normalize($result);

        // J'affiche la vue avec mon résultat
        return $this->render('client/index.html.twig', [
            'data' => $data
        ]);
    }


}

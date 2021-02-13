<?php

namespace App\Controller;

use App\Service\HelloService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloServiceController extends AbstractController
{
    /**
     * @Route("/soap")
     * @param HelloService $helloService
     * @return Response
     */
    public function index(HelloService $helloService): Response
    {
        // Je crée une nouvelle requête SOAP
        $soapServer = new \SoapServer('http://localhost:8000/hello.wsdl');
        // Paramétrage de l'objet à partir de mon Service HelloService
        $soapServer->setObject($helloService);
        // Je crée une nouvelle response
        $response = new Response();
        // Je paramètre le header de la response
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');
        // Démarre la tamporisation
        ob_start();
        // traite la requete SOAP, appelle les fonctions nécessaires et envoie une réponse en retour.
        $soapServer->handle();
        // Je paramètre le contenu de ma response (ob_get_clean lit le contenu du tampon puis l'efface)
        $response->setContent(ob_get_clean());

        // Je retourne la response
        return $response;
    }


}


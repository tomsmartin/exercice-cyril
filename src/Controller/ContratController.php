<?php

namespace App\Controller;

use App\Form\ContratType;
use App\Entity\Contrat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Serializer\SerializerInterface;

/**
* @Route("/contrat")
*/
class ContratController extends AbstractController
{
  /**
  * @Route ("/new")
  * @param Request $request
  */
  public function new(Request $request){
      $contrat = new Contrat();

      $form = $this->createForm(ContratType::class, $contrat);
      $form->add('submit', SubmitType::class, [
        'label' => 'Enregistrer',
      ]);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid())
      {
        $em = $this->getDoctrine()->getManager();
        $em->persist($contrat);
        $em->flush();
        return $this->redirectToRoute('contrat_list');
      }

      return $this->render('contrat/new.html.twig', array('form' => $form->createView()));
  }

  /**
  * @Route ("/edit/{contrat}")
  * @param Request $request
  */
  public function edit (Request $request, Contrat $contrat){

    $form = $this->createForm(ContratType::class, $contrat);

    $form->add('submit', SubmitType::class, [
      'label' => 'Modifier',
    ]);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {
      $em = $this->getDoctrine()->getManager();
      $em->persist($contrat);
      $em->flush();
      return $this->redirectToRoute('contrat_list');
    }

    return $this->render('contrat/edit.html.twig', array('form' => $form->createView()));
  }

  /**
   * @Route("/list", name="contrat_list")
   */
  public function list (Request $request){
    $repository = $this->getDoctrine()->getManager()->getRepository(Contrat::class);
    $list = $repository->allContrat();

    return $this->render('contrat/list.html.twig', array('lalist' => $list)); // On

  }
}

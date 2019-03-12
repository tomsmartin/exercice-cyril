<?php

namespace App\Controller;

use App\Form\CandidatureType;
use App\Entity\Candidature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Serializer\SerializerInterface;

/**
* @Route("/candidature")
*/
class CandidatureController extends AbstractController
{
  /**
  * @Route ("/new")
  * @param Request $request
  */
  public function new(Request $request){
      $candidature = new Candidature();

      $form = $this->createForm(CandidatureType::class, $candidature);
      $form->add('submit', SubmitType::class, [
        'label' => 'Enregistrer',
      ]);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid())
      {
        $em = $this->getDoctrine()->getManager();
        $em->persist($candidature);
        $em->flush();
        return $this->redirectToRoute('candidature_list');
      }

      return $this->render('candidature/new.html.twig', array('form' => $form->createView()));
  }

  /**
  * @Route ("/edit/{candidature}")
  * @param Request $request
  */
  public function edit (Request $request, Candidature $candidature){

    $form = $this->createForm(CandidatureType::class, $candidature);

    $form->add('submit', SubmitType::class, [
      'label' => 'Modifier',
    ]);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {
      $em = $this->getDoctrine()->getManager();
      $em->persist($candidature);
      $em->flush();
      return $this->redirectToRoute('candidature_list');
    }

    return $this->render('candidature/edit.html.twig', array('form' => $form->createView()));
  }

  /**
   * @Route("/list", name="candidature_list")
   */
  public function list (Request $request){
    $repository = $this->getDoctrine()->getManager()->getRepository(Candidature::class);
    $list = $repository->allCandidature();

    return $this->render('candidature/list.html.twig', array('lalist' => $list)); // On
  }
}

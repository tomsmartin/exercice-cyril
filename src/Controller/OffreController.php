<?php

namespace App\Controller;

use App\Form\OffreType;
use App\Entity\Offre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Serializer\SerializerInterface;

/**
* @Route("/offre")
*/
class OffreController extends AbstractController
{
  /**
  * @Route ("/new")
  * @param Request $request
  */
  public function new(Request $request){
      $offre = new Offre();

      $form = $this->createForm(OffreType::class, $offre);
      $form->add('submit', SubmitType::class, [
        'label' => 'Enregistrer',
      ]);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid())
      {
        $em = $this->getDoctrine()->getManager();
        $em->persist($offre);
        $em->flush();
        return $this->redirectToRoute('offre_list');
      }

      return $this->render('offre/new.html.twig', array('form' => $form->createView()));
  }

  /**
  * @Route ("/edit/{offre}")
  * @param Request $request
  */
  public function edit (Request $request, Offre $offre){

    $form = $this->createForm(OffreType::class, $offre);

    $form->add('submit', SubmitType::class, [
      'label' => 'Modifier',
    ]);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {
      $em = $this->getDoctrine()->getManager();
      $em->persist($offre);
      $em->flush();
      return $this->redirectToRoute('offre_list');
    }

    return $this->render('offre/edit.html.twig', array('form' => $form->createView()));
  }

  /**
   * @Route("/list", name="offre_list")
   */
  public function list (Request $request){
    $repository = $this->getDoctrine()->getManager()->getRepository(Offre::class);
    $list = $repository->allOffre();

    return $this->render('offre/list.html.twig', array('lalist' => $list)); // On
  }
}

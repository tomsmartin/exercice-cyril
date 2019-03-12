<?php

namespace App\Controller;

use App\Form\CompetenceType;
use App\Entity\Competence;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Serializer\SerializerInterface;

/**
* @Route("/competence")
*/
class CompetenceController extends AbstractController
{
  /**
  * @Route ("/new")
  * @param Request $request
  */
  public function new(Request $request){
      $competence = new Competence();

      $form = $this->createForm(CompetenceType::class, $competence);
      $form->add('submit', SubmitType::class, [
        'label' => 'Enregistrer',
      ]);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid())
      {
        $em = $this->getDoctrine()->getManager();
        $em->persist($competence);
        $em->flush();
        return $this->redirectToRoute('competence_list');
      }

      return $this->render('competence/new.html.twig', array('form' => $form->createView()));
  }

  /**
  * @Route ("/edit/{competence}")
  * @param Request $request
  */
  public function edit (Request $request, Competence $competence){

    $form = $this->createForm(CompetenceType::class, $competence);

    $form->add('submit', SubmitType::class, [
      'label' => 'Modifier',
    ]);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {
      $em = $this->getDoctrine()->getManager();
      $em->persist($competence);
      $em->flush();
      return $this->redirectToRoute('competence_list');
    }

    return $this->render('competence/edit.html.twig', array('form' => $form->createView()));
  }

  /**
   * @Route("/list", name="competence_list")
   */
  public function list (Request $request){
    $repository = $this->getDoctrine()->getManager()->getRepository(Competence::class);
    $list = $repository->allCompetence();

    return $this->render('competence/list.html.twig', array('lalist' => $list)); // On

  }
}

<?php

namespace App\Controller;

use App\Form\JobType;
use App\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Serializer\SerializerInterface;

/**
* @Route("/job")
*/
class JobController extends AbstractController
{
  /**
  * @Route ("/new")
  * @param Request $request
  */
  public function new(Request $request){
      $job = new Job();

      $form = $this->createForm(JobType::class, $job);
      $form->add('submit', SubmitType::class, [
        'label' => 'Enregistrer',
      ]);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid())
      {
        $em = $this->getDoctrine()->getManager();
        $em->persist($job);
        $em->flush();
        return $this->redirectToRoute('job_list');
      }

      return $this->render('job/new.html.twig', array('form' => $form->createView()));
  }

  /**
  * @Route ("/edit/{job}")
  * @param Request $request
  */
  public function edit (Request $request, Job $job){

    $form = $this->createForm(JobType::class, $job);

    $form->add('submit', SubmitType::class, [
      'label' => 'Modifier',
    ]);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {
      $em = $this->getDoctrine()->getManager();
      $em->persist($job);
      $em->flush();
      return $this->redirectToRoute('job_list');
    }

    return $this->render('job/edit.html.twig', array('form' => $form->createView()));
  }

  /**
   * @Route("/list", name="job_list")
   */
  public function list (Request $request){
    $repository = $this->getDoctrine()->getManager()->getRepository(Job::class);
    $list = $repository->allJob();

    return $this->render('job/list.html.twig', array('lalist' => $list)); // On

  }
}

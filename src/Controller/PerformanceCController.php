<?php

namespace App\Controller;

use App\Entity\PerformanceC;
use App\Entity\Competition;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PerformanceCType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;


class PerformanceCController extends AbstractController
{
    #[Route('/performance/c', name: 'app_performance_c')]
    public function index(): Response
    {
        return $this->render('performance_c/index.html.twig', [
            'controller_name' => 'PerformanceCController',
        ]);
    }

  /**
     * @Route("/listP", name="listPerformance")
     */
    public function listPerformance()
    {
        $performanCes = $this->getDoctrine()->getRepository(PerformanceC::class)->findAll();
        return $this->render('performance_c/listBO.html.twig', ["performances" => $performanCes]);
    }



  /**
     * @Route("/listPF", name="listPerformanceF")
     */
    public function listPerformanceF()
    {
        $performanCes = $this->getDoctrine()->getRepository(PerformanceC::class)->findAll();
        return $this->render('performance_c/listFO.html.twig', ["performances" => $performanCes]);
    }


     /**
     * @Route("/addP", name="addPerformance")
     */
    public function addPerformanceC(Request $request)
    {
        $performanceC = new  PerformanceC();
        
        $form = $this->createForm( PerformanceCType::class,  $performanceC);
        
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$student->setMoyenne(0);
            $em->persist( $performanceC);
            $em->flush();
            return $this->redirectToRoute("listPerformance");
        }
       return $this->render("performance_c/addBO.html.twig", array('form' => $form->createView()));

    }



    /**
     * @Route("/deletep/{id}", name="deletePerformance")
     */
    public function deletePerformance($id)
    {
        $perofrmanceC = $this->getDoctrine()->getRepository(PerformanceC::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($perofrmanceC);
        $em->flush();
        return $this->redirectToRoute("listPerformance");
    }

 /**
     * @Route("/showp/{id}", name="showPerformance")
     */
    public function showCPerformance($id)
    {
        $perofrmanceC = $this->getDoctrine()->getRepository(PerformanceC::class)->find($id);
        return $this->render('Performance_c/showBO.html.twig', array("performanceC" => $perofrmanceC  ));
    }

  /**
     * @Route("/updatep/{id}", name="updatePerformance")
     */
    public function updatePerformance(Request $request, $id)
    {
        $perofrmanceC = $this->getDoctrine()->getRepository(PerformanceC::class)->find($id);
        $form = $this->createForm(PerformanceCType::class, $perofrmanceC);
        $form->add("Modifier", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listPerformance');
        }
        return $this->render("performance_c/updateBO.html.twig", array('form' => $form->createView()));
    }

    public function deletePerformanceF($competition)
    {
        $perofrmanceC = $this->getDoctrine()->getRepository(PerformanceC::class)->find($competition);
        $em = $this->getDoctrine()->getManager();
        $em->remove($perofrmanceC);
        $em->flush();
        return $this->redirectToRoute("listPerformance");
      
    }
    
     /**
     * @Route("/listByComp", name="listByComp)
     */
   // public function listPerformanceByCompetition($competition)
    //{

      //  $perofrmanceC = $this->getDoctrine()->getRepository(PerformanceC::class)->findByCompetition($competition);
       // return $this->render('Performance_c/show.html.twig', array("performanceC" => $perofrmanceC  ));
       
   // } */

}

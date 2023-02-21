<?php

namespace App\Controller;

use App\Entity\Competition;
use App\Repository\PerformanceCRepository;
use App\Entity\PerformanceC;
use App\Repository\CompetitionRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CompetitionType;
use App\Form\CompetitionUpadateType;


class CompetitionController extends AbstractController
{
    #[Route('/', name: 'app_competition')]
    public function index(): Response
    {
        return $this->render('baseBO.html.twig', [
            'controller_name' => 'CompetitionController',
        ]);
    }
    


      /**
     * @Route("/update/{id}", name="updateCompetition")
     */
    public function updateCompetition(Request $request, $id)
    {
        $competition = $this->getDoctrine()->getRepository(Competition::class)->find($id);
        $form = $this->createForm(CompetitionUpadateType::class, $competition);
        $form->add("Modifier", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('listCompetition');
        }
        return $this->render("competition/updateBO.html.twig", array('form' => $form->createView()));
    }

     /**
     * @Route("/listCompetition", name="listCompetition")
     */
    public function listCompetiton()
    {
        $competitions = $this->getDoctrine()->getRepository(Competition::class)->findAll();
        return $this->render('competition/listBO.html.twig', ["competitions" => $competitions]);
    }

     /**
     * @Route("/listCompetitionF", name="listCompetitionF")
     */
    public function listCompetitonF()
    {
        $competitions = $this->getDoctrine()->getRepository(Competition::class)->findAll();
        return $this->render('competition/listFO.html.twig', ["competitions" => $competitions]);
    }



    /**
     * @Route("/add", name="addCompetition")
     */
    public function addCompetition(Request $request)
    {
        $competition = new Competition();
        
        $form = $this->createForm( CompetitionType::class,  $competition);
     
      
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ) {
            $em = $this->getDoctrine()->getManager();
            //$student->setMoyenne(0);
            $em->persist( $competition);
            $em->flush();
            return $this->redirectToRoute("listCompetition");
        }
       return $this->render("competition/addBO.html.twig", array('form' => $form->createView()));
    }

     /**
     * @Route("/delete/{id}", name="deleteCompetmition")
     */
    public function deleteCompetition($id)
    {
             
        $competition = $this->getDoctrine()->getRepository(Competition::class)->find($id);
        $em = $this->getDoctrine()->getManager();
     
        $em->remove($competition);
        $em->flush();
        return $this->redirectToRoute("listCompetition");
    }

    /**
     * @Route("/show/{id}", name="showCompetition")
     */
    public function showCompetition($id)
    {
        $competition = $this->getDoctrine()->getRepository(Competition::class)->find($id);
        return $this->render('competition/showBO.html.twig', array("competition" => $competition ));
    }

 /**
     * @Route("/showF/{id}", name="showCompetitionF")
     */
    public function showCompetitionF($id)
    {
        $competition = $this->getDoctrine()->getRepository(Competition::class)->find($id);
        return $this->render('competition/showFO.html.twig', array("competition" => $competition ));
    }
 /**
     * @Route("/showFN/{nom}", name="showCompetitionFN")
     */
    public function showCompetitionFN(CompetitionRepository $rep,$nom) { 
   
        $competitions= $rep->findOneByNom($nom);
        return $this->render('competition/showFO.html.twig', [
            "competitions" => $competitions,
        ]);

}
}
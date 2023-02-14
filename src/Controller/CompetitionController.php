<?php

namespace App\Controller;

use App\Entity\Competition;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\CompetitionType;



class CompetitionController extends AbstractController
{
    #[Route('/competition', name: 'app_competition')]
    public function index(): Response
    {
        return $this->render('competition/index.html.twig', [
            'controller_name' => 'CompetitionController',
        ]);
    }
    


      /**
     * @Route("/update/{id}", name="updateCompetition")
     */
    public function updateCompetition(Request $request, $id)
    {
        $competition = $this->getDoctrine()->getRepository(Competition::class)->find($id);
        $form = $this->createForm(CompetitionType::class, $competition);
        $form->add("Modifier", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('list Competition');
        }
        return $this->render("competition/update.html.twig", array('form' => $form->createView()));
    }

     /**
     * @Route("/listCompetition", name="listCompetition")
     */
    public function listCompetiton()
    {
        $competitions = $this->getDoctrine()->getRepository(Competition::class)->findAll();
        return $this->render('competition/list.html.twig', ["competitions" => $competitions]);
    }


    /**
     * @Route("/add", name="istCompetition")
     */
    public function addCompetition(Request $request)
    {
        $competition = new Competition();
        $form = $this->createForm( CompetitionType::class,  $competition);
        $form->add("Ajouter", SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            //$student->setMoyenne(0);
            $em->persist( $competition);
            $em->flush();
            return $this->redirectToRoute('listStudent');
        }
        return $this->render("competition/add.html.twig", array('form' => $form->createView()));
    }

     /**
     * @Route("/delete/{id}", name="deleteCompetition")
     */
    public function deleteCompetition($id)
    {
        $competition = $this->getDoctrine()->getRepository(Student::class)->find($id);
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
        $competition = $this->getDoctrine()->getRepository(Student::class)->find($id);
        return $this->render('Competition/show.html.twig', array("student" => $competition ));
    }


}

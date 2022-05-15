<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\PFE;
use App\Form\PfeType;
//use http\Env\Request;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
//use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PfeController extends AbstractController
{
    #[Route('/pfe', name: 'app_pfe')]
    public function index(Request $request , ManagerRegistry $doctrine): Response
    {
        $pfe = new  PFE();
        $form=$this->createForm(PfeType::class, $pfe);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $manager = $doctrine->getManager();
            $manager->persist($pfe);
            $manager->flush();
            $this->addFlash("info", "this pfe is added !");
            return  $this->render('details.html.twig',['pfe'=>$pfe]);
        }

        return $this->render('pfe/index.html.twig', [ 'form'=>$form->createView()
        ]);
    }

    #[Route('/pfe/affichage' , name :'affichage_app')]
    public function  addichage(ManagerRegistry $doctrine): Response{
        $manager=$doctrine->getRepository(Entreprise::class);
        $demandes=$manager->comptage();
        return $this->render('affichage.html.twig' , ['demandes'=>$demandes]);
    }
    #[Route('/listePfe' , name: 'liste')]
    public function listePfe(ManagerRegistry $doctrine): Response {
        $manger=$doctrine->getRepository(PFE::class);
        $pfe=$manger->findAll();
        return $this->render('listePfe.html.twig', ['pfe'=>$pfe]);
    }
    #[Route('/welcome' , name:'welcome')]
    public function welcome(): Response{
        return $this->render('welcome.html.twig');
    }

 }

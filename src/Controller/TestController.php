<?php

namespace App\Controller;

use App\Entity\Fabriquant;
use App\Entity\Modele;
use App\Repository\VehiculeRepository;
use App\Repository\StatusRepository;
use App\Repository\FabriquantRepository;
use App\Repository\ModeleRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use App\Entity\Vehicule;
use App\Form\TestType;
use App\Entity\Status;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Component\OptionsResolver\OptionsResolver;



class TestController extends AbstractController

{
    // #[Route('/test', name: 'test')]
    // public function index(): Response
    // {
    //     return $this->render('test/index.html.twig', [
    //         'controller_name' => 'TestController',
    //     ]);
    // }

    #[Route('/test', name: 'test' , methods:'GET|POST')]
    public function Filter(ModeleRepository $MRep , VehiculeRepository $repository,FabriquantRepository $Frep,  StatusRepository $Rstatus , Request $request , UtilisateurRepository $Users)
    {
       $status = $Rstatus -> findAll();
       $F = $Frep -> findAll();
       $M = $MRep -> findAll();
       $u = $Users -> findAll();
       $Mq = $MRep -> findAll();

    //    $join = $repository->findAllByAll() ;
       
    //    dump($join);die();
              
       

            $form = $this->createFormBuilder()
            ->add('Year',
                'Symfony\Component\Form\Extension\Core\Type\ChoiceType',[
                'choices' => $this->getYears(1960) , 
                'label' => false,
                'required' => false
            ])


            ->add('Status',EntityType::class,array(
                'class' => Status::class,
                'choice_label' => function ($status) {
                 
                    return $status->getNom();
                 },
                 'expanded' => false ,
                 'required' => false ,
                 'label' => false 
  
            ))

            ->add('Marque',EntityType::class,array(
                'class' => Fabriquant::class,
                'choice_label' => function ($F) {
                 
                    return $F->getNom();
                 },
                 'required' => false ,
                 'label' => false 
  
            ))

            ->add('Modele',EntityType::class,array(
                'class' => Modele::class,
                'choice_label' => function ($M) {
                 
                    return $M->getNom();
                 },
                 'required' => false ,
                 'label' => false 
  
            ))


            ->add('Users',EntityType::class,array(
                'class' => Utilisateur::class,
                'choice_label' => function ($users) {
                 
                    return $users->getnom();
                 },
                 'required' => false ,
                 'label' => false 
  
            ))

            ->add('Inv',EntityType::class,array(
                'class' => Vehicule::class,
                'choice_label' => function ($vehicules) {
                 
                    return $vehicules->getNuminventaire();
                 },
                 'required' => false ,
                 'label' => false 
  
            ))



            ->add('Submit', SubmitType::class)
            ->getForm();
            ;


          



            $form -> handleRequest($request);
            $y =$form->get('Year')->getData() ;
         

         
            $SearchByYears = $repository->findByYear( $y);
            $Status =$form->get('Status')->getData() ;
         

            $SearchByStatus = $repository->findBystatus($Status);
            $marque =$form->get('Marque')->getData() ;
         

            $SearchByMarque = $repository->findByMarque($marque);
            $Modele =$form->get('Modele')->getData() ;
         

            $SearchbyModele = $repository->findByModel($Modele);
            $Users =$form->get('Users')->getData();  
 
             if($Users)
            { $SearchByUser = $repository->findByUser($Users->getId());  }
           

            $vehicules = $repository -> findAll();


            $Inv =$form->get('Inv')->getData();           
                if ($Inv )
                 {  $SearchByInv = $repository->findByNumInv($Inv->getNuminventaire());}
                    // dump($SearchByInv);die();
              

// ------------------------------------------------------------ 


    //   dump($form["Inv"]->getData()    );die();


         

          if ($y)
               { $filter = $SearchByYears ;
            }
          else if ($Inv)
               { $filter = $SearchByInv ; }
          else if ($Status )
                { $filter = $SearchByStatus ;}
          else if ($Modele)
                {$filter = $SearchbyModele ;}
          else if ($marque )
                {$filter = $SearchByMarque ;}

       
          
          else if ($Users  )
               {$filter = $SearchByUser  ;}
               
          else 
               {$filter = $vehicules  ;}
            //    dump($u);die();
            //    dump($u);die();
                
            $years = $this->getYears(1960) ;

             $emptyyearvalue ='' ;
        return $this->render('test/index.html.twig', [
            
            
            'form' => $form->createView(),
            'vehicule' => $filter ,
            'Status' => $status ,
            'modele' => $M,
            'marque' => $F, 
            'users' => $u , 
            'Y' => $years ,
            'emptyyear' =>  $emptyyearvalue

        
            
        ]);   
    
     }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }



    private function getYears($min, $max='current')
    {
         $years = range($min, ($max === 'current' ? date('Y') : $max));

         return array_combine($years, $years);
    }
}

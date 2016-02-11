<?php

namespace Bse\CandidatureBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Model\UserManager;
use Bse\CandidatureBundle\Entity\Candidature;
use Bse\CandidatureBundle\Entity\User as FOSUserEntity;
use Bse\CandidatureBundle\Form\CandidatureType;

use Bse\CandidatureBundle\Data\ArrayData;
use Bse\CandidatureBundle\Utils\codeBarreC128;

/**
 * Candidature controller.
 */
class CandidatureController extends Controller
{
    /**
     * Lists all Candidature entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_candidature_welcome'));
        }
        
        $lastCompeletedSynchronisation = $this->getLastCompletedSynchronisation();

        
       $individu = $em->createQuery('SELECT i FROM BseCandidatureBundle:Individu i WHERE i.username = :username AND i.datesync = :datesync')
                    ->setParameter('username',$user->getId())
                    ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                    ->getResult()[0];

        $candidature = $em->getRepository('BseCandidatureBundle:Candidature')->findOneBy(array(
                'fosuserId' => $user->getId() ));
          
          // $filieresChoosed = explode("//", $candidature->getFiliere());        
     
        // transform $filieresChoosed array to key -> value array where key is 'faculte' and value is 'filiere'
        //$filieresChoosed = $this->getFilieresArrayOnKeyValueForm($filieresChoosed);

        return $this->render('BseCandidatureBundle:Candidature:index.html.twig', array(
            'candidature' => $candidature, 'user' => $user ,'individu' => $individu
        ));
    }


    public function ficheIndividuelleAction() {

        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_candidature_welcome'));
        }

        $user = $this->get('security.context')->getToken()->getUser();


        $lastCompeletedSynchronisation = $this->getLastCompletedSynchronisation();

        
        $individu = $em->createQuery('SELECT i FROM BseCandidatureBundle:Individu i WHERE i.username = :username AND i.datesync = :datesync')
                    ->setParameter('username',$user->getId())
                    ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                    ->getResult()[0];

        $bac = $em->createQuery('SELECT b from BseCandidatureBundle:Bac b WHERE b.codInd = :codInd AND b.datesync = :datesync')
                ->setParameter('codInd', $individu->getCodInd())
                ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                ->getResult();
	    $bac = (!empty($bac))?$bac[0]:null;
        $etape = $em->createQuery('SELECT e FROM BseCandidatureBundle:Etape e WHERE e.codInd = :codInd AND e.datesync = :datesync')
                ->setParameter('codInd',$individu->getCodInd())
                ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                ->getResult();
	    $etape = (!empty($etape))?$etape[0]:null;
        if (!$individu) {
            throw $this->createNotFoundException("Les données de la fiche individuelle n'ont pas été trouvée");
        }
        $response = $this->render('BseCandidatureBundle:Default:ficheIndividuelle.html.twig', array('individu' => $individu, 'bac' => $bac , 'etape' => $etape));
        $this->disableCacheOnResponse($response);
        return $response;
    }

    public function inscriptionPedagogiqueAction() {

        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_candidature_welcome'));
        }

     
        $lastCompeletedSynchronisation = $this->getLastCompletedSynchronisation();

       
        $individu = $em->getRepository('BseCandidatureBundle:Individu')->findOneBy(array('username'=> $user->getId(),
                                                                                 'datesync'=> $lastCompeletedSynchronisation->getDate()));
        $queryBuilder = $em->createQueryBuilder();


        $anneeUniverstaireList = $em->createQuery('SELECT a FROM BseCandidatureBundle:AnneeUni a WHERE a.datesync = :datesync')
                                ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                                ->getResult();
        $anneeUniverstaire = end($anneeUniverstaireList);
           

        $elementsPedagogiques = $queryBuilder->select(array('c'))
                   ->from('BseCandidatureBundle:Cursusannee', 'c')
                   ->where(
                     $queryBuilder->expr()->eq('c.codInd', $individu->getCodInd()),
                     $queryBuilder->expr()->eq('c.codAnnee', $anneeUniverstaire->getcodAnu())
                     //$queryBuilder->expr()->eq('c.codSession', 1),
                     //$qb->expr()->eq('c.annee', 2009),
                     //$queryBuilder->expr()->isNotNull('c.note')
		     //$queryBuilder->expr()->eq('c.etat', 1)
                   )
                   ->andWhere('c.datesync = :datesycn')
                   ->setParameter('datesycn',$lastCompeletedSynchronisation->getDate())
                   //->addOrderBy('c.codElp', 'ASC')
                   //->groupBy('c.codElp')
                   ->getQuery()->getResult();



             
        $response =  $this->render('BseCandidatureBundle:Default:inscriptionPedagogique.html.twig', 
                              array('elementsPedagogiques' => $elementsPedagogiques,
                                    'individu' => $individu));
        $this->disableCacheOnResponse($response);
        return $response;
    }

    public function emploiDuTempsAction()
    {

        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_candidature_welcome'));
        }

        $lastCompeletedSynchronisation = $this->getLastCompletedSynchronisation();


        $individu = $em->createQuery('SELECT i FROM BseCandidatureBundle:Individu i WHERE i.username = :username AND i.datesync = :datesync')
                    ->setParameter('username',$user->getId())
                    ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                    ->getResult()[0];

        $response =  $this->render('BseCandidatureBundle:Default:emploiDuTemps.html.twig',  array('individu' => $individu));
        $this->disableCacheOnResponse($response);
        return $response;
    }

    public function resultatsAction()
    {
        

        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_candidature_welcome'));
        }


        $lastCompeletedSynchronisation = $this->getLastCompletedSynchronisation();

        
        $individu = $em->getRepository('BseCandidatureBundle:Individu')->findOneBy(array('username'=> $user->getId(),
                                                                                 'datesync'=> $lastCompeletedSynchronisation->getDate()));
        $queryBuilder = $em->createQueryBuilder();
        
        $anneeUniverstaireList = $em->createQuery('SELECT a FROM BseCandidatureBundle:AnneeUni a WHERE a.datesync = :datesync')
                                ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                                ->getResult();
        $anneeUniverstaire = end($anneeUniverstaireList);

        $elementsPedagogiques = $queryBuilder->select(array('c'))
                   ->from('BseCandidatureBundle:Cursusresultat', 'c')
                   ->where(
                     $queryBuilder->expr()->eq('c.codInd', $individu->getCodInd()),
                     $queryBuilder->expr()->eq('c.codAnnee', $anneeUniverstaire->getcodAnu()),
                     $queryBuilder->expr()->eq('c.etat', 1),
                     //$qb->expr()->eq('c.etat', 1),
                     $queryBuilder->expr()->isNotNull('c.note')
                   )
                   ->andWhere('c.datesync = :datesycn')
                   ->setParameter('datesycn',$lastCompeletedSynchronisation->getDate())
                   //->addOrderBy('c.codElp', 'ASC')
                   //->groupBy('c.codElp', 'c.codSession')
                   ->getQuery()->getResult();

        
        $response = $this->render('BseCandidatureBundle:Default:resultats.html.twig', 
                              array('elementsPedagogiques' => $elementsPedagogiques,
                                    'individu' => $individu));
        $this->disableCacheOnResponse($response);
        return $response;
    }


    public function cursusAction()
    {


        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_candidature_welcome'));
        }
        
        $lastCompeletedSynchronisation = $this->getLastCompletedSynchronisation();

        $individu = $em->getRepository('BseCandidatureBundle:Individu')->findOneBy(array('username' => $user->getId(),
                                                                                 'datesync'=> $lastCompeletedSynchronisation->getDate()));
        $queryBuilder = $em->createQueryBuilder();
	
        $elementsPedagogiques = $queryBuilder->select(array('c'))
                   ->from('BseCandidatureBundle:Cursusresultat', 'c')
                   ->where(
                     $queryBuilder->expr()->eq('c.codInd', $individu->getCodInd()),
                     //$queryBuilder->expr()->eq('c.etat', 1),
                     $queryBuilder->expr()->lt('c.codAnnee', $individu->getCodAnuIna()),
                     //$queryBuilder->expr()->eq('c.codSession', 1),
                     $queryBuilder->expr()->isNotNull('c.note')
                   )
                   ->andWhere('c.datesync = :datesycn')             
                   ->setParameter('datesycn',$lastCompeletedSynchronisation->getDate())
                   ->addOrderBy('c.codAnnee','DESC')
                   ->addOrderBy('c.idCursus','ASC')
                   //->addOrderBy('c.codSession','DESC')
                   //->addOrderBy('c.codElp', 'ASC')
                   //->groupBy('c.codElp', 'c.codSession')
                   ->getQuery()->getResult();

        $response = $this->render('BseCandidatureBundle:Default:cursus.html.twig', 
                              array('elementsPedagogiques' => $elementsPedagogiques,
                                    'individu' => $individu));
        $this->disableCacheOnResponse($response);
        return $response;
    }
  

    public function examensAction()
    {

        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_candidature_welcome'));
        }

        $lastCompeletedSynchronisation = $this->getLastCompletedSynchronisation();


        $anneeUniverstaireList = $em->createQuery('SELECT a FROM BseCandidatureBundle:AnneeUni a WHERE a.datesync = :datesync')
                                ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                                ->getResult();
        $anneeUniverstaire = end($anneeUniverstaireList);

        $individu = $em->getRepository('BseCandidatureBundle:Individu')->findOneBy(array('username'=> $user->getId(),
                                                                               'datesync' =>$lastCompeletedSynchronisation->getDate()) );
        
        $queryBuilder = $em->createQueryBuilder();

        $examens = $queryBuilder->select(array('c'))
                   ->from('BseCandidatureBundle:Examen', 'c')
                   ->where(
                     $queryBuilder->expr()->eq('c.codInd', $individu->getCodInd()),
                     $queryBuilder->expr()->eq('c.codAnnee', $anneeUniverstaire->getcodAnu()),
                     //$qb->expr()->eq('c.annee', 2009),
                     $queryBuilder->expr()->isNotNull('c.dateDeb')
                   )
                   ->andWhere('c.datesync = :datesycn')
                   ->setParameter('datesycn',$lastCompeletedSynchronisation->getDate())
                   ->addOrderBy('c.dateDeb', 'ASC')
                   ->addOrderBy('c.dhhDeb', 'ASC')
                   //->groupBy('c.codElp', 'c.codSession')
                   ->getQuery()->getResult();

        $response =  $this->render('BseCandidatureBundle:Default:examens.html.twig', 
                              array('examens' => $examens,
                                    'individu' => $individu));
        $this->disableCacheOnResponse($response);
        return $response;
    }



    public function pdfAttestationInscriptionAction(Request $request)
    {
        // ###################### Load candidature data ######################        

        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_candidature_welcome'));
        }

        $user = $this->get('security.context')->getToken()->getUser();

        $lastCompeletedSynchronisation = $this->getLastCompletedSynchronisation();


        $individu = $em->createQuery('SELECT i FROM BseCandidatureBundle:Individu i WHERE i.username = :username AND i.datesync = :datesync')
                    ->setParameter('username',$user->getId())
                    ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                    ->getResult()[0];
        $etape = $em->createQuery('SELECT e FROM BseCandidatureBundle:Etape e WHERE e.codInd = :codInd AND e.datesync = :datesync')
                ->setParameter('codInd',$individu->getCodInd())
                ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                ->getResult()[0];

        $anneeUniverstaireList = $em->createQuery('SELECT a FROM BseCandidatureBundle:AnneeUni a WHERE a.datesync = :datesync')
                                ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                                ->getResult();
        $anneeUniverstaire = end($anneeUniverstaireList);


        // ###################### generate PDF ######################        

        $pdfObj = $this->container->get("white_october.tcpdf")->create();

        $pdfObj->SetMargins(PDF_MARGIN_LEFT, 50, PDF_MARGIN_RIGHT);
        $pdfObj->SetHeaderMargin(PDF_MARGIN_HEADER);

        $pdfObj->setPrintHeader(true);
        $pdfObj->setPrintFooter(false);

        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';        
        $lg['a_meta_language'] = 'ar';
        $lg['w_page'] = 'page';

        // set some language-dependent strings (optional)
        $pdfObj->setLanguageArray($lg);
        $pdfObj->SetFont('dejavusans', '', 8);
        //$pdfObj->SetFont('helvetica', '', 9);        
        $pdfObj->addPage();

        $html = $this->renderView('BseCandidatureBundle:Candidature:attestationInscription.html.twig', array(
            'individu' => $individu,
            'etape' => $etape,
            'anneeUniversitaire' => $anneeUniverstaire
        ));
        // output the HTML content
        $pdfObj->writeHTML($html);
        
        $response = new Response($pdfObj->Output('document.pdf', 'I'), 200, array('Content-Type' => 'application/pdf; charset=utf-8'));
        $this->disableCacheOnResponse($response);
        return $response;
    }

    public function pdfResultatsAction(Request $request)
    {
         $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_candidature_welcome'));
        }


        $lastCompeletedSynchronisation = $this->getLastCompletedSynchronisation();


        $individu = $em->getRepository('BseCandidatureBundle:Individu')->findOneBy(array('username'=>$user->getId(),
                                                                                 'datesync'=> $lastCompeletedSynchronisation->getDate()));
        $queryBuilder = $em->createQueryBuilder();
        
        $anneeUniverstaireList = $em->createQuery('SELECT a FROM BseCandidatureBundle:AnneeUni a WHERE a.datesync = :datesync')
                                ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                                ->getResult();
        $anneeUniverstaire = end($anneeUniverstaireList);

        $elementsPedagogiques = $queryBuilder->select(array('c'))
                   ->from('BseCandidatureBundle:Cursusresultat', 'c')
                   ->where(
                     $queryBuilder->expr()->eq('c.codInd', $individu->getCodInd()),
                     $queryBuilder->expr()->eq('c.codAnnee', $anneeUniverstaire->getcodAnu()),
                     $queryBuilder->expr()->eq('c.etat', 1),
                     //$qb->expr()->eq('c.annee', 2009),
                     $queryBuilder->expr()->isNotNull('c.note')
                   )
                   ->andWhere('c.datesync = :datesycn')
                   ->setParameter('datesycn',$lastCompeletedSynchronisation->getDate())
                   //->addOrderBy('c.codElp', 'ASC')
                   //->groupBy('c.codElp', 'c.codSession')
                   ->getQuery()->getResult();
        
        
        // ###################### generate PDF ######################        

        $pdfObj = $this->container->get("white_october.tcpdf")->create();

        $pdfObj->SetMargins(PDF_MARGIN_LEFT, 50, PDF_MARGIN_RIGHT);
        $pdfObj->SetHeaderMargin(PDF_MARGIN_HEADER);

        $pdfObj->setPrintHeader(true);
        $pdfObj->setPrintFooter(false);

        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';        
        $lg['a_meta_language'] = 'ar';
        $lg['w_page'] = 'page';

        // set some language-dependent strings (optional)
        $pdfObj->setLanguageArray($lg);
        $pdfObj->SetFont('dejavusans', '', 8);
        //$pdfObj->SetFont('helvetica', '', 9);        
        $pdfObj->addPage();

        $html = $this->renderView('BseCandidatureBundle:Pdf:resultats.html.twig', array(
                'elementsPedagogiques' => $elementsPedagogiques,
                'individu' => $individu,
        ));
        // output the HTML content
        $pdfObj->writeHTML($html);
        
        $response = new Response($pdfObj->Output('document.pdf', 'I'), 200, array('Content-Type' => 'application/pdf; charset=utf-8'));
        $this->disableCacheOnResponse($response);
        return $response;
    }

    public function pdfCursusAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_candidature_welcome'));
        }

        $lastCompeletedSynchronisation = $this->getLastCompletedSynchronisation();

        $individu = $em->getRepository('BseCandidatureBundle:Individu')->findOneBy(array('username'=>$user->getId(),
                                                                                 'datesync'=> $lastCompeletedSynchronisation->getDate()));

        $queryBuilder = $em->createQueryBuilder();
    
	    $elementsPedagogiques = $queryBuilder->select(array('c'))
                   ->from('BseCandidatureBundle:Cursusresultat', 'c')
                   ->where(
                     $queryBuilder->expr()->eq('c.codInd', $individu->getCodInd()),
                     $queryBuilder->expr()->eq('c.etat', 1),
                     $queryBuilder->expr()->lt('c.codAnnee', $individu->getCodAnuIna()),
                     //$queryBuilder->expr()->eq('c.codAnnee', 2014),
                     //$queryBuilder->expr()->eq('c.codSession', 1),
                     $queryBuilder->expr()->isNotNull('c.note')
                   )
                   ->andWhere('c.datesync = :datesycn')             
                   ->setParameter('datesycn',$lastCompeletedSynchronisation->getDate())
                   ->addOrderBy('c.codAnnee','DESC')
                   ->addOrderBy('c.idCursus','ASC')
                   //->addOrderBy('c.codSession','DESC')
                   //->addOrderBy('c.codElp', 'ASC')
                   //->groupBy('c.codElp', 'c.codSession')
                   ->getQuery()->getResult();

	   /*$cursusAnne = $queryBuilder->select(array('b'))
                   ->from('BseCandidatureBundle:Cursusresultat', 'b')
                   ->where(
                     $queryBuilder->expr()->eq('b.codInd', $individu->getCodInd()),
                     $queryBuilder->expr()->isNotNull('c.note')
                   )
                   ->andWhere('b.datesync = :datesycn')             
                   ->setParameter('datesycn',$lastCompeletedSynchronisation->getDate())
                   ->addOrderBy('b.codAnnee','DESC')
                   ->groupBy('b.codAnnee')
                   ->getQuery()->getResult();*/

        // ###################### generate PDF ######################        

        $pdfObj = $this->container->get("white_october.tcpdf")->create();

        $pdfObj->SetMargins(PDF_MARGIN_LEFT, 50, PDF_MARGIN_RIGHT);
        $pdfObj->SetHeaderMargin(PDF_MARGIN_HEADER);

        $pdfObj->setPrintHeader(true);
        $pdfObj->setPrintFooter(false);

        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';        
        $lg['a_meta_language'] = 'ar';
        $lg['w_page'] = 'page';

        // set some language-dependent strings (optional)
        $pdfObj->setLanguageArray($lg);
        $pdfObj->SetFont('dejavusans', '', 8);
        //$pdfObj->SetFont('helvetica', '', 9);        
        $pdfObj->addPage();

        $html = $this->renderView('BseCandidatureBundle:Pdf:cursus.html.twig', array(
                'elementsPedagogiques' => $elementsPedagogiques,
               // 'cursusAnne' => $cursusAnne,
                'individu' => $individu
        ));
        // output the HTML content
        $pdfObj->writeHTML($html);
        
        $response = new Response($pdfObj->Output('document.pdf', 'I'), 200, array('Content-Type' => 'application/pdf; charset=utf-8'));
        $this->disableCacheOnResponse($response);
        return $response;
    }


    public function pdfInscriptionPedagogiqueAction(Request $request){

        /*$lastCompeletedSynchronisation = $this->getLastCompletedSynchronisation();

        $em = $this->getDoctrine()->getManager();
        $user= $this->get('security.context')->getToken()->getUser();

        $individu = $em->createQuery('SELECT i FROM BseCandidatureBundle:Individu i WHERE i.username = :username AND i.datesync = :datesync')
                    ->setParameter('username',$user->getUsername())
                    ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                    ->getResult()[0];
        $anneeUniverstaireList = $em->createQuery('SELECT a FROM BseCandidatureBundle:AnneeUni a WHERE a.datesync = :datesync')
                                ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                                ->getResult();
        $anneeUniverstaire = end($anneeUniverstaireList);

        $elementsPedagogiques = $em->getRepository('BseCandidatureBundle:Cursusresultat')
                                    ->findBy(
                                        array('codInd' => $individu->getCodInd(), 
                                                'codAnnee' =>  $anneeUniverstaire->getcodAnu(),
                                                'codSession' => 1,
                                                'datesync' =>  $lastCompeletedSynchronisation->getDate(),
                                                'note' => null)); // notes is null is done for the inscription , a new row is create to assign the note */
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_candidature_welcome'));
        }


        $lastCompeletedSynchronisation = $this->getLastCompletedSynchronisation();


        $individu = $em->getRepository('BseCandidatureBundle:Individu')->findOneBy(array('username'=>$user->getId(),
                                                                                 'datesync'=> $lastCompeletedSynchronisation->getDate()));
                                                                                     $queryBuilder = $em->createQueryBuilder();

        $anneeUniverstaireList = $em->createQuery('SELECT a FROM BseCandidatureBundle:AnneeUni a WHERE a.datesync = :datesync')
                                ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                                ->getResult();
        $anneeUniverstaire = end($anneeUniverstaireList);
           
 	    $elementsPedagogiques = $queryBuilder->select(array('c'))
                   ->from('BseCandidatureBundle:Cursusannee', 'c')
                   ->where(
                     $queryBuilder->expr()->eq('c.codInd', $individu->getCodInd()),
                     $queryBuilder->expr()->eq('c.codAnnee', $anneeUniverstaire->getcodAnu())
                     //$queryBuilder->expr()->eq('c.codSession', 1),
                     //$qb->expr()->eq('c.annee', 2009),
                     //$queryBuilder->expr()->isNotNull('c.note')
		     //$queryBuilder->expr()->eq('c.etat', 1)
                   )
                   ->andWhere('c.datesync = :datesycn')
                   ->setParameter('datesycn',$lastCompeletedSynchronisation->getDate())
                   //->addOrderBy('c.codElp', 'ASC')
                   //->groupBy('c.codElp')
                   ->getQuery()->getResult();
        
        // ###################### generate PDF ######################        

        $pdfObj = $this->container->get("white_october.tcpdf")->create();

        $pdfObj->SetMargins(PDF_MARGIN_LEFT, 50, PDF_MARGIN_RIGHT);
        $pdfObj->SetHeaderMargin(PDF_MARGIN_HEADER);

        $pdfObj->setPrintHeader(true);
        $pdfObj->setPrintFooter(false);

        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';        
        $lg['a_meta_language'] = 'ar';
        $lg['w_page'] = 'page';

        // set some language-dependent strings (optional)
        $pdfObj->setLanguageArray($lg);
        $pdfObj->SetFont('dejavusans', '', 8);
        //$pdfObj->SetFont('helvetica', '', 9);        
       
        // $pdfObj->addPage();
          //  'elementsPedagogiques' => $elementsPedagogiques,
        // 'individu' => $individu,
           // 'semestres_elementsPedagogiques' => $semestres_elementsPedagogiques
        //));



        $pdfObj->addPage();

        $html = $this->renderView('BseCandidatureBundle:Pdf:inscriptionPedagogique.html.twig', array(
            'individu' => $individu,
            'elementsPedagogiques' => $elementsPedagogiques
        ));

        /*

            $html = $this->renderView('BseCandidatureBundle:Pdf:attestationInscription.html.twig', array(
                'individu' => $individu,
                'etape' => $etape,
                'anneeUniversitaire' => $anneeUniverstaire
            ));
            // output the HTML content
            $pdfObj->writeHTML($html);
        */
        

        // output the HTML content
        $pdfObj->writeHTML($html);
        
        $response = new Response($pdfObj->Output('document.pdf', 'I'), 200, array('Content-Type' => 'application/pdf; charset=utf-8'));
        $this->disableCacheOnResponse($response);
        return $response;
    }


    public function codeBarreAction($codeApogee){
    	// Creation d'une instance codeBarreC128
    	// Avec le code 'www.ilbee.net' (string)
    	$code = new codeBarreC128($codeApogee);
    	$code->setFormat('PNG');
    	// Si on veux afficher le code dans l'image
    	$code->setTitle();

    	// Le code de l'image doit etre entouré par le code barre
    	$code->setFramedTitle(true);

    	// Definit la hauteur de l'image
    	$code->setHeight(50);
    	
     	$headers = array(
            	'Content-Type'     => 'image/png',
            	'Content-Disposition' => 'inline',
    		'filename="codeBarre"');
    	// Renvoi l'image
    	return new Response($code->Output('codeBarre'), 200, $headers);
    }

    public function pdfEmploiTempsAction(Request $request)
    {
        // ###################### Load candidature data ######################        

        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_candidature_welcome'));
        }

        $user = $this->get('security.context')->getToken()->getUser();

        $lastCompeletedSynchronisation = $this->getLastCompletedSynchronisation();


        $individu = $em->createQuery('SELECT i FROM BseCandidatureBundle:Individu i WHERE i.username = :username AND i.datesync = :datesync')
                    ->setParameter('username',$user->getId())
                    ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                    ->getResult()[0];
        $etape = $em->createQuery('SELECT e FROM BseCandidatureBundle:Etape e WHERE e.codInd = :codInd AND e.datesync = :datesync')
                ->setParameter('codInd',$individu->getCodInd())
                ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                ->getResult()[0];

        $anneeUniverstaireList = $em->createQuery('SELECT a FROM BseCandidatureBundle:AnneeUni a WHERE a.datesync = :datesync')
                                ->setParameter('datesync',$lastCompeletedSynchronisation->getDate())
                                ->getResult();
        $anneeUniverstaire = end($anneeUniverstaireList);


        // ###################### generate PDF ######################        

        $pdfObj = $this->container->get("white_october.tcpdf")->create();

        $pdfObj->SetMargins(PDF_MARGIN_LEFT, 50, PDF_MARGIN_RIGHT);
        $pdfObj->SetHeaderMargin(PDF_MARGIN_HEADER);

        $pdfObj->setPrintHeader(true);
        $pdfObj->setPrintFooter(false);

        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';        
        $lg['a_meta_language'] = 'ar';
        $lg['w_page'] = 'page';

        // set some language-dependent strings (optional)
        $pdfObj->setLanguageArray($lg);
        $pdfObj->SetFont('dejavusans', '', 8);
        //$pdfObj->SetFont('helvetica', '', 9);        
        $pdfObj->addPage();

        $html = $this->renderView('BseCandidatureBundle:Candidature:emploitemps.html.twig', array(
            'individu' => $individu,
            'etape' => $etape,
            'anneeUniversitaire' => $anneeUniverstaire
        ));
        // output the HTML content
        $pdfObj->writeHTML($html);
        
        $response = new Response($pdfObj->Output('document.pdf', 'I'), 200, array('Content-Type' => 'application/pdf; charset=utf-8'));
        $this->disableCacheOnResponse($response);
        return $response;
    }

    public function pdfExamenAction(Request $request)
    {
        // ###################### Load candidature data ######################        
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_candidature_welcome'));
        }

        $lastCompeletedSynchronisation = $this->getLastCompletedSynchronisation();


        $individu = $em->getRepository('BseCandidatureBundle:Individu')->findOneBy(array('username'=>$user->getId(),
                                                                                 'datesync'=> $lastCompeletedSynchronisation->getDate()));

       
        $queryBuilder = $em->createQueryBuilder();

        $examens = $queryBuilder->select(array('c'))
                   ->from('BseCandidatureBundle:Examen', 'c')
                   ->where(
                     $queryBuilder->expr()->eq('c.codInd', $individu->getCodInd()),
                     //$queryBuilder->expr()->eq('c.codAnnee', $anneeUniverstaire->getcodAnu()),
                     //$qb->expr()->eq('c.annee', 2009),
		     $queryBuilder->expr()->eq('c.etat', 1),
                     $queryBuilder->expr()->isNotNull('c.dateDeb')
                   )
                   ->andWhere('c.datesync = :datesycn')
                   ->setParameter('datesycn',$lastCompeletedSynchronisation->getDate())
                   ->addOrderBy('c.dateDeb', 'ASC')
                   //->groupBy('c.codElp', 'c.codSession')
                   ->getQuery()->getResult();

       

        //$examens = $em->getRepository('BseCandidatureBundle:Examen')->findOneByUsername($user->getUsername());
        //$etape = $em->getRepository('BseCandidatureBundle:Etape')->findOneByCodInd($examen->getCodInd());
        /*
                        $elementsPedagogiques = $em->getRepository('BseCandidatureBundle:Cursusresultat')
                                    ->findBy(
                                        array('codInd' => $individu->getCodInd(), 
                                                'codAnnee' =>  $anneeUniverstaire->getcodAnu(),
                                                'codSession' => 1,
                                                'datesync' =>  $lastCompeletedSynchronisation->getDate(),
                                                'note' => null)); // notes is null is done for the */
        //$anneeUniverstaireList = $em->getRepository('BseCandidatureBundle:AnneeUni')->findAll();
        //$anneeUniverstaire = end($anneeUniverstaireList);


        // ###################### generate PDF ######################        

        $pdfObj = $this->container->get("white_october.tcpdf")->create();

        $pdfObj->SetMargins(PDF_MARGIN_LEFT, 50, PDF_MARGIN_RIGHT);
        $pdfObj->SetHeaderMargin(PDF_MARGIN_HEADER);

        $pdfObj->setPrintHeader(true);
        $pdfObj->setPrintFooter(false);

        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';        
        $lg['a_meta_language'] = 'ar';
        $lg['w_page'] = 'page';

        // set some language-dependent strings (optional)
        $pdfObj->setLanguageArray($lg);
        $pdfObj->SetFont('dejavusans', '', 8);
        //$pdfObj->SetFont('helvetica', '', 9);        
        $pdfObj->addPage();

        $html = $this->renderView('BseCandidatureBundle:Candidature:examens.html.twig', array(
            //'examen' => $examen,
            //'etape' => $etape,
        'individu' => $individu,
        'tab' => $examens,
        'pdfObj' => $pdfObj// @TEST_ONLY
            //'anneeUniversitaire' => $anneeUniverstaire

        ));

        // output the HTML content
        $pdfObj->writeHTML($html);
        
        
        $response = new Response($pdfObj->Output('document.pdf', 'I'), 200, array('Content-Type' => 'application/pdf; charset=utf-8'));
        $this->disableCacheOnResponse($response);
        return $response;
    }


    private function getLastCompletedSynchronisation(){
        
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();

        if(!$user instanceof FOSUserEntity){
            return $this->redirect($this->generateUrl('bse_candidature_welcome'));
        }

        $user = $this->get('security.context')->getToken()->getUser();

        $synchronisation = $em->getRepository('BseCandidatureBundle:Datesynch')
              ->findBy(
                 array('etat' => 1), 
                 array('date' => 'DESC')
               )[0];

        return $synchronisation;
    }

    // @VERY_IMPORTANT
    // @REASON : Security
    // for security reason if not applied to a repsonse object it's possible to get back to the previous page
    // using the button "Previous" even if the user is not logged in
    private function disableCacheOnResponse($response){
        $response->setPrivate();
        $response->setMaxAge(0);
        $response->setSharedMaxAge(0);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        $response->headers->addCacheControlDirective('no-store', true);
    }

}

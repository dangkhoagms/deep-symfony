<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Dinosaur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class DinosaurController extends Controller
{

    /**
     * @Route(path="/",name="app_index")
     */
    public function indexAction($os_linux){

        $em = $this->getDoctrine()->getManager();
        $request = new Request();
        $request->attributes->set(
          '_controller',
            'AppBundle:Dinosaur:_latestTweets'
        );
        $httpKernel = $this->container->get('http_kernel');
        $reponse = $httpKernel->handle(
          $request,HttpKernelInterface::SUB_REQUEST
        );
        //dump($httpKernel); die;


     //   return $reponse;

        return $this->render("dinosaur/index.html.twig",[
                'dinosaurs' => $em->getRepository(Dinosaur::class)
            ->findAll(),
            'os'=>$os_linux
        ]);
    }

    /**
     * @Route(path="/dinosaur/{id}",name="dinosaur_show")
     */
    public function show(Dinosaur $dinosaur){
        return $this->render("dinosaur/show.html.twig",[
            'dinosaur'=> $dinosaur
        ]);
    }

    public function _latestTweetsAction()
    {
        $tweets = [
            'Dinosaurs can have existential crises too you know.',
            'Eating lollipops... ',
            'Rock climbing... '
        ];

        return $this->render('dinosaur/_latestTweets.html.twig', [
            'tweets' => $tweets
        ]);
    }
}

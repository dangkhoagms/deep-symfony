<?php


namespace AppBundle\EventListener;


use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class UserAgentSubscriber implements EventSubscriberInterface
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
   {

       $this->logger = $logger;
   }

    public static function getSubscribedEvents()
    {
        return array(
            'kernel.request' => 'onKernelRequest'
        );
    }
    public function onKernelRequest(GetResponseEvent $event){
        if(!$event->isMasterRequest()){
            return ;
        }
        $request = $event->getRequest();

        $agent = $request->headers->get('user-agent');
        $this->logger->info('Init logger');
        $this->logger->info('user-agent'.$agent);
        $isLinux = stripos($agent,'linux') !== false;
        if($isLinux){
        $request->attributes->set('os_linux',$isLinux);
        }
       //dump($request); die;

    }

}

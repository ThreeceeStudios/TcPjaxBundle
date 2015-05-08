<?php

namespace Tc\Bundle\Pjax\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * ResponseListener
 */
class ResponseListener
{
    /**
     * @var string
     */
    protected $pjaxVersion;

    /**
     * @param $pjaxVersion
     */
    public function __construct($pjaxVersion)
    {
        $this->pjaxVersion = $pjaxVersion;
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $request = $event->getRequest();

        if ($request->headers->get('X-PJAX', false)) {
            $event->getResponse()->headers->set('X-PJAX-Version', $this->pjaxVersion);
        }

    }
}

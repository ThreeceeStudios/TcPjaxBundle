<?php

namespace Tc\Bundle\Pjax\Pjax;

use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Pjax
 */
class Pjax implements PjaxInterface
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @param $pjaxContainer
     * @param $fullView
     * @param $pjaxView
     * @return string
     */
    public function getView($pjaxContainer, $fullView, $pjaxView)
    {
        $pjaxContainer = '#'.ltrim($pjaxContainer, '#');
        if ($this->isPjax() && $this->isCorrectContainer($pjaxContainer)) {
            return $pjaxView;
        } else {
            return $fullView;
        }
    }

    /**
     * @return boolean
     */
    public function isPjax()
    {
        return $this->requestStack->getCurrentRequest()->headers->get('X-PJAX', false);
    }

    /**
     * @param $pjaxContainer
     * @return boolean
     */
    public function isCorrectContainer($pjaxContainer)
    {
        $pjax = $this->requestStack->getCurrentRequest()->get('_pjax', false);
        if (!$pjax && $this->requestStack->getParentRequest()) {
            $pjax = $this->requestStack->getParentRequest()->get('_pjax', false);
        }

        return $pjax === $pjaxContainer;
    }
}

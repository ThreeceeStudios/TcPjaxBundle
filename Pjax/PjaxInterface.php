<?php

namespace Tc\Bundle\Pjax\Pjax;

/**
 * PjaxInterface
 */
interface PjaxInterface
{
    /**
     * @param $pjaxContainer
     * @param $fullView
     * @param $pjaxView
     * @return string
     */
    public function getView($pjaxContainer, $fullView, $pjaxView);

    /**
     * @return boolean
     */
    public function isPjax();

    /**
     * @param $pjaxContainer
     * @return boolean
     */
    public function isCorrectContainer($pjaxContainer);
}

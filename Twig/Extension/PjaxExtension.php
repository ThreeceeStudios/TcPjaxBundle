<?php

namespace Tc\Bundle\Pjax\Twig\Extension;

use Tc\Bundle\Pjax\Pjax\PjaxInterface;

/**
 * PjaxExtension
 */
class PjaxExtension extends \Twig_Extension
{
    /**
     * @var PjaxInterface
     */
    private $pjax;

    /**
     * @var string
     */
    protected $pjaxVersion;

    /**
     * @param PjaxInterface $pjax
     */
    public function __construct(PjaxInterface $pjax, $pjaxVersion)
    {
        $this->pjax = $pjax;
        $this->pjaxVersion = $pjaxVersion;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('pjax', array($this, 'pjaxFunction')),
            new \Twig_SimpleFunction('pjaxContainer', array($this, 'pjaxContainerFunction')),
            new \Twig_SimpleFunction('pjaxVersion', array($this, 'pjaxVersionFunction')),
        );
    }

    /**
     * @param $pjaxContainer
     * @param $fullView
     * @param $pjaxView
     * @return string
     */
    public function pjaxFunction($pjaxContainer, $fullView, $pjaxView)
    {
        return $this->pjax->getView($pjaxContainer, $fullView, $pjaxView);
    }

    /**
     * @param $pjaxContainer
     * @param bool $disable
     * @param null $pjaxVersion
     * @param int $timeout
     * @return string
     */
    public function pjaxContainerFunction($pjaxContainer, $disable = false, $pjaxVersion = null, $timeout = 2000)
    {
        $pjaxContainer = ltrim($pjaxContainer, '#');

        if (null === $pjaxVersion) {
            $pjaxVersion = $this->pjaxVersion;
        }

        $attributes = sprintf(
            'data-pjax-container=%s id=%s data-pjax-version=%s data-pjax-timeout=%s',
            $pjaxContainer,
            $pjaxContainer,
            $pjaxVersion,
            $timeout
        );

        if ($disable) {
            $attributes .= ' data-pjax-disable="1"';
        }

        return $attributes;
    }

    /**
     * @param $pjaxVersion
     * @return string
     */
    public function pjaxVersionFunction($pjaxVersion = null)
    {
        if (null === $pjaxVersion) {
            $pjaxVersion = $this->pjaxVersion;
        }

        return sprintf('<meta http-equiv="x-pjax-version" content="%s" />', $pjaxVersion);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tc_pjax';
    }
}

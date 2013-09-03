<?php

namespace Seegno\BootstrapBundle\Twig\Extension;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * SeegnoBootstrapExtension
 */
class SeegnoBootstrapExtension extends \Twig_Extension
{
    /**
     * @var SessionInterface
     */
    protected $session;


    /**
     * Constructor
     *
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'seegno_bootstrap_alerts' => new \Twig_Function_Method($this, 'renderHtmlAlerts', array('is_safe' => array('html'))),
            'seegno_bootstrap_alert'  => new \Twig_Function_Method($this, 'renderHtmlAlert', array('is_safe' => array('html'))),
        );
    }

    /**
     * Render all flashes on the flashbag
     *
     * @param  boolean $dismissable  The default value is true.
     * @return string  The HTML
     */
    public function renderHtmlAlerts($dismissable = true)
    {
        $flashbag = $this->session->getFlashbag();

        if (count($flashbag)) {
            return $this->renderAlerts($flashbag->all(), $dismissable);
        }
    }

    /**
     * Render single alert passing by the type and the messages
     *
     * @param  string       $type
     * @param  array|string $messages
     * @param  boolean      $dismissable The default value is true.
     * @return string       The HTML
     */
    public function renderHtmlAlert($type, $messages, $dismissable = true)
    {
        $messages = is_array($messages) ? $messages : array($messages);

        return $this->renderAlerts(array($type => $messages), $dismissable);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'seegno_bootstrap';
    }

    /**
     * Helper to parse an array of flashes to HTML
     *
     * @param  array   $flashes
     * @param  boolean $dismissable The default value is true.
     * @return string  The HTML
     */
    private function renderAlerts($flashes, $dismissable = true)
    {
        $alerts = array();

        foreach ($flashes as $key => $messages) {
            $params = array(
                'messages' => $messages,
                'class'    => sprintf('alert alert-%s', $key)
            );

            if ($dismissable) {
                $params['class'] .= ' alert-dismissable';
            }

            $alerts[] = $params;
        }

        return $this->environment->render('SeegnoBootstrapBundle:Alert:layout.html.twig', array(
            'alerts'      => $alerts,
            'dismissable' => $dismissable
        ));
    }
}

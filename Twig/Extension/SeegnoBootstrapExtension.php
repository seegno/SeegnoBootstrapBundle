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
     * @var array
     */
    protected $alertsTypes;


    /**
     * Constructor
     *
     * @param SessionInterface $session
     * @param array            $alertsTypes
     */
    public function __construct(SessionInterface $session, array $alertsTypes)
    {
        $this->session = $session;
        $this->alertsTypes = $alertsTypes;
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
     * @param  boolean $strict       If false, renders all the flashes on the FlashBag.
     *
     * @return string  The HTML
     */
    public function renderHtmlAlerts($dismissable = true, $strict = true)
    {
        $flashbag = $this->session->getFlashbag();
        $flashes = array();

        if (false === $strict) {
            $flashes = $flashbag->all();
        } else {
            foreach ($flashbag->keys() as $key) {
                if (in_array($key, $this->alertsTypes)) {
                    $flashes[$key] = $flashbag->get($key);
                }
            }
        }

        if (count($flashes)) {
            return $this->renderAlerts($flashes, $dismissable);
        }
    }

    /**
     * Render single alert passing by the type and the messages
     *
     * @param  string       $type
     * @param  array|string $messages
     * @param  boolean      $dismissable The default value is true.
     *
     * @return string       The HTML
     */
    public function renderHtmlAlert($type, $messages = false, $dismissable = true)
    {
        if (false === $messages) {
            $messages = $this->session->getFlashbag()->get($type);
        } else {
            $messages = (is_array($messages) ? $messages : array($messages));
        }

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
     *
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

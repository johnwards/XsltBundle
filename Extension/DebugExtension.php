<?php

namespace Bundle\Liip\XsltBundle\Extension;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Kernel;
use Bundle\Liip\XsltBundle\Extension;

class DebugExtension implements Extension
{
    protected $kernel;
    protected $request;

    public function __construct(Kernel $kernel, Request $request)
    {
        $this->kernel = $kernel;
        $this->request = $request;
    }

    public function apply(\DOMDocument $dom)
    {
        if ($this->kernel->isDebug()) {

            // Check for ?XML parameter
            if ($this->request->query->get('XML', false) !== false) {

                // print raw XML
                header('Content-Type: text/xml');
                echo $dom->saveXML();
                exit;
            }
        }
    }
}

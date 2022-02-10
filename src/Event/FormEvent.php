<?php

namespace Softspring\CoreBundle\Event;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\EventDispatcher\Event;

class FormEvent extends Event
{
    protected ?Request $request;

    protected FormInterface $form;

    /**
     * FormEvent constructor.
     */
    public function __construct(FormInterface $form, ?Request $request = null)
    {
        $this->form = $form;
        $this->request = $request;
    }

    public function getForm(): FormInterface
    {
        return $this->form;
    }

    /**
     * @return Request|null
     */
    public function getRequest()
    {
        return $this->request;
    }
}

<?php

namespace Bayfront\Validator\Abstracts;

use Bayfront\Validator\Interfaces\ValidationRuleInterface;

abstract class Rule implements ValidationRuleInterface
{

    /**
     * Default validation error message which can be
     * overwritten by each ValidationRule.
     *
     * @var string
     */
    private string $message = '';

    /**
     * @inheritDoc
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getMessage(): string
    {

        if ($this->message == '') {
            return 'The input is not valid';
        }

        return $this->message;

    }

}
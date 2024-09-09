<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Checks if string only contains alpha characters.
 */
class Alpha extends Rule implements ValidationRuleInterface
{

    private string $value;

    /**
     * @param mixed $value
     */
    public function __construct(mixed $value)
    {
        $this->value = strval($value);
        $this->setMessage('The value must contain only alpha characters');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return ctype_alpha($this->value);
    }

}
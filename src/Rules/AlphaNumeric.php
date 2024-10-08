<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Checks if string only contains alphanumeric characters.
 */
class AlphaNumeric extends Rule implements ValidationRuleInterface
{

    private string $value;

    /**
     * @param mixed $value (string)
     */
    public function __construct(mixed $value)
    {
        $this->value = strval($value);
        $this->setMessage('The value must contain only alphanumeric characters');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return ctype_alnum($this->value);
    }

}
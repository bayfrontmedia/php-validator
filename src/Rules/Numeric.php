<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Checks if string only contains numeric characters.
 */
class Numeric extends Rule implements ValidationRuleInterface
{

    private mixed $value;

    /**
     * @param mixed $value
     */
    public function __construct(mixed $value)
    {
        $this->value = $value;
        $this->setMessage('The value must be numeric');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return (is_numeric($this->value));
    }

}
<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Value is an array.
 */
class IsArray extends Rule implements ValidationRuleInterface
{

    private mixed $value;

    /**
     * @param mixed $value
     */
    public function __construct(mixed $value)
    {
        $this->value = $value;
        $this->setMessage('The value must be an array');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return is_array($this->value);
    }

}
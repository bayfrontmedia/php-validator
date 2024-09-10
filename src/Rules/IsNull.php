<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Value is null.
 */
class IsNull extends Rule implements ValidationRuleInterface
{

    private mixed $value;

    /**
     * @param mixed $value
     */
    public function __construct(mixed $value)
    {
        $this->value = $value;
        $this->setMessage('The value must be NULL');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return is_null($this->value);
    }

}
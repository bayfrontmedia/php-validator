<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Value is a JSON string.
 */
class IsJson extends Rule implements ValidationRuleInterface
{

    private mixed $value;

    /**
     * @param mixed $value
     */
    public function __construct(mixed $value)
    {
        $this->value = $value;
        $this->setMessage('The value must be a JSON string');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {

        if (is_string($this->value)) {

            if (null !== json_decode($this->value)) {
                return (json_last_error() == JSON_ERROR_NONE);
            }

        }

        return false;

    }

}
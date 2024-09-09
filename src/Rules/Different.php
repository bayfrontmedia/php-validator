<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Different values.
 * Strings are compared as case-sensitive.
 */
class Different extends Rule implements ValidationRuleInterface
{

    private mixed $value;
    private mixed $match;

    /**
     * @param mixed $value
     * @param mixed $match
     */
    public function __construct(mixed $value, mixed $match)
    {

        $this->value = $value;
        $this->match = $match;

        $this->setMessage('Both values must be different');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return $this->value !== $this->match;
    }

}
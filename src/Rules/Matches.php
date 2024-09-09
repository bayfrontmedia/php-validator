<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Matching values.
 * Strings are compared as case-sensitive.
 */
class Matches extends Rule implements ValidationRuleInterface
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

        $this->setMessage('Both values must match');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return $this->value === $this->match;
    }

}
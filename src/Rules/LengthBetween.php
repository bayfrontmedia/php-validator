<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Checks if string length is between min and max length.
 */
class LengthBetween extends Rule implements ValidationRuleInterface
{

    private string $value;
    private int $min;
    private int $max;

    /**
     * @param mixed $value (string)
     * @param mixed $min (int)
     * @param mixed $max (int)
     */
    public function __construct(mixed $value, mixed $min, mixed $max)
    {

        $this->value = strval($value);
        $this->min = intval($min);
        $this->max = intval($max);

        $this->setMessage('The value must have a length between ' . $this->min . '-' . $this->max);

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return strlen($this->value) >= $this->min && strlen($this->value) <= $this->max;
    }

}
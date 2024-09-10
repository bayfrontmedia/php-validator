<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Checks if value is between given min and max values.
 */
class Between extends Rule implements ValidationRuleInterface
{

    private float $value;
    private float $min;
    private float $max;

    /**
     * @param mixed $value (float)
     * @param mixed $min (float)
     * @param mixed $max (float)
     */
    public function __construct(mixed $value, mixed $min, mixed $max)
    {

        $this->value = floatval($value);
        $this->min = floatval($min);
        $this->max = floatval($max);

        $this->setMessage('The value must be between ' . $this->min . '-' . $this->max);

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return $this->value >= $this->min && $this->value <= $this->max;
    }

}
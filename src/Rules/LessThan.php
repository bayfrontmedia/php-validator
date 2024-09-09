<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Checks if value is less than a given number.
 */
class LessThan extends Rule implements ValidationRuleInterface
{

    private float $value;
    private float $compare;

    /**
     * @param mixed $value (float)
     * @param mixed $compare (float)
     */
    public function __construct(mixed $value, mixed $compare)
    {

        $this->value = floatval($value);
        $this->compare = floatval($compare);

        $this->setMessage('The value must be less than ' . $this->compare);

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return $this->value < $this->compare;
    }

}
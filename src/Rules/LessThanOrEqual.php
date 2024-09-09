<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Checks if value is less than or equal to a given number.
 */
class LessThanOrEqual extends Rule implements ValidationRuleInterface
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

        $this->setMessage('The value must be less than or equal to ' . $this->compare);

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return $this->value <= $this->compare;
    }

}
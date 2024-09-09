<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Checks if values are equal.
 */
class Equals extends Rule implements ValidationRuleInterface
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

        $this->setMessage('The values do not equal');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return $this->value == $this->compare;
    }

}
<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Checks if value length is a given length.
 */
class LengthEquals extends Rule implements ValidationRuleInterface
{

    private string $value;
    private int $length;

    /**
     * @param mixed $value (string)
     * @param mixed $length (int)
     */
    public function __construct(mixed $value, mixed $length)
    {

        $this->value = strval($value);
        $this->length = intval($length);

        $this->setMessage('The value must have a length of ' . $this->length);

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return strlen($this->value) == $this->length;
    }

}
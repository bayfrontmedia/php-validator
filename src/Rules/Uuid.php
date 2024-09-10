<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Checks if string is a valid UUID.
 */
class Uuid extends Rule implements ValidationRuleInterface
{

    private string $value;

    /**
     * @param mixed $value (string)
     */
    public function __construct(mixed $value)
    {
        $this->value = strval($value);
        $this->setMessage('The value must be a valid UUID');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        $regex = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/';
        return (bool)preg_match($regex, $this->value);
    }

}
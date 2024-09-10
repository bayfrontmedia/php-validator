<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Checks if string validates as an email address.
 */
class Email extends Rule implements ValidationRuleInterface
{

    private string $value;

    /**
     * @param mixed $value (string)
     */
    public function __construct(mixed $value)
    {
        $this->value = strval($value);
        $this->setMessage('The value must be an email address');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return filter_var($this->value, FILTER_VALIDATE_EMAIL);
    }

}
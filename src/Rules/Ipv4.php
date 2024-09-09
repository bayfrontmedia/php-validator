<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Checks if string validates as an IPv4 address.
 */
class Ipv4 extends Rule implements ValidationRuleInterface
{

    private string $value;

    /**
     * @param mixed $value (string)
     */
    public function __construct(mixed $value)
    {
        $this->value = strval($value);
        $this->setMessage('The value must be an IPv4');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return filter_var($this->value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

}
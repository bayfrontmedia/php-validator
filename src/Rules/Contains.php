<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Checks if string value contains case-sensitive needle(s).
 */
class Contains extends Rule implements ValidationRuleInterface
{

    private string $value;
    private array $needles;

    /**
     * @param mixed $value (string)
     * @param mixed $needles (array)
     */
    public function __construct(mixed $value, mixed $needles)
    {

        $this->value = strval($value);
        $this->needles = (array)$needles;

        $this->setMessage('The value does not contain a required needle');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {

        foreach ($this->needles as $needle) {
            if (!str_contains($this->value, $needle)) {
                return false;
            }
        }

        return true;

    }

}
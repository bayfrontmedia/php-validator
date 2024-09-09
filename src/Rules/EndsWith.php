<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Checks if string ends with a given needle.
 */
class EndsWith extends Rule implements ValidationRuleInterface
{

    private string $value;
    private string $needle;

    /**
     * @param mixed $value (string)
     * @param mixed $needle (string))
     */
    public function __construct(mixed $value, mixed $needle)
    {

        $this->value = strval($value);
        $this->needle = strval($needle);

        $this->setMessage('The value must end with: ' . $this->needle);

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return str_ends_with($this->value, $this->needle);
    }

}
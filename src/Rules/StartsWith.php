<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Checks if string begins with a given needle.
 */
class StartsWith extends Rule implements ValidationRuleInterface
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

        $this->setMessage('The value must start with: ' . $this->needle);

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return str_starts_with($this->value, $this->needle);
    }

}
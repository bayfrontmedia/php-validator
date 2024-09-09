<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;
use DateTime;

/**
 * Checks if string is a valid date according to a given format.
 *
 * See: https://www.php.net/manual/en/datetime.format.php
 */
class Date extends Rule implements ValidationRuleInterface
{

    private string $value;
    private string $format;

    /**
     * @param mixed $value (string)
     * @param mixed $format (format)
     */
    public function __construct(mixed $value, mixed $format = 'Y-m-d H:i:s')
    {
        $this->value = strval($value);
        $this->format = strval($format);
        $this->setMessage('The value must be of date type: ' . $this->format);

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        $obj = DateTime::createFromFormat($this->format, $this->value);
        return $obj && $obj->format($this->format) == $this->value;
    }

}
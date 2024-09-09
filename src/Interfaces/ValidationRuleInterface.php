<?php

namespace Bayfront\Validator\Interfaces;

use Bayfront\Validator\Abstracts\Rule;

interface ValidationRuleInterface
{

    /**
     * Set validation error message.
     *
     * @param string $message
     * @return Rule
     */
    public function setMessage(string $message): Rule;

    /**
     * Get validation error message.
     *
     * If a message has not been set, the default message for the rule will be used.
     *
     * @return string
     */
    public function getMessage(): string;

    /**
     * Is validation valid?
     *
     * @return bool
     */
    public function isValid(): bool;

}
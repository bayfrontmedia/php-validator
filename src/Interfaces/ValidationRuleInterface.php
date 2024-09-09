<?php

namespace Bayfront\Validator\Interfaces;

use Bayfront\Validator\Abstracts\Rule;

interface ValidationRuleInterface
{

    /**
     * Set validation error message.
     *
     * The placeholder :attribute will be automatically replaced with
     * the set attribute value;
     *
     * @param string $message
     * @return Rule
     */
    public function setMessage(string $message): Rule;

    /**
     * Get validation error message.
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
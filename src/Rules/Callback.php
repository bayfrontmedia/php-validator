<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Value must return TRUE from the callback function.
 * The value is passed as an argument to the function.
 */
class Callback extends Rule implements ValidationRuleInterface
{

    private mixed $value;
    private $callback;

    /**
     * @param mixed $value
     * @param callable $callback
     */
    public function __construct(mixed $value, callable $callback)
    {
        $this->value = $value;
        $this->callback = $callback;
        $this->setMessage('The value must return TRUE from callable function');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return boolval(call_user_func($this->callback, $this->value));
    }

}
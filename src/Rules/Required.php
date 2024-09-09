<?php

namespace Bayfront\Validator\Rules;

use Bayfront\ArrayHelpers\Arr;
use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Required array key exists.
 */
class Required extends Rule implements ValidationRuleInterface
{

    private mixed $value;
    private mixed $key;

    /**
     * @param mixed $value (array)
     * @param mixed $key (string: Array key in dot notation)
     */
    public function __construct(mixed $value, mixed $key)
    {

        $this->value = $value;
        $this->key = $key;

        $this->setMessage('Required array key is missing';

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {

        if (!is_array($this->value) ||
            !is_string($this->key)) {
            return false;
        }


        if (Arr::has($this->value, $this->key) || Arr::get($this->value, $this->key, []) === null) {
            return true;
        }

        return false;

    }

}
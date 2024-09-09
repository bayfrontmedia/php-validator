<?php

namespace Bayfront\Validator\Rules;

use Bayfront\ArrayHelpers\Arr;
use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Required array key to exist.
 */
class Required extends Rule implements ValidationRuleInterface
{

    private mixed $array;
    private mixed $key;

    /**
     * @param mixed $array (array)
     * @param mixed $key (string: Array key in dot notation)
     */
    public function __construct(mixed $array, mixed $key)
    {

        $this->array = $array;
        $this->key = $key;

        $this->setMessage('Required array key is missing');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {

        if (!is_array($this->array) ||
            !is_string($this->key)) {
            return false;
        }


        if (Arr::has($this->array, $this->key) || Arr::get($this->array, $this->key, []) === null) {
            return true;
        }

        return false;

    }

}
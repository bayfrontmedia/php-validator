<?php

namespace Bayfront\Validator\Rules;

use Bayfront\Validator\Abstracts\Rule;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;

/**
 * Value is an uploaded file.
 */
class IsFile extends Rule implements ValidationRuleInterface
{

    private mixed $value;

    /**
     * @param mixed $value
     */
    public function __construct(mixed $value)
    {
        $this->value = $value;
        $this->setMessage('The value must be an uploaded file');

    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {

        if (!is_array($this->value)
            || !isset($this->value['name'])
            || !isset($this->value['tmp_name'])
            || (isset($this->value['error']) && $this->value['error'] !== UPLOAD_ERR_OK)
            || !is_uploaded_file($this->value['tmp_name'])) {
            return false;
        }

        return true;

    }

}
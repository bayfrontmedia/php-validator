<?php

namespace Bayfront\Validator;

use Bayfront\ArrayHelpers\Arr;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;
use Bayfront\Validator\Rules\Alpha;
use Bayfront\Validator\Rules\AlphaNumeric;
use Bayfront\Validator\Rules\Between;
use Bayfront\Validator\Rules\Contains;
use Bayfront\Validator\Rules\Date;
use Bayfront\Validator\Rules\Email;
use Bayfront\Validator\Rules\EndsWith;
use Bayfront\Validator\Rules\Equals;
use Bayfront\Validator\Rules\GreaterThan;
use Bayfront\Validator\Rules\GreaterThanOrEqual;
use Bayfront\Validator\Rules\Ip;
use Bayfront\Validator\Rules\Ipv4;
use Bayfront\Validator\Rules\Ipv6;
use Bayfront\Validator\Rules\IsArray;
use Bayfront\Validator\Rules\IsBoolean;
use Bayfront\Validator\Rules\IsEmpty;
use Bayfront\Validator\Rules\IsFloat;
use Bayfront\Validator\Rules\IsInteger;
use Bayfront\Validator\Rules\IsJson;
use Bayfront\Validator\Rules\IsNull;
use Bayfront\Validator\Rules\IsObject;
use Bayfront\Validator\Rules\IsString;
use Bayfront\Validator\Rules\LengthBetween;
use Bayfront\Validator\Rules\LengthEquals;
use Bayfront\Validator\Rules\LessThan;
use Bayfront\Validator\Rules\LessThanOrEqual;
use Bayfront\Validator\Rules\Matches;
use Bayfront\Validator\Rules\MaxLength;
use Bayfront\Validator\Rules\MinLength;
use Bayfront\Validator\Rules\Numeric;
use Bayfront\Validator\Rules\Required;
use Bayfront\Validator\Rules\StartsWith;
use Bayfront\Validator\Rules\Url;
use Bayfront\Validator\Rules\Uuid;
use Bayfront\Validator\Rules\Uuidv4;

class Validator
{

    /**
     * Was the validation valid?
     *
     * @var bool
     */
    private bool $is_valid = true;

    /**
     * Validation messages.
     *
     * @var array
     */
    private array $messages = [];

    /**
     * Defined validation messages.
     *
     * @var array
     */
    private array $set_messages = [];

    /**
     * Available validation rules.
     *
     * @var array
     */
    private array $rules = [
        'alpha' => Alpha::class,
        'alphaNumeric' => AlphaNumeric::class,
        'between' => Between::class,
        'contains' => Contains::class,
        'date' => Date::class,
        'email' => Email::class,
        'endsWith' => EndsWith::class,
        'equals' => Equals::class,
        'greaterThan' => GreaterThan::class,
        'greaterThanOrEqual' => GreaterThanOrEqual::class,
        'ip' => Ip::class,
        'ipv4' => Ipv4::class,
        'ipv6' => Ipv6::class,
        'isArray' => IsArray::class,
        'isBoolean' => IsBoolean::class,
        'isEmpty' => IsEmpty::class,
        'isFloat' => IsFloat::class,
        'isInteger' => IsInteger::class,
        'isJson' => IsJson::class,
        'isNull' => IsNull::class,
        'isObject' => IsObject::class,
        'isString' => IsString::class,
        'lengthBetween' => LengthBetween::class,
        'lengthEquals' => LengthEquals::class,
        'lessThan' => LessThan::class,
        'lessThanOrEqual' => LessThanOrEqual::class,
        'matches' => Matches::class,
        'maxLength' => MaxLength::class,
        'minLength' => MinLength::class,
        'numeric' => Numeric::class,
        'required' => Required::class,
        'startsWith' => StartsWith::class,
        'url' => Url::class,
        'uuid' => Uuid::class,
        'uuidv4' => Uuidv4::class
    ];

    /**
     * Checks if array key exists including null value.
     *
     * @param array $array
     * @param string $key (In dot notation)
     * @return bool
     */
    private function keyDoesNotExist(array $array, string $key): bool
    {
        return Arr::get($array, $key) === null && Arr::get($array, $key, []) === [];
    }

    /**
     * Validate input against a set of rules.
     *
     * @param array $input
     * @param array $rules
     * @param bool $require_all
     * @param bool $first_error_only
     * @return self
     */
    public function validate(array $input, array $rules, bool $require_all = false, bool $first_error_only = false): Validator
    {

        foreach ($rules as $input_key => $rule_list) {

            $rule_list = explode('|', $rule_list);

            foreach ($rule_list as $rule_definition) {

                // Check required

                if (in_array('required', $rule_list)) {

                    /** @var ValidationRuleInterface $rule_class */
                    $rule_class = new $this->rules['required']($input, $input_key);

                    if (!$rule_class->isValid()) {

                        $this->is_valid = false;
                        $this->messages[$input_key][] = $rule_class->getMessage();

                        if ($first_error_only) {
                            return $this;
                        }

                        continue 2; // Stop iterating this key

                    }

                }

                // Check nullable

                if (in_array('nullable', $rule_list)) {

                    /** @var ValidationRuleInterface $rule_class */
                    $rule_class = new $this->rules['isNull'](Arr::get($input, $input_key));

                    if ($rule_class->isValid()) {

                        /*
                        $this->is_valid = false;
                        $this->messages[$input_key][] = $rule_class->getMessage();

                        if ($first_error_only) {
                            return $this;
                        }

                        continue 2; // Stop iterating this key
                        */

                        continue 2; // Stop iterating this key

                    }

                }

                /*
                if (in_array('nullable', $rule_list) &&
                    Arr::get($input, $input_key, []) === null) {
                    continue 2;
                }
                */

                // Check all other rules

                $definition = explode(':', $rule_definition, 2);

                $rule = $definition[0];

                if ($rule == 'required' || $rule =='nullable') {
                   continue; // Already checked
                }

                if (!isset($this->rules[$rule])) {

                    $this->is_valid = false;
                    $this->messages[$input_key][] = 'Invalid rule: ' . $rule;

                    if ($first_error_only) {
                        return $this;
                    }

                }

                if ($this->keyDoesNotExist($input, $input_key)) {

                    if ($require_all) {

                        $this->is_valid = false;
                        $this->messages[$input_key][] = 'Key does not exist: ' . $input_key;

                        if ($first_error_only) {
                            return $this;
                        }

                    }

                    continue 2; // Stop iterating this key

                }

                /*
                echo 'key: ' . $input_key . ' rule: ' . $rule . PHP_EOL;
                print_r($definition);
                die;
                */

                if (!isset($definition[1])) { // No parameters defined in rule

                    /*
                    $params = [
                        $input,
                        $input_key
                    ];
                    */

                    $params = [Arr::get($input, $input_key)];

                } else { // Parameters defined in rule

                    $params = explode(',', $definition[1]);

                    array_unshift($params, Arr::get($input, $input_key)); // Subject
                    //array_unshift($params, $input); // Add entire array to beginning

                }

                /** @var ValidationRuleInterface $rule_class */
                $rule_class = new $this->rules[$rule](...$params);

                if (!$rule_class->isValid()) {

                    $this->is_valid = false;
                    $this->messages[$input_key][] = $rule_class->getMessage();

                    if ($first_error_only) {
                        return $this;
                    }

                }

            }


        }

        return $this;

    }

    /**
     * Was the validation valid?
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->is_valid;
    }

    /**
     * Set validation messages for specific array keys.
     *
     * @param array $messages (Key = Array key in dot notation, Value = Message)
     * @return $this
     */
    public function setMessages(array $messages): Validator
    {

        foreach ($messages as $key => $message) {
            $this->set_messages[$key][0] = $message;
        }

        return $this;

    }

    /**
     * Get all validation messages.
     *
     * Array keys equal the rule array key in which the validation error occurred.
     *
     * @return array
     */
    public function getMessages(): array
    {

        $messages = $this->messages;

        foreach ($this->set_messages as $k => $v) {
            if (isset($messages[$k])) {
                $messages[$k] = $v;
            }
        }

        return $messages;

    }

}
<?php

namespace Bayfront\Validator;

use Bayfront\ArrayHelpers\Arr;
use DateTime;

class Validate
{

    /*
     * ############################################################
     * Strings
     * ############################################################
     */

    /**
     * Checks if string is empty.
     *
     * @param string $string
     *
     * @return bool
     */

    public static function empty(string $string): bool
    {
        return $string == '';
    }

    /**
     * Checks if two strings match.
     *
     * @param string $string
     * @param string $matches
     *
     * @return bool
     */

    public static function matches(string $string, string $matches): bool
    {
        return $string == $matches;
    }

    /**
     * Checks if string length is greater than or equal to a given length.
     *
     * @param string $string
     * @param int $length
     *
     * @return bool
     */

    public static function minLength(string $string, int $length): bool
    {
        return strlen($string) >= $length;
    }

    /**
     * Checks if string length is less than or equal to a given length.
     *
     * @param string $string
     * @param int $length
     *
     * @return bool
     */

    public static function maxLength(string $string, int $length): bool
    {
        return strlen($string) <= $length;
    }

    /**
     * Checks if string length is equal to a given length.
     *
     * @param string $string
     * @param int $length
     *
     * @return bool
     */

    public static function lengthEquals(string $string, int $length): bool
    {
        return strlen($string) == $length;
    }

    /**
     * Checks if string length is between min and max length.
     *
     * @param string $string
     * @param int $min
     * @param int $max
     *
     * @return bool
     */

    public static function lengthBetween(string $string, int $min, int $max): bool
    {
        return strlen($string) >= $min && strlen($string) <= $max;
    }

    /**
     * Checks if string contains case-sensitive needle(s).
     *
     * @param string $string
     * @param $needles array|string
     *
     * @return bool
     */

    public static function contains(string $string, array|string $needles): bool
    {
        $needles = (array)$needles;

        foreach ($needles as $needle) {

            if (!str_contains($string, $needle)) {

                return false;

            }

        }

        return true;

    }

    /**
     * Checks if string begins with a given needle.
     *
     * @param string $string
     * @param string $needle
     *
     * @return bool
     */

    public static function startsWith(string $string, string $needle): bool
    {
        return str_starts_with($string, $needle);
    }

    /**
     * Checks if string ends with a given needle.
     *
     * @param string $string
     * @param string $needle
     *
     * @return bool
     */

    public static function endsWith(string $string, string $needle): bool
    {
        return str_ends_with($string, $needle);
    }

    /**
     * Checks if string validates as email.
     *
     * @param string $string
     *
     * @return bool
     */

    public static function email(string $string): bool
    {
        return filter_var($string, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Checks if string validates as a URL.
     *
     * @param string $string
     *
     * @return bool
     */

    public static function url(string $string): bool
    {
        return filter_var($string, FILTER_VALIDATE_URL);
    }

    /**
     * Checks if string validates as an IP address.
     *
     * @param string $string
     *
     * @return bool
     */

    public static function ip(string $string): bool
    {
        return filter_var($string, FILTER_VALIDATE_IP);
    }

    /**
     * Checks if string validates as an IPv4 address.
     *
     * @param string $string
     *
     * @return bool
     */

    public static function ipv4(string $string): bool
    {
        return filter_var($string, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    /**
     * Checks if string validates as an IPv6 address.
     *
     * @param string $string
     *
     * @return bool
     */

    public static function ipv6(string $string): bool
    {
        return filter_var($string, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
    }

    /**
     * Checks if string only contains alpha characters.
     *
     * @param string $string
     *
     * @return bool
     */

    public static function alpha(string $string): bool
    {
        return ctype_alpha($string);
    }

    /**
     * Checks if string is numeric.
     *
     * @param string $string
     *
     * @return bool
     */

    public static function numeric(string $string): bool
    {
        return (is_numeric($string));
    }

    /**
     * Checks if string only contains alphanumeric characters.
     *
     * @param string $string
     *
     * @return bool
     */

    public static function alphaNumeric(string $string): bool
    {
        return ctype_alnum($string);
    }

    /**
     * Checks if string is a valid date according to a given format.
     *
     * See: https://www.php.net/manual/en/datetime.format.php
     *
     * @param string $string
     * @param string $format (Date format to validate)
     *
     * @return bool
     */

    public static function date(string $string, string $format = 'Y-m-d H:i:s'): bool
    {
        $obj = DateTime::createFromFormat($format, $string);

        return $obj && $obj->format($format) == $string;
    }

    /*
     * ############################################################
     * Numbers
     * ############################################################
     */

    /**
     * Checks if value is less than a given number.
     *
     * @param int $value
     * @param int $compare
     *
     * @return bool
     */

    public static function lessThan(int $value, int $compare): bool
    {
        return $value < $compare;
    }

    /**
     * Checks if value is greater than a given number.
     *
     * @param int $value
     * @param int $compare
     *
     * @return bool
     */

    public static function greaterThan(int $value, int $compare): bool
    {
        return $value > $compare;
    }

    /**
     * Checks if value is less than or equal to a given number.
     *
     * @param int $value
     * @param int $compare
     *
     * @return bool
     */

    public static function lessThanOrEqual(int $value, int $compare): bool
    {
        return $value <= $compare;
    }

    /**
     * Checks if value is greater than or equal to a given number.
     *
     * @param int $value
     * @param int $compare
     *
     * @return bool
     */

    public static function greaterThanOrEqual(int $value, int $compare): bool
    {
        return $value >= $compare;
    }

    /**
     * Checks if values are equal.
     *
     * @param int $value
     * @param int $compare
     *
     * @return bool
     */

    public static function equals(int $value, int $compare): bool
    {
        return $value == $compare;
    }

    /**
     * Checks if value is between given min and max values.
     *
     * @param int $value
     * @param int $min
     * @param int $max
     *
     * @return bool
     */

    public static function between(int $value, int $min, int $max): bool
    {
        return $value >= $min && $value <= $max;
    }

    /*
     * ############################################################
     * Types
     * ############################################################
     */

    /**
     * Checks if value is NULL.
     *
     * @param mixed $value
     *
     * @return bool
     */

    public static function null(mixed $value): bool
    {
        return (NULL === $value);
    }

    /**
     * Checks if value is an integer.
     *
     * @param mixed $value
     *
     * @return bool
     */

    public static function integer(mixed $value): bool
    {
        return is_int($value);
    }

    /**
     * Checks if value is a float.
     *
     * @param mixed $value
     *
     * @return bool
     */

    public static function float(mixed $value): bool
    {
        return is_float($value);
    }

    /**
     * Checks if value is a boolean.
     *
     * @param mixed $value
     *
     * @return bool
     */

    public static function boolean(mixed $value): bool
    {
        return is_bool($value);
    }

    /**
     * Checks if value is an object.
     *
     * @param mixed $value
     *
     * @return bool
     */

    public static function object(mixed $value): bool
    {
        return is_object($value);
    }

    /**
     * Checks if value is an array.
     *
     * @param mixed $value
     *
     * @return bool
     */

    public static function array(mixed $value): bool
    {
        return is_array($value);
    }

    /**
     * Checks if value is a string.
     *
     * @param mixed $value
     *
     * @return bool
     */

    public static function string(mixed $value): bool
    {
        return is_string($value);
    }

    /**
     * Checks if value is a JSON string.
     *
     * @param mixed $value
     *
     * @return bool
     */

    public static function json(mixed $value): bool
    {

        if (self::string($value)) {

            if (NULL !== json_decode($value)) {

                return (json_last_error() == JSON_ERROR_NONE);

            }

        }

        return false;

    }

    /**
     * Validate array values against a set of rules.
     *
     * Multiple rules can be validated against one key by separating them with a pipe (|).
     *
     * Available rules are:
     *
     *  - empty
     *  - email
     *  - url
     *  - ip
     *  - ipv4
     *  - ipv6
     *  - alpha
     *  - numeric
     *  - alphanumeric
     *  - null
     *  - integer
     *  - float
     *  - boolean
     *  - object
     *  - array
     *  - string
     *  - json
     *
     * @param array $array (Array to validate)
     * @param array $rules
     *     (Array whose keys are the array key to validate in dot notation
     *     and values are the rule)
     *
     * @return void
     *
     * @throws ValidationException
     */

    public static function as(array $array, array $rules): void
    {

        $valid_rules = [
            'empty',
            'email',
            'url',
            'ip',
            'ipv4',
            'ipv6',
            'alpha',
            'numeric',
            'alphanumeric',
            'null',
            'integer',
            'float',
            'boolean',
            'object',
            'array',
            'string',
            'json'
        ];

        foreach ($rules as $key => $v) {

            $validations = explode('|', $v);

            foreach ($validations as $validation) {

                /*
                 * Because flattening the array using Arr::dot removes empty arrays,
                 * the "array" rule must be explicitly validated here.
                 */

                if ($validation == 'array') { // Validate array

                    $value = Arr::get($array, $key, []); // Get value in dot notation

                    if (self::array($value)) {

                        continue 2; // Passed: iterate to next rule

                    }

                    continue; // Failed: continue to next validation

                    /*
                     * Because a key with NULL value will not be returned below,
                     * the "null" rule must be explicitly validated here.
                     */

                } else if ($validation == 'null') { // Validate null

                    if (self::null(Arr::get($array, $key))) {

                        continue 2; // Passed: iterate to next rule

                    }

                    continue; // Failed: continue to next validation

                } else if (Arr::has($array, $key)) { // Check for all other keys in dot notation

                    if (in_array($validation, $valid_rules)) { // Validate everything else

                        if (self::$validation(Arr::get($array, $key))) {

                            continue 2; // Passed: iterate to next rule

                        }

                        continue; // Failed: continue to next validation

                    }

                } else {

                    continue 2; // Key does not exist on array: iterate to next rule

                }

                /*
                 * Invalid rule
                 */

                throw new ValidationException('Unable to validate value (' . $key . '): invalid rule (' . $v . ')');

            }

            /*
             * If all the validation rules have iterated and no passing rule was found
             */

            throw new ValidationException('Unable to validate value (' . $key . '): with rule (' . $v . ')');

        }

    }

}
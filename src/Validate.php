<?php

/**
 * @package php-validator
 * @link https://github.com/bayfrontmedia/php-validator
 * @author John Robinson <john@bayfrontmedia.com>
 * @copyright 2020 Bayfront Media
 */

namespace Bayfront\Validator;

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
     * @param $needles string|array
     *
     * @return bool
     */

    public static function contains(string $string, $needles): bool
    {
        $needles = (array)$needles;

        foreach ($needles as $needle) {

            if (strpos($string, $needle) === false) {

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
        return substr($string, 0, strlen($needle)) === $needle;
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
        return substr($string, -strlen($needle)) === $needle;
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
        return (ctype_alpha($string)) ? true : false;
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
        return (ctype_alnum($string)) ? true : false;
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
     * Checks if value is an integer.
     *
     * @param mixed $value
     *
     * @return bool
     */

    public static function integer($value): bool
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

    public static function float($value): bool
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

    public static function boolean($value): bool
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

    public static function object($value): bool
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

    public static function array($value): bool
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

    public static function string($value): bool
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

    public static function json($value): bool
    {

        if (self::string($value)) {

            if (NULL !== json_decode($value)) {

                return (json_last_error() == JSON_ERROR_NONE);

            }

        }

        return false;

    }

}
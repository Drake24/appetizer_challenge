<?php

namespace App\Helpers;

class Functions
{
    /**
     * Convert Json String to Associative Array.
     *
     * @param  string  $jsonString
     * @return associative array $self
     */
	public static function toArray($jsonString)
    {
        return json_decode($jsonString, true);    	
    }

    /**
     * Convert Json String to Object.
     *
     * @param  string  $jsonString
     * @return jsonObject $self
     */
    public static function toObject($jsonString)
    {
    	return json_decode($jsonString);
    }

    /**
     * Converts an array to a Json String
     *
     * @param  array $array
     * @return jsonObject $self
     */
    public static function toJson($array)
    {
        return json_encode($array);
    }

    /**
     * Converts string to date
     *
     * @param  string $date
     * @return date $self
     */
    public static function convertDate($date)
    {
        return date('Y-m-d', strtotime($date));
    }

    /**
     * Converts difference of two dates
     *
     * @param  string $date
     * @param  string $date
     * @return int $self
     */
    public static function dateDiff($startDate, $endDate)
    {
        $dateDiff = date_diff(date_create($startDate), date_create($endDate));
        return $dateDiff->format("%R%a");
    }

    /**
     * Converts string date to date object
     *
     * @param  string $date
     * @return date $self
     */
    public static function toDate($date)
    {
        return date_create($date);
    }

    /**
     * Converts date to integer presentation of day
     *
     * @param  string $date
     * @return int $self
     */
    public static function day($date)
    {
        return $dayofweek = date('w', strtotime($date));
    }
}
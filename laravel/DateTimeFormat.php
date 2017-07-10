<?php

use Illuminate\Database\Eloquent\Model;
use DateTime;
class DateTimeFormat extends Model
{
    // this is for laravel eloquent accessor and mutator functionalities only

    /**
     * convert from integer time format (second) to readable time format ( for e.g.: Y-M-d)
     * DATE_FORMAT has been defined in app/constants.php file
     * database column affected: published_date
     * @param: Integer (time in second-base)
     * @return: String (time in readable format)
     */
    public function getPublishedDateAttribute($value) {
        try {
            $input_format = 'U';
            $date = DateTime::createFromFormat($input_format, $value);
            return $date->format(\Config::get('constants.DATE_FORMAT'));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * convert from readable time format (second) to second-base time format
     * DATE_FORMAT has been defined in app/constants.php file
     * database column affected: published_date
     * @param: String (time in readable format)
     * @return: Integer (time in second-base)
     */
    public function setPublishedDateAttribute($value) {
        try {
            $input_format = \Config::get('constants.DATE_FORMAT');
            $date = DateTime::createFromFormat($input_format, $value);
            $this->attributes['published_date'] = $date->format('U');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
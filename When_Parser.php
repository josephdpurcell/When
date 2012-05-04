<?php
/**
 * Name: WhenParser
 * Author: Joseph D. Purcell <josephdpurcell@gmail.com>
 * Location: http://github.com/josephdpurcell/WhenParser
 * Created: May 2012
 * Description: Extends the When library to parse human readable strings for recurring dates
 * Requirements: The When library and its dependencies
 */
class When_Parser
{
    private $when;

    public function __construct ()
    {
        $this->When = new When;

		$this->valid_week_days = array('SU', 'MO', 'TU', 'WE', 'TH', 'FR', 'SA');
		$this->valid_months = array('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
		$this->valid_frequencies = array('SECONDLY', 'MINUTELY', 'HOURLY', 'DAILY', 'WEEKLY', 'MONTHLY', 'YEARLY');

        $this->week_days_map = array(
                'SUNDAY' => 'SU',
                'MONDAY' => 'MO',
                'TUESDAY' => 'TU',
                'WEDNESDAY' => 'WE',
                'THURSDAY' => 'TH',
                'FRIDAY' => 'FR',
                'SATURDAY' => 'SA',
                'SUN' => 'SU',
                'MON' => 'MO',
                'TUE' => 'TU',
                'WED' => 'WE',
                'THU' => 'TH',
                'FRI' => 'FR',
                'SAT' => 'SA'
                );
        $this->months_map = array(
                'JANUARY'=>'JAN',
                'FEBRUARY'=>'FEB',
                'MARCH'=>'MAR',
                'APRIL'=>'APR',
                'MAY'=>'MAY',
                'JUNE'=>'JUN',
                'JULY'=>'JUL',
                'AUGUST'=>'AUG',
                'SEPTEMBER'=>'SEP',
                'OCTOBER'=>'OCT',
                'NOVEMBER'=>'NOV',
                'DECEMBER'=>'DEC'
                );
        $this->frequency_map = array(
                'EVERY SECOND'=>'SECONDLY',
                'EVERY MINUTE'=>'MINUTELY',
                'EVERY HOUR'=>'HOURLY',
                'EVERY DAY'=>'DAILY',
                'EVERY WEEK'=>'WEEKLY',
                'EVERY MONTH'=>'MONTHLY',
                'EVERY YEAR'=>'YEARLY',
                'EACH SECOND'=>'SECONDLY',
                'EACH MINUTE'=>'MINUTELY',
                'EACH HOUR'=>'HOURLY',
                'EACH DAY'=>'DAILY',
                'EACH WEEK'=>'WEEKLY',
                'EACH MONTH'=>'MONTHLY',
                'EACH YEAR'=>'YEARLY',
                'ONCE A SECOND'=>'SECONDLY',
                'ONCE A MINUTE'=>'MINUTELY',
                'ONCE A HOUR'=>'HOURLY',
                'ONCE A DAY'=>'DAILY',
                'ONCE A WEEK'=>'WEEKLY',
                'ONCE A MONTH'=>'MONTHLY',
                'ONCE A YEAR'=>'YEARLY'
                );
    }

    public function parse ($string)
    {
        $string = strtoupper($string);

        list($year,$month,$day,$hour,$minute,$second,$freq) = $this->_extract($string,'today');

        // get recurrence object
        $date = $year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':'.$second;
        $r = new When;
        $r->recur($date,$freq);

        return $r;
    }

    /**
     * @param string $string The string to extract data from
     * @param bool|string $default_to Can be false to return null, 'today' or
     * true for today, or 'now' for the current time
     */
    private function _extract ($string,$default_to=false)
    {
        if (!$default_to)
        {
            $year = null;
            $month = null;
            $day = null;
            $hour = null;
            $minute = null;
            $second = null;
            $freq = null;
        }
        else if ($default_to=='today')
        {
            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $hour = '00';
            $minute = '00';
            $second = '00';
            $freq = null;
        }
        else
        {
            $year = date('Y');
            $month = date('m');
            $day = date('d');
            $hour = date('h');
            $minute = date('m');
            $second = date('s');
            $freq = null;
        }

        //
        // GET DAY, MONTH, YEAR
        //

        // GET BY A DATE
        $date = null;
        $regex = '/[0-9]+\/[0-9]+\/[0-9]+/';
        preg_match($regex,$string,$matches);
        if (is_array($matches) && !empty($matches[0]))
        {
            $date = $matches[0];
        }
        if ($date)
        {
            $time = strtotime($date);
            $year = date('Y',$time);
            $month = date('m',$time);
            $day = date('d',$time);
        }

        // ELSE GET BY INDIVIDUAL
        else
        {
            // YEAR
            // TODO
            $year = date('Y');

            // DAY
            // map day
            // TODO
            // get day
            $regex = '/ON( THE)? [0-9]{1,}/';
            preg_match($regex,$string,$matches);
            if (is_array($matches) && !empty($matches[0]))
            {
                $regex = '/[0-9]{1,}/';
                preg_match($regex,$matches[0],$matches);
                if (is_array($matches))
                {
                    $day = $matches[0];
                }
            }

            // MONTH
            // map month
            $keys = array_keys($this->months_map);
            $values = array_values($this->months_map);
            $string = str_replace($keys,$values,$string);
            // get month
            $regex = '/('.implode('|',$this->valid_months).')/';
            preg_match($regex,$string,$matches);
            if (is_array($matches) && !empty($matches[0]))
            {
                $month = $matches[0];
            }
            $string = str_replace("EVERY {$month}",'EVERY YEAR',$string);
            // map time
            // TODO
            // get time
            // TODO
        }

        // GET FREQUENCY
        // map frequency
        $keys = array_keys($this->frequency_map);
        $values = array_values($this->frequency_map);
        $string = str_replace($keys,$values,$string);
        // grab frequency
        $regex = '/('.implode('|',$this->valid_frequencies).')/';
        preg_match($regex,$string,$matches);
        if (is_array($matches) && !empty($matches[0]))
        {
            $freq = $matches[0];
        }

        /*
        $retval = array($year,$month,$day,$hour,$minute,$second,$freq);
        print_r($retval);
        die();
        */

        return array($year,$month,$day,$hour,$minute,$second,$freq);
    }

}

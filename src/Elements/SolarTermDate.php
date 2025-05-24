<?php

namespace JapaneseDate\Elements;

use JapaneseDate\Components\JapaneseDate;
use JapaneseDate\DateTime;
use RuntimeException;

/**
 * Class SolarTermDate
 *
 * @property-read int year
 * @property-read int solar_term
 * @property-read int month
 * @property-read int day
 * @property-read float solar_longitude
 * @property-read bool is_sekki
 * @property-read bool is_chuki
 */
class SolarTermDate
{
    protected array $attribute = [
        'is_sekki' => false,
        'is_chuki' => false,

        'year'            => 0,
        'solar_term'      => -1,
        'month'           => 0,
        'day'             => 0,
        'solar_longitude' => 0.0,
    ];

    /**
     * @var array
     */
    protected const SOLAR_TERM_MONTH = [
        3, 4, 4, 5, 5, 6, 6, 7, 7, 8, 8, 9, 9, 10, 10, 11, 11, 12, 12, 1, 1, 2, 2, 3,
    ];

    /**
     * @param int $year
     * @param int $solar_term
     * @param int $day
     */
    public function __construct(int $year, int $solar_term, int $day)
    {
        $this->attribute['year'] = $year;
        $this->attribute['solar_term'] = $solar_term;
        $this->attribute['day'] = $day;

        if ($solar_term % 2 === 0) {
            $this->attribute['is_chuki'] = true;
        } else {
            $this->attribute['is_sekki'] = true;
        }

        $this->attribute['month'] = self::SOLAR_TERM_MONTH[$solar_term];

        $this->attribute['solar_longitude'] = 15 * $solar_term;
    }

    /**
     * @param string $key
     * @return string|\JapaneseDate\DateTime|null|int
     */
    public function __get(string $key): null|string|DateTime|int
    {
        return $this->attribute[$key] ?? match ($key) {
            'solarTermText' => JapaneseDate::SOLAR_TERM[$this->solar_term],
            'dateTime'      => DateTime::create($this->year, $this->month, $this->day),
            default         => null,
        };
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set(string $key, mixed $value)
    {
        throw new RuntimeException('Can not set key:' . $key . ' =  ' . $value);
    }

    /**
     * @param string $key
     * @return bool
     */
    public function __isset(string $key): bool
    {
        return match ($key) {
            'solarTermText', 'dateTime' => true,
            default => isset($this->attribute[$key]),
        };
    }
}

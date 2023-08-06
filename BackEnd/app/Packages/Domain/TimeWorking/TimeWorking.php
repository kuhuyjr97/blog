<?php

namespace App\Packages\Domain\TimeWorking;

use DateTime;

class TimeWorking
{
    private Datetime $timeStart;
    private Datetime $timeEnd;

    /**
     * User constructor.
     * @param Datetime $timeStart
     * @param Datetime $timeEnd
     */
    public function __construct(
        Datetime $timeStart,
        Datetime $timeEnd
    ) {
        $this->timeStart = $timeStart;
        $this->timeEnd = $timeEnd;
    }

    /**
     * @return DateTime
     */
    public function timeStart(): DateTime
    {
        return $this->timeStart;
    }

    /**
     * @return DateTime
     */
    public function timeEnd(): DateTime
    {
        return $this->timeEnd;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'time_start' => $this->timeStart(),
            'time_end' => $this->timeEnd(),
        ];
    }
}

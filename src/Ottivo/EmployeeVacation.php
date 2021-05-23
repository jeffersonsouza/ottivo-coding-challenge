<?php

namespace Ottivo;

use DateTime;

class EmployeeVacation
{
    public array $employee;
    private int $defaultVacationDays = 26;
    private int $minimumAgeForAdditionalDays = 30;
    private int $targetYear;

    public function __construct(array $employee, int $targetYear)
    {
        $this->targetYear = $targetYear;

        // converting into named parameters only to keep the things readable
        $this->employee = [
            'name' => $employee[0],
            'birthDate' => $employee[1],
            'contractStartDate' => $employee[2],
            'specialContract' => $employee[3] ?? '',
        ];
    }

    public function getEmployeeVacationDays(): array
    {
        $vacationDays = $this->getCurrentVacationDays($this->employee['contractStartDate'], $this->employee['specialContract']);
        $additionalVacationDays = $this->getAdditionalVacationDays($this->employee['birthDate']);

        return [
            'name' => $this->employee['name'],
            'vacationDays' => is_int($vacationDays) ? $vacationDays + $additionalVacationDays : $vacationDays,
        ];
    }

    public function getCurrentVacationDays(string $contractStartDate, string $specialContract): int | string
    {
        $contractDate = new DateTime($contractStartDate);
        if ($this->targetYear < $contractDate->format('Y')) {
            return 'not applicable';
        }

        if (!empty($specialContract)) {
            return intval($specialContract);
        }

        if ($this->targetYear > $contractDate->format('Y')) {
            return $this->defaultVacationDays;
        }

        $monthsInAYear = 12; // this is "dummy", but is good to avoid "magic numbers" in code
        $monthsOfContract = ($monthsInAYear - $contractDate->format('m'));

        if (01 == $contractDate->format('d')) {
            // adding +1 to count start month as full month
            // when start date is at first day of month
            ++$monthsOfContract;
        }

        return ceil(($this->defaultVacationDays / $monthsInAYear) * $monthsOfContract);
    }

    public function getAdditionalVacationDays(string $dateOfBirth): int
    {
        $yearsToGetAdditionalVacationDay = 5;
        $currentDate = new DateTime();
        $birthDate = new DateTime($dateOfBirth);

        $age = $birthDate->diff($currentDate)->y;
        if ($age < $this->minimumAgeForAdditionalDays) {
            return 0;
        }

        return floor(($age - $this->minimumAgeForAdditionalDays) / $yearsToGetAdditionalVacationDay);
    }
}

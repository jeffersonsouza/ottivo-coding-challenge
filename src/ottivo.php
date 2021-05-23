<?php

use Ottivo\EmployeeVacation;

require_once __DIR__.'/../vendor/autoload.php';

/*
 * The Task.
 *
 * The fictional company Ottivo wants to determine each of its employee's
 * yearly vacation days for a given year.
 *
 * Requirements:
 * - Each employee has a minimum of 26 vacation days regardless of age;
 * - A special contract can overwrite the amount of minimum vacation days;
 * - Employees >= 30 years get one additional vacation day every 5 years;
 * - Contracts can start on the 1st or the 15th of a month;
 * - Contracts starting in the course of the year get 1/12 of the yearly
 *   vacation days for each full month;
 */

/**
 * Load the list of Employees from CSV file and and print the processed result.
 *
 * @param [string]       $csvPath
 * @param [int | string] $year
 */
function processLines(string $csvPath, int | string $year): void
{
    try {
        $file = fopen($csvPath, 'r');
        fgetcsv($file, 1000, ','); // Just to skip the header of csv ;)

        // Formating the output and printing out the header
        echo "\n";
        $mask = "%-20.20s | %-15.15s\n";
        printf($mask, 'Name', 'Vacation Days');
        echo "-------------------------------------- \n";

        while ($data = fgetcsv($file, 1000, ',')) {
            $employeeVacation = new EmployeeVacation($data, $year);
            $vacationData = $employeeVacation->getEmployeeVacationDays();
            printf($mask, $vacationData['name'], $vacationData['vacationDays']);
        }

        fclose($file);
    } catch (Exception $exception) {
        echo 'Failed to open the file. '.$exception->getMessage();
    }
}

$targetYear = '';
while (empty($targetYear)) {
    $targetYear = intval(readline('Please enter the target year: '));

    // small check to avoid to call the function with invalid year
    $targetYear = $targetYear ?? '';
}

processLines(__DIR__.'/'.'list-of-employees.csv', $targetYear);

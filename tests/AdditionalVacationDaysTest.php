<?php

namespace Test;

use Ottivo\EmployeeVacation;

/**
 * @internal
 * @coversNothing
 */
class AdditionalVacationDaysTest extends \Codeception\Test\Unit
{
    private EmployeeVacation $employeeWithNoAdditionalDays;
    private EmployeeVacation $employeeWithTwoAdditionalDays;

    // tests
    public function testWithNoAdditionalDays()
    {
        $this->assertEquals(0, $this->employeeWithNoAdditionalDays->getAdditionalVacationDays(
            $this->employeeWithNoAdditionalDays->employee['birthDate']
        ));
    }


    public function testWithAdditionalDays()
    {
        $this->assertEquals(2, $this->employeeWithTwoAdditionalDays->getAdditionalVacationDays(
            $this->employeeWithTwoAdditionalDays->employee['birthDate']
        ));
    }


    protected function _before()
    {
        $this->employeeWithNoAdditionalDays = new EmployeeVacation([
            'Jefferson Souza', '10.11.1986', '01.05.2018',
        ], 2021);

        $this->employeeWithTwoAdditionalDays = new EmployeeVacation([
            'Jefferson Souza', '10.11.1978', '01.05.2018',
        ], 2021);
    }

    protected function _after()
    {
    }
}

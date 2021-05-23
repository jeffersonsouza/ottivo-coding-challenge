<?php

namespace Test;

use Ottivo\EmployeeVacation;

/**
 * @internal
 * @coversNothing
 */
class CurrentVacationDaysTest extends \Codeception\Test\Unit
{
    private EmployeeVacation $employee;
    private EmployeeVacation $employeeNotApplicable;
    private EmployeeVacation $employeeWithNoFullVacationDays;
    private $defaultContractDays = 26;
    private $specialContractDays = 30;

    // tests
    public function testDefaultDays()
    {
        $this->assertEquals($this->defaultContractDays, $this->employee->getCurrentVacationDays($this->employee->employee['contractStartDate'], ''));
    }

    public function testSpecialContractDays()
    {
        $this->assertEquals($this->specialContractDays, $this->employee->getCurrentVacationDays(
            $this->employee->employee['contractStartDate'],
            $this->employee->employee['specialContract'],
        ));
    }

    public function testNotApplicable()
    {
        $this->assertEquals('not applicable', $this->employeeNotApplicable->getCurrentVacationDays(
            $this->employeeNotApplicable->employee['contractStartDate'],
            $this->employeeNotApplicable->employee['specialContract']
        ));
    }

    public function testWithNoFullVacationDays()
    {
        $this->assertEquals(7, $this->employeeWithNoFullVacationDays->getCurrentVacationDays(
            $this->employeeWithNoFullVacationDays->employee['contractStartDate'],
            $this->employeeWithNoFullVacationDays->employee['specialContract']
        ));
    }

    protected function _before()
    {
        $this->employee = new EmployeeVacation([
            'Jefferson Souza', '10.11.1986', '01.05.2018', "{$this->specialContractDays} vacation days",
        ], 2021);

        $this->employeeWithNoFullVacationDays = new EmployeeVacation([
            'Jefferson Souza', '10.11.1986', '01.10.2018',
        ], 2018);

        $this->employeeNotApplicable = new EmployeeVacation([
            'Jefferson Souza', '10.11.1986', '01.05.2018',
        ], 2017);
    }
}

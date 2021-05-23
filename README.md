## Coding Test - Employees Vacation

### The Task

The fictional company Ottivo wants to determine each of its employee's yearly vacation days for a
given year.

Requirements:
Each employee has a minimum of 26 vacation days regardless of age
A special contract can overwrite the amount of minimum vacation days
Employees >= 30 years get one additional vacation day every 5 years
Contracts can start on the 1st or the 15th of a month
Contracts starting in the course of the year get 1/12 of the yearly vacation days for each full
month

For your solution, please implement a command line script that takes the year of interest as an
input argument and outputs the employees names with the respective number of vacation days.

Please avoid using a database to store the employees and include a README file documenting
how to setup and run the command as well as its tests. If you feel that there are ambiguities in the
requirements, feel free to make assumptions and also document them.

### Project Considerations

The task was quite simple to solve, from beginning to the end was between 3 to 4 hours to configure everything, create the tests
and program the requirements.

The task could've been done with some structured code or just created a couple functions to solve the problem, but I opted to
implement a proper project to turn the solution more understandable and turn easier to create the tests.

In main class, the properties to current employee and also the methods that extract the necessary information could be private to the class,
I've opted to make then public to turn the test scripts simple and do not need to use class reflection to then call private methods.

I used the Codeception test lib to create the tests, but it could also be done with PHP Unit. I just choose Codeception because I'm used to it.

### Running the Project

The project was created and tested using `docker` containers and `docker-compose` commands.
You can find the `docker-compose.yml` file at the root directory of this project. So, to continue I'm assuming that you
have `docker` and `docker-compose` up and running on your machine.

I'm using composer to manage the project dependencies (actually the test suite) and also to manage the main namespace.

To install the dependencies, you can simple run `docker-compose run composer` and the necessary dependencies will be installed.

To run the tests you can run the service `test` with the command `docker-compose run test`.

To run the main application you can run the service `ottivo` with the command `docker-compose run ottivo` and a prompt will ask for target year
to then call the code logic for calculation.

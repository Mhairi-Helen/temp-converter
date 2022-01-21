<?php

namespace Tests\Unit;

use Symfony\Component\Console\Application;
use Console\App\Commands\TempConverterCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

final class TempConverterTest extends TestCase
{
    /**
     * Set up new application with commnand
     * 
     */

    public function setup() : void
    {
        $TempConverterCommand = new TempConverterCommand();

        $application = new Application();
        
        $application->add($TempConverterCommand);
        $application->run();

    }

    /**
     * Check that Fahrenheit to Celsius conversion works
     * 
     * @return bool
     */
    public function testFahrenheitToCelsuius()
    {
        $this->assertSame("The temperature is 36.7 Celsius", $TempConverterCommand("98", "Fahrenheit"));
    }

    /**
     * Check that Celsius to Fahrenheit conversion works
     * 
     * @return bool
     */
    public function testCelsuiusToFahrenheit()
    {
        $this->assertSame("The temperature is 98.1 Fahrenheit", $TempConverterCommand("36.7", "Celsius" ));
    }

    /**
     * Check that only numerical values are accepted for
     * temperature and the correct error is returned
     * 
     * @return bool
     */
    public function testValueValidationError()
    {
        $this->assertSame("The first argument, the temperature, must be an number", $TempConverterCommand("Celsius", "Celsius" ));
    }

    /**
     * Check that only Fahrenheit or Celsius values are 
     * accepted for the unit and the correct error is 
     * returned
     * 
     * @return bool
     */
    public function testUnitValidationError()
    {
        $this->assertSame("Sorry, the unit must either be Fahrenheit or Celsius", $TempConverterCommand("98", "Foo" ));
    }

}
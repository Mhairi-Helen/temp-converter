<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Console\App\Commands\TempConverterCommand;
use Symfony\Component\Console\Tester\CommandTester;

final class TempConverterTest extends TestCase
{
    /**
     * Set up new application with commnand
     * 
     */

    public function setup() : void
    {   
        $application = new Application();
        $application->run();
        $command = $application->find('app:convert-temp');
        $commandTester = new CommandTester($command);
    }

    /**
     * Check that Fahrenheit to Celsius conversion works
     * 
     * @return bool
     */
    public function testFahrenheitToCelsuius()
    {
        $commandTester->execute([
            // pass arguments to the helper
            'value' => '98', 
            'unit' => 'Fahrenheit'
        ]);

        $this->assertSame("The temperature is 36.7 Celsius", $output);
    }

    /**
     * Check that Celsius to Fahrenheit conversion works
     * 
     * @return bool
     */
    public function testCelsuiusToFahrenheit()
    {  
        $commandTester->execute([
            // pass arguments to the helper
            'value' => '36.7', 
            'unit' => 'Celsius'
        ]);

        $this->assertSame("The temperature is 98.1 Fahrenheit", $output);
    }

    /**
     * Check that only numerical values are accepted for
     * temperature and the correct error is returned
     * 
     * @return bool
     */
    public function testValueValidationError()
    {       
        $commandTester->execute([
            // pass arguments to the helper
            'value' => 'Celsius', 
            'unit' => 'Celsius'
        ]);

        $this->assertSame("The first argument, the temperature, must be an number", $output);
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
          $commandTester->execute([
            // pass arguments to the helper
            'value' => '98', 
            'unit' => 'foo'
        ]);
        
        $this->assertSame("Sorry, the unit must either be Fahrenheit or Celsius", $output);
    }

}
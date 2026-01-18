<?php

namespace Omnia\LivewireCalendar\Tests;

use Omnia\LivewireCalendar\LivewireCalendar;
use Livewire\Livewire;
use Livewire\Features\SupportTesting\Testable;

class LivewireCalendarTest extends TestCase
{
    private function createComponent($parameters = []) : Testable
    {
        return Livewire::test(LivewireCalendar::class, $parameters);
    }

    public function test_can_build_component()
    {
        //Arrange

        //Act
        $component = $this->createComponent([]);

        //Assert
        $this->assertNotNull($component);
    }

    public function test_can_navigate_to_next_month()
    {
        //Arrange
        $component = $this->createComponent([]);

        //Act
        $component->call('goToNextMonth');

        //Assert
        $this->assertEquals(
            today()->startOfMonth()->addMonthNoOverflow(),
            $component->get('startsAt')
        );

        $this->assertEquals(
            today()->endOfMonth()->startOfDay()->addMonthNoOverflow(),
            $component->get('endsAt')
        );
    }

    public function test_can_navigate_to_previous_month()
    {
        //Arrange
        $component = $this->createComponent([]);

        //Act
        $component->call('goToPreviousMonth');

        //Assert
        $this->assertEquals(
            today()->startOfMonth()->subMonthNoOverflow(),
            $component->get('startsAt')
        );

        $this->assertEquals(
            today()->endOfMonth()->startOfDay()->subMonthNoOverflow(),
            $component->get('endsAt')
        );
    }

    public function test_can_navigate_to_current_month()
    {
        //Arrange
        $component = $this->createComponent([]);

        $component->call('goToPreviousMonth');
        $component->call('goToPreviousMonth');
        $component->call('goToPreviousMonth');

        //Act
        $component->call('goToCurrentMonth');

        //Assert
        $this->assertEquals(
            today()->startOfMonth(),
            $component->get('startsAt')
        );

        $this->assertEquals(
            today()->endOfMonth()->startOfDay(),
            $component->get('endsAt')
        );
    }
}

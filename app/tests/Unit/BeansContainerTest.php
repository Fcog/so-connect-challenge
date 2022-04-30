<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Domain\Exceptions\ContainerFullException;
use Domain\BeansContainer;
use Tests\TestCase;

class BeansContainerTest extends TestCase
{
    use RefreshDatabase;

    public function test_num_spoons_are_removed_correctly()
    {
        $container = new BeansContainer(10, 10);

        $container->useBeans(2);

        $this->assertEquals(8, $container->getBeans());
    }

    public function test_num_spoons_are_added_correctly()
    {
        $container = new BeansContainer(10, 10);

        $container->useBeans(4);

        $container->addBeans(2);

        $this->assertEquals(8, $container->getBeans());
    }

    public function test_beans_container_is_full()
    {
        $this->expectException(ContainerFullException::class);

        $container = new BeansContainer(10, 10);

        $container->addBeans(1);
    }

    public function test_beans_container_is_full_when_adding_spoons()
    {
        $this->expectException(ContainerFullException::class);

        $container = new BeansContainer(10, 10);

        $container->useBeans(2);

        $container->addBeans(2);

        $container->addBeans(1);
    }
}

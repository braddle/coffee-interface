<?php

include dirname(dirname(__FILE__)) . '/EspressoMachine.interface.php';
include dirname(dirname(__FILE__)) . '/AbstractWaterContainer.php';
include dirname(dirname(__FILE__)) . '/StandardWaterContainer.php';

/**
 *
 * @author Mark Bradley<mark@mark-bradley.net>
 */
class StandardWaterContainerTest extends PHPUnit_Framework_TestCase
{
	/**
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns null
	 */
	public function testAddWater()
	{
		$water_container = new StandardWaterContainer();

		$unit = ($water_container->getSize() / 5);

		for ($i = 1; $i <= 6; $i++)
		{
			if ($water_container->isFull())
			{
				try
				{
					$water_container->addWater($unit);
				}
				catch (Exception $e)
				{
					$this->assertInstanceOf('ContainerFullException', $e);
				}
			}
			else
			{
				$water_container->addWater($unit);
				$this->assertEquals($unit * $i, 
						    $water_container->getWater());
			}
		}
	}

	/**
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @params 
	 * @returns 
	 */
	public function testUseWater()
	{
		$water_container = new StandardWaterContainer();
		$water_container->addWater($water_container->getSize());

		$unit = ($water_container->getWater() / 4);

		for ($i = 1; $i <= 5; $i++)
		{
			if ($water_container->isEmpty())
			{
				try
				{
					$water_container->useWater($unit);
				}
				catch(Exception $e)
				{
					$this->assertInstanceOf('EspressoMachineContainerException', $e);
				}
			}
			else
			{
				$this->assertEquals(($water_container->getWater() - $unit),
						    $water_container->useWater($unit));
			}
		}
	}

	/**
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns null
	 */
	public function testIsEmpty()
	{
		$water_container = new StandardWaterContainer();
		
		$this->assertTrue($water_container->isEmpty());

		$water_container->addWater(1);
		
		$this->assertFalse($water_container->isEmpty());		
	}
	
	/**
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns null
	 */
	public function testIsFull()
	{
		$water_container = new StandardWaterContainer();
		
                $this->assertFalse($water_container->isFull());

		$water_container->addWater($water_container->getSize());

		$this->assertTrue($water_container->isFull());
	}

} // StandardWaterContainerTest
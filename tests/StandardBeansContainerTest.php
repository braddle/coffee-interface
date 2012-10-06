<?php

include dirname(dirname(__FILE__)) . '/EspressoMachine.interface.php';
include dirname(dirname(__FILE__)) . '/AbstractBeansContainer.php';
include dirname(dirname(__FILE__)) . '/StandardBeansContainer.php';
include dirname(dirname(__FILE__)) . '/Spoon.php';

/**
 *
 * @author Mark Bradley<mark@mark-bradley.net>
 */
class StandardBeansContainerTest extends PHPUnit_Framework_TestCase
{

	/**
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns null
	 */
	public function testAddBeans()
	{
		$beans_container = new StandardBeansContainer();

		$number_of_spoons_to_fill = ($beans_container->getSize() / Spoon::NUMBER_OF_BEANS);
		$too_many_spoons          = ($number_of_spoons_to_fill + 1);

		$beans_container = new StandardBeansContainer();
		
		for ($i = 1; $i <= $too_many_spoons; $i++)
		{
			if ($beans_container->isFull())
			{
				try
				{
					$beans_container->addBeans(1);
				}
				catch (Exception $e)
				{
					$this->assertInstanceOf('ContainerFullException', $e);
				}				
			}
			else
			{
				$beans_container->addBeans(1);
				$this->assertEquals($i * Spoon::NUMBER_OF_BEANS, $beans_container->getBeans());
			}
		}
	}

	/**
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns null
	 */
	public function testUseBeans()
	{
		$beans_container = new StandardBeansContainer();

		$number_of_spoons_to_fill = ($beans_container->getSize() / Spoon::NUMBER_OF_BEANS);
		$too_many_spoons          = ($number_of_spoons_to_fill + 1);

		$beans_container->addBeans($number_of_spoons_to_fill);	       

		for ($i = 1; $i <= $too_many_spoons; $i++)
		{
			if ($beans_container->isEmpty())
			{
				try
				{
					$beans_container->useBeans(1);
				}
				catch (Exception $e)
				{
					$this->assertInstanceOf('EspressoMachineContainerException', $e);
				}
			}
			else
			{
				$beans_container->useBeans(1);
				$this->assertEquals($beans_container->getSize() - ($i * Spoon::NUMBER_OF_BEANS),
						    $beans_container->getBeans());
			}
		}
	}

	/**
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns null
	 */
	public function testIsFull()
	{
		$beans_container = new StandardBeansContainer();

		$number_of_spoons_to_fill = ($beans_container->getSize() / Spoon::NUMBER_OF_BEANS);

		$this->assertFalse($beans_container->isFull());

		$beans_container->addBeans($number_of_spoons_to_fill);	       

		$this->assertTrue($beans_container->isFull());
	}

	/**
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns null
	 */
	public function testIsEmpty()
	{
		$beans_container = new StandardBeansContainer();

		$number_of_spoons_to_fill = ($beans_container->getSize() / Spoon::NUMBER_OF_BEANS);

		$this->assertTrue($beans_container->isEmpty());

		$beans_container->addBeans($number_of_spoons_to_fill);	       
		
		$this->assertFalse($beans_container->isEmpty());
	}

} // StandardBeansContainerTest

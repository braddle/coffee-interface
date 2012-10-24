<?php

abstract class AbstractBeansContainer implements BeansContainer
{
	
	private $number_of_beans;
	
	/**
	 * Returns the total number of beans the BeansContainer can contain
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 *
	 * @return integer
	 */
	abstract public function getSize();

	/**
	 * returns the number of bean that we can consided the current container
	 * is running low on beans.
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns integer
	 */
	abstract public function getMinimumLevel();
	
	/**
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns void
	 */
	public function __construct()
	{
		$this->number_of_beans = 0;
	}

	/**
	 * Adds beans to the container
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 *
	 * @param integer $numSpoons number of spoons of beans
	 * @throws ContainerFullException, EspressoMachineContainerException
	 *
	 * @return void
	 */
	public function addBeans($numSpoons)
	{
		for ($i = 1; $i <= $numSpoons; $i++)
		{
			if ($this->isFull())
			{
				throw new ContainerFullException ('Beans Container is full! We were about to a spoon full' . $i .
								  ' of ' . $numSpoons);
			}

			$this->number_of_beans += Spoon::NUMBER_OF_BEANS;
		}
	}

	/**
	 * Get $numSpoons from the container
	 *
	 * @throws EspressoMachineContainerException
	 * @param integer $numSpoons number of spoons of beans
	 * @return integer
	 */
	public function useBeans($numSpoons)
	{
		$required_number_beans = ($numSpoons * Spoon::NUMBER_OF_BEANS);

		if ($required_number_beans > $this->number_of_beans)
		{
			throw new EspressoMachineContainerException('There are not enough beans in the container.');
		}

		$this->number_of_beans -= $required_number_beans;
	}
	
	/**
	 * Returns the number of spoons of beans left in the container
	 *
	 * @return integer
	 */
	public function getBeans()
	{
		return $this->number_of_beans;
	}
	
	/**
	 * Returns whether the container is full of beans
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns boolean
	 */
	public function isFull()
	{
		return ($this->getBeans() == $this->getSize());
	}

	/**
	 * Returns whether the container is empty.
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns boolean
	 */
	public function isEmpty()
	{
		return ($this->getBeans() == 0);
	}

}
<?php

/**
 *
 * @author Mark Bradley<mark@mark-bradley.net>
 */
abstract class AbstractWaterContainer implements WaterContainer
{

	private $litres;
	
	/**
	 * Returns the total number of beans the BeansContainer can contain
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 *
	 * @return integer
	 */
	abstract protected function getSize();

	/**
	 * returns the number of litres that we can consided the current container
	 * is running low on water.
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
		$this->litres = 0;
	}

	/**
	 * Adds water to the coffee machine's water tank
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @param float $litres
	 * @throws ContainerFullException, EspressoMachineContainerException
	 *
	 * @return void
	 */
	public function addWater($litres)
	{
		$litres_to_fill     = ($this->getSize() - $this->getWater());
		$litres_to_be_added = ($litres_to_fill >= $litres) ? $litres : $litres_to_fill;

		$this->litres += $litres_to_be_added;

		if ($litres_to_be_added == 0)
		{
			throw new ContainerFullException('Water container is full. You tried to add ' . $litres . 
							 ' litres, but the container only needed ' . $litres_to_fill .
							 ' litres to fill it.');
		}
	}

	/**
	 * Use $litres from the container
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @throws EspressoMachineContainerException
	 * @param float $litres
	 * @return integer
	 */
	public function useWater($litres)
	{
		if ($litres > $this->getWater())
		{
			throw new EspressoMachineContainerException('Water container does not have enough water. ' . $litres .
								    ' litres were request but only ' . $this->getWater() .
								    ' litres are available.');

		}

		$this->litres -= $litres;

		return $this->getWater();
	}

	/**
	 * Returns the volume of water left in the container
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @return float number of litres
	 */
	public function getWater()
	{
		return $this->litres;
	}

	/**
	 * Returns whether to containers is full of water.
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns boolean
	 */
	public function isFull()
	{
		return ($this->getWater() == $this->getSize());
	}

	/**
	 * Returns whether the container is Empty.
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns boolean
	 */
	public function isEmpty()
	{
		return ($this->getWater() == 0);
	}

} // AbstractWaterContainer

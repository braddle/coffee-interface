<?php

/**
 *
 * @author Mark Bradley<mark@mark-bradley.net>
 */
class EspressoMachine implements EspressoMachineInterface
{

	const DESCALE_WATER_REQUIRED = 1;

	const ESPRESSO_LITRES = 0.06; // Wikipedia typical espresso is 60ml
	const ESPRESSO_BEANS  = 40; // Wikianswer says that it take 40 beans to make one shot of espresso

	private $beans_container;
	private $water_container;

	private $descale_required;

	/**
	 * Runs the process to descale the machine
	 * so the machine can be used make coffee
	 * uses 1 litre of water
	 *
	 * @throws NoWaterException
	 *
	 * @return void
	 */
	public function descale()
	{
		if ($this->water_container->getWater() > self::DESCALE_WATER_REQUIRED)
		{
			throw new NoWaterException('The water container does not contain enough water to decale. ' .
						   self::DESCALE_WATER_REQUIRED . ' litres are require but only' .
						   $this->water_container->getWater() . ' litres available.');
		}

		$this->water_container->useWater(self::DESCALE_WATER_REQUIRED);
	}

	/**
	 * Runs the process for making Espresso
	 *
	 * @throws DescaleNeededException, NoBeansException, NoWaterException
	 *
	 * @return float of litres of coffee made
	 */
	public function makeEspresso()
	{

	}

	/**
	 * @see makeEspresso
	 * @throws DescaleNeededException, NoBeansException, NoWaterException
	 *
	 * @return float of litres of coffee made
	 */
	public function makeDoubleEspresso()
	{
	  
	}

	/**
	 * This method controls what is displayed on the screen of the machine
	 * Returns ONE of the following human readable statuses in the following preference order:
	 *
	 * Descale needed
	 * Add beans and water
	 * Add beans
	 * Add water
	 * {Integer} Espressos left
	 *
	 * Please note you should return "Add water" if the machine needs descaling and doesn't have enough water
	 *
	 * @return string
	 */
	public function getStatus()
	{
	  
	}

	/**
	 * @param BeansContainer $container
	 */
	public function setBeansContainer(BeansContainer $container)
	{
		$this->beans_container = $container;
	}

	/**
	 * @return BeansContainer
	 */
	public function getBeansContainer()
	{
		return $this->beans_container;
	}

	/**
	 * @param WaterContainer $container
	 */
	public function setWaterContainer(WaterContainer $container)
	{
		$this->water_container = $container;
	}

	/**
	 * @return WaterContainer
	 */
	public function getWaterContainer()
	{
		return $this->water_container;
	}

} // EspressoMachine

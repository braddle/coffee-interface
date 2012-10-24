A<?php

/**
 *
 * @author Mark Bradley<mark@mark-bradley.net>
 */
class StandardWaterContainer extends AbstractWaterContainer
{

	/**
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns integer
	 */
	public function getSize()
	{
		return 2;
	}

	/**
	 * returns the number of litres that we can consided the current container
	 * is running low on water.
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns integer
	 */
	abstract public function getMinimumLevel()
	{
		return 0.5;
	}


} // StandardWaterContainer

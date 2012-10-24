<?php

/**
 *
 * @author Mark Bradley<mark@mark-bradley.net>
 */
class StandardBeansContainer extends AbstractBeansContainer
{

	/**
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns integer
	 */
	public function getSize()
	{
		return 50;
	}

	/**
	 * returns the number of bean that we can consided the current container
	 * is running low on beans.
	 *
	 * @author Mark Bradley<mark@mark-bradley.net>
	 * @returns integer
	 */
	abstract public function getMinimumLevel()
	{
		return 15;
	}

}
<?php

/**
 * Cache Class
 *
 * @author lzyy http://blog.leezhong.com
 * @version 0.1.0
 */
class Cache extends Witty_Base
{
	public function adapter($adapter)
	{
		$adapter_class = 'Cache_Adapter_'.ucfirst($adapter);
		if (!class_exists($adapter_class))
		{
			throw new Cache_Exception('adapter "{adapter}" not found', array('{adapter}' => $adapter));
		}
		return Witty::instance($adapter_class, Witty::get_config($adapter_class));
	}

	public function add($id, $data, $lifetime = NULL)
	{
		throw new Cache_Exception('cache add method not implenmented');
	}

	public function get($id, $default = null)
	{
		throw new Cache_Exception('cache get method not implenmented');
	}

	public function set($id, $data, $lifetime = NULL)
	{
		throw new Cache_Exception('cache set method not implenmented');
	}

	public function delete($id)
	{
		throw new Cache_Exception('cache delete method not implenmented');
	}
}

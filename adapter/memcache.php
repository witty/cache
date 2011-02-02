<?php

class Cache_Adapter_Memcache extends Cache {
	
	protected $_memcache;

	protected $_compress;

	protected function _before_config($config)
	{
		if(!extension_loaded('memcache'))
		{
			throw new Cache_Exception('Memcache PHP extention not loaded');
		}
	}

	protected function _after_construct()
	{
		$config = $this->_config;

		$this->_memcache = new Memcache;

		$servers = isset($config['servers']) ? $config['servers'] : NULL;

		if (!$servers)
		{
			throw new Cache_Exception('No Memcache servers defined in configuration');
		}

		$config = array(
			'host' => 'localhost',
			'port' => 11211,
			'persistent' => FALSE,
			'weight' => 1,
			'timeout' => 1,
			'retry_interval' => 15,
			'status' => TRUE,
			'compression' => FALSE,
			'failure_callback' => array($this, 'failure'),
		);

		foreach ($servers as $server)
		{
			$server += $config;

			$this->_memcache->addServer($server['host'], $server['port'], $server['persistent'], $server['weight'], $server['timeout'], $server['retry_interval'], $server['status'], $server['failure_callback']);
		}

		$this->_compress = $config['compression'] ? MEMCACHE_COMPRESSED : FALSE;

	}

	public function failure($host, $port)
	{
		throw new Cache_Exception('Memcache could not connect to host "{host}" using port "{port}"', array('{host}' => $host, '{port}' => $port));
	}

	public function get($id, $default = NULL)
	{
		return $this->_memcache->get($id);
	}

	public function set($id, $data, $lifetime = NULL)
	{
		empty($lifetime) && $lifetime = $this->_config['lifetime'];
		return $this->_memcache->set($id, $data, $this->_compress, $lifetime);
	}

	public function add($id, $data, $lifetime = NULL)
	{
		empty($lifetime) && $lifetime = $this->_config['lifetime'];
		return $this->_memcache->add($id, $data, $this->_compress, $lifetime);
	}

	public function delete($id)
	{
		return $this->_memcache->delete($id);
	}

}

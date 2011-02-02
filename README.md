## Cache Class

### Basic Usage 

	require '/path/to/modules/witty/witty.php';
	Witty::init();
	Witty::set_config_dir('config');

	// choose cache adapter
	$cache = Witty::instance('Cache')->adapter('memcache');
	//$cache = Witty::instance('Cache')->adapter('file');

	$cache->set('foo', 'bar', 1800);
	// $cache->add('bar', 'foo');
	// $cache->get('foo', 'default');
	// $cache->delete('foo');

### Config

	return array(
		'Cache_Adapter_File' => array(
			'cache_dir' => dirname(__DIR__).'/cache',
		),
		'Cache_Adapter_Memcache' => array(
			'lifetime' => 3600,
			'servers' => array(
				'server1' => array(
					'host' => 'localhost',
					'port' => 11211,
					'persistent' => false,
					'weight' => 1,
					'timeout' => 1,
					'retry_interval' => 15,
					'status' => true,
					'compression' => false,
				),
			),
		),
	);


<?php

class Pages extends CI_Controller {

	public function __construct()
        {
                parent::__construct();
                $this->load->driver('cache');
				$this->cache->redis->save('foo', 'bar', 10);
        }

	public function view($page = 'home')
	{
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php'))
		{
		show_404();
		}
		$data['visitas'] = $this->cache->redis->increment('visitas');
		$data['title'] = ucfirst($page);
		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
		echo "Has entrado " . $data['visitas'] . " veces ";
		$this->load->helper("sit");
		$ar = mostrar_datos_file("/etc/passwd","\n");
		echo $ar[0];
	}
}
?>

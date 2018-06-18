<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Welcome_model');
		$this->load->helper('url');
	}
	public function index()
	{
		$data['file']= file('/etc/passwd');
		$this->load->library('pro');
		$data['news']=$this->pro->show('http://ep00.epimg.net/rss/elpais/portada.xml');
		$this->load->view('welcome_message',$data);
	}
	public function linefile($i=null) {
		if($i){
			$i='/tmp/' . $i;
		}else{
			$i='/etc/passwd';
		}
		$data['linea']= $this->Welcome_model->linefile($i);
		$this->load->view('welcome_message',$data);
	}
	public function product($i=null){
		$data['product']= $this->Welcome_model->getProduct($i);
		$this->load->view('welcome_message',$data);
	}
	public function fliker(){
		$data['fliker']=$this->Welcome_model->getFliker();
		$this->load->view('welcome_message',$data);
	}
	public function autores($id=null) {
            if($id===null){
              $data['autores'] = $this->Welcome_model->getAutores($id);
	      $this->load->view('autores',$data);
            }
            else{
              $data['unAutor'] = $this->Welcome_model->getUnAutor($id);
              $data['frases'] = $this->Welcome_model->getAutores($id);
	      $this->load->view('autores1',$data);
            }
        }
} 
//enunciado
//1.- Escribir aqui una nueva funcion llamada line_file que reciba como argumento el nombre de un fichero que previamente existe en /tmp. Esta funcion devolvera la primera linea del fichero que se recibe como argumento. ¿Como debo dar solucion a esto?

//2.- Crear una tabla productos que tenga una descripcion de un producto y escribimos una nueva funcion en el welcome-model que se llamara get y que recibe como argumento el nombre de una tabla esa funcion sirve para optener todas las filas de la tabla que se recibe como paramentro

//3.- Si en el primer punto te pide que agreges la siguiente validacion: si el argumento es nulo que adoptes el /etc/passwd y muestre la primera linea, donde hay que tocas ¿en el modelo o en el controlador?
//En el controlador con una condicion si lo encuentra que prosiga sino que muestre el etc/passwd
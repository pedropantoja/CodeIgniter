<?php
	class Welcome_model extends CI_Model {

		public function __construct(){
			$this->load->database();
		}
		public function get($id){
			$query = $this->db->get('product');
			return $query->result_array();
		}
        public function linefile($id){
            return fgets(fopen($id,'r'));
        }
        public function getProduct($id){
            //json de noticias
           $json_noticias = getPage('http://localhost:5301/api/news', "GET", null);
            //json de productos
        	//$st_json = getPage('http://localhost:5300/api/product', "GET", null);
            //
        	$productos = json_decode($json_noticias,true);    
        	// por como viene la informacion estoy obligado a realizar otro decode 
        	//$productos1 = json_decode($productos,true);
           	return $productos;
            //return $productos1;
        }
        public function getFliker(){
            $url = "https://api.flickr.com/services/feeds/photos_public.gne?tags=sevilla";
            $texto = file_get_contents($url);
            $tree = new SimpleXMLElement($texto);
            $tree->registerXPathNamespace("feed","http://www.w3.org/2005/Atom");
            $links = $tree->xpath("//feed:entry/feed:link[@rel='enclosure']/@href");
            $lista = array();
            foreach ($links as $key => $value) {
                $lista[$key]['link'] = $value;
                $lista[$key]['title'] = $tree->entry[$key]->title;
            }
            return $lista;
        }
        public function getUnAutor($id=null) {
            if($id != null) {
                $query = $this->db->get_where('autores',array('id_autor' => $id));
                $ar = $query->result_array();
                return $ar[0]['nombre_completo'];
            }
            else { echo "AAAlllgOOOO va va va MMMAAALLL";}
                return "Errrror";
        }
        public function getAutores($id=null) {
            if($id===null) {
                $redis = new Redis();
                $redis -> pconnect("localhost");
                $redis -> select(7);
                $ar = $redis -> smembers("frases:autores:set");
                foreach($ar as $i =>  $nombre) {
                    $array[$i]['nombre'] = $nombre;
                    $query = $this->db->get_where('autores',array('nombre_completo' => $nombre));
                    $reg = $query->result_array();
                    $array[$i]['id'] = $reg[0]['id_autor'];
                }
            return $array;
            } 
            else {
                $query = $this->db->get_where('frases',array('id_autor' => $id));
              return $query->result_array();
            }
        }
    } 
?>
  
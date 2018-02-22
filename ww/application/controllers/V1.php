<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';


class v1 extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ww_model');
    }

    public function index_get()
    {
        $cities = $this->Ww_model->get();

        if (!is_null($cities)) {
            $this->response(array('response' => $cities), 200);
        } else {
            $this->response(array('error' => 'No hay imagenes de ciudades en la base de datos...'), 404);
        }
    }

    function upload_post()
    {
    // log_message('debug',print_r($this->input->post));
    $config['upload_path'] ='./public';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '1000';
    $config['max_width']  = '2000';
    $config['max_height']  = '1080';
    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload())
    {
         $this->response(array('error', $this->upload->display_errors()), 400);
         //log_message('error',$this->upload->display_errors());

         //$this->response(print_r($upload_data),400);
         
      
    }else{
    //$this->response(array('response' => 'Upload Succesfully'), 200); 
     $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
    $file_name = $upload_data['file_name']; 
     $id = $this->Ww_model->save($file_name);

        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
            //$this->response(print_r($upload_data), 200);

         
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
  
    }

    
    }

    public function find_get($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }
        $city = $this->Ww_model->get($id);

        if (!is_null($city)) {
            $this->response(array('response' => $city), 200);
        } else {
            $this->response(array('error' => 'Ciudad no encontrada...'), 404);
        }
    }
    public function search_get()
    {
        if (!$this->get('name')) {
            $this->response(null, 400);
        }
        $city = $this->Ww_model->get_search($this->get('name'));

        if (!is_null($city)) {
            $this->response(array('response' => $city), 200);
        } else {
            $this->response(array('error' => 'Ciudad no encontrada...'), 404);
        }
    }


    public function index_post()
    {
        if (!$this->post('city')) {
            $this->response(null, 400);
        }

        $id = $this->Ww_model->save($this->post('city'));

        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function index_put()
    {
        if (!$this->put('city')) {
            $this->response(null, 400);
        }

        $update = $this->Ww_model->update($this->put('city'));

        if (!is_null($update)) {
            $this->response(array('response' => 'Ciudad actualizada!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function index_delete($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }

        $delete = $this->Ww_model->delete($id);

        if (!is_null($delete)) {
            $this->response(array('response' => 'Ciudad eliminada!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}
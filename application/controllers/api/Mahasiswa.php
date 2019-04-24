<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
/**
 *
 */
class Mahasiswa extends REST_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Mahasiswa_model');
  }

  public function index_get(){
    $id = $this->get('id');

    if ($id === null) {
      $mahasiswa = $this->Mahasiswa_model->getMahasiswa();
    }else{
      $mahasiswa = $this->Mahasiswa_model->getMahasiswa($id);
    }

    if ($mahasiswa) {

      $this->response([
          'status' => TRUE,
          'data' => $mahasiswa
      ], REST_Controller::HTTP_OK);

    }else{

      $this->response([
          'status' => FALSE,
          'message' => 'Id Not Found'
      ], REST_Controller::HTTP_NOT_FOUND);

    }

  }

  public function index_delete(){
    $id = $this->delete('id');

    if ($id === null) {

      $this->response([
          'status' => FALSE,
          'message' => 'Provide An Id'
      ], REST_Controller::HTTP_BAD_REQUEST);

    }else{

      $data = $this->Mahasiswa_model->deleteMahasiswa($id);

      if ($data > 0) {
        // ok
        $this->response([
            'status' => TRUE,
            'data' => $id,
            'message' => 'deleted!'
        ], REST_Controller::HTTP_NO_CONTENT);
      }else{
        //id not Found
        $this->response([
            'status' => FALSE,
            'message' => 'Id Not Found'
        ], REST_Controller::HTTP_BAD_REQUEST);
      }


    }
  }

  public function index_post(){

    $data = [
      'nrp' => $this->post('nrp'),
      'nama' => $this->post('nama'),
      'email' => $this->post('email'),
      'jurusan' => $this->post('jurusan')
    ];

    if ($this->Mahasiswa_model->createMahasiswa($data) > 0) {

      $this->response([
          'status' => TRUE,
          'message' => 'New Mahasiswa Has Been Created!'
      ], REST_Controller::HTTP_CREATED);

    }else{

      $this->response([
          'status' => FALSE,
          'message' => 'Failed Created Mahasiswa!'
      ], REST_Controller::HTTP_BAD_REQUEST);

    }
  }

  public function index_put(){

    $id = $this->put('id');

    $data = [
      'nrp' => $this->put('nrp'),
      'nama' => $this->put('nama'),
      'email' => $this->put('email'),
      'jurusan' => $this->put('jurusan')
    ];

    if ($this->Mahasiswa_model->updateMahasiswa($data, $id) > 0) {

      $this->response([
          'status' => TRUE,
          'message' => 'Mahasiswa Has Been Updated!'
      ], REST_Controller::HTTP_OK);

    }else{

      $this->response([
          'status' => FALSE,
          'message' => 'Failed Updated Mahasiswa!'
      ], REST_Controller::HTTP_BAD_REQUEST);

    }

  }
}




 ?>

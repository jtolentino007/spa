<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Upload extends AIMS_Controller
  {

    function __construct()
    {
      parent::__construct();
    }

    function index()
    {

      $this->ReturnView();
    }

    public function ajax_upload()
    {
      if (isset($_FILES["image_file"]["name"]))
      {
        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $this->load->library('upload',$config);
        if(!$this->upload->do_upload('image_file'))
        {
          $response['status'] = "error";
          $response['message'] = $this->upload->display_errors();
        }
        else
        {
          $response['status'] = "success";
          $data = $this->upload->data();
          $response['img_src'] = 'assets/img/'.$data["file_name"];
        }

        echo json_encode($response);
      }
    }
  }

?>

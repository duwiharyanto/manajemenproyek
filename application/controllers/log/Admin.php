<?php
defined('BASEPATH') or exit('No direct script access allowed');
include APPPATH . 'controllers/master.php';
class Admin extends Master
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud');
        $this->userid = $this->session->userdata('user_id');
        $this->userlevel = $this->session->userdata('user_level');
        $this->cek_admin();
    }
    //VARIABELS
    private $master_tabel = "log";
    private $default_url = "log/admin/";
    private $default_view = "log/admin/";
    private $view = "template/backend";
    private $id = "log_id";

    private function global_set($data)
    {
        $data = array(
            'menu' => 'setting',
            'submenu_menu' => 'log',
            'headline' => $data['headline'],
            'url' => $data['url'],
            'ikon' => "fa fa-users",
            'view' => "views/log/admin/index.php",
            'detail' => false,
            'edit' => false,
            'delete' => true,
            'print' => false,
        );
        return (object) $data;
    }
    public function index()
    {
        $global_set = array(
            'headline' => 'daftar log',
            'url' => 'log/admin/',
        );

        $global = $this->global_set($global_set);
        if ($this->input->post('submit')) {
            //PROSES SIMPAN
            $data = array(
                'user_tahunanggaran' => $this->input->post('user_tahunanggaran'),
                'user_kegiatan' => $this->input->post('user_kegiatan'),
                'user_user' => $this->input->post('user_user'),
                'user_lokasi' => $this->input->post('user_lokasi'),
            );
            // $query=array(
            //     'data'=>$data,
            //     'tabel'=>$this->master_tabel,
            // );
            // $insert=$this->Crud->insert($query);
            // $this->notifiaksi($insert);
            // redirect(site_url($this->default_url));
            $this->dump_data($data);
        } else {
            $pekerjaan = array(
                'tabel' => 'pekerjaan',
            );
            $data = array(
                'pekerjaan' => $this->Crud->read($pekerjaan)->result(),
                'global' => $global,
                'menu' => $this->menu(),
            );
            $this->load->view($this->view, $data);
        }
    }
    public function tabel()
    {
        $global_set = array(
            'headline' => 'data log',
            'url' => 'log/admin/',
        );
        $global = $this->global_set($global_set);
        //PROSES TAMPIL DATA
        $query = array(
            'select'=>'a.*,b.user_nama,b.user_username',
            'tabel' => 'log a',
            'join'=>array(
                array('tabel'=>'user b', 'ON'=>'b.user_id=a.log_iduser','jenis'=>'INNER'),
            ),
            'order'=>array('kolom'=>'log_date','orderby'=>'DESC'),
        );
        $data = array(
            'data' => $this->Crud->join($query)->result(),
            'global' => $global,
        );
        $this->load->view($this->default_view . 'tabel', $data);
        //$this->dump_data($data);
    }
    public function hapus()
    {
        $id=$this->input->post('id');
        $query = array(
            'tabel' => $this->master_tabel,
            'where' => array($this->id => $id),
        );
        $delete = $this->Crud->delete($query);
        if($delete){
            $dt['success']='hapus data berhasil';
        }else{
            $dt['error']='hapus data gagal';
            $dt['msg']=$delete;
        }
        $this->output->set_output(json_encode($dt));
        //$this->notifiaksi($delete);
        //redirect(site_url($this->default_url));
    }
}

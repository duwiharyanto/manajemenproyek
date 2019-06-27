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
    private $master_tabel = "user";
    private $default_url = "user/admin/";
    private $default_view = "user/admin/";
    private $view = "template/backend";
    private $id = "user_id";

    private function global_set($data)
    {
        $data = array(
            'menu' => 'setting',
            'submenu_menu' => 'user',
            'headline' => $data['headline'],
            'url' => $data['url'],
            'ikon' => "fa fa-users",
            'view' => "views/user/admin/index.php",
            'detail' => false,
            'edit' => true,
            'delete' => true,
            'print' => false,
        );
        return (object) $data;
    }
    public function index()
    {
        $global_set = array(
            'headline' => 'daftar user',
            'url' => 'user/admin/',
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
            'headline' => 'data user',
            'url' => 'user/admin/',
        );
        $global = $this->global_set($global_set);
        //PROSES TAMPIL DATA
        $query = array(
            'tabel' => $this->master_tabel,
            'order' => array('kolom' => 'user_nama', 'orderby' => 'DESC'),
        );
        $data = array(
            'data' => $this->Crud->read($query)->result(),
            'global' => $global,
        );
        $this->load->view($this->default_view . 'tabel', $data);
        //$this->dump_data($data);
    }

    public function add()
    {
        $global_set = array(
            'submenu' => false,
            'headline' => 'add user',
            'url' => $this->default_url, //AKAN DIREDIRECT KE INDEX
        );
        $global = $this->global_set($global_set);
        if ($this->input->post('user_nama')) {
            $data = array(
                'user_nama' => $this->input->post('user_nama'),
                'user_username' => $this->input->post('user_username'),
                'user_password' => $this->input->post('user_password'),
                'user_level' => $this->input->post('user_level'),
                'user_tersimpan' => date('Y-m-d'),
            );
            $query=array(
                'tabel'=>$this->master_tabel,
                'data'=>$data,
            );
            $insert=$this->Crud->insert($query);
            if($insert){
                $dt=array(
                    'success'=>'data berhasil disimpan',
                );
            }else{
                $dt=array(
                    'error'=>'data gagal disimpan',
                );                
            }
            //$this->dump_data($data);
            return $this->output->set_output(json_encode($dt)); 
        } else {
            $data = array(
                'global' => $global,
            );
            $this->load->view($this->default_view . 'add', $data);
        }
    }
    public function edit()
    {
        $global_set = array(
            'submenu' => false,
            'headline' => 'edit data',
            'url' => $this->default_url,
        );
        $global = $this->global_set($global_set);
        $id = $this->input->post('id');
        if ($this->input->post('user_nama')){
            $data = array(
                'user_nama' => $this->input->post('user_nama'),
                'user_username' => $this->input->post('user_username'),
                'user_password' => $this->input->post('user_password'),
                'user_level' => $this->input->post('user_level'),
            );
            $query = array(
                'data' => $data,
                'where' => array($this->id => $id),
                'tabel' => $this->master_tabel,
            );
            $update = $this->Crud->update($query);
            if($update){
                $dt['success']='Update berhasil';
            }else{
                $dt['error']='Update gagal';
            }
            return $this->output->set_output(json_encode($dt));
            //$this->notifiaksi($update);
            //redirect(site_url($this->default_url));
        } else {
            $query = array(
                'tabel' => $this->master_tabel,
                'where' => array(array($this->id => $id)),
            );
            $data = array(
                'data' => $this->Crud->read($query)->row(),
                'global' => $global,
            );
            $this->load->view($this->default_view . 'edit', $data);
            //$this->dump_data($data);
        }
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
    public function downloadberkas($file)
    {
        $path = $this->path;
        $this->downloadfile($path, $file);
    }
    public function adddata(){
        $global_set = array(
            'submenu' => false,
            'headline' => 'add user',
            'url' => $this->default_url, //AKAN DIREDIRECT KE INDEX
        );
        $global = $this->global_set($global_set);
        $data=array(
            'global'=>$global,
        );        
        $this->load->view($this->default_url.'modaladd',$data);
    }
    public function modaledit(){
        $global_set = array(
            'submenu' => false,
            'headline' => 'add user',
            'url' => $this->default_url, //AKAN DIREDIRECT KE INDEX
        );
        $global = $this->global_set($global_set);        
        $id=$this->input->post('id');
        $query=array(
            'tabel'=>$this->master_tabel,
            'where'=>array(array($this->id=>$id)),
        );
        $data=array(
            'global'=>$global,
            'data'=>$this->Crud->read($query)->row(),
        );
        //$this->dump_data($data['data']);
        $this->load->view($this->default_view.'modaledit',$data);
    }
}

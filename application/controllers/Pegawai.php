<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function index()
	{
		$this->load->model('pegawai_model');
		$data["pegawai_list"] = $this->pegawai_model->getDataPegawai();
		$this->load->view('pegawai',$data);	
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|alpha|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('nip', 'Nip', 'trim|required|numeric|min_length[2]|max_length[12]');
		$this->form_validation->set_rules('tanggalLahir', 'TanggalLahir', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|alpha_numeric|min_length[5]|max_length[50]');
		$this->load->model('pegawai_model');	
		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_pegawai_view');

		}else{
			$this->pegawai_model->insertPegawai();
			$this->load->view('tambah_pegawai_sukses');

		}
	}
	//method update butuh parameter id berapa yang akan di update
	public function update($id)
	{
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		//sebelum update data harus ambil data lama yang akan di update
		$this->load->model('pegawai_model');
		$data['pegawai']=$this->pegawai_model->getPegawai($id);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_pegawai_view',$data);

		}else{
			$this->pegawai_model->updateById($id);
			$this->load->view('edit_pegawai_sukses');

		}
	}

	public function delete($id)
	{
		$where=array('id'=>$id);
		$this->load->model('pegawai_model');
		$this->pegawai_model->deleteById($id);
		redirect('pegawai','refresh');
	}
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */

 ?>
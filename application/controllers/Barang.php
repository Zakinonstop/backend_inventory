<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Barang_model');
	}

	public function index()
	{
		echo "index";
	}

	public function list_barang()
	{
		$data_barang = $this->Barang_model->get_barang();

		$konten = '<tr>
					<td>Nama</td>
					<td>Deskripsi</td>
					<td>Stok</td>
					<td>Harga barang</td>
					<td>Tanggal_masuk</td>
					<td>Nama_admin</td>
					<td>Aksi</td>
					</tr>';

		foreach ($data_barang->result() as $key => $value) {
			$konten .= '<tr>
						<td>' . $value->nama_barang . '</td>
						<td>' . $value->deskripsi . '</td>
						<td>' . $value->stok . '</td>
						<td>' . $value->harga_barang . '</td>
						<td>' . $value->tanggal_masuk . '</td>
						<td>' . $value->nama_admin . '</td>
						<td>Read | <a href="#' . $value->id_barang . '" class="linkHapusBarang">Hapus | <a href="#' . $value->id_barang . '" class="linkEditBarang">Edit</td>
						</tr>';
		}
		// $konten = $this->load->view('barang/list_barang', null, true);

		$data_json = array(
			'konten' => $konten,
		);

		echo json_encode($data_json);
	}

	public function create_action()
	{
		$this->db->trans_start();

		$this->Barang_model->insert_data();

		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
			$data_output = array('sukses' => 'tidak', 'pesan' => 'Gagal Input Data Barang');
		} else {
			$this->db->trans_commit();
			$data_output = array('sukses' => 'ya', 'pesan' => 'Berhasil Input Data Barang');
		}

		echo json_encode($data_output);
	}

	public function update_action()
	{
		$this->db->trans_start();

		$data = [
			'nama_barang' => $this->input->post('nama_barang'),
			'deskripsi' => $this->input->post('deskripsi')
		];

		$id_barang = $this->input->post('id_barang');
		$this->Barang_model->update_dataa($id_barang);

		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
			$data_output = array('sukses' => 'tidak', 'pesan' => 'Gagal Input Data Barang');
		} else {
			$this->db->trans_commit();
			$data_output = array('sukses' => 'ya', 'pesan' => 'Berhasil Input Data Barang');
		}

		echo json_encode($data_output);
	}

	public function detail()
	{
		$id_barang = $this->input->get('id_barang');
		$data_detail = $this->Barang_model->get_by_id($id_barang);

		if ($data_detail->num_rows() > 0) {
			$data_output = array('sukses' => 'ya', 'detail' => $data_detail->row_array());
		} else {
			$data_output = array('sukses' => 'tidak');
		}

		echo json_encode($data_output);
	}

	public function delete_data()
	{
		$this->db->trans_start();
		$id_barang = $this->input->get('id_barang');
		$this->Barang_model->hapus_data($id_barang);

		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
			$data_output = array('sukses' => 'tidak', 'pesan' => 'Gagal Hapus Data Barang');
		} else {
			$this->db->trans_commit();
			$data_output = array('sukses' => 'ya', 'pesan' => 'Berhasil Hapus Data Barang');
		}

		echo json_encode($data_output);
	}

	public function soft_delete_data()
	{
		$this->db->trans_start();
		$id_barang = $this->input->get('id_barang');
		$this->Barang_model->soft_delete_data($id_barang);

		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
			$data_output = array('sukses' => 'tidak', 'pesan' => 'Gagal Hapus Data Barang');
		} else {
			$this->db->trans_commit();
			$data_output = array('sukses' => 'ya', 'pesan' => 'Berhasil Hapus Data Barang');
		}

		echo json_encode($data_output);
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    public function get_barang()
    {
        $this->db->select('*');
        $this->db->from('barang');
        return $this->db->get();
    }

    public function insert_data()
    {
        $data = [
            // 'nama_barang' => 'Tahu bulat',
            // 'deskripsi' => 'Digoreng dadakan'
            'nama_barang' => $this->input->post('nama_barang'),
            'deskripsi' => $this->input->post('deskripsi'),
            'harga_barang' => $this->input->post('harga_barang'),
            'nama_admin' => $this->input->post('nama_admin'),
            'stok' => $this->input->post('stok'),
            'tanggal_masuk' => $this->input->post('tanggal_masuk')
        ];

        $this->db->insert('barang', $data);
    }

    public function update_data($id_barang, $data)
    {
        $id_barang = $this->input->post('id_barang');

        $data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'deskripsi' => $this->input->post('deskripsi')
        ];

        $this->db->where('id_barang', $id_barang);
        $this->db->update('barang', $data);
    }

    public function get_by_id($id_barang)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('id_barang', $id_barang);
        return $this->db->get();
    }
}

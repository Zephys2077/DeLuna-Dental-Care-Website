<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model(['Pasien_model', 'Reservasi_model', 'Obat_model']);
        $this->load->helper('url');
    }

    public function index() {
        $period = $this->input->get('period') ?? 'daily';
        
        $data['title'] = 'Laporan';
        $data['period'] = $period;
        
        // Get date range based on period
        $dates = $this->_get_date_range($period);
        $start_date = $dates['start'];
        $end_date = $dates['end'];
        
        // Get reports data
        $data['pasien'] = $this->_get_patient_report($start_date, $end_date);
        $data['reservasi'] = $this->_get_reservation_report($start_date, $end_date);
        
        $this->load->view('templates/header');
        $this->load->view('laporan/index', $data);
        $this->load->view('templates/footer');
    }

    private function _get_date_range($period) {
        $end_date = date('Y-m-d 23:59:59');
        
        switch($period) {
            case 'daily':
                $start_date = date('Y-m-d 00:00:00');
                break;
            case 'weekly':
                $start_date = date('Y-m-d 00:00:00', strtotime('-7 days'));
                break;
            case 'monthly':
                $start_date = date('Y-m-d 00:00:00', strtotime('-1 month'));
                break;
            case 'yearly':
                $start_date = date('Y-m-d 00:00:00', strtotime('-1 year'));
                break;
            default:
                $start_date = date('Y-m-d 00:00:00');
        }
        
        return ['start' => $start_date, 'end' => $end_date];
    }

    private function _get_patient_report($start_date, $end_date) {
        return [
            'total' => $this->db->count_all('pasien'),
            'new' => $this->db->where("STR_TO_DATE(SUBSTRING_INDEX(tempat_tgl_lahir, ', ', -1), '%d-%m-%Y') >=", $start_date)
                             ->where("STR_TO_DATE(SUBSTRING_INDEX(tempat_tgl_lahir, ', ', -1), '%d-%m-%Y') <=", $end_date)
                             ->count_all_results('pasien')
        ];
    }

    private function _get_reservation_report($start_date, $end_date) {
        return [
            'total' => $this->db->where('tgl_jam >=', $start_date)
                               ->where('tgl_jam <=', $end_date)
                               ->count_all_results('reservasi'),
            'completed' => $this->db->where('tgl_jam >=', $start_date)
                                  ->where('tgl_jam <=', $end_date)
                                  ->where('status', 'Selesai')
                                  ->count_all_results('reservasi'),
            'pending' => $this->db->where('tgl_jam >=', $start_date)
                                ->where('tgl_jam <=', $end_date)
                                ->where('status', 'Pending')
                                ->count_all_results('reservasi')
        ];
    }

    private function _get_medication_report($start_date, $end_date) {
        return $this->db->query("
            SELECT o.nama_obat, COUNT(*) as total_usage
            FROM rekam_medis rm
            JOIN obat o ON FIND_IN_SET(o.No, rm.id_obat) > 0
            WHERE rm.tanggal BETWEEN ? AND ?
            GROUP BY o.No
            ORDER BY total_usage DESC
            LIMIT 5
        ", [$start_date, $end_date])->result();
    }
}
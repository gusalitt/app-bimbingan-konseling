<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use PHPUnit\Event\Telemetry\Duration;
use tidy;

class guruModel extends Model
{
    protected $table = "guru";
    protected $primaryKey = "id_guru";
    protected $useTimestamps = true;
    protected $allowedFields = ["slug", "foto", "nama_guru", "mata_pelajaran", "wali_kelas"];

    public function getFilteredData($keyword = null, $kategori_mapel = '', $show = 10, $sort = 'id_guru', $page = 1)
    {

        $query = $this->select('*');

        if (!empty($keyword)) {
            $query = $query->groupStart()
                ->like('nama_guru', $keyword)
                ->orLike('mata_pelajaran', $keyword)
                ->orLike('wali_kelas', $keyword)
                ->groupEnd();
        }

        if (!empty($kategori_mapel)) {
            $query = $query->where('LOWER(mata_pelajaran)', strtolower($kategori_mapel));
        }

        // Calculate the total pages from the filtered data
        $totalData = $query->countAllResults(false);
        $totalPages = (int) ceil($totalData / ($show == 0 ? 10 : $show));

        if (!empty($show) && $show > 0) {
            $query = $query->limit(intval($show));
        }

        if (!empty($sort)) {
            switch ($sort) {
                case 'terlama':
                    $query = $query->orderBy('created_at', 'ASC');
                    break;

                case 'terbaru':
                    $query = $query->orderBy('created_at', 'DESC');
                    break;

                case 'nama_guru':
                case 'mata_pelajaran':
                case 'wali_kelas':
                    $query = $query->orderBy($sort, 'ASC');
                    break;

                default:
                    $query = $query->orderBy('id_guru', 'DESC');
                    break;
            }
        } else {
            $query = $query->orderBy('id_guru', 'DESC');
        }

        if (!empty($page) && $page > 0) {
            $query = $query->paginate($show);
        }

        $itemStart = ($page - 1) * $show;

        return [
            'query' => $query,
            'itemStart' => $itemStart,
            'totalData' => $totalData,
            'totalPages' => $totalPages,
        ];
    }

    public function getColumnNames()
    {
        $query = $this->db->query("
            SELECT COLUMN_NAME
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_NAME = '{$this->table}'
            AND TABLE_SCHEMA = '{$this->db->getDatabase()}'
        ");

        $columns = [];
        foreach ($query->getResultArray() as $row) {
            $columns[] = $row['COLUMN_NAME'];
        }

        return array_diff($columns, ['id_guru', 'slug', 'foto', 'created_at', 'updated_at']);
    }

    public function  getMataPelajaran()
    {
        $result = $this->select('mata_pelajaran')
            ->distinct()
            ->orderBy('mata_pelajaran', 'ASC')
            ->findAll();

        $filtered = array_filter($result, function ($row) {
            return $row['mata_pelajaran'] !== '-' && strlen($row['mata_pelajaran']) > 1;
        });

        return $filtered;
    }
}

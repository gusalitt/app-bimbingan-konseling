<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use PHPUnit\Event\Telemetry\Duration;
use tidy;

class siswaModel extends Model
{
    protected $table = "siswa";
    protected $primaryKey = "id_siswa";
    protected $useTimestamps = true;
    protected $allowedFields = ["slug", "foto", "nama_siswa", "nisn", "kelas", "jurusan"];

    public function getFilteredData($keyword = null, $kategori_jurusan = '', $show = 10, $sort = 'id_siswa', $page = 1)
    {

        $query = $this->select('*');

        if (!empty($keyword)) {
            $query = $query->groupStart()
                ->like('nama_siswa', $keyword)
                ->orLike('nisn', $keyword)
                ->orLike('jurusan', $keyword)
                ->groupEnd();
        }

        if (!empty($kategori_jurusan)) {
            $query = $query->where('LOWER(jurusan)', strtolower($kategori_jurusan));
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

                case 'nama_siswa':
                case 'nisn':
                case 'kelas':
                case 'jurusan':
                    $query = $query->orderBy($sort, 'ASC');
                    break;

                default:
                    $query = $query->orderBy('id_siswa', 'DESC');
                    break;
            }
        } else {
            $query = $query->orderBy('id_siswa', 'DESC');
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

        return array_diff($columns, ['id_siswa', 'slug', 'foto', 'created_at', 'updated_at']);
    }
}

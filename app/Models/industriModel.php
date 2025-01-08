<?php

namespace App\Models;

use CodeIgniter\Model;

class industriModel extends Model
{
    protected $table = "industri";
    protected $primaryKey = "id_industri";
    protected $useTimestamps = true;
    protected $allowedFields = ["slug", "id_siswa", "tempat_industri", "tgl_mulai", "tgl_selesai", "status"];

    public function getFilteredData($keyword = null, $kategori_status = '', $show = 10, $sort = 'id_industri', $page = 1, $getAll = false)
    {

        $query = $this->select('
                i.id_industri,
                i.slug AS industri_slug,
                i.id_siswa,
                i.tempat_industri, 
                i.tgl_mulai, 
                i.tgl_selesai, 
                i.status,
                s.nama_siswa,
                CONCAT(s.kelas, " - ", s.jurusan) AS kelass
                ')
            ->from('industri i')
            ->join('siswa s', 's.id_siswa = i.id_siswa')
            ->groupBy('i.id_industri');


        if (!empty($keyword)) {
            $query = $query->groupStart()
                ->like('s.nama_siswa', $keyword)
                ->orLike('i.tempat_industri', $keyword)
                ->orLike('i.tgl_mulai', $keyword)
                ->orLike('i.tgl_selesai', $keyword)
                ->groupEnd();
        }

        if (!empty($kategori_status)) {
            $query = $query->where('LOWER(i.status)', strtolower($kategori_status));
        }

        // Calculate the total pages from the filtered data
        $totalData = $query->countAllResults(false);
        $totalPages = (int) ceil($totalData / ($show == 0 ? 10 : $show));

        if (!$getAll) {
            if (!empty($show) && $show > 0) {
                $query = $query->limit(intval($show));
            }

            if (!empty($sort)) {
                switch ($sort) {
                    case 'terlama':
                        $query = $query->orderBy('i.created_at', 'ASC');
                        break;

                    case 'terbaru':
                        $query = $query->orderBy('i.created_at', 'DESC');
                        break;

                    case 'nama_siswa':
                        $query = $query->orderBy('s.nama_siswa', 'ASC');
                        break;

                    case 'tempat_industri':
                    case 'tgl_mulai':
                    case 'tgl_selesai':
                    case 'status':
                        $query = $query->orderBy("i.$sort", 'ASC');
                        break;

                    default:
                        $query = $query->orderBy('i.id_siswa', 'ASC');
                        break;
                }
            } else {
                $query = $query->orderBy('i.id_industri', 'DESC');
            }

            if (!empty($page) && $page > 0) {
                $query = $query->paginate($show);
            }
        }

        $itemStart = ($page - 1) * $show;

        return [
            'query' => $query,
            'itemStart' => $itemStart,
            'totalData' => $totalData,
            'totalPages' => $totalPages,
        ];
    }

    public function generatedUniqueSlug(string $nama): string
    {
        $newSlug = url_title($nama, '-', true);
        $slug = $newSlug;
        $counter = 1;

        while ($this->where('slug', $slug)->first()) {
            $slug = $newSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function updateSlug(string $namaSiswa, string $oldSlug): string
    {
        $newSlug = url_title($namaSiswa, '-', true);

        $cleanedOldSlug = preg_replace("/-\d+$/", '', $oldSlug);

        if ($newSlug == $cleanedOldSlug) {
            return $oldSlug;
        }

        return $this->generatedUniqueSlug($namaSiswa);
    }

    public function getDataByIdentifier(string $column,  string $identifier)
    {
        $query = $this->select('
                i.id_industri,
                i.slug AS industri_slug,
                i.id_siswa,
                i.tempat_industri, 
                i.tgl_mulai, 
                i.tgl_selesai, 
                i.status,
                s.nama_siswa,
                CONCAT(s.kelas, " - ", s.jurusan) AS kelass
                ')
            ->from('industri i')
            ->join('siswa s', 's.id_siswa = i.id_siswa')
            ->where("i.{$column}", $identifier)
            ->groupBy('i.id_industri')
            ->first();

        return $query;
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
        array_unshift($columns, 'kelass');
        array_unshift($columns, 'nama_siswa');

        return array_diff($columns, ['id_industri', 'id_siswa', 'slug', 'created_at', 'updated_at']);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class pelanggaranModel extends Model
{
    protected $table = "pelanggaran";
    protected $primaryKey = "id_pelanggaran";
    protected $useTimestamps = true;
    protected $allowedFields = ["slug", "id_siswa", "pelanggaran", "tingkat_pelanggaran", "tindakan", "tanggal"];

    public function getFilteredData($keyword = null, $kategori_tingkat_pelanggaran = '', $show = 10, $sort = 'id_pelanggaran', $page = 1, $getAll = false)
    {

        $query = $this->select('
                p.id_pelanggaran,
                p.slug AS pelanggaran_slug,
                p.id_siswa,
                p.pelanggaran, 
                p.tingkat_pelanggaran, 
                p.tindakan,
                p.tanggal,
                s.nama_siswa,
                CONCAT(s.kelas, " - ", s.jurusan) AS kelass
                ')
            ->from('pelanggaran p')
            ->join('siswa s', 's.id_siswa = p.id_siswa')
            ->groupBy('p.id_pelanggaran');


        if (!empty($keyword)) {
            $query = $query->groupStart()
                ->like('s.nama_siswa', $keyword)
                ->orLike('p.tingkat_pelanggaran', $keyword)
                ->orLike('p.tindakan', $keyword)
                ->orLike('p.tanggal', $keyword)
                ->groupEnd();
        }

        if (!empty($kategori_tingkat_pelanggaran)) {
            $query = $query->where('LOWER(p.tingkat_pelanggaran)', strtolower($kategori_tingkat_pelanggaran));
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
                        $query = $query->orderBy('p.created_at', 'ASC');
                        break;

                    case 'terbaru':
                        $query = $query->orderBy('p.created_at', 'DESC');
                        break;

                    case 'nama_siswa':
                        $query = $query->orderBy('s.nama_siswa', 'ASC');
                        break;

                    case 'pelanggaran':
                    case 'tingkat_pelanggaran':
                    case 'tindakan':
                    case 'tanggal':
                        $query = $query->orderBy("p.$sort", 'ASC');
                        break;

                    default:
                        $query = $query->orderBy('p.id_siswa', 'ASC');
                        break;
                }
            } else {
                $query = $query->orderBy('p.id_pelanggaran', 'DESC');
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
                p.id_pelanggaran,
                p.slug AS pelanggaran_slug,
                p.id_siswa,
                p.pelanggaran, 
                p.tingkat_pelanggaran, 
                p.tindakan,
                p.tanggal,
                s.nama_siswa,
                s.foto,
                CONCAT(s.kelas, " - ", s.jurusan) AS kelass
                ')
            ->from('pelanggaran p')
            ->join('siswa s', 's.id_siswa = p.id_siswa')
            ->where("{$column}", $identifier)
            ->groupBy('p.id_pelanggaran');

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

        return array_diff($columns, ['id_pelanggaran', 'id_siswa', 'slug', 'created_at', 'updated_at']);
    }
}

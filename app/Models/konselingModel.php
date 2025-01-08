<?php

namespace App\Models;

use CodeIgniter\Model;

class konselingModel extends Model
{
    protected $table = "konseling";
    protected $primaryKey = "id_konseling";
    protected $useTimestamps = true;
    protected $allowedFields = ["slug", "id_siswa", "id_konselor", "tanggal", "permasalahan", "tindakan", "catatan", "status"];


    public function getFilteredData($keyword = null, $kategori_status = '', $show = 10, $sort = 'id_konseling', $page = 1, $getAll = false)
    {
        $query = $this->select('
                    k.id_konseling,
                    k.tanggal,
                    k.slug AS konseling_slug,
                    k.permasalahan, 
                    k.tindakan, 
                    k.catatan, 
                    k.status, 
                    s.nama_siswa,
                    CONCAT(s.kelas, " - ", s.jurusan) AS kelass,
                    kslr.nama_konselor
                    ')
            ->from('konseling k')
            ->join('siswa s', 's.id_siswa = k.id_siswa')
            ->join('konselor kslr', 'kslr.id_konselor = k.id_konselor')
            ->groupBy('k.id_konseling');


        if (!empty($keyword)) {
            $query = $query->groupStart()
                ->like('s.nama_siswa', $keyword)
                ->orLike('kslr.nama_konselor', $keyword)
                ->orLike('k.tanggal', $keyword)
                ->orLike('k.status', $keyword)
                ->groupEnd();
        }

        if (!empty($kategori_status)) {
            $query = $query->where('LOWER(k.status)', strtolower($kategori_status));
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
                        $query = $query->orderBy('k.created_at', 'ASC');
                        break;

                    case 'terbaru':
                        $query = $query->orderBy('k.created_at', 'DESC');
                        break;

                    case 'nama_siswa':
                        $query = $query->orderBy('s.nama_siswa', 'ASC');
                        break;

                    case 'nama_konselor':
                        $query = $query->orderBy('kslr.nama_konselor', 'ASC');
                        break;

                    case 'status':
                    case 'tanggal':
                        $query = $query->orderBy("k.$sort", 'ASC');
                        break;

                    default:
                        $query = $query->orderBy('k.id_konseling', 'ASC');
                        break;
                }
            } else {
                $query = $query->orderBy('k.id_konseling', 'DESC');
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

    public function getJadwalData()
    {
        $data = $this->select('
                    k.id_konseling,
                    k.tanggal,
                    k.slug AS konseling_slug,
                    k.permasalahan, 
                    k.tindakan, 
                    k.catatan, 
                    k.status, 
                    s.foto,
                    s.nama_siswa,
                    CONCAT(s.kelas, " - ", s.jurusan) AS kelass,
                    kslr.nama_konselor
                    ')
            ->from('konseling k')
            ->join('siswa s', 's.id_siswa = k.id_siswa')
            ->join('konselor kslr', 'kslr.id_konselor = k.id_konselor')
            ->groupBy('k.id_konseling')
            ->get()
            ->getResultArray();

        return $data;
    }

    public function getDataByIdentifier(string $condition,  string $identifier)
    {
        $query = $this->select('
                    k.id_konseling,
                    k.tanggal,
                    k.slug AS konseling_slug,
                    k.permasalahan, 
                    k.tindakan, 
                    k.catatan, 
                    k.status, 
                    s.id_siswa,
                    s.nama_siswa,
                    CONCAT(s.kelas, " - ", s.jurusan) AS kelass,
                    kslr.nama_konselor,
                    kslr.id_konselor
                    ')
            ->from('konseling k')
            ->join('siswa s', 's.id_siswa = k.id_siswa')
            ->join('konselor kslr', 'kslr.id_konselor = k.id_konselor')
            ->where("{$condition}", $identifier)
            ->groupBy('k.id_konseling')
            ->first();

        return $query;
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

    public function updateTotalKonseling($id_konselor)
    {
        $this->db->table('konselor')
            ->set('total_konseling', 'total_konseling + 1', false)
            ->where('id_konselor', $id_konselor)
            ->update();
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
        array_unshift($columns, 'nama_konselor');
        array_unshift($columns, 'kelass');
        array_unshift($columns, 'nama_siswa');

        return array_diff($columns, ['id_konseling', 'id_siswa', 'id_konselor', 'slug', 'created_at', 'updated_at']);
    }
}

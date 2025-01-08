<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\adminModel;
use App\Models\siswaModel;
use App\Models\pelanggaranModel;
use App\Models\konselingModel;
use App\Models\industriModel;
use Config\Database;

class HomeController extends BaseController
{
    protected $adminModel, $siswaModel, $pelanggaranModel, $konselingModel, $industriModel;

    public function __construct()
    {
        $this->adminModel = new adminModel();
        $this->siswaModel = new siswaModel();
        $this->pelanggaranModel = new pelanggaranModel();
        $this->konselingModel = new konselingModel();
        $this->industriModel = new industriModel();
    }

    public function dashboard() {
        $totalSiswa = $this->siswaModel->countAll();
        $totalPelanggaran = $this->pelanggaranModel->countAll();
        $totalKonseling = $this->konselingModel->countAll();
        $totalIndustri = $this->industriModel->countAll();
        
        $jadwalKonseling = $this->konselingModel
                                ->select('
                                    ssw.nama_siswa,
                                    ssw.foto AS foto_siswa,
                                    CONCAT(ssw.kelas, " - ", ssw.jurusan) AS kelass,
                                    kslr.nama_konselor,
                                    kslr.foto AS foto_konselor,
                                    kslng.tanggal,
                                ')
                            ->from('konseling kslng')
                            ->join('siswa ssw', 'ssw.id_siswa = kslng.id_siswa')
                            ->join('konselor kslr', 'kslr.id_konselor = kslng.id_konselor')
                            ->where('kslng.tanggal >=', date('Y-m-d'))
                            ->where('kslng.status', 'Dijadwalkan')
                            ->groupBy('kslng.id_konseling')
                            ->orderBy('kslng.tanggal', 'ASC')
                            ->get()->getResultArray();

        $data = [
            'totalSiswa' => $totalSiswa,
            'totalPelanggaran' => $totalPelanggaran,
            'totalKonseling' => $totalKonseling,
            'totalIndustri' => $totalIndustri,
            'jadwalKonseling' => $jadwalKonseling,
        ];

        return view('pages/dashboard', $data);
    }
    
    protected function getTotalData($data, $identifier) {
        $result = [];
        foreach ($data as $row) {
            $key = $row[$identifier];
            if (!isset($result[$key])) {
                $result[$key] = 0;
            }
            $result[$key]++;
        }

        return $result;
    }

    public function getChartData() {

        if (!$this->request->isAJAX()) {
            return redirect()->to('/dashboard');
        }

        $dataSiswa = $this->siswaModel->select('nama_siswa, jurusan')->orderBy('jurusan', 'DESC')->findAll();
        $dataSiswaIndustri = $this->industriModel
                                ->select('s.nama_siswa, s.jurusan')
                                ->from('industri i')
                                ->join('siswa s', 's.id_siswa = i.id_siswa')
                                ->orderBy('s.jurusan', 'DESC')
                                ->groupBy('i.id_siswa')
                                ->get()->getResultArray();

        $konseling = $this->konselingModel->select('tanggal AS tanggal_konseling')->orderBy('tanggal', 'ASC')->findAll();
        $pelanggaran = $this->pelanggaranModel->select('tanggal AS tanggal_pelanggaran')->orderBy('tanggal', 'ASC')->findAll();

        $data = [
            'studentsByMajor' => $this->getTotalData($dataSiswa, 'jurusan'),
            'studentsIndustryByMajor' => $this->getTotalData($dataSiswaIndustri, 'jurusan'),
            'konseling' => $this->getTotalData($konseling, 'tanggal_konseling'),
            'pelanggaran' => $this->getTotalData($pelanggaran, 'tanggal_pelanggaran'),
        ];

        return $this->response->setJSON($data);
    }
} 
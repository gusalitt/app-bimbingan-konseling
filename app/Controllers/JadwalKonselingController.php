<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\konselingModel;
use App\Models\siswaModel;
use App\Models\konselorModel;
use DateTime;

class JadwalKonselingController extends BaseController
{
    protected $konselingModel;
    protected $siswaModel;
    protected $konselorModel;

    public function __construct()
    {
        $this->konselingModel = new konselingModel();
        $this->siswaModel = new siswaModel();
        $this->konselorModel = new konselorModel();
    }

    public function preparedData()
    {
        $jadwal = $this->konselingModel->getJadwalData();

        foreach ($jadwal as $index => &$item) {
            $item['hash_tanggal'] = hash('sha256', $item['tanggal'] . $index);
        }
        $data = [
            'jadwal' => $jadwal,
            'siswaList' => $this->siswaModel
                ->select('id_siswa, nama_siswa, kelas, jurusan')
                ->orderBy('kelas', 'ASC')
                ->orderBy('jurusan', 'ASC')
                ->findAll(),
            'konselorList' => $this->konselorModel
                ->select('id_konselor, nama_konselor')
                ->orderBy('nama_konselor', 'ASC')
                ->findAll(),
            'validation' => \Config\Services::validation(),
            'urlToAddForm' => build_query_url(site_url('/jadwal/add'), $this->request),
            'title' => 'jadwal'
        ];

        return $data;
    }

    public function index()
    {
        $data =  $this->preparedData();

        return view('pages/konseling/jadwal_konseling', $data);
    }

    public function detail($date)
    {
        $data = $this->preparedData();
        $jadwal = $data['jadwal'];

        // One data
        $konselingDetail = null;
        foreach ($jadwal as $item) {
            if ($item['hash_tanggal'] == $date) {
                $konselingDetail = $item;
                break;
            }
        }

        // All Data
        $allKonselingData = null;
        if ($konselingDetail) {
            $allKonselingData = array_filter($jadwal, function ($item) use ($konselingDetail) {
                return $item['nama_siswa'] == $konselingDetail['nama_siswa'] && $item['tanggal'] !== $konselingDetail['tanggal'];
            });
        }

        if ($allKonselingData) {
            usort($allKonselingData, function ($a, $b) {
                $dateA = new DateTime($a['tanggal']);
                $dateB = new DateTime($b['tanggal']);

                return $dateA <=> $dateB;
            });
        }

        $data['konselingDetail'] = $konselingDetail ?? [];
        $data['allKonselingData'] = $allKonselingData ?? [];
        $data['ModalDetailActive'] = true;

        return view('pages/konseling/jadwal_konseling', $data);
    }

    public function edit($slug)
    {
        $data = $this->preparedData();

        $data['knslng'] = $this->konselingModel->getDataByIdentifier('k.slug', $slug);
        $data['ModalEditActive'] = true;
        $data['urlToEditForm'] = build_query_url(site_url('/jadwal/update'), $this->request, $data['knslng']['id_konseling']);

        if (empty($data['knslng'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data jadwal konseling ' . $slug . ' tidak ada!');
        }

        return view('pages/konseling/jadwal_konseling', $data);
    }

    public function save($id = null)
    {
        $isUpdate = $id !== null;
        $siswa_id = intval($this->request->getPost('siswa_id'));
        $namaSiswa = trim(explode('(', $this->request->getPost('namaSiswa'))[0]);
        $namaKonselor = $this->request->getPost('namaKonselor');
        $konselor_id = intval($this->request->getPost('konselor_id'));
        $tanggal = $this->request->getPost('tanggal');

        // Validation Data
        $validation = service('validation');
        $validation->setRules([
            'namaSiswa' => [
                'rules' => "required|findStudentByName[{$namaSiswa}]",
                'errors' => [
                    'required' => 'Nama siswa wajib diisi!',
                    'findStudentByName' => 'Nama siswa tersebut tidak ditemukan dalam data siswa!'
                ]
            ],
            'siswa_id' => [
                'rules' => "required|isStudentIdAndNameValid[{$siswa_id}{$namaSiswa}]",
                'errors' => [
                    'required' => 'Upss sepertinya ada kesalahan! Mohon coba lagi...',
                    'isStudentIdAndNameValid' => 'Upss sepertinya ada kesalahan! Mohon coba lagi..',
                ]
            ],
            'namaKonselor' => [
                'rules' => "required|findKonselorByName[{$namaKonselor}]",
                'errors' => [
                    'required' => 'Nama konselor wajib diisi!',
                    'findKonselorByName' => 'Nama konselor tersebut tidak ditemukan dalam data konselor!'
                ]
            ],
            'konselor_id' => [
                'rules' => "required|isKonselorIdAndNameValid[{$konselor_id}{$namaKonselor}]",
                'errors' => [
                    'required' => 'Upss sepertinya ada kesalahan! Mohon coba lagi...',
                    'isKonselorIdAndNameValid' => 'Upss sepertinya ada kesalahan! Mohon coba lagi...',
                ]
            ],
            'tanggal' => [
                'rules' => "required|valid_date",
                'errors' => [
                    'required' => 'Tanggal konseling wajib diisi!',
                    'valid_date' => 'Harap masukkan tanggal yang valid.',
                ]
            ],
            'status' => [
                'rules' => 'required|in_list[Dijadwalkan,Selesai,Dibatalkan]',
                'errors' => [
                    'required' => 'Status wajib diisi!',
                    'in_list' => 'Status harus berisi salah satu dari: {param} ',
                ]
            ],

        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $data = $this->preparedData();

            session()->setFlashdata('modalType', $isUpdate ? 'edit' : 'add');

            $data[$isUpdate ? 'oldEditData' : 'oldAddData'] = $this->request->getPost();
            $data[$isUpdate ? 'ModalEditActive' : 'ModalAddActive'] = true;
            $data['urlToAddForm'] = build_query_url(site_url('/jadwal/add'), $this->request);
            $data['urlToEditForm'] = build_query_url(site_url('/jadwal/update'), $this->request, $isUpdate ? $id : null);

            if ($isUpdate) {
                $data['knslng'] = $this->konselingModel->getDataByIdentifier('k.id_konseling', $id);
            }

            return view('pages/konseling/jadwal_konseling', $data);
        }

        // Data Action
        $jadwalKonselingData = [
            'slug' => $isUpdate
                ?  $this->konselingModel->updateSlug($namaSiswa, $this->request->getPost('oldSlug'))
                : $this->konselingModel->generatedUniqueSlug($namaSiswa),
            'id_siswa' => (int) $siswa_id,
            'id_konselor' => (int) $konselor_id,
            'tanggal' => $tanggal,
            'permasalahan' => $this->request->getPost('permasalahan') ?: '-',
            'tindakan' => $this->request->getPost('tindakan') ?: '-',
            'catatan' => $this->request->getPost('catatan') ?: '-',
            'status' => $this->request->getPost('status'),
        ];

        // Update total counseling on counselor data
        if ($isUpdate) {
            $old_id_konselor = (int) $this->konselingModel->find($id)['id_konselor'];

            if ($old_id_konselor !== $jadwalKonselingData['id_konselor']) {
                $this->konselingModel->updateTotalKonseling($jadwalKonselingData['id_konselor']);
            }
        } else {
            $this->konselingModel->updateTotalKonseling($jadwalKonselingData['id_konselor']);
        }

        $isSaved = $isUpdate
            ? $this->konselingModel->update($id, $jadwalKonselingData)
            : $this->konselingModel->save($jadwalKonselingData);

        session()->setFlashdata(
            $isSaved ? 'success' : 'error',
            $isSaved
                ? 'Jadwal konseling berhasil ' . ($isUpdate ? 'diedit!' : 'ditambah!')
                : 'Jadwal konseling GAGAL ' . ($isUpdate ? 'diedit!' : 'ditambah')
        );

        $url = build_query_url(site_url('/jadwal'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }

    public function delete($id)
    {
        if (!$this->konselingModel->find($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman tidak ditemukan.');
        }

        if ($this->konselingModel->delete($id)) {
            session()->setFlashdata('success', 'Jadwal konseling berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Jadwal konseling GAGAL dihapus!');
        }

        $url = build_query_url(site_url('/jadwal'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }
}

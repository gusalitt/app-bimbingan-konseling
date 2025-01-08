<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\pelanggaranModel;
use App\Models\siswaModel;
use PHPUnit\Util\ThrowableToStringMapper;
use DateTime;


class PelanggaranController extends BaseController
{
    protected $pelanggaranModel;
    protected $siswaModel;

    public function __construct()
    {
        $this->pelanggaranModel = new pelanggaranModel();
        $this->siswaModel = new siswaModel();
    }

    private function buildEditPelanggaranUrls(): array
    {
        $pelanggaran = $this->pelanggaranModel->select('id_pelanggaran, slug')->findAll();
        $urlsToEditPelanggaran = [];

        foreach ($pelanggaran as $plngrn) {
            $url = build_query_url(site_url('/pelanggaran/edit'), $this->request, $plngrn['slug']);
            $urlsToEditPelanggaran[$plngrn['id_pelanggaran']] = $url;
        }

        return $urlsToEditPelanggaran;
    }

    private function setPaginationSession(int $currentPage, int $totalPages): void
    {
        $nextPage = intval($currentPage);
        $previousPage = intval($currentPage);

        //  Logic btn Next & Previous at the Pagination.
        if ($nextPage < $totalPages) ++$nextPage;
        if ($previousPage > 1) --$previousPage;

        session()->set('nextPagePelanggaran', $nextPage);
        session()->set('previousPagePelanggaran', $previousPage);
    }

    private function redirectToValidPage(string $queryParam): \CodeIgniter\HTTP\RedirectResponse
    {
        return redirect()->to(build_query_url(site_url('/pelanggaran'), $this->request, null, [$queryParam]));
    }

    public function preparedData()
    {
        $keyword = $this->request->getGet('key');
        $kategori_tingkat_pelanggaran = $this->request->getGet('kategoriTingkatPelanggaran') ?? '';
        $show = intval($this->request->getGet('show') ?? 10);
        $sort = $this->request->getGet('sort') ?? 'terbaru';
        $page = intval($this->request->getGet('page') ?? 1);

        $filteredData = $this->pelanggaranModel->getFilteredData(
            $keyword,
            $kategori_tingkat_pelanggaran,
            ($show == 0 ? 10 : $show),
            $sort,
            ($page == 0 ? 1 : $page)
        );

        $totalData = $filteredData['totalData'];
        $totalPages = $filteredData['totalPages'];

        // Validate the number of rows displayed.
        if ($show !== 10) {
            if ($show < 0 || $show > $totalData || !is_numeric($show)) {
                return $this->redirectToValidPage('show');
            }
        }

        // Next & Previous button logic in Pagination.
        $this->setPaginationSession($page, $totalPages);

        // Validate in Pagination.
        if ($page != 1) {
            if ($page < 0 || $page > $totalPages || !is_numeric($page)) {
                return $this->redirectToValidPage('page');
            }
        }

        return [
            'pelanggaran' => $filteredData['query'],
            'itemStart' => $filteredData['itemStart'],
            'pager' => $this->pelanggaranModel->pager,
            'totalPelanggaran' => $totalData,
            'validation' => \Config\Services::validation(),
            'keyword' => $keyword,
            'kategori_tingkat_pelanggaran' => $kategori_tingkat_pelanggaran,
            'show' => $show,
            'sort' => $sort,
            'urlsToEditPelanggaran' => $this->buildEditPelanggaranUrls(),
            'urlToAddForm' => build_query_url(site_url('/pelanggaran/add'), $this->request),

            // To Print Data
            'columnNames' => $this->pelanggaranModel->getColumnNames(),
            'records' => $this->pelanggaranModel->getFilteredData(null, null, null, null, null, true)['query']->get()->getResultArray(),
            'title' => 'pelanggaran',

            'siswaList' => $this->siswaModel
                ->select('id_siswa, nama_siswa, kelas, jurusan')
                ->orderBy('kelas', 'ASC')
                ->orderBy('jurusan', 'ASC')
                ->findAll(),
        ];
    }

    public function index()
    {
        $data = $this->preparedData();

        if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $data;
        }

        return view('pages/pelanggaran/data_pelanggaran', $data);
    }

    public function edit($slug)
    {
        $data = $this->preparedData();

        if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $data;
        }

        $data['plngrn'] = $this->pelanggaranModel->getDataByIdentifier('p.slug', $slug)->first();
        $data['ModalEditActive'] = true;
        $data['urlToEditForm'] = build_query_url(site_url('/pelanggaran/update'), $this->request, $data['plngrn']['id_pelanggaran']);

        if (empty($data['plngrn'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pelanggaran ' . $slug . ' tidak ada!');
        }

        return view('pages/pelanggaran/data_pelanggaran', $data);
    }

    public function save($id = null)
    {
        $isUpdate = $id !== null;
        $siswa_id = intval($this->request->getPost('siswa_id'));
        $namaSiswa = trim(explode('(', $this->request->getPost('namaSiswa'))[0]);
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
                    'isStudentIdAndNameValid' => 'Upss sepertinya ada kesalahan! Mohon coba lagi...',
                ]
            ],
            'pelanggaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis pelanggaran wajib diisi!',
                ]
            ],
            'tingkatPelanggaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tingkat pelanggaran wajib diisi!',
                ]
            ],
            'tanggal' => [
                'rules' => "required|valid_date",
                'errors' => [
                    'required' => 'Tanggal terjadinya pelanggaran wajib diisi!',
                    'valid_date' => 'Harap masukkan tanggal yang valid.',
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $data = $this->preparedData();
            if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
                return $data;
            }

            session()->setFlashdata('modalType', $isUpdate ? 'edit' : 'add');

            $data[$isUpdate ? 'oldEditData' : 'oldAddData'] = $this->request->getPost();
            $data[$isUpdate ? 'ModalEditActive' : 'ModalAddActive'] = true;
            $data['urlToAddForm'] = build_query_url(site_url('/pelanggaran/add'), $this->request);
            $data['urlToEditForm'] = build_query_url(site_url('/pelanggaran/update'), $this->request, $isUpdate ? $id : null);

            if ($isUpdate) {
                $data['plngrn'] = $this->pelanggaranModel->getDataByIdentifier('p.id_pelanggaran', $id)->first();
            }

            return view('pages/pelanggaran/data_pelanggaran', $data);
        }

        // Data Action
        $pelanggaranData = [
            'slug' => $isUpdate
                ?  $this->pelanggaranModel->updateSlug($namaSiswa, $this->request->getPost('oldSlug'))
                : $this->pelanggaranModel->generatedUniqueSlug($namaSiswa),
            'id_siswa' => $siswa_id,
            'pelanggaran' =>  $this->request->getPost('pelanggaran'),
            'tingkat_pelanggaran' => $this->request->getPost('tingkatPelanggaran'),
            'tindakan' => $this->request->getPost('tindakan') ?: '-',
            'tanggal' => $tanggal,
        ];

        $isSaved = $isUpdate
            ? $this->pelanggaranModel->update($id, $pelanggaranData)
            : $this->pelanggaranModel->save($pelanggaranData);

        session()->setFlashdata(
            $isSaved ? 'success' : 'error',
            $isSaved
                ? 'Data pelanggaran berhasil ' . ($isUpdate ? 'diedit!' : 'ditambah!')
                : 'Data pelanggaran GAGAL ' . ($isUpdate ? 'diedit!' : 'ditambah')
        );

        $url = build_query_url(site_url('/pelanggaran'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }

    public function delete($id)
    {
        if (!$this->pelanggaranModel->find($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman tidak ditemukan.');
        }

        if ($this->pelanggaranModel->delete($id)) {
            session()->setFlashdata('success', 'Data pelanggaran berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Data pelanggaran GAGAL dihapus!');
        }

        $url = build_query_url(site_url('/pelanggaran'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }

    public function historySearch()
    {
        $data['siswaList'] = $this->siswaModel->findAll();
        return view('pages/pelanggaran/pencarian_riwayat', $data);
    }

    public function violationHistory()
    {
        $namaSiswaSearch = str_replace('+', ' ', $this->request->getGet('search'));
        
        $validation = service('validation');
        $validation->setRules([
            'search' => [
                'rules' => "required|findStudentByName[{$namaSiswaSearch}]",
                'errors' => [
                    'required' => 'Nama siswa wajib diiisi',
                    'findStudentByName' => 'Nama siswa tersebut tidak ditemukan dalam data siswa!'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/riwayat-pelanggaran/cari')->withInput()->with('errors', $validation->getErrors());
        }


        $pelanggaranData = $this->pelanggaranModel->getDataByIdentifier('s.nama_siswa', $namaSiswaSearch)->orderBy('p.tanggal', 'DESC')->findAll();
        $totalPelanggaran = [
            'total_ringan' => 0,
            'total_sedang' => 0,
            'total_berat' => 0,
        ];

        foreach ($pelanggaranData as $index => $entry) {
            if ($entry['tingkat_pelanggaran'] == 'ringan') $totalPelanggaran['total_ringan']++;
            if ($entry['tingkat_pelanggaran'] == 'sedang') $totalPelanggaran['total_sedang']++;
            if ($entry['tingkat_pelanggaran'] == 'berat') $totalPelanggaran['total_berat']++;
        }

        $data = [
            'pelanggaranData' => $pelanggaranData,
            'totalPelanggaran' => $totalPelanggaran,
        ];

        if (!$data['pelanggaranData'] && $data['pelanggaranData'] === []) {
            session()->setFlashdata('info', 'Siswa ini belum memiliki riwayat pelanggaran.');
            return redirect()->to('/riwayat-pelanggaran/cari')->with('modalMessage', true);
        } 

        return view('pages/pelanggaran/riwayat_pelanggaran', $data);
    }
}

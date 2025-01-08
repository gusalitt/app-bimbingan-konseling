<?php  
namespace App\Validation;

use App\Models\siswaModel;
use App\Models\jurusanModel;
use App\Models\konselingModel;
use App\Models\konselorModel;

class CustomValidation
{
    protected $siswaModel;
    protected $jurusanModel;
    protected $konselorModel;

    public function __construct()
    {
        $this->siswaModel = new siswaModel();
        $this->jurusanModel = new jurusanModel();
        $this->konselorModel = new konselorModel();
    }

    public function isStudentIdAndNameValid(string $siswaId, string $namaSiswa): bool
    {
        $siswaId = (int)$siswaId;
        $namaSiswa = preg_replace("/\d/", '', explode('(', $namaSiswa)[0]);

        $siswa = $this->siswaModel->select('nama_siswa')->find($siswaId);

        if (!$siswa) {
            return false;
        }

        return strtolower(trim($siswa['nama_siswa'])) === strtolower(trim($namaSiswa));
    }

    public function findStudentByName(string $namaSiswa): bool {
        $namaSiswa = trim(explode('(', $namaSiswa)[0]);

        $siswa = $this->siswaModel->where('LOWER(nama_siswa)', strtolower($namaSiswa))->first();
        return $siswa !== null;
    }

    public function findMajorByName(string $namaJurusan): bool {
        $siswa = $this->jurusanModel->where('LOWER(nama_jurusan)', strtolower($namaJurusan))->first();
        return $siswa !== null;
    }



    public function findKonselorByName(string $namaKonselor): bool {
        $namaKonselor = trim(explode('(', $namaKonselor)[0]);

        $konselor = $this->konselorModel->where('LOWER(nama_konselor)', strtolower($namaKonselor))->first();
        return $konselor !== null;
    }

    public function isKonselorIdAndNameValid(string $konselorId, string $namaKonselor): bool
    {
        $konselorId = (int)$konselorId;
        $namaKonselor = preg_replace("/\d/", '', $namaKonselor);
        $konselor = $this->konselorModel->select('nama_konselor')->find($konselorId);

        if (!$konselor) {
            return false;
        }

        return strtolower(trim($konselor['nama_konselor'])) === strtolower(trim($namaKonselor));
    }
}
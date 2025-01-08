<?php
namespace App\Models;
use CodeIgniter\Model;
use PHPUnit\Event\Telemetry\Duration;
use tidy;

class jurusanModel extends Model 
{
    protected $table = "jurusan";
    protected $primaryKey = "id_jurusan";
    protected $useTimestamps = true;
    protected $allowedFields = ["slug", "nama_jurusan", "deskripsi"]; 

    public function getFilteredData($keyword = null, $sort = 'id_jurusan', $order = 'desc') {

        $query = $this->select('*');
        if (!empty($keyword)) {
            $query = $query->like('nama_jurusan', $keyword)->orLike('deskripsi', $keyword);
        } 

        if ($sort != 'nama_jurusan') {
            $sort = 'id_jurusan';
        }

        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'desc';
        }

        return $query->orderBy($sort, $order)->findAll();
    }

    public function getColumnNames() {
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

        return array_diff($columns, ['id_jurusan', 'slug', 'created_at', 'updated_at']);
    }
}
?>
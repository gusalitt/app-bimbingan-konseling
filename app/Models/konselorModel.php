<?php
namespace App\Models;
use CodeIgniter\Model;
use PHPUnit\Event\Telemetry\Duration;
use tidy;

class konselorModel extends Model 
{
    protected $table = "konselor";
    protected $primaryKey = "id_konselor";
    protected $useTimestamps = true;
    protected $allowedFields = ["slug", "foto", "nama_konselor", "no_telp", "total_konseling"]; 

    public function getFilteredData($keyword = null, $sort = 'id_konselor', $order = 'desc') {

        $query = $this->select('*');
        if (!empty($keyword)) {
            $query = $query->like('nama_konselor', $keyword)->orLike('total_konseling', $keyword);
        } 

        if (!in_array($sort, ['nama_konselor', 'total_konseling'])) {
            $sort = 'id_konselor';
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

        return array_diff($columns, ['id_konselor', 'slug', 'foto', 'created_at', 'updated_at']);
    }
}
?>
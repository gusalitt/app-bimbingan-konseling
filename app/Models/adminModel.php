<?php

namespace App\Models;

use CodeIgniter\Model;
use PHPUnit\Event\Telemetry\Duration;
use tidy;

class adminModel extends Model
{
    protected $table = "admin";
    protected $primaryKey = "id_admin";
    protected $useTimestamps = true;
    protected $allowedFields = ["slug", "username", "email", "password", "tanggal_terdaftar", "status", "remember_token"];

    public function getFilteredData($keyword = null, $sort = 'id_admin', $order = 'desc')
    {

        $query = $this->select('*');
        if (!empty($keyword)) {
            $query = $query->like('username', $keyword)->orLike('email', $keyword);
        }

        if (!in_array($sort, ['username', 'email', 'tanggal_terdaftar'])) {
            $sort = 'id_admin';
        }

        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'desc';
        }

        return $query->orderBy($sort, $order)->findAll();
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

        return array_diff($columns, ['id_admin', 'slug', 'password', 'remember_token', 'created_at', 'updated_at']);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class PendingModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pendingdocuments';
    public function getPendingDocumentsByOfficeID($officeID)
    {
        return $this->db->table('pendingdocuments')
            ->where('OfficeID', $officeID)
            ->get()
            ->getResult();
    }
    public function deleteFromPending($documentID)
    {
        $this->where('DocumentID', $documentID)
            ->delete();
    
        return $this->affectedRows() > 0;
    }
    protected $primaryKey       = 'PendingDocumentID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['PendingDocumentID', 'Title','Author','Purpose','DateReceived','Status','Progress','TrackingNumber','Location','OfficeID','DocumentID'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}

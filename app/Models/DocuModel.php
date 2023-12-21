<?php

namespace App\Models;

use CodeIgniter\Model;

class DocuModel extends Model
{

    protected $DBGroup          = 'default';
    protected $table            = 'documents';
    public function getDocumentsByOfficeID($officeID)
    {
        return $this->db->table('documents')
            ->where('OfficeID', $officeID)
            ->get()
            ->getResult();
    }

    public function getPendingDocumentsByOfficeID($officeID)
    {
        return $this->db->table('documents')
            ->where('OfficeID', $officeID)
            ->where('status', 'Pending') 
            ->get()
            ->getResult();
    }    

    public function getReceivedDocumentsByOfficeID($officeID)
    {
        return $this->db->table('documents')
            ->where('OfficeID', $officeID)
            ->where('status', 'In Progress') 
            ->get()
            ->getResult();
    }
    public function getCompletedDocumentsByOfficeID($officeID)
    {
        return $this->db->table('documents')
            ->where('OfficeID', $officeID)
            ->where('status', 'Completed') 
            ->get()
            ->getResult();
    }
    public function getHistoryDocumentsByOfficeID($officeID)
    {
        return $this->db->table('documents')
            ->where('OfficeID', $officeID)
            ->whereIn('status', ['Deleted', 'Sent Out of Office'])
            ->get()
            ->getResult();
    }

    public function updateStatus($documentId, $newStatus)
    {
        return $this->set('Status', $newStatus) // Use 'Status' with uppercase 'S'
                    ->where('DocumentID', $documentId)
                    ->update();
    }

    public function updateDocument($documentId, $newStatus, $newOfficeId)
    {
        $data = [
            'Status' => $newStatus,
            'OfficeID' => $newOfficeId,
        ];

        $builder = $this->db->table('documents');
        $builder->where('DocumentID', $documentId);
        $builder->replace($data);

        // Check if the replace was successful
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updateLocation($documentId, $newLocation)
    {
        return $this->where('DocumentID', $documentId)->update(['Location' => $newLocation]);
    }

    protected $primaryKey       = 'DocumentID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['DocumentID', 'Title','Author','Purpose','DateReceived','Status','Progress','TrackingNumber','Location','OfficeID'];

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

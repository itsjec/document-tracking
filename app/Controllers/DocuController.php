<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DocuModel;
use App\Models\OfficeModel;

class DocuController extends ResourceController
{
    public function index()
    {
        $officeID = session()->get('OfficeID');

        if ($officeID) {
            $data['officeID'] = $officeID;
            return view('/admin', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function getLastTrackingNumber()
    {
    
        $lastTrackingNumber = DocuModel::orderBy('DocumentID', 'DESC')->first();
    
        if ($lastTrackingNumber) {
            return $this->response->setJSON(['trackingNumber' => $lastTrackingNumber->trackingNumber]);
        } else {
            return $this->response->setJSON(['trackingNumber' => null]);
        }
    }    

    public function getDocumentsByOfficeID($officeID)
    {
        $documentModel = new DocuModel();
        $documents = $documentModel->getDocumentsByOfficeID($officeID);
    
        return $this->response->setJSON($documents);
    }

    public function getPendingDocumentsByOfficeID($officeID)
    {
        $pending = new DocuModel();
        $documents = $pending->getPendingDocumentsByOfficeID($officeID);
    
        return $this->response->setJSON($documents);
    }

    public function getReceivedDocumentsByOfficeID($officeID)
    {
        $received = new DocuModel();
        $documents = $received->getReceivedDocumentsByOfficeID($officeID);
    
        return $this->response->setJSON($documents);
    }

    public function getCompletedDocumentsByOfficeID($officeID)
    {
        $completed= new DocuModel();
        $documents = $completed->getCompletedDocumentsByOfficeID($officeID);
    
        return $this->response->setJSON($documents);
    }

    public function getHistoryDocumentsByOfficeID($officeID)
    {
        $completed= new DocuModel();
        $documents = $completed->getHistoryDocumentsByOfficeID($officeID);
    
        return $this->response->setJSON($documents);
    }
    
    public function getDocu()
    {
        $main = new DocuModel();
        $data = $main->findAll();
        return $this->respond($data, 200);
    }
    
    public function getOffice()
    {
        $main = new OfficeModel();
        $data = $main->findAll();
        return $this->respond($data, 200);
    }

    public function insert()
    {
        try {
            $trackingNumber = $this->generateTrackingNumber(); 
            $progressDefault = 'For Approval';

            $data = [
                'Title' => $this->request->getVar('title'),
                'Author' => $this->request->getVar('author'),
                'Purpose' => $this->request->getVar('purpose'),
                'DateReceived' => date('Y-m-d'), 
                'Status' => 'Pending',
                'Progress' => $progressDefault,
                'TrackingNumber' => $trackingNumber,
                'Location' => $this->request->getVar('Location.OfficeName'),
                'OfficeID' => $this->request->getVar('Location.OfficeID'),
            ];

            $model = new DocuModel();
            $result = $model->insert($data);

            if ($result) {
                return $this->respond(['success' => true, 'message' => 'Document inserted successfully']);
            } else {
                return $this->respond(['success' => false, 'message' => 'Failed to insert document']);
            }
        } catch (\Throwable $th) {
            return $this->respond(["message" => "Error: ".$th->getMessage()]);
        }
    }

    private function generateTrackingNumber()
    {
        $prefix = 'TN'; 
        $timestamp = date('YmdHis');
        $randomPart = strtoupper(substr(md5(uniqid(rand(), true)), 0, 6)); 

        $trackingNumber = "{$prefix}-{$timestamp}-{$randomPart}";

        return $trackingNumber;
    }

    public function getLastInsertedTrackingNumber()
    {
        $model = new DocuModel();
    
        $lastInsertedDocument = $model
            ->orderBy('DocumentID', 'DESC')
            ->first();
    
        if ($lastInsertedDocument) {
            $trackingNumber = $lastInsertedDocument['TrackingNumber'];
            return $this->respond(['TrackingNumber' => $trackingNumber], 200);
        } else {
            return $this->respond(['error' => 'No documents found'], 404);
        }
    }     
    
    public function approveDocument($documentId)
    {
        try {
            $documentModel = new DocuModel();
            $success = $documentModel->updateStatus($documentId, 'In Progress');
    
            if ($success) {
                return $this->respond(['message' => 'Document approved successfully'], Response::HTTP_OK);
            } else {
                return $this->respond(['error' => 'Document not found or update failed'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error in approveDocument: ' . $e->getMessage());
            return $this->respond(['error' => 'Internal Server Error: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
    
    public function completeDocument($documentId)
    {
        try {
            $documentModel = new DocuModel();
            $success = $documentModel->updateStatus($documentId, 'Completed');
    
            if ($success) {
                return $this->respond(['message' => 'Document completed successfully'], Response::HTTP_OK);
            } else {
                return $this->respond(['error' => 'Document not found or update failed'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error in completeDocument: ' . $e->getMessage());
            return $this->respond(['error' => 'Internal Server Error: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deleteDocument($documentId)
    {
        try {
            $documentModel = new DocuModel();
            $success = $documentModel->updateStatus($documentId, 'Deleted');
    
            if ($success) {
                return $this->respond(['message' => 'Document completed successfully'], Response::HTTP_OK);
            } else {
                return $this->respond(['error' => 'Document not found or update failed'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error in completeDocument: ' . $e->getMessage());
            return $this->respond(['error' => 'Internal Server Error: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function sendOutDocument($documentId)
    {
        try {
            $documentModel = new DocuModel();
            $success = $documentModel->updateStatus($documentId, 'Pending');
    
            if ($success) {
                return $this->respond(['message' => 'Document completed successfully'], Response::HTTP_OK);
            } else {
                return $this->respond(['error' => 'Document not found or update failed'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error in completeDocument: ' . $e->getMessage());
            return $this->respond(['error' => 'Internal Server Error: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateOfficeID($documentId, $newOfficeID)
    {
        $newOffice = $this->find($newOfficeID);
    
        if ($newOffice) {
            $newOfficeName = $newOffice['OfficeName'];

            $data = [
                'OfficeID' => $newOfficeID,
                'Location' => $newOfficeName,
            ];
    
            // Use your actual table name and primary key column name
            $this->where('DocumentID', $documentId)->update($data);
    
            // Check if the update was successful
            return $this->db->affectedRows() > 0;
        } else {
            // Handle the case where the new OfficeID is not found
            return false;
        }
    }
    
    

    public function searchDocumentByTrackingNumber($trackingNumber)
    {
        $documentModel = new DocuModel();

        $document = $documentModel->where('TrackingNumber', $trackingNumber)->first();
    
        if ($document) {
            return $this->respond($document, 200);
        } else {
            return $this->respond(null, 404);
        }
    }
    
    
    
}
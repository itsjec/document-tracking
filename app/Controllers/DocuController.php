<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DocuModel;
use App\Models\OfficeModel;
use App\Models\ReceivedModel;
use App\Models\PendingModel;
use App\Models\CompletedModel;

class DocuController extends ResourceController
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: http://localhost:8081');
        header('Access-Control-Allow-Headers: http://localhost:8081');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Authorization, Content-Type');

    }
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
        header('Access-Control-Allow-Origin: http://localhost:8081');
    
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
        header('Access-Control-Allow-Origin: http://localhost:8081');
        $main = new DocuModel();
        $data = $main->findAll();
        return $this->respond($data, 200);
    }
    
    public function getOffice()
    {
        header('Access-Control-Allow-Origin: http://localhost:8081');
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
    
            $newStatus = $this->request->getJSON()->Status; 
    
            $success = $documentModel->updateStatus($documentId, $newStatus);
    
            if ($success) {
                return $this->respond(['message' => 'Document approved successfully'], Response::HTTP_OK);
            } else {
                return $this->respond(['error' => 'Document not found or update failed'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {

            log_message('error', 'Exception in approveDocument: ' . $e->getMessage());
    

            return $this->respond(['error' => 'Internal Server Error: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }  
    
    public function completeDocument($documentId)
    {
        try {
            $documentModel = new DocuModel();
    
            $newStatus = $this->request->getJSON()->Status; 
    
            $success = $documentModel->updateStatus($documentId, $newStatus);
    
            if ($success) {
                return $this->respond(['message' => 'Document approved successfully'], Response::HTTP_OK);
            } else {
                return $this->respond(['error' => 'Document not found or update failed'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {

            log_message('error', 'Exception in approveDocument: ' . $e->getMessage());
    

            return $this->respond(['error' => 'Internal Server Error: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    } 


    public function sendOutDocument($documentId)
    {
        header('Access-Control-Allow-Origin: http://localhost:8081');
        try {
            $documentModel = new DocuModel();
            $newLocation = $this->request->getJSON()->Location; 

            $success = $documentModel->updateLocation($documentId, $newLocation);

            if ($success) {
                return $this->respond(['message' => 'Document sent out successfully'], Response::HTTP_OK);
            } else {
                return $this->respond(['error' => 'Document not found or update failed'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            log_message('error', 'Exception in sendOutDocument: ' . $e->getMessage());
            return $this->respond(['error' => 'Internal Server Error: ' . $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function searchDocumentByTrackingNumber($trackingNumber)
    {
        header('Access-Control-Allow-Origin: http://localhost:8081');
        $documentModel = new DocuModel();

        $document = $documentModel->where('TrackingNumber', $trackingNumber)->first();
    
        if ($document) {
            return $this->respond($document, 200);
        } else {
            return $this->respond(null, 404);
        }
    }
    
    
    
}
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DocuModel;
use App\Models\OfficeModel;

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

        // Check if OfficeID is set (user is logged in)
        if ($officeID) {
            $data['officeID'] = $officeID;
            return view('/admin', $data);
        } else {
            // Handle the case when the user is not logged in
            // Redirect or display a login page
            return redirect()->to('/login'); // Change '/login' to your actual login route
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
        // Fetch documents based on the OfficeID
        $documentModel = new DocuModel();
        $documents = $documentModel->getDocumentsByOfficeID($officeID);
    
        // Return the documents as JSON
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
                'Location' => $this->request->getVar('Location'),
                'OfficeID' => $this->request->getVar('Location'),
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

    
    
}

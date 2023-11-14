<?php
declare(strict_types=1);

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;

class PatientController extends Controller
{

  // Handle List Patient by Id => GET
  public function listPatientAction()
  {
    try {

      $patients = Patients::find();
      $response = [
        'status' => [
        'code'  => 200,
        'response' => 'success',
        'message' => 'Success retrieved data',
        ],
        'result'  => $patients,
      ];

      $this->response->setStatusCode(200);
      $this->response->setJsonContent($response);

    } catch (\Exception $e) {

      $response = [
        'status' => [
        'code'  => 500,
        'response'  => 'error',
        'message' => $e->getMessage(),
        ],
        'result' => null,
      ];
      
      $this->response->setStatusCode(500);
      $this->response->setJsonContent($response);
    }
    return $this->response;
  }

  // Handle Get Patient by Id => GET
  public function getPatientAction($id)
  {
    try {

      $patient = Patients::findFirst($id);

        if ($patient) {
          
          $response = [
            'status' => [
            'code' => 200,
            'response' => 'success',
            'message' => 'Success retrieved data',
            ],
            'result' => $patient,
          ];

        } else {

          $response = [
            'status' => [
            'code'  => 404,
            'response' => 'fail',
            'message'  => 'Patient not found',
            ],
            'result' => null,
          ];

          $this->response->setStatusCode(404);
          $this->response->setJsonContent($response);
          return $this->response;
        }

        $this->response->setStatusCode(200);
        $this->response->setJsonContent($response);

    } catch (\Exception $e) {

      $response = [
        'status'  => [
        'code'  => 500,
        'response' => 'error',
        'message' => $e->getMessage(),
        ],
        'result' => null,
      ];

      $this->response->setStatusCode(500);
      $this->response->setJsonContent($response);
    }
    return $this->response;
  }

  // Handle Create Patient => POST
  public function createPatientAction()
  {
    try {

      $data = $this->request->getJsonRawBody();

      if (empty($data->name) || 
          empty($data->sex) || 
          empty($data->religion) ||
          empty($data->phone) || 
          empty($data->address) || 
          empty($data->nik)) {
        
        $response = [
          'status' => [
          'code'  => 400,
          'response' => 'fail',
          'message' => 'All fields must be filled!',
          ],
          'result'  => $patients,
        ];

        $this->response->setStatusCode(400);
        $this->response->setJsonContent($response);

        return $this->response;
      }

      $patient = new Patients();
      $patient->name = strtolower($data->name);
      $patient->sex = strtolower($data->sex);
      $patient->religion = strtolower($data->religion);
      $patient->phone = intval($data->phone);
      $patient->address = strtolower($data->address);
      $patient->nik = intval($data->nik);

      $success = $patient->save();

      $response = [
        'status' => [
        'code'  => 201,
        'response' => 'success',
        'message' => 'Data added successfully',
        ],
        'result' => $patient,
      ];

      $this->response->setJsonContent($response);
      $this->response->setStatusCode(201);

    } catch (\Exception $e) {

      $response = [
        'status' => [
        'code' => 500,
        'response' => 'error',
        'message' => $e->getMessage(),
        ],
        'result' => null,
        ];

        $this->response->setStatusCode(500);
        $this->response->setJsonContent($response);
    }
    return $this->response;
  }

  // Handle Update Patient by Id => PATCH
  public function updatePatientAction($id)
  {
    try {
      $patient = Patients::findFirstById($id);

      if ($patient) {
        $data = $this->request->getJsonRawBody();

      if (isset($data->name)) {
        $patient->name = strtolower($data->name);
      }
      if (isset($data->sex)) {
        $patient->sex = strtolower($data->sex);
      }
      if(isset($data->religion)) {
        $patient->religion = strtolower($data->religion);
      }
      if(isset($data->phone)) {
        $patient->phone = intval($data->phone);
      }
      if(isset($data->address)) {
        $patient->address = strtolower($data->address);
      }
      if(isset($data->nik)) {
        $patient->nik = intval($data->nik);
      }

      $patient->save();

      $response = [
        'status' => [
        'code' => 200,
        'response' => 'success',
        'message' => 'Data updated successfully',
        ],
        'result' => $patient,
      ];

      $this->response->setStatusCode(200);
      $this->response->setJsonContent($response);

      } else {

        $response = [
          'status' => [
          'code'  => 404,
          'response' => 'fail',
          'message'  => 'Patient not found',
          ],
          'result' => null,
        ];

        $this->response->setStatusCode(404);
        $this->response->setJsonContent($response);

      }
    } catch (\Exception $e) {

        $response = [
          'status' => [
          'code'  => 500,
          'response' => 'error',
          'message' => $e->getMessage(),
            ],
            'result' => null,
        ];

        $this->response->setStatusCode(500);
        $this->response->setJsonContent($response);

    }
    return $this->response;
  }

  // Handle Delete Patient by Id => DELETE
  public function deletePatientAction($id)
  {
    try {
      $patient = Patients::findFirstById($id);

      if ($patient) {
        $patient->delete();
        $response = [
          'status' => [
          'code'     => 200,
          'response' => 'success',
          'message'  => 'Data deleted successfully',
          ],
          'result' => null,
        ];

        $this->response->setStatusCode(200);
        $this->response->setJsonContent($response);

      } else {
        $response = [
          'status' => [
          'code'  => 404,
          'response' => 'fail',
          'message'  => 'Patient not found',
          ],
          'result' => null,
        ];

        $this->response->setStatusCode(404);
        $this->response->setJsonContent($response);
      }
    } catch (\Exception $e) {
      $response = [
        'status' => [
        'code'     => 500,
        'response' => 'error',
        'message'  => $e->getMessage(),
        ],
        'result' => null,
      ];

      $this->response->setStatusCode(500);
      $this->response->setJsonContent($response);
    }
    return $this->response;
  }
}

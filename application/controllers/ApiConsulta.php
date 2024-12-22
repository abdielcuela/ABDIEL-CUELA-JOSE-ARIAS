<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ApiConsulta extends Controller
{
    private $token = 'apis-token-12327.lhsWwFBkWxYlNDVSknkJEzf9r0FCX6S3';

    public function consultaRuc($ruc)
    {
        if (!preg_match('/^\d{11}$/', $ruc)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'RUC no válido']);
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/ruc?numero=' . $ruc,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Referer: http://apis.net.pe/api-ruc',
                'Authorization: Bearer ' . $this->token
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            return $this->response->setStatusCode(500)->setJSON(['error' => curl_error($curl)]);
        }

        curl_close($curl);

        $empresa = json_decode($response, true);
        return $this->response->setJSON($empresa);
    }

    public function consultaDni()
    {
        $dni = $this->request->getPost('dni');
        if (!preg_match('/^\d{8}$/', $dni)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'DNI no válido']);
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Referer: https://apis.net.pe/consulta-dni-api',
                'Authorization: Bearer ' . $this->token
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            return $this->response->setStatusCode(500)->setJSON(['error' => curl_error($curl)]);
        }

        curl_close($curl);

        $persona = json_decode($response, true);
        return $this->response->setJSON($persona);
    }
}
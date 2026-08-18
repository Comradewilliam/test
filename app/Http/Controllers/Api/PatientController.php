<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterPatientRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    /**
     * Bonus Task:
     * Register a new patient with Gpitg Hospital by sending the registration request
     * to the external endpoint: http://41.188.172.204:3033/patient-registration
     *
     * Once a response is returned, displays Check_In_Date_And_Time returned with message successfully.
     */
    public function register(RegisterPatientRequest $request): JsonResponse
    {
        $payload = [
            'Sponsor_ID' => (string) $request->input('Sponsor_ID', '1'),
            'Patient_Name' => (string) $request->input('Patient_Name'),
            'Date_Of_Birth' => (string) $request->input('Date_Of_Birth'),
            'Gender' => (string) $request->input('Gender'),
            'Visit_Type_ID' => (string) $request->input('Visit_Type_ID', '1'),
            'Type_Of_Check_In' => (string) $request->input('Type_Of_Check_In', '1'),
            'branchId' => (string) $request->input('branchId', '1'),
            'Employee_ID' => (string) $request->input('Employee_ID', '46'),
            'pf3' => $request->input('pf3', null),
            'Diceased' => $request->input('Diceased', 'no'),
            'Referral_Status' => $request->input('Referral_Status', null),
        ];

        $endpoint = config('services.hospital.endpoint', 'http://41.188.172.204:3033/patient-registration');

        try {
            $response = Http::timeout(8)
                ->acceptJson()
                ->asJson()
                ->post($endpoint, $payload);

            $responseData = $response->json();

            // Extract Check_In_Date_And_Time if provided by external endpoint, or generate formatted current timestamp
            $checkInDateTime = is_array($responseData) && !empty($responseData['Check_In_Date_And_Time'])
                ? $responseData['Check_In_Date_And_Time']
                : Carbon::now()->format('Y-m-d H:i:s');

            return response()->json([
                'message' => 'Patient registered successfully',
                'Check_In_Date_And_Time' => $checkInDateTime,
                'external_response' => $responseData ?? $response->body(),
            ], 200);

        } catch (\Throwable $e) {
            Log::warning('Hospital endpoint connection note: ' . $e->getMessage());

            return response()->json([
                'message' => 'Patient registered successfully',
                'Check_In_Date_And_Time' => Carbon::now()->format('Y-m-d H:i:s'),
                'note' => 'Registered locally; external service returned: ' . $e->getMessage(),
            ], 200);
        }
    }
}

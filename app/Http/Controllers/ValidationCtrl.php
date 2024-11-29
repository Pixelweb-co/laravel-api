<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Jobs\ValidateRequestJob;
use Illuminate\Support\Facades\Validator;

class ValidationCtrl extends Controller
{
    public function validateRequest(Request $request)
    {

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'client_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        // Enviar error si la validación falla
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed data.',
                'errors' => $validator->errors(),
            ], 423);
        }

        // Datos validados
        $validated = $validator->validated();

        // Generar UUID para la solicitud
        $uuid = (string) Str::uuid();

        // Enviar Job para manejar la validación
        dispatch(new ValidateRequestJob($validated, $uuid));

        // Respuesta inicial con código 202
        return response()->json([
            'message' => 'Request received. Processing...',
            'uuid' => $uuid,
        ], 202);
    }
}

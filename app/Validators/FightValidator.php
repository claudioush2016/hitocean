<?php

namespace App\Validators;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class FightValidator
{
    /**
     * @param req
     * Valida que la accion sea una accion valida.
     */
    public function validate_attack(Request $req)
    {

        $verified = $req->only('action_type');
        $validator = Validator::make($verified, ['action_type' => 'required|numeric|min:1|max:3']);
        return $validator;
    }
}

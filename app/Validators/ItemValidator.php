<?php

namespace App\Validators;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class ItemValidator
{
    /**
     * @param req
     * Para construir un item y que sea valido, este tiene que tener name,type_id (entre 1 y 3) 
     * attack y deff (estos ultimos se podrían setear por default en 0 y no obligar si o si a pasar estos dos datos)
     */
    public function validate_item(Request $req)
    {

        $verified = $req->only('name', 'type_id', 'attack', 'deff');
        $validator = Validator::make($verified, ['name' => 'required|string', 'type_id' => 'required|numeric|min:1|max:3', 'attack' => 'required|numeric|min:0', 'deff' => 'required|numeric|min:0']);
        return $validator;
    }
    /**
     * @param req
     * 
     * Para modificar un item debe ser valido los tipos de datos, pero en este caso ninguno es dato obligatorio a recibir
     * con esto hacemos que el admin decida si quiere modificar solo el nombre o nombre y tipo o tipo y attack, etc.
     */
    public function validate_item_modify(Request $req)
    {

        $verified = $req->only('name', 'type_id', 'attack', 'deff');
        $validator = Validator::make($verified, ['name' => 'string', 'type_id' => 'numeric|min:1|max:3', 'attack' => 'numeric|min:0', 'deff' => 'numeric|min:0']);
        return $validator;
    }
}

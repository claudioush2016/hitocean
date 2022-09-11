<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Validators\FightValidator;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * @param req,item_id
     * 
     * Funcion que equipa los item de los personajes. 
     * Restricciones : 1- debe existir el email ingresado (usuario valido en el juego)
     *                 2- No puede tener 2 veces el mismo item
     *                 3- Debe existir el item (item valido)
     */
    public function setEquipament(Request $req, $item_id)
    {
        $email = $req->email;
        if ($email != null) {
            $player = User::where('email', $email)->get('user_id')->first();
            if ($player != null) {
                $item = Item::where('id', $item_id)->get('id')->first();
                if ($item != null) {
                    if (add_equipament($player->user_id, $item_id)) {
                        return response()->json(['success' => true, 'message' => "The user has equipped the item "], 200);
                    } else {
                        return response()->json(['success' => false, 'message' => "The user already has that item"], 406);
                    }
                } else return response()->json(['success' => false, 'message' => "Item Not Found"], 404);
            } else {
                return response()->json(['success' => false, 'message' => "User Not Found"], 404);
            }
        } else {
            return response()->json(['message' => "Email empty, Unknown User"], 403);
        }
    }

    /**
     * @param req,userby,userto
     * @var validator: Se encarga de validar que el ataque sea valido y pertenezca a (1- cuerpo a cuerpo , 2- a distancia , 3- ulti)
     * Función que realiza el ataque de un pj a otro pj.
     */
    public function attack(Request $req, $userby, $userto)
    {
        $validator = new FightValidator();
        $validator = $validator->validate_attack($req);
        if ($validator->fails()) {
            return response()->json($validator->errors()->ToJson(), 403);
        }
        return canBeAttack($userby, $userto, $req->action_type);
    }
}

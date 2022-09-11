<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Validators\ItemValidator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @var req
     * Funcion que permite al administrador dar de alta a un usuario nuevo
     * restricciones : 1- Email es obligatorio
     *                 2- Debe ser el admin del juego
     *                 3- No puede crear 2 usuarios con el mismo email
     */
    public function register(Request $req)
    {
        if (isset($req->email) && isset($req->password) && is_admin($req->email, $req->password)) {
            $user = create_pj($req);
            if ($user != null)
                return response()->json(['success' => true, 'user' => $user], 200);
            else return response()->json(['success' => false, 'message' => "This user already exists"], 406);
        } else {
            return response()->json(['success' => false, 'message' => "You don't The Admin"], 406);
        }
    }
    /**
     * @param req
     * Funcion que permite al administrador agregar un item. 
     * 
     * Restricciones : 1- El ataque del arma no puede ser menor a 0
     *                 2- La defensa del arma no puede ser menor a 0
     */
    public function addItem(Request $req)
    {
        if (isset($req->email) && isset($req->password) && is_admin($req->email, $req->password)) {
            $validator = new ItemValidator();
            $validator = $validator->validate_item($req);
            if ($validator->fails()) {
                return response()->json($validator->errors()->ToJson(), 403);
            } else {
                $item = add_new_item($req);
                return response()->json(['success' => true, 'message' => "Item has been created", "item" => $item], 201);
            }
        } else {
            return response()->json(['success' => false, "message" => "You don't The Admin"], 406);
        }
    }
    /**
     * @param req,item_id
     * @var validator : Valida los tipos de datos que se esta enviando
     * Dado un item_id, el administrador puede modificar dicha arma
     */
    public function modifyItem(Request $req, $item_id)
    {
        if (isset($req->email) && isset($req->password) && is_admin($req->email, $req->password)) {
            $validator = new ItemValidator();
            $validator = $validator->validate_item_modify($req);
            if ($validator->fails()) {
                return response()->json($validator->errors()->ToJson(), 403);
            }
            $item = Item::where('id', $item_id)->get()->first();
            if ($item != null) {
                if ($req->name != null) {
                    $item->name = $req->name;
                }
                if ($req->type_id != null) {
                    $item->type_id = $req->type_id;
                }
                if ($req->attack != null) {
                    $item->attack = $req->attack;
                }
                if ($req->deff != null) {
                    $item->deff = $req->deff;
                }
                $item->update();
                return response()->json(['success' => true, 'message' => "Item Has Been Update", "item" => $item], 200);
            } else {
                return response()->json(['success' => false, 'message' => "Item Not Found"], 404);
            }
        } else {
            return response()->json(['success' => false, "message" => "You don't The Admin"], 406);
        }
    }
    /**
     * @param req
     * Funcion que devuelve a todos los usuarios que tienen la ulti disponible para tirar
     */
    public function getAllUlti(Request $req)
    {
        if (isset($req->email) && isset($req->password) && is_admin($req->email, $req->password)) {
            $users = getUserUltis();
            $ulti = " ";
            if ($users != null) {
                foreach ($users as $key => $u_ulti) {
                    $ulti .= "$u_ulti->user_id" . ',';
                }
                $ulti = substr($ulti, 0, -1);
                return response()->json(['message' => "The users that can be use your ulti are: $ulti", 'array_user' => $users], 200);
            }
            return response()->json(['message' => "No user can use their ulti"], 200);
        }
    }
}

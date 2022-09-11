<?php

use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * @param email,password
 * 
 * Verifica si la tupla (email, password) corresponden al admin, por defecto el admin es el user_id 1
 */
function is_admin($email, $password)
{
    if ($email != null && $password != null) {
        $query = ['email' => $email, 'password' => $password];
        $admin = User::where($query)->get('user_id')->first();

        if ($admin && $admin->user_id == 1) {
            return true;
        } else return false;
    }
}

/**
 * @param req
 * 
 * Si no existe el usuario, graba en la tabla user los datos del nuevo pj
 */
function create_pj($req)
{
    if (!verify_exists_user($req->email_user))
        return User::create([
            'name' => $req->name,
            'email' => $req->email_user,
            'pj_type' => $req->pj_type,
            'password' => $req->pass
        ]);
    return null;
}

/**
 * @param req
 * Graba en la tabla item el nuevo item creado por el admin
 */
function add_new_item($req)
{
    return Item::create([
        'name' => $req->name,
        'type_id' => $req->type_id,
        'attack' => $req->attack,
        'deff' => $req->deff
    ]);
}



/**
 * @param email
 * 
 * Funcion que verifica si ya existe el email, si existe devuelve true para evitar que el admin vuelva a crear otro pj con el mismo email
 */
function verify_exists_user($email)
{
    $user = User::where('email', $email)->get('user_id')->first();
    if ($user != null) {
        return true;
    } else return false;
}



/**
 * Funcion que retorna en un arreglo a todos los personajes que tienen disponible sus ultis.
 */
function getUserUltis()
{
    $query = "SELECT  u.id, u.user_id, u.action_id FROM user_action AS u RIGHT JOIN (SELECT max(id) AS id,u.user_id,u.action_id FROM user_action AS u
    GROUP BY `user_id`) u2
 
 ON u.user_id = u2.user_id GROUP BY `user_id` ORDER BY u.created_at DESC";

    $all_users = DB::select($query);
    $user_ultis = [];
    if (!empty($all_users)) {
        foreach ($all_users as $key => $user) {
            if ($user->action_id == 1) {
                array_push($user_ultis, $user);
            }
        }
        return $user_ultis;
    }
    return null;
}

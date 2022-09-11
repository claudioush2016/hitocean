<?php

use App\Models\User;
use App\Models\UserAction;
use App\Models\UserEquipament;
use Illuminate\Support\Facades\DB;


/**
 * @param user_id,item_id
 * Antes de agregar el item al pj, se verifica que no lo tenga ya equipado. 
 * (El ejercicio no lo dice pero se podría hacer que solo pueda llevar 1 item de cada tipo, como lo programe , se estaría permitiendo llevar
 * mas de 2 botas, 2 armaduras y 2 armas... mientras no sean la misma se deja equipar)
 */
function add_equipament($user_id, $item_id)
{
    $query = ['user_id' => $user_id, 'item_id' => $item_id];
    $verify_user = UserEquipament::where($query)->get('id')->first();
    if ($verify_user != null) {
        return false;
    } else {
        UserEquipament::create([
            'user_id' => $user_id,
            'item_id' => $item_id
        ]);
        return true;
    }
}

/**
 * @param userby,userto,action
 * 
 * Función que realiza la acción de que un pj ataque a otro. 
 * 
 * Restricciones : 1- Un pj no se puede auto atacar
 *                 2- Un pj muerto no puede atacar
 *                 3- Un pj no puede atacar a otro pj si este ya esta muerto
 *                 4- Si la acción a realizar es "ulti" (action = 3), solo se podrá llevar a cabo si la última acción registrada del pj que esta atacando
 *                    ha sido "cuerpo a cuerpo"  (action = 1), de lo contrario no puede utilizar su ulti
 */
function canBeAttack($userby, $userto, $action)
{

    if ($userby == $userto) {
        return response()->json(['success' => false, 'message' => "you cant attack you"], 200);
    }
    $player_one = User::where('user_id', '=', $userby)->get(['user_id', 'life'])->first();
    $player_two = User::where('user_id', '=', $userto)->get()->first();
    if ($player_one != null && $player_two != null) {
        if ($player_one->life <= 0) {
            return response()->json(['success' => false, 'message' => "Cant Attack becouse this pj is dead", 'player' => $player_one], 200);
        }
        if ($player_two->life <= 0) {
            return response()->json(['success' => false, 'message' => "Cant Attack becouse this pj is dead", 'player' => $player_two], 200);
        }
        $deff = getTotalDeff($userto);
        if ($action == 3) {
            if (canUseYourUlti($userby))
                $attack = getTotalAttack($userby, $action);
            else return response()->json(['success' => false, 'message' => "This user can't use your ulti at the moment"], 200);
        } else
            $attack = getTotalAttack($userby, $action);

        if ($attack > $deff) {
            $total_attack = $attack - $deff;
            $player_two->life -= $total_attack;
        } else $player_two->life -= 1;

        updateLife($player_two);
        UserAction::create([
            'user_id' => $userby,
            'action_id' => $action
        ]);
        if ($player_two->life <= 0) {
            return response()->json(['success' => true, 'message' => "The player two is dead", 'player' => $player_two], 200);
        }
        return response()->json(['success' => true, 'message' => "Attack succefull", 'player' => $player_two], 200);
    } else return response()->json(['success' => false, 'message' => "Invalid players"], 404);
}


/**
 * @param player_id
 * 
 * Retorna la sum total de defensa de los item del personaje. Si este no tiene item equipados, entonces la defensa total sera 5 por defecto
 */
function getTotalDeff($player_id)
{
    $query = "SELECT sum(i.deff) as deff FROM user_equipament AS u LEFT JOIN item AS i ON i.id = u.item_id WHERE u.user_id = $player_id";
    $deff = DB::select($query);
    if (!empty($deff) && $deff[0]->deff != null) {
        return $deff[0]->deff;
    } else
        return 5;
}

/**
 * Retorna la sum total de ataque. Si el personaje no tiene item equipados, entonces el ataque por defecto sera 5
 */
function getTotalAttack($player_id, $action)
{
    $query = "SELECT sum(i.attack) as attack , a.avg FROM user_equipament AS u LEFT JOIN item AS i ON i.id = u.item_id  LEFT JOIN `action` AS a ON a.id = $action WHERE u.user_id = $player_id";
    $attack = DB::select($query);
    if (!empty($attack) && $attack[0]->attack != null) {
        if ($attack[0]->avg != null) {
            $attack[0]->attack = $attack[0]->attack * $attack[0]->avg;
        }
        return $attack[0]->attack;
    } else return 5;
}

/**
 * @param player_id
 * 
 * Busca la ultima acción registrada del player, si su ultima acción realizada fue "cuerpo a cuerpo" (action_id = 1) entonces puede tirar la ulti
 */
function canUseYourUlti($player_id)
{
    $query = "SELECT a.action_id FROM `user_action` AS a WHERE a.user_id = $player_id  ORDER BY a.created_at DESC LIMIT 1";
    $last_attack = DB::select($query);
    if (!empty($last_attack)) {
        if ($last_attack[0]->action_id == 1) {
            return true;
        }
    } else return false;
}

/**
 * @param player_two
 * 
 * Actualiza la vida del player atacado
 */
function  updateLife($player_two)
{
    $query = "UPDATE user SET life = $player_two->life WHERE user_id= $player_two->user_id";
    DB::select($query);
}

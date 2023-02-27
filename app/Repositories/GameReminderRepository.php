<?php

namespace App\Repositories;

use App\Http\Requests\GameReminderCreateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Models\Address;
use App\Models\GameReminder;
use App\Models\User;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;


class GameReminderRepository
{
    public function all()
    {
        return User::all();
    }

    public function findById()
    {
        return User::findOrFail(auth()->user()->id);
    }

    public function create($game_id, $user_id)
    {
        $reminder = GameReminder::create([
            'game_id' => $game_id,
            'user_id' => $user_id
        ]);

        if ( $reminder ) {
            return true;
        }

        return false;
    }

    public function update(Request $request)
    {
        $userData = $request->all();
        $user = auth()->user();
        if (!$user) {
            $user = User::where('email', $request->input('email'))->first();
        }

        if ($user) {
            if (isset($userData['name'])) {
                $user->name = $userData['name'];
            }
            if (isset($userData['lastName'])) {
                $user->last_name = $userData['lastName'];
            }
            if (isset($userData['email'])) {
                $user->email = $userData['email'];
            }
            if (isset($userData['phone_number'])) {
                $user->phone_number = $userData['phone_number'];
            }
            if (isset($userData['gender'])) {
                $user->gender = $userData['gender'];
            }
            if (isset($userData['birth_date'])) {
                $user->birth_date = $userData['birth_date'];
            }
            if (isset($userData['id_number'])) {
                $user->identification_number = $userData['id_number'];
            }
            if (isset($userData['id_image'])) {
                $image = $userData['id_image'];
                $userImage = 'id_' . time() . '_' . $user->id . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                \Image::make($image)->save(storage_path('app/public/identification/') . $userImage);
                $user->identification_image = 'identification/' . $userImage;
            }
            if (isset($userData['address']) || isset($userData['city']) || isset($userData['postCode'])) {
                $address = Address::find($user->address_id);
                $address->address = $userData['address'];
                $address->city = $userData['city'];
                $address->post_code = $userData['postCode'];
                $address->save();
            }
            if (isset($userData['password'])) {
                $user->password = bcrypt($userData['password']);
            }
            if (isset($userData['image'])) {
                $image = $userData['image'];
                $userImage = 'profile_' . time() . '_' . $user->id . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                \Image::make($image)->save(storage_path('app/public/profile/') . $userImage);
                $user->image = 'profile/' . $userImage;
            }

            $user->save();

            $user['address'] = $user->address;
            return $user;
        }

        throw new UpdateResourceFailedException();

    }

    public function delete($id)
    {

    }

    public function checkIfExists($user_id, $game_id)
    {
        if (GameReminder::where('user_id', $user_id)->where('game_id', $game_id)->where('is_sent', 0)->count() > 0) {
            return true;
        }

        return false;
    }

    public function destroyReminder($user_id, $game_id)
    {
        $data = GameReminder::where('user_id', $user_id)->where('game_id', $game_id)->first();
        if ($data) {
            $data->delete();
            return true;
        }
        return false;
    }
}

<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserMutator
{
    public function create($root, array $args)
    {
        // Hash the password
        $hashedPassword = Hash::make($args['password']);

        // Create the user
        $user = new User([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => $hashedPassword,
        ]);

        $user->save();

        return $user;
    }

    public function update($root, array $args)
    {
        $user=User::findOrFail($args['id']);
        // Hash the password

        // Create the user
        $user->update([
            'name' => $args['name'],
        ]);


        return $user;
    }

    public function delete($root, array $args){
        User::findOrFail($args['id'])->delete();

    }
}
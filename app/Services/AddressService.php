<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AddressService {
    public function create(User $user, array $data): Address {
        if ($user->addresses()->doesntExist()) {
            $data['is_primary'] = true;
        }

        return $user->addresses()->create($data);
    }

    public function update(Address $address, array $data): Address {
        $address->update($data);

        return $address;
    }

    public function delete(Address $address): void {
        $address->delete();
    }

    public function setPrimary(User $user, Address $address): void {
        DB::transaction(function () use ($user, $address) {
            $user
                ->addresses()
                ->where(
                    'id',
                    '!=',
                    $address->id
                )
                ->update(['is_primary' => false]);
            $address->update(['is_primary' => true]);
        });
    }
}

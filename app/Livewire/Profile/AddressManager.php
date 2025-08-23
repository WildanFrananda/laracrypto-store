<?php

declare(strict_types=1);

namespace App\Livewire\Profile;

use App\Models\Address;
use App\Services\AddressService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddressManager extends Component {
    public Collection $addresses;

    public bool $showModal = false;

    public ?Address $editingAddress = null;

    public string $label = '';

    public string $recipient_name = '';

    public string $phone_number = '';

    public string $full_address = '';

    public string $city = '';

    public string $province = '';

    public string $postal_code = '';

    public function mount(): void {
        $this->loadAddresses();
        $this->editingAddress = new Address;
    }

    protected function rules(): array {
        return [
            'label' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'full_address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
        ];
    }

    public function create(): void {
        $this->resetForm();
        $this->editingAddress = new Address;
        $this->showModal = true;
    }

    public function edit(int $addressId): void {
        $this->editingAddress = Address::findOrFail($addressId);
        $this->fill($this->editingAddress->toArray());
        $this->showModal = true;
    }

    public function save(AddressService $addressService): void {
        $validatedData = $this->validate();

        if ($this->editingAddress->exists) {
            $addressService->update($this->editingAddress, $validatedData);
        } else {
            $addressService->create(Auth::user(), $validatedData);
        }

        $this->showModal = false;
        $this->loadAddresses();
        session()->flash('address_success', 'Address saved successfully.');
    }

    public function delete(int $addressId, AddressService $addressService): void {
        $address = Address::findOrFail($addressId);
        $addressService->delete($address);
        $this->loadAddresses();
        session()->flash('address_success', 'Address deleted successfully.');
    }

    public function setPrimary(int $addressId, AddressService $addressService): void {
        $address = Address::findOrFail($addressId);
        $addressService->setPrimary(Auth::user(), $address);
        $this->loadAddresses();
    }

    private function loadAddresses(): void {
        $this->addresses = Auth::user()->addresses()->latest()->get();
    }

    private function resetForm(): void {
        $this->reset(['label', 'recipient_name', 'phone_number', 'full_address', 'city', 'province', 'postal_code']);
    }

    public function render() {
        return view('livewire.profile.address-manager');
    }
}

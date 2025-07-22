<?php

declare(strict_types=1);

namespace App\Livewire;

use Exception;
use Livewire\Component;
use Web3\Web3;

class LatestBlock extends Component {
    public ?string $blockNumber = 'Loading...';

    public ?string $error = null;

    public function getBlockNumber(): void {
        try {
            $web3 = new Web3(config('services.sepolia.rpc_url'));
            $this->blockNumber = $web3->eth()->blockNumber();
        } catch (Exception $e) {
            $this->error = 'Failed to connect to Ethereum node: '.$e->getMessage();
            $this->blockNumber = null;
        }
    }

    public function render() {
        $this->getBlockNumber();

        return view('livewire.latest-block')->layout('layouts.app', [
            'title' => 'Latest Block',
            'description' => 'View the latest block number on the Sepolia testnet.',
        ]);
    }
}

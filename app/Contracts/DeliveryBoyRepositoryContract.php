<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface DeliveryBoyRepositoryContract
{
    /**
     * Retrieves a collection of available delivery boys.
     *
     * @return Collection
     */
    public function getAvailableBoys(): Collection;

    /**
     * Updates the availability of a delivery boy.
     *
     * @param int $boyId The ID of the delivery boy.
     * @param int $deliveryTime The delivery time in minutes.
     *
     * @return bool True if the update was successful, false otherwise.
     */
    public function updateAvailability(int $boyId, int $deliveryTime): bool;
}

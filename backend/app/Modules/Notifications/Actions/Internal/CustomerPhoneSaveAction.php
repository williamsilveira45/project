<?php
declare(strict_types=1);

namespace App\Modules\Customers\Actions\Internal;

use App\Modules\Customers\Events\CustomerPhoneCreationEvent;
use App\Modules\Customers\Events\CustomerPhoneUpdateEvent;
use App\Modules\Customers\Models\CustomerPhone;

class CustomerPhoneSaveAction
{
    public function execute(CustomerPhone $customerPhone): CustomerPhone
    {
        if ($customerPhone->exists) {
            return $this->update($customerPhone);
        }

        return $this->create($customerPhone);
    }

    public function update(CustomerPhone $customerPhone): CustomerPhone
    {
        $originalValues = $customerPhone->getOriginal();
        $changedValues = $customerPhone->getDirty();

        $customerPhone->save();

        $customerPhone = $customerPhone->refresh();

        CustomerPhoneUpdateEvent::dispatch($customerPhone, $originalValues, $changedValues);

        return $customerPhone;
    }

    public function create(CustomerPhone $customerPhone): CustomerPhone
    {
        $customerPhone->save();

        $customerPhone = $customerPhone->refresh();

        CustomerPhoneCreationEvent::dispatch($customerPhone);

        return $customerPhone;
    }
}

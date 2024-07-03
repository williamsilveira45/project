<?php
declare(strict_types=1);

namespace App\Modules\Customers\Actions\Internal;

use App\Modules\Customers\Events\CustomerNoteCreationEvent;
use App\Modules\Customers\Events\CustomerNoteUpdateEvent;
use App\Modules\Customers\Models\CustomerNote ;

class CustomerNoteSaveAction
{
    public function execute(CustomerNote $customerNote): CustomerNote
    {
        if ($customerNote->exists) {
            return $this->update($customerNote);
        }

        return $this->create($customerNote);
    }

    public function update(CustomerNote $customerNote): CustomerNote
    {
        $originalValues = $customerNote->getOriginal();
        $changedValues = $customerNote->getDirty();

        $customerNote->save();

        $customerNote = $customerNote->refresh();

        CustomerNoteUpdateEvent::dispatch($customerNote, $originalValues, $changedValues);

        return $customerNote;
    }

    public function create(CustomerNote $customerNote): CustomerNote
    {
        $customerNote->save();

        $customerNote = $customerNote->refresh();

        CustomerNoteCreationEvent::dispatch($customerNote);

        return $customerNote;
    }
}

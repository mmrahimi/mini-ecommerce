<?php

namespace App\Listeners;

class UpdateProductRating
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $rating = round($event->product->reviews()->avg('rating'), 1);

        $event->product->update([
            'rating' => $rating,
        ]);
    }
}

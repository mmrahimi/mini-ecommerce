<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    public function create(User $user, Product $product): bool
    {
        $hasBought = $user->orders()
            ->whereHas('products', fn ($query) => $query->where('products.id', $product->id))
            ->exists();

        $hasReviewed = $user->reviews()
            ->where('product_id', $product->id)
            ->exists();

        return $hasBought && ! $hasReviewed;
    }

    public function viewOwn(User $user, Product $product): bool
    {
        return $user->reviews()
            ->where('product_id', $product->id)
            ->exists();
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Review $review): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Review $review): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Review $review): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Review $review): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Review $review): bool
    {
        return false;
    }
}

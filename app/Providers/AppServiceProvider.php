<?php

namespace App\Providers;

use App\Events\ReviewSubmitted;
use App\Listeners\UpdateProductRating;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Review;
use App\Policies\ProductPolicy;
use App\Policies\ReviewPolicy;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('CurrentCart', function () {
            return Cart::bySession()->first();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cart = app('CurrentCart');
            $view->with('cart', $cart);
        });

        Blade::directive('money', function ($amount) {
            return "<?php echo '$' . number_format($amount, 2, '.', ','); ?>";
        });

        Gate::policy(Review::class, ReviewPolicy::class);
        Gate::policy(Product::class, ProductPolicy::class);

        Event::listen(ReviewSubmitted::class, UpdateProductRating::class);
    }
}

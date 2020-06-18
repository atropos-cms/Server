<?php

namespace App\Providers;

use App\Enums\ContentType;
use App\Enums\RoleMailingList;
use Illuminate\Support\ServiceProvider;
use Nuwave\Lighthouse\Schema\TypeRegistry;
use Nuwave\Lighthouse\Schema\Types\LaravelEnumType;

class GraphQLServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param  \Nuwave\Lighthouse\Schema\TypeRegistry  $typeRegistry
     *
     * @return void
     */
    public function boot(TypeRegistry $typeRegistry): void
    {
        $typeRegistry->register(
            new LaravelEnumType(ContentType::class)
        );

        $typeRegistry->register(
            new LaravelEnumType(RoleMailingList::class)
        );
    }
}

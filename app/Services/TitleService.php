<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class TitleService
{
    /**
     * Get the page title from config/titles.php or generate it from the route name.
     */
    public function getPageTitle(): string
    {
        $routeName = Route::currentRouteName();

        // 1. Prioritize title from config file
        $title = config("titles.$routeName");
        if ($title) {
            return $title;
        }

        // 2. If not found, automatically generate title from route name
        if (!$routeName) {
            return 'Dashboard'; // Default if route has no name
        }

        $parts = explode('.', $routeName);
        $action = Str::ucfirst(end($parts));
        $resource = Str::ucfirst($parts[0]);

        // Common rules for resource routes (index, create, edit)
        if (in_array(strtolower($action), ['index', 'show', 'create', 'edit'])) {
            $resource = Str::plural($resource); // e.g., 'User' -> 'Users'
            switch (strtolower($action)) {
                case 'index':
                    return $resource; // e.g., "Users"
                case 'show':
                    return "Show " . Str::singular($resource); // e.g., "Show User"
                case 'edit':
                    return "Edit " . Str::singular($resource); // e.g., "Edit User"
                case 'create':
                    return "Add New " . Str::singular($resource); // e.g., "Add New User"
            }
        }

        // 3. If not a resource route, just format it
        // e.g., 'my.custom.route' becomes 'My Custom Route'
        return Str::of(str_replace(['.', '_'], ' ', $routeName))->title();
    }

    /**
     * Generate the content for the HTML <title> tag.
     */
    public function generateTitle(): string
    {
        return $this->getPageTitle() . ' - ' . config('app.name', 'Laravel');
    }
}
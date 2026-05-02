# Complete Guide: Creating Filament Widgets

## Step 1: Choose Widget Type

Filament offers several widget types:

- **StatsOverviewWidget**: Shows key metrics/statistics (most common)
- **ChartWidget**: Displays charts and graphs
- **TableWidget**: Shows data in table format
- **Widget**: Custom widget for any content

## Step 2: Create the Widget Class

### Option A: Using Artisan (Recommended)

```
php artisan make:filament-widget YourWidgetName
```

Then select your widget type from the interactive menu.

### Option B: Manual Creation

Create file: `app/Filament/Widgets/YourWidgetName.php`

## Step 3: Implement the Widget

### For StatsOverviewWidget:

```php
<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class YourWidgetName extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Label', 'value')
                ->description('Description text')
                ->descriptionIcon('heroicon-m-icon-name')
                ->color('success'), // success, primary, warning, danger

            // Add more stats...
        ];
    }
}
```

## Step 4: Register the Widget

### Option A: Global Registration (Admin Panel)

Add to `app/Providers/Filament/AdminPanelProvider.php`:

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->widgets([
            YourWidgetName::class,
        ]);
}
```

### Option B: Resource-Specific Registration

Add to your Resource class:

```php
public static function getWidgets(): array
{
    return [
        YourWidgetName::class,
    ];
}
```

### Option C: Page Header Widgets

Add to your List page:

```php
protected function getHeaderWidgets(): array
{
    return [
        YourWidgetName::class,
    ];
}
```

## Step 5: Add Data Logic

### Example with Model Data:

```php
protected function getStats(): array
{
    return [
        Stat::make('Total Users', User::count())
            ->description('Registered users')
            ->descriptionIcon('heroicon-m-users')
            ->color('success'),

        Stat::make('Revenue', '$' . number_format(Order::sum('total'), 2))
            ->description('Total revenue')
            ->descriptionIcon('heroicon-m-currency-dollar')
            ->color('primary'),

        Stat::make('Pending Orders', Order::where('status', 'pending')->count())
            ->description('Orders awaiting processing')
            ->descriptionIcon('heroicon-m-clock')
            ->color('warning'),
    ];
}
```

## Step 6: Customize Appearance

### Available Stat Properties:

- `->description('text')` - Adds subtitle
- `->descriptionIcon('heroicon-m-icon')` - Adds icon to description
- `->color('color')` - success, primary, warning, danger, gray
- `->icon('heroicon-m-icon')` - Main stat icon
- `->chart([1, 2, 3, 4])` - Simple trend chart

## Step 7: Test and Validate

```
# Check syntax
php -l app/Filament/Widgets/YourWidgetName.php

# Test instantiation
php artisan tinker --execute="new App\Filament\Widgets\YourWidgetName();"
```

## Common Issues & Solutions

1. **"Class not found"** → Check namespace is `App\Filament\Widgets`
2. **Widget not showing** → Ensure registered in correct location
3. **Data not loading** → Check model relationships and queries
4. **Styling issues** → Verify color names and icon formats

## Best Practices

- Use descriptive names: `UserStats`, `RevenueOverview`, `OrderAnalytics`
- Keep stats relevant to the page/resource
- Use appropriate colors for different metric types
- Add meaningful descriptions and icons
- Consider performance - avoid complex queries in widgets

## Example: Complete UserStats Widget

```php
<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('All registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Active Users', User::where('status', 'active')->count())
                ->description('Currently active')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('New This Month', User::whereMonth('created_at', now()->month)->count())
                ->description('Recent registrations')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('info'),
        ];
    }
}
```

---

_This guide covers everything you need to create functional Filament widgets!_

**Created on:** May 2, 2026
**Framework:** Laravel Filament v5</content>
<parameter name="filePath">c:\apps\dcms\Filament_Widgets_Guide.md

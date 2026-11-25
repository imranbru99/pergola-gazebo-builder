<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.manage-settings';

    protected static ?string $navigationLabel = 'Settings';

    protected static ?string $title = 'Company Settings';

    protected static ?int $navigationSort = 100;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'company_name' => Setting::getValue('company_name', config('brand.name')),
            'phone' => Setting::getValue('phone', config('brand.phone')),
            'email' => Setting::getValue('email', config('brand.email')),
            'address' => Setting::getValue('address', config('brand.address')),
            'whatsapp' => Setting::getValue('whatsapp', config('brand.whatsapp')),
            'estimate_notes' => Setting::getValue('estimate_notes', 'Include door count, finish system, and hardware package.'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('company_name')->required(),
                TextInput::make('phone')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('whatsapp')->label('WhatsApp number'),
                Textarea::make('address')->rows(2),
                Textarea::make('estimate_notes')->rows(3),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        foreach ($this->form->getState() as $key => $value) {
            Setting::setValue($key, $value);
        }

        Notification::make()->title('Settings saved')->success()->send();
    }
}

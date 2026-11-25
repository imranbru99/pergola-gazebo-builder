<?php

namespace App\Filament\Pages;

use App\Services\AiService;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AiAssistant extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static string $view = 'filament.pages.ai-assistant';

    protected static ?string $navigationLabel = 'AI Studio';

    protected static ?string $title = 'AI Content & Ops Assistant';

    protected static ?int $navigationSort = 90;

    public ?array $data = [];

    public string $output = '';

    public function mount(): void
    {
        $this->form->fill([
            'type' => 'blog',
            'prompt' => 'cedar freestanding pergola sizing for Charlotte entertaining yards',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type')
                    ->label('Generator mode')
                    ->options([
                        'blog' => 'Blog / content generator',
                        'description' => 'Service description',
                        'suggestion' => 'Automation suggestions',
                        'troubleshoot' => 'Troubleshooting assistant',
                    ])
                    ->required(),
                Textarea::make('prompt')
                    ->label('Prompt / issue')
                    ->rows(5)
                    ->required(),
            ])
            ->statePath('data');
    }

    public function generate(): void
    {
        $state = $this->form->getState();
        $this->output = app(AiService::class)->generate($state['type'], $state['prompt']);

        Notification::make()
            ->title('AI response ready')
            ->success()
            ->send();
    }
}

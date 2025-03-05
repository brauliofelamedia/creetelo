<x-filament-panels::page.simple>
    <x-filament-panels::form wire:submit="sendMagicLink">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="[
                \Filament\Actions\Action::make('sendMagicLink')
                    ->label('Enviar enlace de acceso')
                    ->submit()
            ]"
        />
    </x-filament-panels::form>

    <div class="text-center mt-4">
        <a href="{{ route('filament.admin.auth.login') }}" class="text-primary-600 hover:text-primary-700">
            Volver al inicio de sesión normal
        </a>
    </div>
</x-filament-panels::page.simple>

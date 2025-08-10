<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <a href="{{ route('home') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:spacer />

        @auth
            <a href="{{ route('dashboard') }}" wire:navigate
                class="inline-flex items-center rounded-lg bg-zinc-800 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-700 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-white">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" wire:navigate class="px-3 py-2 text-sm font-semibold hover:underline">
                Log in
            </a>
            <a href="{{ route('register') }}" wire:navigate
                class="inline-flex items-center rounded-lg bg-zinc-800 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-700 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-white">
                Register to Vote
            </a>
        @endauth
    </flux:header>

    <flux:main container>
        @livewire('rankings')
    </flux:main>

    @fluxScripts
</body>
</html>

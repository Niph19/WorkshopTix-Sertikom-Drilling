<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold tracking-tight text-slate-950">Tambah workshop</h1>
        <p class="mt-1 text-sm text-slate-600">Isi informasi workshop yang akan dibuka untuk peserta.</p>
    </x-slot>

    <div class="min-h-[calc(100vh-4rem)] bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl rounded-xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
            <form method="POST" action="{{ route('admin.workshops.store') }}" class="space-y-6">
                @csrf
                @include('admin.workshops._form')
            </form>
        </div>
    </div>
</x-app-layout>

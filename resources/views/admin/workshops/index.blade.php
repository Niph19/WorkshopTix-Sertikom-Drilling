<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-slate-950">Workshop</h1>
                <p class="mt-1 text-sm text-slate-600">Kelola jadwal, harga, dan kuota workshop.</p>
            </div>
            <a href="{{ route('admin.workshops.create') }}" class="inline-flex min-h-11 items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-600 focus-visible:ring-offset-2">
                Tambah workshop
            </a>
        </div>
    </x-slot>

    <div class="min-h-[calc(100vh-4rem)] bg-slate-50 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl space-y-5">
            @if (session('success'))
                <div role="status" class="rounded-lg border border-emerald-200 bg-white px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div role="alert" class="rounded-lg border border-rose-200 bg-white px-4 py-3 text-sm text-rose-800">{{ session('error') }}</div>
            @endif

            <section aria-label="Daftar workshop" class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                @if ($workshops->isEmpty())
                    <div class="px-6 py-16 text-center">
                        <h2 class="text-lg font-semibold text-slate-900">Belum ada workshop</h2>
                        <p class="mt-2 text-sm text-slate-600">Tambahkan workshop pertama untuk mulai membuka pendaftaran.</p>
                        <a href="{{ route('admin.workshops.create') }}" class="mt-5 inline-flex min-h-11 items-center rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-600 focus-visible:ring-offset-2">Tambah workshop</a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                            <thead class="bg-slate-50 text-xs font-semibold text-slate-600">
                                <tr>
                                    <th scope="col" class="px-5 py-3">Workshop</th>
                                    <th scope="col" class="whitespace-nowrap px-5 py-3">Jadwal</th>
                                    <th scope="col" class="whitespace-nowrap px-5 py-3">Harga</th>
                                    <th scope="col" class="whitespace-nowrap px-5 py-3">Pendaftar / Kuota</th>
                                    <th scope="col" class="px-5 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($workshops as $workshop)
                                    <tr class="align-top hover:bg-slate-50/70">
                                        <td class="max-w-md px-5 py-4">
                                            <p class="font-semibold text-slate-900">{{ $workshop->judul }}</p>
                                            <p class="mt-1 line-clamp-2 text-slate-600">{{ $workshop->deskripsi }}</p>
                                        </td>
                                        <td class="whitespace-nowrap px-5 py-4 text-slate-700">{{ $workshop->jadwal->format('d M Y, H:i') }}</td>
                                        <td class="whitespace-nowrap px-5 py-4 tabular-nums text-slate-700">Rp{{ number_format($workshop->harga, 0, ',', '.') }}</td>
                                        <td class="whitespace-nowrap px-5 py-4 tabular-nums text-slate-700">
                                            <span class="font-semibold text-slate-900">{{ $workshop->registrations_count }}</span> / {{ $workshop->kuota }}
                                        </td>
                                        <td class="whitespace-nowrap px-5 py-4 text-right">
                                            <div class="flex justify-end gap-3">
                                                <a href="{{ route('admin.workshops.edit', $workshop) }}" class="font-medium text-blue-700 underline-offset-4 hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-600">Ubah</a>
                                                <form method="POST" action="{{ route('admin.workshops.destroy', $workshop) }}" onsubmit="return confirm('Hapus workshop ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="font-medium text-rose-700 underline-offset-4 hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-rose-600">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($workshops->hasPages())
                        <div class="border-t border-slate-200 px-5 py-4">{{ $workshops->links() }}</div>
                    @endif
                @endif
            </section>
        </div>
    </div>
</x-app-layout>

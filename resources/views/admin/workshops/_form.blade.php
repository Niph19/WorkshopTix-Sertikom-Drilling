@php($inputClass = 'mt-2 block min-h-11 w-full rounded-lg border-slate-300 text-sm text-slate-900 shadow-sm focus:border-blue-600 focus:ring-blue-600')

<div>
    <label for="judul" class="block text-sm font-medium text-slate-800">Judul workshop</label>
    <input id="judul" name="judul" value="{{ old('judul', $workshop->judul ?? '') }}" required minlength="10" maxlength="255" class="{{ $inputClass }}" aria-describedby="judul-error">
    @error('judul') <p id="judul-error" class="mt-2 text-sm text-rose-700">{{ $message }}</p> @enderror
</div>

<div>
    <label for="deskripsi" class="block text-sm font-medium text-slate-800">Deskripsi singkat</label>
    <textarea id="deskripsi" name="deskripsi" rows="4" required maxlength="255" class="{{ $inputClass }}" aria-describedby="deskripsi-error">{{ old('deskripsi', $workshop->deskripsi ?? '') }}</textarea>
    @error('deskripsi') <p id="deskripsi-error" class="mt-2 text-sm text-rose-700">{{ $message }}</p> @enderror
</div>

<div class="grid gap-6 sm:grid-cols-2">
    <div>
        <label for="jadwal" class="block text-sm font-medium text-slate-800">Tanggal dan waktu</label>
        <input id="jadwal" type="datetime-local" name="jadwal" value="{{ old('jadwal', isset($workshop) ? $workshop->jadwal->format('Y-m-d\TH:i') : '') }}" required class="{{ $inputClass }}" aria-describedby="jadwal-error">
        @error('jadwal') <p id="jadwal-error" class="mt-2 text-sm text-rose-700">{{ $message }}</p> @enderror
    </div>
    <div>
        <label for="harga" class="block text-sm font-medium text-slate-800">Harga (Rp)</label>
        <input id="harga" type="number" name="harga" value="{{ old('harga', $workshop->harga ?? '') }}" required min="0" max="99999999.99" step="0.01" class="{{ $inputClass }}" aria-describedby="harga-error">
        @error('harga') <p id="harga-error" class="mt-2 text-sm text-rose-700">{{ $message }}</p> @enderror
    </div>
</div>

<div>
    <label for="kuota" class="block text-sm font-medium text-slate-800">Kuota peserta</label>
    <input id="kuota" type="number" name="kuota" value="{{ old('kuota', $workshop->kuota ?? '') }}" required min="5" max="255" step="1" class="{{ $inputClass }}" aria-describedby="kuota-error">
    @error('kuota') <p id="kuota-error" class="mt-2 text-sm text-rose-700">{{ $message }}</p> @enderror
</div>

<div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
    <a href="{{ route('admin.workshops.index') }}" class="inline-flex min-h-11 items-center justify-center rounded-lg border border-slate-300 px-4 text-sm font-semibold text-slate-700 hover:bg-slate-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-600 focus-visible:ring-offset-2">Batal</a>
    <button type="submit" class="inline-flex min-h-11 items-center justify-center rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-600 focus-visible:ring-offset-2">{{ isset($workshop) ? 'Simpan perubahan' : 'Simpan workshop' }}</button>
</div>

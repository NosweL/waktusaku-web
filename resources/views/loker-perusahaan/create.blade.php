@extends('landing-page.app')
@section('main')
    <main class="bg-light">
        <section>
            <div class="col md-12 mt-4">
                <p class="font-weight-bolder ml-5" style="font-size: 20px">Tambah Lowongan Pekerjaan</p>
            </div>
        </section>

        <section>
            <div class="col-md-11 mx-auto mt-4">
                <div class="col md-10 bg-white mx-auto py-4" style="border-radius: 15px;">
                    <div class="col-md-11 mx-auto mt-4">
                        <h6 class="font-weight-bolder">Detail dan Jenis Pekerjaan</h6>
                    </div>
                    <form action="{{ route('loker-perusahaan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $profileUser->id }}">
                        <input type="hidden" name="id_perusahaan" value="{{ $perusahaan->id }}">
                        <div class="col-md-10 mx-auto mt-4">
                            <div class="form-group">
                                <label for="id_kategori">Kategori Pekerjaan</label>
                                <select name="id_kategori[]"
                                    class="form-control select2 @error('id_kategori') is-invalid @enderror kategori"
                                    multiple>
                                    @foreach ($kategoris as $kategori)
                                        <option
                                            value="{{ $kategori->id }}"{{ in_array($kategori->id, old('id_kategori', [])) ? 'selected' : '' }}>
                                            {{ $kategori->kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kategori')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-loker form-control @error('judul') is-invalid @enderror"
                                    id="judul" name="judul" placeholder="Masukkan judul lowongan pekerjaan"
                                    value="{{ old('judul') }}">
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <label class="mb-3">Jenis Pekerjaan</label>
                                <div class="radio-group @error('tipe_pekerjaan') is-invalid @enderror">
                                    <label>
                                        <input type="radio" name="tipe_pekerjaan" value="Onsite"
                                            {{ old('tipe_pekerjaan') === 'Onsite' ? 'checked' : '' }}>
                                        Onsite
                                    </label>
                                    <label>
                                        <input type="radio" name="tipe_pekerjaan" value="Remote"
                                            {{ old('tipe_pekerjaan') === 'Remote' ? 'checked' : '' }}>
                                        Remote
                                    </label>
                                    @error('tipe_pekerjaan')
                                        <div class="invalid-feedback">{{ $message }}
                                            {{ var_dump(old('tipe_pekerjaan')) }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 mx-auto mt-4">
                            <div class="form-group">
                                <label for="lokasi">Lokasi Kerja</label>
                                <input type="text" class="form-loker form-control @error('lokasi') is-invalid @enderror"
                                    id="lokasi" name="lokasi" placeholder="Masukkan lokasi kerja"
                                    value="{{ old('lokasi') }}">
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-11 mx-auto mt-5">
                            <h6 class="font-weight-bolder">Ketentuan dan Persyaratan</h6>
                        </div>
                        <div class="col-md-10 mx-auto mt-4">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="text-loker form-control @error('deskripsi') is-invalid @enderror"
                                    type="text" style="height: 200px;" placeholder="Masukkan deskripsi pekerjaan">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <label for="requirement">Persyaratan</label>
                                <textarea name="requirement" id="requirement" class="form-control summernote @error('requirement') is-invalid @enderror"
                                    type="text">{{ old('requirement') }}</textarea>
                                @error('requirement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-10 mx-auto mt-3">
                            <div class="form-group">
                                <label for="id_keahlian">Keahlian</label>
                                <select name="id_keahlian[]"
                                    class="form-control select2 @error('id_keahlian') is-invalid @enderror keahlian"
                                    multiple>
                                    @foreach ($keahlians as $keahlian)
                                        <option
                                            value="{{ $keahlian->id }}"{{ in_array($keahlian->id, old('id_keahlian', [])) ? 'selected' : '' }}>
                                            {{ $keahlian->keahlian }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_keahlian')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-10 mx-auto mt-3">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="min_pendidikan">Pendidikan Minimal yang Dibutuhkan</label>
                                    <select class="form-control select2 @error('min_pendidikan') is-invalid @enderror"
                                        id="min_pendidikan" name="min_pendidikan">
                                        <option value="" disabled selected>Pilih minimal pendidikan</option>
                                        <option value="SMA" {{ old('min_pendidikan') === 'SMA' ? 'selected' : '' }}>
                                            SMA
                                        </option>
                                        <option value="SMK" {{ old('min_pendidikan') === 'SMK' ? 'selected' : '' }}>
                                            SMK
                                        </option>
                                        <option value="SMA/SMK"
                                            {{ old('min_pendidikan') === 'SMA/SMK' ? 'selected' : '' }}>
                                            SMA/SMK
                                        </option>
                                        <option value="S1" {{ old('min_pendidikan') === 'S1' ? 'selected' : '' }}>
                                            S1
                                        </option>
                                    </select>
                                    @error('min_pendidikan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="min_pengalaman">Pengalaman Kerja Minimal yang Dibutuhkan</label>
                                    <select class="form-control select2 @error('min_pengalaman') is-invalid @enderror"
                                        id="min_pengalaman" name="min_pengalaman">
                                        <option value="" disabled selected>Pilih minimal pengalaman</option>
                                        <option value="Tidak ada"
                                            {{ old('min_pengalaman') === 'Tidak ada' ? 'selected' : '' }}>
                                            Tidak ada
                                        </option>
                                        <option value="Kurang dari setahun"
                                            {{ old('min_pengalaman') === 'kurang dari setahun' ? 'selected' : '' }}>
                                            Kurang dari setahun
                                        </option>
                                        <option value="Lebih dari setahun"
                                            {{ old('min_pengalaman') === 'Lebih dari setahun' ? 'selected' : '' }}>
                                            Lebih dari setahun
                                        </option>
                                    </select>
                                    @error('min_pengalaman')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 mx-auto mt-3">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="jumlah_pelamar">Jumlah Karyawan</label>
                                    <input type="number"
                                        class="form-loker form-control @error('jumlah_pelamar') is-invalid @enderror"
                                        id="jumlah_pelamar" name="jumlah_pelamar"
                                        placeholder="Masukkan jumlah karyawan yang dibutuhkan"
                                        value="{{ old('jumlah_pelamar') }}">
                                    @error('jumlah_pelamar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="gaji">Gaji</label>
                                    <div class="d-flex">
                                        <div class="d-flex align-items-center flex-grow-1">
                                            <input type="text"
                                                class="form-loker form-control mr-2 @error('gaji_bawah') is-invalid @enderror"
                                                id="gaji_bawah" name="gaji_bawah" value="{{ old('gaji_bawah') }}"
                                                placeholder="contoh: 3000000">
                                            <span class="mr-2">-</span>
                                            <input type="text"
                                                class="form-loker form-control @error('gaji_atas') is-invalid @enderror"
                                                id="gaji_atas" name="gaji_atas" value="{{ old('gaji_atas') }}"
                                                placeholder="contoh: 3000000">
                                        </div>
                                    </div>
                                    @if ($errors->has('gaji_bawah') && !$errors->has('gaji_atas'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('gaji_bawah') }}
                                        </div>
                                    @elseif (!$errors->has('gaji_bawah') && $errors->has('gaji_atas'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('gaji_atas') }}
                                        </div>
                                    @elseif ($errors->has('gaji_bawah') && $errors->has('gaji_atas'))
                                        <div class="invalid-feedback d-block">
                                            {{ $errors->first('gaji_atas') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 mx-auto mt-3">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="tutup">Lowongan di tutup</label>
                                    <input type="date"
                                        class="form-loker form-control @error('tutup') is-invalid @enderror"
                                        id="tutup" name="tutup" value="{{ old('tutup') }}">
                                    @error('tutup')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="status" value="Pending">
                        <div class="col-md-11 text-right my-4">
                            <button class="btn btn-primary mr-1 px-3" style="border-radius: 15px;">Tambah</button>
                            <a class="btn btn-secondary px-4" href="{{ route('loker-perusahaan.index') }}"
                                style="border-radius: 15px;">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('customStyle')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@push('customScript')
    <script src="{{ asset('assets/js/summernote-bs4.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.kategori').select2({
                placeholder: 'Pilih Kategori',
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.keahlian').select2({
                placeholder: 'Pilih Keahlian',
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#requirement').summernote({
                placeholder: 'Masukkan persyaratan pekerjaan',
                height: 195,
            });
        });
    </script>

    <script>
        function formatRupiah(angka) {
            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
            var formatted = formatter.format(angka);
            // return formatter.format(angka);
            formatted = formatted.replace("Rp", "");
            return formatted;
        }

        document.getElementById('gaji_bawah').addEventListener('input', function() {
            var value = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiah(value);
        });

        document.getElementById('gaji_atas').addEventListener('input', function() {
            var value = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiah(value);
        });
    </script>
@endpush

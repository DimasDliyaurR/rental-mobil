<div>

    <form action="{{ asset('transaksi-tambah/tambah') }}" method="post" wire:submit="save">
        @csrf

        @if (session()->has('success'))
            <div class="bg-green p-3 rounded text-center">Transaksi Berhasil</div>
        @endif
        <p>{{ $indexLength }}/{{ count($head) }} | Form {{ $head[$indexLength - 1] }}</p>
        @if ($indexLength == 1)
            {{-- Data Diri Form Start --}}

            {{-- Foto Penyewa --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label for="foto_penyewa" class="form-label">Foto Penyewa</label>
                    <input type="file" id="formFileLg" name="foto_penyewa" class="form-control form-control-lg"
                        wire:model="foto_penyewa" value="{{ $foto_penyewa }}">
                </div>
                @error('foto_penyewa')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Foto Penyewa --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label for="nama_penyewa" class="form-label">Nama Penyewa</label>
                    <input type="text" name="nama_penyewa" class="form-control" wire:model="nama_penyewa">
                </div>
                @error('nama_penyewa')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- No Telp --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label for="no_telp" class="form-label">Nomor Telepon</label>
                    <input type="text" id="no_telp" name="no_telp" class="form-control" wire:model="no_telp">
                </div>
                @error('no_telp')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- No KTP --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label for="no_ktp" class="form-label">Nomor KTP</label>
                    <input type="text" id="no_ktp" name="no_ktp" class="form-control" wire:model="no_ktp">
                </div>
                @error('no_ktp')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- No KTP --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label for="foto_ktp" class="form-label">Foto KTP</label>
                    <input type="file" id="foto_ktp" name="foto_ktp" class="form-control form-control-lg"
                        wire:model="foto_ktp">
                </div>
                @error('foto_ktp')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- No SIM --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label for="no_sim" class="form-label">Nomor SIM</label>
                    <input type="text" id="no_sim" name="no_sim" class="form-control" wire:model="no_sim">
                </div>
                @error('no_sim')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Foto SIM --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label for="foto_sim" class="form-label">Foto SIM</label>
                    <input type="file" id="foto_sim" name="foto_sim" class="form-control form-control-lg"
                        wire:model="foto_sim">
                </div>
                @error('foto_sim')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Data Diri Form End --}}
        @endif

        @if ($indexLength == 2)
            {{-- Kendaraan Form Start --}}

            {{-- Kendaraan --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label for="kendaraan" class="form-label">Kendaraan</label>
                    <select type="email" class="form-control" id="kendaraan" name="kendaraan"
                        wire:model="kendaraan_field">
                        <option selected disabled> -- Pilih Kendaraan -- </option>
                        @foreach ($kendaraan as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_kendaraan }}</option>
                        @endforeach
                    </select>
                </div>
                @error('kendaraan_field')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Tanggal Pengambilan --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label for="tanggal_pengambilan" class="form-label">Tanggal Pengambilan</label>
                    <input class="form-control" id="tanggal_pengambilan" type="date" name="tanggal_pengambilan"
                        value="{{ old('tanggal_pengambilan') }}" wire:model="tanggal_pengambilan">
                </div>
                @error('tanggal_pengembalian')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Lokasi Pengambilan --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label for="lokasi_pengambilan" class="form-label">Lokasi Pengambilan</label>
                    <input class="form-control" id="lokas_pengambilan" name="lokasi_pengembalian"
                        wire:model="lokasi_pengembalian">
                </div>
                @error('lokasi_pengembalian')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Driver --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label class="form-label" for="driver">
                        Memakai Driver atau tidak ?
                    </label>
                    <select class="form-control" name="driver" wire:model="driver">
                        <option value="1">Iya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                @error('driver')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Durasi --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label class="form-label" for="durasi">
                        Durasi (h)
                    </label>
                    <input class="form-control" name="durasi" wire:model="durasi">
                </div>
                @error('durasi')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Tanggal Kembali --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label class="form-label" for="tanggal_kembali">
                        Tanggal Kembali
                    </label>
                    <input class="form-control" name="tanggal_kembali" type="date" wire:model="tanggal_kembali">
                </div>
                @error('tanggal_kembali')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Waktu Kembali --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label class="form-label" for="waktu_kembali">
                        Waktu Kembali
                    </label>
                    <input class="form-control" name="waktu_kembali" type="time" wire:model="waktu_kembali">
                </div>
                @error('waktu_kembali')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Foto BBM --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label class="form-label" for="foto_bbm">
                        Foto BBM
                    </label>
                    <input class="form-control form-control-lg" name="foto_bbm" type="file" id="formFileLg"
                        wire:model="foto_bbm">
                </div>
                @error('foto_bbm')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Jumlah BBM --}}
            <div class="mb-3">
                <div class="mb-3">
                    <label class="form-label" for="jumlah_bbm">
                        Jumlah BBM
                    </label>
                    <input class="form-control form-control-lg" name="jumlah_bbm" wire:model="jumlah_bbm">
                </div>
                @error('jumlah_bbm')
                    <span class="form-text text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            {{-- Kendaraan Form End --}}
        @endif

        @if ($indexLength == 3)
        @endif


        @if ($indexLength == count($head))
            <table>
                <tr>
                    <td>Foto Penyewa :</td>
                    <td>:</td>
                    <td>{{ $foto_penyewa }}</td>
                </tr>
                <tr>
                    <td>Nama Penyewa</td>
                    <td>:</td>
                    <td>{{ $nama_penyewa }}</td>
                </tr>
                <tr>
                    <td>No telepon</td>
                    <td>:</td>
                    <td>{{ $no_telp }}</td>
                </tr>
                <tr>

                    <td>No KTP</td>
                    <td>:</td>app
                    <td>{{ $no_ktp }}</td>
                </tr>
                <tr>

                    <td>Foto KTP</td>
                    <td>:</td>
                    <td>{{ $foto_ktp }}</td>
                </tr>
                <tr>

                    <td>No SIM</td>
                    <td>:</td>
                    <td>{{ $no_sim }}</td>
                </tr>
                <tr>

                    <td>Foto SIM</td>
                    <td>:</td>
                    <td>{{ $foto_sim }}</td>
                </tr>
                <tr>

                    <td>Foto TTD</td>
                    <td>:</td>
                    <td>{{ $foto_ttd }}</td>
                </tr>
                <tr>

                    <td>Kendaraan</td>
                    <td>:</td>
                    @php
                        $find = $kendaraan_find::find($kendaraan_field);
                    @endphp
                    <td>{{ $find ? $find->nama_kendaraan : '' }}</td>
                </tr>
                <tr>

                    <td>Tanggal Pengambilan</td>
                    <td>:</td>
                    <td>{{ $tanggal_pengambilan }}</td>
                </tr>
                <tr>

                    <td>Lokasi Pengambilan</td>
                    <td>:</td>
                    <td>{{ $lokasi_pengembalian }}</td>
                </tr>
                <tr>

                    <td>Pakai Driver</td>
                    <td>:</td>
                    <td>{{ $driver == 1 ? 'Memakai' : 'Tidak Memakai' }}</td>
                </tr>
                <tr>

                    <td>Durasi</td>
                    <td>:</td>
                    <td>{{ $durasi }} Hari</td>
                </tr>
                <tr>

                    <td>Tanggal Pengembalian</td>
                    <td>:</td>
                    <td>{{ $tanggal_kembali }}</td>
                </tr>
                <tr>

                    <td>Waktu Kembali</td>
                    <td>:</td>
                    <td>{{ $waktu_kembali }}</td>
                </tr>
                <tr>

                    <td>Foto BBM</td>
                    <td>:</td>
                    <td>{{ $foto_bbm }}</td>
                </tr>
                <tr>

                    <td>Jumlah BBM</td>
                    <td>:</td>
                    <td>{{ $jumlah_bbm }}</td>
                </tr>
            </table>
        @endif

        @if ($indexLength == count($head))
            <div class="mb-3">
                <button class="btn btn-success">Submit</button>
            </div>
        @endif
        <div class="countainer d-flex flex-row justify-content-between">

            @if ($indexLength != 1)
                <div>
                    <a class="btn btn-primary" wire:click="removeStep">Sebelumnya</a>
                </div>
            @elseif($indexLength == 1)
                <div></div>
            @endif

            @if ($indexLength != count($head))
                <div>
                    <a class="btn btn-primary" wire:click="addStep">Selanjutnya</a>
                </div>
            @endif
        </div>

    </form>


</div>

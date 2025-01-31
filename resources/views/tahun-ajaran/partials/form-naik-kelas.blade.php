<div id="kenaikan_kelas">
   <div class="row">
      <div class="col-sm-6">
         <div class="form-group">
            <label for="nominal_daftar_ulang">Nominal Daftar Ulang</label>
            <input type="text" class="form-control @error('nominal_daftar_ulang') is-invalid @enderror" id="rupiah"
               name="nominal_daftar_ulang" placeholder="Masukkan nominal" value="{{ old('nominal_daftar_ulang') }}"
               required>
            @error('nominal_daftar_ulang')
               <div class="invalid-feedback">
                  {{ $message }}
               </div>
            @enderror
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col">
         <div class="alert alert-danger">
            <h5><i class="fas fa-exclamation-triangle mr-2"></i><b>Peringatan!</b></h5>
            <span>
               1. Data pembayaran komite akan direset setelah tahun pelajaran baru ditambahkan. <br>
               2. Pastikan file excel pembayaran komite sudah didownload terlebih dahulu sebelum menambah tahun
               pelajaran
               baru!
            </span>
         </div>
      </div>
   </div>
   <hr class="mt-0">
   <label>Data Kenaikan Kelas</label>
   @foreach ($kelas_non_kosong as $knk)
      @if ($knk->tingkatan == 12)
         <div class="form-group row mb-3 ml-2">
            <label for="kelas_asal_{{ $knk->id }}" class="col-form-label ml-2 mr-3">Kelas</label>
            <div class="col-2 pl-0 mr-3">
               <select class="form-control" disabled>
                  <option value="{{ $knk->id }}" selected>{{ $knk->nama }}</option>
               </select>
               <select class="form-control" name="kelas_asal_{{ $knk->id }}" id="kelas_asal_{{ $knk->id }}"
                  required hidden>
                  <option value="{{ $knk->id }}" selected>{{ $knk->nama }}</option>
               </select>
            </div>
            <div class="col-1">
               <label class="col-form-label text-success">Lulus</label>
               <input type="text" name="ket_lulus" id="ket_lulus" value="lulus" hidden readonly>
            </div>
         </div>
      @else
         <div class="form-group row mb-3 ml-2">
            <label for="kelas_asal_{{ $knk->id }}" class="col-form-label ml-2 mr-3">Kelas</label>
            <div class="col-2 pl-0 mr-3">
               <select class="form-control" disabled>
                  <option value="{{ $knk->id }}" selected>{{ $knk->nama }}</option>
               </select>
               <select class="form-control" name="kelas_asal_{{ $knk->id }}" id="kelas_asal_{{ $knk->id }}"
                  required hidden>
                  <option value="{{ $knk->id }}" selected>{{ $knk->nama }}</option>
               </select>
            </div>
            <div class="col-1">
               <label class="col-form-label text-success">Naik</label>
               <label class="col-form-label ml-3">ke</label>
            </div>
            <label for="kelas_tujuan_{{ $knk->id }}" class="col-form-label mr-3">Kelas</label>
            <div class="col-2">
               <select class="form-control" name="kelas_tujuan_{{ $knk->id }}"
                  id="kelas_tujuan_{{ $knk->id }}" required>
                  <option value="" disabled hidden selected>-- Pilih kelas --</option>
                  @foreach ($kelas as $k)
                     <option value="{{ $k->id }}">{{ $k->nama }}</option>
                  @endforeach
               </select>
            </div>
         </div>
      @endif
   @endforeach
</div>
<div id="tinggal_kelas">
   <hr class="mt-0">
   <label>Data Siswa Tinggal Kelas / Tidak Lulus</label>
   <div class="form-group row mb-3">
      <label for="jml_siswa_tinggal_kelas" class="col-form-label pr-0 ml-4 mr-3">Jumlah</label>
      <div class="col-1 ml-1">
         <input type="number" class="form-control" id="jml_siswa_tinggal_kelas" name="jml_siswa_tinggal_kelas"
            placeholder="Jumlah siswa yang tinggal kelas/tidak lulus" value="0" min="0">
      </div>
   </div>
   <div id="form_siswa_tinggal_kelas"></div>
</div>

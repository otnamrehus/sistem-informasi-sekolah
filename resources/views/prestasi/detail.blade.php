@extends('layouts.main')

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>{{ $title }}</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Akademik</li>
                     <li class="breadcrumb-item">Data Prestasi</li>
                     <li class="breadcrumb-item active">Detail Prestasi</li>
                  </ol>
               </div>
            </div>
         </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-12">
                  <div class="card card-info">
                     <div class="card-header">
                        <div class="d-inline-flex"></div>
                        <div class="d-inline-flex">
                           <h4 class="m-0">Detail Prestasi</h4>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <div class="row">
                           <div class="d-inline-flex mb-3 ml-2">
                              <a href="/prestasi" class="btn btn-secondary btn-sm mr-1">
                                 <i class="fas fa-long-arrow-left"></i> Kembali</a>
                              @can('admin')
                                 <a href="/prestasi/{{ $prestasi->id }}/edit" class="btn btn-primary btn-sm mr-1">
                                    <i class="fas fa-edit"></i> Edit</a>
                                 <a href="" class="btn btn-danger btn-sm mr-1" data-toggle="modal"
                                    data-target="#modal-delete-{{ $prestasi->id }}">
                                    <i class="fas fa-trash"></i> Hapus</a>
                                 <!-- Modal -->
                                 <div class="modal fade" id="modal-delete-{{ $prestasi->id }}" style="display: none;"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                       <div class="modal-content bg-warning">
                                          <div class="modal-header">
                                             <h4 class="modal-title">Hapus Data Prestasi</h4>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <p>Yakin hapus data prestasi {{ $prestasi->asal }}?</p>
                                          </div>
                                          <div class="modal-footer justify-content-between">
                                             <button type="button" class="btn btn-outline-dark"
                                                data-dismiss="modal">Batal</button>
                                             <form method="POST" action="/prestasi/{{ $prestasi->id }}">
                                                @method('delete')
                                                @csrf
                                                <button onclick="return true" class="btn btn-danger">Hapus</button>
                                             </form>
                                          </div>
                                       </div>
                                       <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                 </div>
                                 <!-- /.modal -->
                              @endcan
                           </div>
                           <table class="table">
                              <tbody>
                                 <tr>
                                    <th style="width: 20%">Nama</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{ $prestasi->nama }}</td>
                                 </tr>
                                 <tr>
                                    <th>Jenis</th>
                                    <th>:</th>
                                    <td>{{ $prestasi->jenis }}</td>
                                 </tr>
                                 <tr>
                                    <th>Capaian</th>
                                    <th>:</th>
                                    <td>{{ $prestasi->capaian }}</td>
                                 </tr>
                                 <tr>
                                    <th>Tingkat</th>
                                    <th>:</th>
                                    <td>{{ $prestasi->tingkat }}</td>
                                 </tr>
                                 <tr>
                                    <th>Tanggal</th>
                                    <th>:</th>
                                    <td>{{ \Carbon\Carbon::parse($prestasi->tanggal)->isoFormat('D MMMM Y') }}</td>
                                 </tr>
                                 <tr>
                                    <th>Bidang</th>
                                    <th>:</th>
                                    <td>{{ $prestasi->bidang }}</td>
                                 </tr>
                                 <tr>
                                    <th>Piagam</th>
                                    <th>:</th>
                                    <td class="text-warning">
                                       @if ($prestasi->piagam == null)
                                          <b>Belum diunggah</b>
                                       @endif
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           @if ($prestasi->piagam != null)
                              <iframe class="col-md-12" height="800" src="/storage/{{ $prestasi->piagam }}"
                                 frameborder="0"></iframe>
                           @endif
                        </div>
                     </div>
                     <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
               </div>
               <!-- /.col -->
            </div>
            <!-- /.row -->
         </div>
         <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
   </div>
@endsection

@section('script')
   <!-- jQuery -->
   <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
   <!-- Bootstrap 4 -->
   <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- AdminLTE App -->
   <script src="/adminlte/dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="/adminlte/dist/js/demo.js"></script>
   <!-- Page specific script -->
   <script></script>
@endsection

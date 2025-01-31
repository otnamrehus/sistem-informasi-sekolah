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
                     <li class="breadcrumb-item">Surat Keluar</li>
                     <li class="breadcrumb-item active">Detail Surat</li>
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
                           <h4 class="m-0">Detail Surat {{ $sk->tujuan }}</h4>
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <div class="row">
                           <div class="d-inline-flex mb-3 ml-2">
                              <a href="/surat-keluar" class="btn btn-secondary btn-sm mr-1">
                                 <i class="fas fa-long-arrow-left"></i> Kembali</a>
                              @can('tata-usaha')
                                 <a href="/surat-keluar/{{ $sk->id }}/edit" class="btn btn-primary btn-sm mr-1">
                                    <i class="fas fa-edit"></i> Edit</a>
                                 <a href="" class="btn btn-danger btn-sm mr-1" data-toggle="modal"
                                    data-target="#modal-delete-{{ $sk->id }}">
                                    <i class="fas fa-trash"></i> Hapus</a>
                                 <!-- Modal -->
                                 <div class="modal fade" id="modal-delete-{{ $sk->id }}" style="display: none;"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                       <div class="modal-content bg-warning">
                                          <div class="modal-header">
                                             <h4 class="modal-title">Hapus Data Surat</h4>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <p>Yakin hapus data surat ke {{ $sk->tujuan }}?</p>
                                          </div>
                                          <div class="modal-footer justify-content-between">
                                             <button type="button" class="btn btn-outline-dark"
                                                data-dismiss="modal">Batal</button>
                                             <form method="POST" action="/surat-keluar/{{ $sk->id }}">
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
                                    <th style="width: 20%">Tujuan</th>
                                    <th style="width: 1%">:</th>
                                    <td>{{ $sk->tujuan }}</td>
                                 </tr>
                                 <tr>
                                    <th>No. Surat</th>
                                    <th>:</th>
                                    <td>{{ "$sk->nomor/$sk->kode_tujuan/$sk->instansi_asal/$sk->bulan-$sk->tahun" }}
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Tanggal Keluar</th>
                                    <th>:</th>
                                    <td>{{ \Carbon\Carbon::parse($sk->tgl_keluar)->isoFormat('D MMMM Y') }}</td>
                                 </tr>
                                 <tr>
                                    <th>Keterangan</th>
                                    <th>:</th>
                                    <td>{{ $sk->keterangan }}</td>
                                 </tr>
                                 <tr>
                                    <th>Isi Surat</th>
                                    <th></th>
                                    <th></th>
                                 </tr>
                              </tbody>
                           </table>
                           <iframe class="col-md-12" height="800" src="/storage/{{ $sk->file_surat }}"
                              frameborder="0"></iframe>
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

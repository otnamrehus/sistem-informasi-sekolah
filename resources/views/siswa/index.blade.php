@extends('layouts.main')

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Data Siswa</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Akademik</li>
                     <li class="breadcrumb-item active">Data Siswa</li>
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
                  <div class="card">
                     <div class="card-header">
                        <div class="d-inline-flex">
                           @can('tata-usaha')
                              <a href="/siswa/create" class="btn btn-success btn-sm mr-1">
                                 <i class="fas fa-file-plus"></i> Tambah Data Siswa</a>
                              <a href="" class="btn bg-gradient-purple btn-sm mr-1" data-toggle="modal"
                                 data-target="#modal-impor">
                                 <i class="fas fa-file-upload"></i> Impor Data Siswa</a>
                           @endcan
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <table id="data_siswa" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th id="thead_0">No.</th>
                                 <th id="thead_1">Nama</th>
                                 <th id="thead_2">Kelas</th>
                                 <th id="thead_3">Jenis Kelamin</th>
                                 <th id="thead_4">NIS</th>
                                 <th id="thead_5">NISN</th>
                                 <th id="thead_6" hidden>No. Telepon</th>
                                 <th id="thead_7" hidden>Alamat</th>
                                 <th id="thead_8">Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($siswa as $s)
                                 <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>
                                       @if ($s->kelas)
                                          {{ $s->kelas->nama }}
                                       @else
                                          -
                                       @endif
                                    </td>
                                    <td>{{ $s->gender }}</td>
                                    <td>{{ $s->nis }}</td>
                                    <td>{{ $s->nisn }}</td>
                                    <td hidden>{{ $s->no_telp }}</td>
                                    <td hidden>{{ $s->tempat_tinggal }}</td>
                                    <td>
                                       <div class="d-inline-flex">
                                          <a href="/siswa/{{ $s->id }}" class="btn btn-info btn-sm mr-1">
                                             <i class="fas fa-eye"></i> Lihat</a>
                                          @can('tata-usaha')
                                             <a href="/siswa/{{ $s->id }}/edit" class="btn btn-primary btn-sm mr-1">
                                                <i class="fas fa-edit"></i> Edit</a>
                                             <a href="" class="btn btn-danger btn-sm mr-1" data-toggle="modal"
                                                data-target="#modal-delete-{{ $s->id }}">
                                                <i class="fas fa-trash"></i> Hapus</a>

                                             <!-- Modal Delete-->
                                             <div class="modal fade" id="modal-delete-{{ $s->id }}"
                                                style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog">
                                                   <div class="modal-content bg-warning">
                                                      <div class="modal-header">
                                                         <h4 class="modal-title">Hapus Data Siswa</h4>
                                                         <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                         </button>
                                                      </div>
                                                      <div class="modal-body">
                                                         <p>Yakin hapus data {{ $s->nama }}?</p>
                                                         <span>Alasan:</span>
                                                         <form method="POST" action="/siswa/{{ $s->id }}">
                                                            @method('delete')
                                                            @csrf
                                                            <div class="form-group">
                                                               <div class="form-check">
                                                                  <input class="form-check-input" type="radio"
                                                                     name="alasan" id="keluar" value="keluar" required>
                                                                  <label class="form-check-label">Keluar/Pindah</label>
                                                               </div>
                                                               <div class="form-check">
                                                                  <input class="form-check-input" type="radio"
                                                                     name="alasan" id="kesalahan" value="kesalahan">
                                                                  <label class="form-check-label">Kesalahan Data</label>
                                                               </div>
                                                               <div class="form-check">
                                                                  <input class="form-check-input" type="radio"
                                                                     name="alasan" id="lainnya" value="lainnya">
                                                                  <label class="form-check-label">Lainnya</label>
                                                               </div>
                                                            </div>
                                                      </div>
                                                      <div class="modal-footer justify-content-between">
                                                         <button type="button" class="btn btn-outline-dark"
                                                            data-dismiss="modal">Batal</button>
                                                         <button onclick="return true" class="btn btn-danger">Hapus</button>
                                                         </form>
                                                      </div>
                                                   </div>
                                                   <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                             </div>
                                             <!-- /.modal delete -->
                                          @endcan
                                       </div>
                                    </td>
                                 </tr>
                              @endforeach
                           </tbody>
                        </table>

                        <!-- Modal Impor-->
                        <div class="modal fade" id="modal-impor" style="display: none;" aria-hidden="true">
                           <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h4 class="modal-title">Impor Data Siswa</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">×</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="alert alert-danger">
                                       <h5><i class="fas fa-info-circle mr-1"></i> Petunjuk!</h5>
                                       <span>
                                          1. Unduh terlebih dahulu format berkas excel. <br>
                                          2. Masukkan data siswa ke dalam berkas excel tersebut. <br>
                                          3. Unggah berkas excel berisikan data siswa melalui unggah berkas di bawah.
                                       </span>
                                       <a href="/siswa-format-download" target="_blank"
                                          class="btn btn-block btn-success col-4 mt-2 text-decoration-none align-content-end">
                                          <i class="fas fa-file-download mr-1"></i> Unduh Format Berkas Excel</a>
                                    </div>
                                    <form method="POST" action="/siswa-impor" enctype="multipart/form-data">
                                       <div class="custom-file mb-2">
                                          <input type="file" class="custom-file-input" id="file_impor"
                                             name="file_impor">
                                          <label for="file_impor" class="custom-file-label" data-browse="Pilih berkas">
                                             Pilih berkas data siswa (.xlsx)</label>
                                          <span class="text-orange ml-1">
                                             <small>
                                                *Berkas harus berupa spreadsheet hasil unduhan format berkas di atas
                                             </small>
                                          </span>
                                       </div>
                                 </div>
                                 <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-outline-dark"
                                       data-dismiss="modal">Batal</button>
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Unggah</button>
                                    </form>
                                 </div>
                              </div>
                              <!-- /.modal-content -->

                           </div>
                           <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal impor -->
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
   <!-- bs-custom-file-input -->
   <script src="/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
   <!-- DataTables  & Plugins -->
   <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
   <script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
   <script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
   <script src="/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
   <script src="/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
   <script src="/adminlte/plugins/jszip/jszip.min.js"></script>
   <script src="/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
   <script src="/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
   <script src="/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
   <script src="/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
   <script src="/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
   <script src="/js/dataTables.export.js"></script>
   <!-- AdminLTE App -->
   <script src="/adminlte/dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="/adminlte/dist/js/demo.js"></script>
   <!-- Page specific script -->
   <script>
      $(document).ready(function() {
         var table = $('#data_siswa').DataTable({
            language: {
               url: "{{ url('/json/dataTable-id.json') }}"
            },
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            initComplete: function() {
               var api = this.api();

               new $.fn.dataTable.Buttons(api, {
                  buttons: [{
                        extend: 'copy',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                     },
                     {
                        extend: 'excel',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                     },
                     {
                        text: 'Word',
                        action: function(e, dt, node, config) {
                           var date = new Date();
                           var time = date.toLocaleString();
                           $.fn.DataTable.Export.word(dt, {
                              filename: $("#title").text(),
                              title: $("#title").text(),
                              message: 'Di ekspor pada ' + time,
                              header: [
                                 $("#thead_0").text(),
                                 $("#thead_1").text(),
                                 $("#thead_2").text(),
                                 $("#thead_3").text(),
                                 $("#thead_4").text(),
                                 $("#thead_5").text(),
                                 $("#thead_6").text(),
                                 $("#thead_7").text(),
                              ],
                              fields: [0, 1, 2, 3, 4, 5, 6, 7],
                              orientation: 'landscape'
                           });
                        }
                     },
                     {
                        extend: 'pdf',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                     },
                     {
                        extend: 'print',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                     }
                  ]
               });

               api.buttons().container().appendTo('#data_siswa_wrapper .col-md-6:eq(0)');
            }
         });
      });

      $(function() {
         bsCustomFileInput.init();
      });

      // $(function() {
      //    $("#data_siswa").DataTable({
      //       "responsive": true,
      //       "lengthChange": false,
      //       "autoWidth": false,
      //       "buttons": [{
      //             extend: 'copy',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4, 5, 6, 7]
      //             }
      //          },
      //          {
      //             extend: 'excel',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4, 5, 6, 7]
      //             }
      //          },
      //          {
      //             extend: 'pdf',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4, 5, 6, 7]
      //             }
      //          },
      //          {
      //             extend: 'print',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4, 5, 6, 7]
      //             }
      //          }
      //       ]
      //    }).buttons().container().appendTo('#data_siswa_wrapper .col-md-6:eq(0)');
      // });
   </script>
@endsection

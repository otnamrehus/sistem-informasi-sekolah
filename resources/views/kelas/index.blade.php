@extends('layouts.main')

@section('container')
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Data Kelas</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item">Akademik</li>
                     <li class="breadcrumb-item active">Data Kelas</li>
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
                              <a href="/kelas/create" class="btn btn-success btn-sm mr-1">
                                 <i class="fas fa-file-plus"></i> Tambah Data Kelas</a>
                           @endcan
                        </div>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                        <table id="table_kelas" class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th id="thead_0">No.</th>
                                 <th id="thead_1">Tingkatan</th>
                                 <th id="thead_2">Kelas</th>
                                 <th id="thead_3">Jumlah Siswa</th>
                                 <th id="thead_4">Wali Kelas</th>
                                 <th id="thead_5">Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($kelas as $k)
                                 <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $k->tingkatan }}</td>
                                    <td>{{ $k->nama }}</td>
                                    <td>{{ $k->siswa->count() }}</td>
                                    <td class="text-left">
                                       @if ($k->wali_kelas)
                                          {{ $k->wali_kelas->nama }}
                                       @else
                                          -
                                       @endif
                                    </td>
                                    <td class="text-left">
                                       <div class="d-inline-flex">
                                          <a href="/kelas/{{ $k->id }}" class="btn btn-info btn-sm mr-1">
                                             <i class="fas fa-eye"></i> Lihat Daftar Siswa</a>
                                          @can('tata-usaha')
                                             <a href="/kelas/{{ $k->id }}/edit" class="btn btn-primary btn-sm mr-1">
                                                <i class="fas fa-edit"></i> Edit</a>
                                             @if ($k->siswa()->get()->count() == 0)
                                                <a href="" class="btn btn-danger btn-sm mr-1" data-toggle="modal"
                                                   data-target="#modal-delete-{{ $k->id }}">
                                                   <i class="fas fa-trash"></i> Hapus</a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modal-delete-{{ $k->id }}"
                                                   style="display: none;" aria-hidden="true">
                                                   <div class="modal-dialog">
                                                      <div class="modal-content bg-warning">
                                                         <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Data Kelas</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                               aria-label="Close">
                                                               <span aria-hidden="true">×</span>
                                                            </button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <p>Yakin hapus data kelas {{ $k->nama }}?</p>
                                                         </div>
                                                         <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-outline-dark"
                                                               data-dismiss="modal">Batal</button>
                                                            <form method="POST" action="/kelas/{{ $k->id }}">
                                                               @method('delete')
                                                               @csrf
                                                               <button onclick="return true"
                                                                  class="btn btn-danger">Hapus</button>
                                                            </form>
                                                         </div>
                                                      </div>
                                                      <!-- /.modal-content -->
                                                   </div>
                                                   <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->
                                             @endif
                                          @endcan

                                       </div>
                                    </td>
                                 </tr>
                              @endforeach
                           </tbody>
                        </table>
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
   <!-- SweetAlert2 -->
   <script src="/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
   <!-- Toastr -->
   <script src="/adminlte/plugins/toastr/toastr.min.js"></script>
   <!-- AdminLTE App -->
   <script src="/adminlte/dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="/adminlte/dist/js/demo.js"></script>
   <!-- Page specific script -->
   <script>
      $(document).ready(function() {
         var table = $('#table_kelas').DataTable({
            language: {
               url: "{{ url('/json/dataTable-id.json') }}"
            },
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            initComplete: function() {

               new $.fn.dataTable.Buttons(api, {
                  buttons: [{
                        extend: 'copy',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4]
                        }
                     },
                     {
                        extend: 'excel',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4]
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
                              ],
                              fields: [0, 1, 2, 3, 4]
                           });
                        }
                     },
                     {
                        extend: 'pdf',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4]
                        }
                     },
                     {
                        extend: 'print',
                        exportOptions: {
                           columns: [0, 1, 2, 3, 4]
                        }
                     }
                  ]
               });

               api.buttons().container().appendTo('#table_kelas_wrapper .col-md-6:eq(0)');
            }
         });
      });

      // $(function() {
      //    $("#table_kelas").DataTable({
      //       "responsive": true,
      //       "lengthChange": false,
      //       "autoWidth": false,
      //       "buttons": [{
      //             extend: 'copy',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4]
      //             }
      //          },
      //          {
      //             extend: 'excel',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4]
      //             }
      //          },
      //          {
      //             extend: 'pdf',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4]
      //             }
      //          },
      //          {
      //             extend: 'print',
      //             exportOptions: {
      //                columns: [0, 1, 2, 3, 4]
      //             }
      //          }
      //       ]
      //    }).buttons().container().appendTo('#table_kelas_wrapper .col-md-6:eq(0)');
      // });
   </script>
@endsection

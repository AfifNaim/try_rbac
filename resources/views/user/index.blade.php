<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Data Users')</title>
  @include('layouts/header')
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="/assets/dataTables/datatables.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('layouts/navbar')

  @include('layouts/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="card card-into card card-outline card-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Users</h1>
          </div>
          </div><!-- /.row -->
          <div class="card-header">
            <div class="float-left">
              <form method="post">
                <a href="/user/create" class="btn btn-primary btn-sm">
                  <i class="fas fa-plus"> Tambah Data</i>
                </a>
              </form>
            </div>
          </div>
          <br>
          <!-- Main content -->
          <section class="content">
            <table class="table data-table dt-head-center table-sm table-bordered table-hover table-striped" id="datatables">
              <thead class="text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Jenis Kelamin</th>
                  <th scope="col">No Telp</th>
                  <th scope="col">Email</th>
                  <th scope="col">Role</th>
                  <th scope="col">EXP Reminder</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($user as $usr)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $usr->name }}</td>
                  <td>{{ $usr->alamat }}</td>
                  <td>{{ $usr->jk }}</td>
                  <td>{{ $usr->no_telp }}</td>
                  <td>{{ $usr->email }}</td>
                  <td>{{ $usr->role->name }}</td>
                  <td>{{ $usr->exp_reminder }} hari</td>
                  <td><span class="badge {{ ($usr->status == 1) ? 'bg-success' : 'bg-secondary' }}">{{ ($usr->status == 1) ? 'Aktif' : 'Tidak Aktif' }}</span></td>
                  <td class="text-center">
                    <div class="btn-group btn-group-sm">
                    @if ($usr->status == 1)
                      <a href="/user/status/{{ $usr->id }}" class="btn btn-sm btn-secondary"><i class="fas fa-times-circle"></i></a>
                    @else
                      <a href="/user/status/{{ $usr->id }}" class="btn btn-sm btn-success"><i class="fas fa-check-circle"></i></a>
                    @endif

                    <a href="/user/{{ $usr->id }}/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>

                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusPengguna{{ $usr->id }}"><i class="fas fa-trash"></i></button>

                    <div class="modal fade" id="modalHapusPengguna{{ $usr->id }}" tabindex="-1" aria-labelledby="modalHapusPengguna" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-body">
                            <h4 class="text-center">Yakin Hapus Pengguna : <span>{{ $usr->name}} ? </span></h4></h4>
                          </div>
                          <div class="modal-footer">
                            <form action="/user/{{ $usr->id }}" method="post">
                              @method('delete')
                              @csrf
                              <button type="submit" class="btn btn-primary">Ok</button>
                            </form>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </section>
          
          <!-- /.content -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
  
  @include('layouts/footer')

  <script src="/assets/dataTables/datatables.min.js"></script>
  <script type="text/javascript">
    $(document).ready( function () {
      $('#datatables').DataTable();
    } );
  </script>

  <script>
    $(function(){
    
        @if(Session::has('success'))
            Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: '{{ Session::get("success") }}'
        })
        @endif

        @if(Session::has('error'))
            Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ Session::get("error") }}'
        })
        @endif
    });
    </script>
</body>
</html>

  
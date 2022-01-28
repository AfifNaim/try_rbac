
  
  @include('layouts/header')

  @include('layouts/navbar')

  @include('layouts/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="card card-into card card-outline card-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manajemen Menu</h1>
          </div>
          </div><!-- /.row -->
          <div class="card-header">
            <div class="float-left">
              <form method="post">
                <a href="/menu/create" class="btn btn-primary btn-sm">
                  <i class="fas fa-plus"> Tambah Data</i>
                </a>
              </form>
            </div>
          </div>
          <br>
          <!-- Main content -->
          <section class="content">
            <table class="table data-table dt-head-center table-sm table-bordered table-hover table-striped" id="datatables-menu">
              <thead class="text-center">
                <tr>
                  <th scope="col">No</th>
                  <th>Data Menu</th>
                  <th>Parent Menu</th>
                  <th>Hak Akses</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @if ($menus->count())
                  @foreach ($menus as $key => $menu)
                      <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                          <td>
                              {{ $menu->judul }}
                              <br />
                              {{ 'URL : ' . $menu->url }}
                          </td>
                          <td>
                              @if ($menu->id_parent != null)
                                  <span class="badge bg-success">
                                      {{ $menu->parent->judul }}
                                  </span>
                              @else
                                  <span class="badge bg-danger">
                                      {{ 'Independen' }}
                                  </span>
                              @endif
                          </td>
                          <td>
                              {{ $menu->hak_akses->name }}
                          </td>
                          <td class="text-center">
                            <div class="btn-group btn-group-sm">
                              
                              <a href="/menu/{{ $menu->id }}/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
          
                              <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapusMenu{{ $menu->id }}"><i class="fas fa-trash"></i></button>
          
                              <div class="modal fade" id="modalHapusMenu{{ $menu->id }}" tabindex="-1" aria-labelledby="modalHapusMenu" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                      <h4 class="text-center">Yakin Hapus Menu : <span>{{ $menu->judul}} ? </span></h4></h4>
                                    </div>
                                    <div class="modal-footer">
                                      <form action="/menu/{{ $menu->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Ok</button>
                                      </form>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </td>
                      </tr>
                  @endforeach
                @endif
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
        $('#datatables-menu').DataTable();
      } );
    </script>

    <script src="/assets/dataTables/datatables.min.js"></script>
    <script type="text/javascript">
      $(document).ready( function () {
        $('#datatables-role').DataTable();
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

  
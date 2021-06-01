<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    
    <div class="card card-primary">
              <div class="card-header">
                <h6 class="text-center">Data Supplier</h6>
              </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table id="tabel" class="table table-striped table-hover" style="width:100%"> 
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Telpon</th>
                            <th>Email</th>
                            <th>Rekening</th>
                            <th>Alamat</th>
                            <th class="text-center"><button type="button" class="btn btn-primary btn-sm" id="btn-tambah" data-toggle="modal" data-target="#modal-info"> Tambah</button></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        
        
    </div>
        {{-- modal --}}
      <div class="modal fade" id="modal-info">
            <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                <h4 class="modal-title">Data Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                
                    <form action="{{route('supplier.store')}}" method="post" id="forms">
                        @csrf
                        <div class="form-group">
                            <label for=""> Nama Supplier</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Supplier">
                            <input type="text" hidden class="form-control" id="id" name="id" placeholder="Nama Supplier">
                        </div>
                        <div class="form-group">
                            <label for=""> Telpon</label>
                            <input type="text" onkeypress="return number(event)" class="form-control" id="telp" name="telp" placeholder="No. Telp">
                        </div>
                        <div class="form-group">
                            <label for=""> E-mail</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Alamat Email">
                        </div>
                        <div class="form-group">
                            <label for=""> No. Rekening</label>
                            <input type="text" onkeypress="return number(event)" class="form-control" id="rekening" name="rekening" placeholder="Rekening">
                        </div>
                        <div class="form-group">
                            <label for=""> Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" cols="30"></textarea>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" id="btn-tutup" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="submit" id="simpan" class="btn btn-outline-light">Save</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    <br>
    <br>
</x-app-layout>
@stack('js')
<script src={{asset("plugins/datatables/jquery.dataTables.js")}}></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function () {
        loaddata()
        // toastr.info('Are you the 6 fingered man?')
    })

    function loaddata() {
        $('#tabel').DataTable({
            serverside: true,
            processing: true,
            language: {
               url: "{{ asset('js/bahasa.json') }}"
            },
            ajax : {
                url : "{{route('supplier.index')}}"
            },
            columns: [
                { data: 'nama', name: 'nama' },
                { data: 'telp', name: 'telp' },
                { data: 'email', name: 'email' },
                { data: 'rekening', name: 'rekening' },
                { data: 'alamat', name: 'alamat' },
                { data: 'aksi', name: 'aksi', orderable: false }
            ]
        })
    }

    function number(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) 
                return false;
            return true;
    }

    $(document).on('submit', 'form', function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            typeData: "JSON",
            data: new FormData(this),
            processData :false,
            contentType: false,
            success : function (res) {
                console.log(res);
                $('#btn-tutup').click()
                $('#tabel').DataTable().ajax.reload()
                toastr.success(res.text, 'Sukses')
            },
            error : function (xhr) {
                toastr.error(xhr.responseJSON.text, 'Gagal')
            }
        })
    })
    
    // edit
    $(document).on('click', '.edit', function () {
        $('#forms').attr('action',"{{route('supplier.updates')}}")
        let id = $(this).attr('id')
        $.ajax({
            url : "{{ route('supplier.edits') }}",
            type : 'post',
            data : {
                id : id,
                _token : "{{ csrf_token() }}"
            },
            success: function (res) {
                //  console.log(res);
                 $('#id').val(res.id)
                 $('#nama').val(res.nama)
                 $('#telp').val(res.telp)
                 $('#alamat').val(res.alamat)
                 $('#rekening').val(res.rekening)
                 $('#email').val(res.email)
                 $('#btn-tambah').click()
            },
            error : function (xhr) {
                console.log(xhr);
            }
        })
    })

    // hapus
    $(document).on('click', '.hapus', function () {
        let id = $(this).attr('id')

        Swal.fire({
            title: 'Yakin Hapus?',
            text: "Data Yang Terhapus Tidak Bisa Kembali!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
               $.ajax({
                    url : "{{ route('supplier.hapus') }}",
                    type : 'post',
                    data : {
                        id : id,
                        _token : "{{ csrf_token() }}"
                    },
                    success: function (res,status) {
                        if (status = '200') {
                            setTimeout(() => {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Data Berhasil Di Hapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((res) => {
                                  $('#tabel').DataTable().ajax.reload()
                                })
                            });
                        }
                    },
                    error : function (xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'GAGAGL MENGHAPUS!',
                            })
                    }
                })
            }
        })
    })

</script>

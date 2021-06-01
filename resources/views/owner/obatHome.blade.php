<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    
    <div class="card card-primary">
              <div class="card-header">
                <h6 class="text-center">Data obat</h6>
              </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table id="tabel" class="table table-striped table-hover" style="width:100%"> 
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Dosis</th>
                            <th>Indikasi</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th class="text-center"><button type="button" class="btn btn-primary btn-sm" id="btn-tambah" data-toggle="modal" data-target="#modal-info"> Tambah</button></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        
        
    </div>
    <br>
    {{-- modal --}}
  <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
        <div class="modal-content bg-info">
            <div class="modal-header">
            <h4 class="modal-title">Data Obat</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            
                <form action="{{route('obat.store')}}" method="post" id="forms">
                    @csrf
                    <div class="form-group">
                        <label for=""> Nama Obat</label>
                        <input type="text" class="form-control" id="nama" autocomplete="off" name="nama" placeholder="Nama Obat">
                        <input type="text" hidden class="form-control" id="id" name="id" autocomplete="off" placeholder="Nama Obat">
                    </div>
                    <div class="form-group">
                        <label for=""> Kode</label>
                        <input type="text" maxlength="8" class="form-control" id="kode" autocomplete="off" name="kode" placeholder="Kode">
                    </div>
                    <div class="form-group">
                        <label for=""> Dosis</label>
                        <input type="text" class="form-control" id="dosis" name="dosis" autocomplete="off" placeholder="Dosis">
                    </div>
                    <div class="form-group">
                        <label for=""> Indikasi</label>
                        <input type="text" class="form-control" id="indikasi" autocomplete="off" name="indikasi" placeholder="Indikasi">
                    </div>
                    <div class="form-group">
                        <label for=""> Kategori</label>
                        <select name="kategori" id="kategori" class="form-control select2bs4">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for=""> Satuan</label>
                        <select name="satuan" id="satuan" class="form-control select2bs4">
                            <option value="">Pilih Satuan</option>
                            @foreach ($satuan as $item)
                                <option value="{{ $item->id }}">{{ $item->satuan }}</option>
                            @endforeach
                        </select>
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
                url : "{{route('obat.index')}}"
            },
            columns: [
                { data: 'nama', name: 'nama' },
                { data: 'kode', name: 'kode' },
                { data: 'dosis', name: 'dosis' },
                { data: 'indikasi', name: 'indikasi' },
                { data: 'kategoris', name: 'kategoris' },
                { data: 'satuans', name: 'satuans' },
                { data: 'aksi', name: 'aksi', orderable: false }
            ]
        })
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
                $("#forms")[0].reset();
                toastr.success(res.text, 'Sukses')
            },
            error : function (xhr) {
                toastr.error(xhr.responseJSON.text, 'Gagal')
            }
        })
    })
    
    // edit
    $(document).on('click', '.edit', function () {
        $('#forms').attr('action',"{{route('obat.updates')}}")
        let id = $(this).attr('id')
        $.ajax({
            url : "{{ route('obat.edits') }}",
            type : 'post',
            data : {
                id : id,
                _token : "{{ csrf_token() }}"
            },
            success: function (res) {
                //  console.log(res);
                 $('#id').val(res.id)
                 $('#nama').val(res.nama)
                 $('#kode').val(res.kode)
                 $('#dosis').val(res.dosis)
                 $('#indikasi').val(res.indikasi)
                 $('#kategori').val(res.kategori)
                 $('#satuan').val(res.satuan)
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
                    url : "{{ route('obat.hapus') }}",
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

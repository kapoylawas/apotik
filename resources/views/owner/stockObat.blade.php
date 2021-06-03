<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

  
    <div class="card card-primary">
              <div class="card-header">
                <h6 class="text-center">Data Stock Obat</h6>
              </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table id="tabel" class="table table-striped table-hover" style="width:100%"> 
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Obat</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stock</th>
                            <th>Keterangan</th>
                            <th>Update Terakhir</th>
                            <th>Admin</th>
                            <th class="text-center"><button type="button" class="btn btn-primary btn-sm" id="btn-tambah" data-toggle="modal" data-target="#modal-info"> Tambah</button></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <br>
</div>

{{-- modal --}}
    <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
                <div class="modal-header">
                <h4 class="modal-title">Stock Obat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
            
                    <form action="{{route('stock.store')}}" method="post" id="forms">
                        @csrf
                        <div class="form-group">
                            <label for=""> Pilih Obat</label>
                            <select name="namaObat" id="namaObat" class="form-control select2bs4">
                                <option value="">Pilih Kategori</option>
                                @foreach ($obat as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            Stock Obat
                            <hr style="border: 1px solid red">
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">Stock Awal</label>
                                    <input type="text" class="form-control" readonly autocomplete="off" value="0" name="stocklama" id="stockLama" class="form-control">
                                    <input type="hidden" hidden class="form-control" hidden autocomplete="off" name="id" id="id" hidden class="form-control">
                            </div> 
                            <div class="form-group col-md-4">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">masuk</label>
                                    <input type="text" class="form-control" onkeypress="return number(event)" autocomplete="off" value="0" name="masuk" id="masuk" class="form-control">
                            </div> 
                            <div class="form-group col-md-4">
                                    <label class="mr-sm-2" for="inlineFormCustomSelect">keluar</label>
                                    <input type="text" class="form-control" onkeypress="return number(event)" autocomplete="off" value="0" name="keluar" id="keluar" class="form-control">
                            </div> 
                        </div>
                        
                        <div class="form-group">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Stock Akhir</label>
                            <input type="text" class="form-control" onkeypress="return number(event)" autocomplete="off" name="stock" id="stock" class="form-control" placeholder="Stock Akhir">
                        </div>

                        <div>
                            Stock Obat
                            <hr style="border: 1px solid red">
                        </div>
                        
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Harga Beli</label>
                            <input type="text" class="form-control" onkeypress="return number(event)" autocomplete="off" maxlength="12" name="beli" id="beli" class="form-control" placeholder="Harga Beli">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2" for="inlineFormCustomSelect">Harga Jual</label>
                            <input type="text" class="form-control" onkeypress="return number(event)" autocomplete="off" maxlength="12" name="jual" id="jual" class="form-control" placeholder="Harga Jual">
                        </div>
                    </div>

                        <div class="form-group">
                            <label for="formGroupExampleInput2">Tanggal Expired</label>
                            <input type='text' class='datepicker-here form-control' autocomplete="off"  data-language="en" data-date-format="yyyy-mm-dd" name="expired" id="expired" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Keterangan</label>
                            <input type="text" class="form-control" autocomplete="off" name="keterangan" id="keterangan" placeholder="keterangan">
                        </div>
                        
                        <button type="submit" id="simpan" class="btn btn-outline-light btn-success btn-block">Save</button>
                        <button type="button" id="btn-tutup" hidden class="btn btn-outline-light btn-danger btn-block" data-dismiss="modal">Close</button>
                        {{-- <div class="modal-footer justify-content-between">
                            
                        </div> --}}
                    </form>
               </div>
         
        </div>
    </div>
  <!-- /.modal -->
</x-app-layout>
@stack('js')
<script src={{asset("plugins/datatables/jquery.dataTables.js")}}></script>
<script src={{asset('dist\js\datepicker.min.js')}}></script>
<script src={{asset('dist\js\i18n\datepicker.en.js')}}></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function () {
        loaddata()
    })

    function loaddata() {
        $('#tabel').DataTable({
            serverside: true,
            processing: true,
            language: {
               url: "{{ asset('js/bahasa.json') }}"
            },
            ajax : {
                url : "{{route('stock.index')}}"
            },
            columns: [
                {
                  data:null,
                  "sortable": false,
                 render: function (data, type, row, meta) {
                     return meta.row + meta.settings._iDisplayStart + 1;
                 }
                },
                { data: 'namaObat', name: 'namaObat' },
                { data: 'beli', name: 'beli' },
                { data: 'jual', name: 'jual' },
                { data: 'stock', name: 'stock' },
                { data: 'keterangan', name: 'keterangan' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'admins', name: 'admins' },
                { data: 'aksi', name: 'aksi', orderable: false }
            ]
        })
    }
    // fungsi tambah data
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


    function number(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) 
                return false;
            return true;
    }

    $(document).on('change', '#namaObat', function () {
        let id = $(this).val()
        $.ajax({
            url : "{{ route('getObat') }}",
            type : 'post',
            data : {
                id : id,
                _token : "{{ csrf_token() }}"
            },success: function (res) {
                $('#stockLama').val(res.data.stock)
                console.log(res);
            },error: function (xhr) {
                console.error(xhr);
            }
        })
    })

     $(document).on('blur', '#masuk', function () {
         let awal = parseInt($('#stockLama').val())
         let masuk = parseInt($('#masuk').val())
         let keluar = parseInt($('#keluar').val())
         let akhir = (awal + masuk)- keluar
         $('#stock').val(akhir)
     })
     $(document).on('blur', '#keluar', function () {
         let awal = parseInt($('#stockLama').val())
         let masuk = parseInt($('#masuk').val())
         let keluar = parseInt($('#keluar').val())
         let akhir = (awal + masuk)- keluar
         $('#stock').val(akhir)
     })

</script>

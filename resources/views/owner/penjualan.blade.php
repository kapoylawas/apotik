<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row">
                    <div class="col-md-4 card card-danger">
                        <div class="card-header">
                            <h3 class="card-title"> data customer</h3>
                        </div>
                        <hr style="border: 1px solid red">
                         <form action="" method="post" id="sample_form">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama pasien</label>
                                <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" placeholder="Nama Lengkap">
                                <input type="text" class="fomr-control" name="id" id="id" hidden>
                            </div>
                            <div class="form-group">
                                <label class="mr-sm-2" for="">Nama Telp</label>
                                <input type="text" aria-label="telp" class="form-control" name="telp" id="telp" maxlength="12" autocomplete="off" placeholder="No Telp" onkeypress="return number(event)">
                            </div>
                            <div class="form-group">
                                <label class="mr-sm-2" for="">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5" placeholder="alamat pasien"></textarea>
                            </div>
                            <hr style="border: 1px solid red">
                            <div class="cols-12">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="">Nomer Resep</label>
                                         <input type="text" class="form-control" autocomplete="off" name="no_resep" id="no_resep" placeholder="Isi jika ada resep">   
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="">Pengirim</label>
                                         <input type="text" class="form-control" autocomplete="off" name="pengirim" id="pengirim" placeholder="Pengirim">   
                                    </div>
                                </div>
                            </div>
                            <hr style="border: 1px solid red">
                        
                        </div>
                        <div class="col-md-8 card">
                            <div class="card header">
                                <h3 class="card-title-danger"> Data pembelian</h3>
                            </div>
                            <br>
                            <div class="row">
                                <div class="form-group col-3">
                                    <label>Obat</label>
                                    <select class="custom-select mr-sm-2 js-example-basic-single form-control" name="obat" id="obat">
                                        <option value="">pilih</option>
                                        @foreach ($obat as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Stock tersedia</label>
                                    <input type="text" class="stock form-control" readonly name="stock" id="stock">
                                </div>
                                <div class="form-group col-3">
                                    <label for="">No kwintasi</label>
                                    <input type="text" class="form-control" readonly name="no" id="no" readonly value="{{$nomer}}">
                                </div>
                                <div class="form-group col-3">
                                    <label for="">Tanggal</label>
                                    <input type="text" class="form-control" readonly name="tanggal" id="tanggal" readonly value="{{$tanggals}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="">Jumlah Pembelian</label>
                                    <div class="btn-group" role="group" aria-label="Basic mixed style example">
                                        <button type="button" class="btn btn-danger btn-sm">-</button>
                                        <input type="text" id="qty" name="qty" class="form-control-sm-2">
                                        <button type="button" class="btn btn-success btn-sm">+</button>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="form-group col-4">
                                    <label>Harga @satuan</label>
                                    <input type="text" class="form-control" onkeypress="return number(event)" max="3" name="harga" id="harga" disabled>
                                </div>
                                <div class="form-group col-4">
                                    <label>Diskon</label>
                                    <input type="text" class="form-control" onkeypress="return number(event)" max="3" name="diskon" id="diskon">
                                </div>
                                <div class="form-group col-4">
                                    <label>Total Harga</label>
                                    <input type="text" class="form-control" onkeypress="return number(event)" name="total" id="total" readonly>
                                </div>
                            </div>
                            <hr style="border: 1px solid red">
                            <div>
                                <button type="submit" id="tambah" name="tambah" class="btn btn-success"><i class="far fa-save"></i> Simpan</button>
                                </form>
                                <button type="submit" id="buka" name="buka" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Obat</button>
                            </div>
                            <hr style="border: 1px solid red">
                            <br>
                            <br>
                            <div class="card card-danger table-responsive">
                                <table class="table table-bordered table-striped table-sm" id="tabel1">
                                    <thead>
                                        <tr>
                                            <th>NO.</th>
                                            <th>Nama Obat</th>
                                            <th>QTY</th>
                                            <th>Harga</th>
                                            <th>Total Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-3">

                                </div>
                                <div class="col-3">

                                </div>
                                <div class="col-3">

                                </div>

                                <button type="button" id="btn-bayar" name="btn-bayar" data-toggle="modal" id="btn-modal" data-target="#modal-seceondary" class="btn btn-danger">
                                    proses
                                </button>

                            </div>
                        </div>
                </div>
                
            </div>
            
        </div>
    </div>
    <br>
</x-app-layout>
@stack('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}

<script>
    $(document).ready(function () {
        $('#obat').select2();
    })

    //  $('#obat').change( function () {
    //     let id = $(this).val()
    //     $.ajax({
    //         url : {{ route('getDataObat') }},
    //         type : 'post',
    //         data : { 
    //          id : id, 
    //         _token : "{{csrf_token()}}"
    //         },success: function (res) {
    //             console.log(res);
    //         },error: function (xhr) {
    //             console.error(xhr);
    //         }
    //     })
    // })

    $(document).on('change', '#obat', function () {
        let id = $(this).val()
        $.ajax({
            url : "{{ route('getDataObat') }}",
            type : 'post',
            data : {
                id : id,
                _token : "{{ csrf_token() }}"
            },success: function (res) {
                console.log(res);
                $('#harga').val(res.jual)
                $('#stock').val(res.stock)
            },error: function (xhr) {
                console.error(xhr);
            }
        })
    })

    function number(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) 
                return false;
            return true;
    }

   
</script>

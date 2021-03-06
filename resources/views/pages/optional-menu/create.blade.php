@extends('layouts.app', ['title' => __('Adding Menu')])

@section('content')
@include('users.partials.header', ['title' => __('Tambah Optional Menu')])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xs-12 col-md-5">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-6">
                                Tambah Optional Menu
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-icon btn-primary btn-sm" href="{{ route('menu.show', $menu->id) }}">
                                    <span class="btn-inner--text">kembali</span>
                                    <span class="btn-inner--icon"><i class="fas fa-reply"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('optional-menu.store', [
                        'menu_id' => $menu->id
                        ]) }}" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label" for="name">Nama</label>
                                    <input class="form-control" type="text" name="name" id="name" placeholder="nama opsi pilihan" required />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="category">Kategori</label>
                                    <input class="form-control" name="category" id="category" placeholder="nasi" required />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="price">Harga</label>
                                    <input class="form-control" type="number" name="price" id="price" placeholder="harga makanan" required />
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button class="btn btn-icon btn-warning" type="cancel">
                                            <span class="btn-inner--icon"><i class="fas fa-times"></i></span>
                                            <span class="btn-inner--text">cancel</span>
                                        </button>
                                        <button class="btn btn-icon btn-success" type="submit">
                                            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                                            <span class="btn-inner--text">submit</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection
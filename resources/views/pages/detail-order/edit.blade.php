@extends('layouts.app', ['title' => __('Edit Pesanan')])

@section('content')
@include('users.partials.header', ['title' => __('Edit Pesanan')])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xs-12 col-md-5">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-6">
                                Edit Pesanan
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-icon btn-primary btn-sm" href="{{ route('order.show', $order) }}">
                                    <span class="btn-inner--text">kembali</span>
                                    <span class="btn-inner--icon"><i class="fas fa-reply"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('detail-order.update', [
                      'code' => $pivot->order->code,
                      'menu' => $pivot->menu->id,
                      'antar' => $pivot->antar
                    ]) }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label" for="menu">Menu</label>
                                    <input class="form-control" type="text" name="menu" id="menu" value="{{ $pivot->menu->name }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="status">Status</label>
                                    <select id="status" class="form-control" name="status">
                                      @foreach ($pivot->daftar['status'] as $status)
                                        <option value="{{ $status }}" {{ $pivot->status==$status ? 'selected' : ''}}>
                                          {{ ucwords($status) }}
                                        </option>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="total">Jumlah</label>
                                    <input class="form-control" type="number" name="total" id="total" value="1" {{ $pivot->order->package->total_items > 0 ? 'readonly' : '' }} required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="antar">Tanggal Antar</label>
                                    <input type="date" name="antar" class="form-control" value="{{ $pivot->antar }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="optional">Menu Pengganti</label>
                                    <select id="optional" class="form-control" name="optional">
                                      <option>-</option>
                                      @foreach ($options as $option)
                                        <option value="{{ $option }}">
                                        {{ ucwords($option) }}
                                        </option>
                                      @endforeach
                                    </select>
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

@push('js')
  <script charset="utf-8">
    $(document).ready(function() {
      const temp = {!! json_encode($menus) !!}
      $('#menu')
      .autocomplete({
        minLength: 0,
        source: temp,
        focus: function(e, ui) {
          $('#menu').val(ui.item.name)
          $('#price').val(`Rp ${ui.item.price.toLocaleString('id')}`)
          return false
        },
        select: function(e, ui) {
          $('#menu').val(ui.item.name)
          $('#price').val(`Rp ${ui.item.price.toLocaleString('id')}`)
          return false
        }
      })
      .autocomplete('instance')._renderItem = function(ul, item) {
        return $("<li>")
          .append(`${item.name} | Rp ${item.price.toLocaleString('id')}`)
          .appendTo(ul)
      }
    })
  </script>
@endpush

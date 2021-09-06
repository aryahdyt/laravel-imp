@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">{{ __('Products') }}</div>

        <div class="card-body">
          <a href="{{ route('product.create') }}" class="btn btn-primary mb-2">Tambah</a>

          <table id="productTable" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Merchant Name</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
  $(function () {
  
  var table = $('#productTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('products.list') }}",
      columns: [
          // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'name', name: 'name'},
          {data: 'merchant', name: 'merchant.merchant_name'},
          {data: 'price', name: 'price'},
          {data: 'status', name: 'status'},
          {
              data: 'action', 
              name: 'action', 
              orderable: true, 
              searchable: true
          },
      ]
  });
  
});
</script>
@endpush
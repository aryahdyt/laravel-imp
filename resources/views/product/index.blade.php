@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Products') }}</div>

        <div class="card-body">
          <a href="{{ route('products.create') }}" class="btn btn-primary mb-2">Tambah</a>

          <table id="producttable" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
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
  
  var table = $('#producttable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('get.product') }}",
      columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
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
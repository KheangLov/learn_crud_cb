@extends("crudbooster::admin_template")
@section("content")
  <!-- Your custom  HTML goes here -->
  <table class='table table-striped table-bordered'>
    <thead>
        <tr>
          <th>Name</th>
          <th>Name Khmer</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
      @foreach($result as $row)
        <tr>
          <td>{{$row->first_name . $row->last_name}}</td>
          <td>{{$row->name_khmer}}</td>
          <td>{{$row->email}}</td>
          <td>
            <!-- To make sure we have read access, wee need to validate the privilege -->
            @if(CRUDBooster::isUpdate() && $button_edit)
            <a class='btn btn-success btn-sm' href='{{CRUDBooster::mainpath("edit/$row->id")}}'>Edit</a>
            @endif
            
            @if(CRUDBooster::isDelete() && $button_edit)
            <a class='btn btn-success btn-sm' href='{{CRUDBooster::mainpath("delete/$row->id")}}'>Delete</a>
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <!-- ADD A PAGINATION -->
  <p>{!! urldecode(str_replace("/?","?",$result->appends(Request::all())->render())) !!}</p>
  @push('bottom')
    <script src="{{ asset('js/app.js') }}"></script>
    @include('sweet::alert')
  @endpush
@endsection
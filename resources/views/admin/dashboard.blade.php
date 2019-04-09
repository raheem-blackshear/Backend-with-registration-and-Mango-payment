@extends('admin.layouts.app')

@section('content')

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title">Richieste di contratto</h4>
          </div>
          <div class="card-body table-responsive">
            <div class="row">
              <div class="col-md-12">
                @if(session()->has('message'))
                  <div class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
                @endif
              </div>
            </div>
            
            
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                        <input id="myInput" class="" type="text" placeholder="Search..">
                    </div>
                </div>
            </div>
            
            
            
            
            <table class="table table-hover">
              <thead class="text-warning">
              <th>Sr.</th>
              <th>Nome</th>
              <th>Username</th>
              <th>Status</th>
              <th>Registrato</th>
              <th>Azione</th>
              </thead>
              <tbody id="myTable">
              @foreach($merchants as $index => $merchant)
                <tr>
                  <td>{{ ++$index }}</td>
                  <td>{{ $merchant->nome_cognome }}</td>
                  <td>{{ $merchant->username }}</td>
                  <td>
                    @if(empty($merchant->email_verified_at))
                      <p>Not Approved</p>
                    @else
                      <p>Approved</p>
                    @endif
                  </td>
                  <td>
                    @if(empty($merchant->r_completed_at))
                      <p>Not Registrato</p>
                    @else
                      <p>Registrato</p>
                    @endif
                  </td>
                  <td class="td-actions text-right">
                    <a href="{{ route('view-merchant', $merchant->id) }}" rel="tooltip" title="View" class="btn btn-success btn-link btn-sm">
                      <i class="material-icons">remove_red_eye</i>
                    </a>
                    
                    @if(empty($merchant->r_completed_at))
                      <a href="{{ route('approve-merchant', $merchant->id) }}" rel="tooltip" title="Approve" class="btn btn-info btn-link btn-sm">
                        <i class="material-icons">
                          touch_app
                        </i>
                      </a>
                    @endif
                     {{-- <a href="#" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" data-href="{{ route('remove-merchant', $merchant->id) }}" onclick="confirmDeletion(this.getAttribute('data-href'))">
                      <i class="material-icons">close</i> --}}
                    </a>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <div class="row">
              <div class="col-md-4">{{ $merchants->links() }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
    function confirmDeletion(url){
        if(!confirm("Are you sure you want to remove merchant ?")){
           return false;
        }else{
          window.location.href = url;
        }
    }
</script>
@endsection

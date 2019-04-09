@extends('admin.layouts.app')



@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Aggiungi Categoria</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('add-category') }}" method="POST">
                        @csrf
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
                                    <label class="bmd-label-floating">Nome</label>
                                    <input type="text" class="form-control" name="category" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Aggiungi Categoria</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>



    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-header card-header-warning">
                <h4 class="card-title">Categorie</h4>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-hover">
                  <thead class="text-warning">
                      <th>Sr.</th>
                      <th>Nome</th>
                      <th>Azione</th>
                  </thead>
                  <tbody>
                  @foreach($categories as $index => $category)
                    <tr>
                      <td>{{ ++$index }}</td>
                      <td>{{ $category->nome }}</td>
                      <td class="td-actions text-right">
                        <a href="{{ route('edit-category', $category->id) }}" rel="tooltip" title="Edit" class="btn btn-success btn-link btn-sm">
                          <i class="material-icons">edit</i>
                        </a>
                         {{-- <a href="#" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" data-href="{{ route('remove-category', $category->id) }}" onclick="confirmDeletion(this.getAttribute('data-href'))">
                          <i class="material-icons">close</i>
                        </a> --}}
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                <div class="row">
                  <div class="col-md-4">{{ $categories->links() }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

<script type="text/javascript">
    function confirmDeletion(url){
        if(!confirm("Are you sure you want to this category ?")){
           return false;
        }else{
          window.location.href = url;
        }
    }
</script>
@endsection
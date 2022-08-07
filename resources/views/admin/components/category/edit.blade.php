@extends("admin.layouts.index")
@section("content")
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit</h1>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Category</h3>
                        </div>
                        <div class="card-body">
                            {!! form::open(['route'=>['categories.update',$category],'id'=>'form-data'] ) !!}
                            @method('PATCH')
                            {{csrf_field()}}
                            @include('admin.components.category.fields')
                            {!!form::close()!!}
                            <button type="submit" class="btn btn-block btn-success" onclick="$('#form-data').submit()">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



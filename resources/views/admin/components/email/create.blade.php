@extends("admin.layouts.index")
@section("content")
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create</h1>
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
                            <div class="col-md-2">
                                <h3 class="card-title">Create Email</h3>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('mails.importView') }}" type="button" class="btn btn-block btn-primary btn-md">Import</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! form::open(['route'=>['emails.store',$email],'id'=>'form-data'] ) !!}
                            @method('POST')
                            {{csrf_field()}}
                            @include('admin.components.email.fields')
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



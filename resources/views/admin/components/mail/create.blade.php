@extends("admin.layouts.index")
@section("content")
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <h3 class="card-title">Create Mail</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! form::open(['route'=>['mails.store',$mail],'id'=>'form-data'] ) !!}
                            @method('POST')
                            {{csrf_field()}}
                            @include('admin.components.mail.fields')
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



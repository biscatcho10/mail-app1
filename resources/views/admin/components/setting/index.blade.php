@extends("admin.layouts.index")
@section("content")

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Settings</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                {!! form::open(['route'=>['settings.update'],'id'=>'form-data', 'method'=>"post"] ) !!}
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 30%">
                            Name
                        </th>
                        <th style="width: 30%">
                            Value
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @csrf
                    @foreach($settings as $setting)
                        <tr>
                            <td>
                                <span>
                                    {{$setting['message']}}
                                </span>
                            </td>
                            <td>
                                {{ form::text($setting['type'], $setting['value'], ['class'=>'form-control']) }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!!form::close()!!}
                <button type="submit" class="btn btn-success float-right m-3" onclick="$('#form-data').submit()">Save
                    Changes
                </button>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection

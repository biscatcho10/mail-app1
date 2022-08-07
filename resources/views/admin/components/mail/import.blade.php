@extends("admin.layouts.index")
@section("content")
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1>Import</h1>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-block btn-primary btn-md" onclick="download()">Download
                        Template
                    </button>
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
                            <h3 class="card-title">Create Mail</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('mails.import') }}" method="POST" id="import"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        {{ form::label('import','Add the excel file')}}
{{--                                        <input type="file" name="file" class="form-control">--}}

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
{{--                                            <div class="input-group-append">--}}
{{--                                                <span class="input-group-text">Upload</span>--}}
{{--                                            </div>--}}
                                        </div>

                                        <br>
                                    </div>
{{--                                    <div class="col-sm-6">--}}
{{--                                        <!-- textarea -->--}}
{{--                                        <div class="form-group">--}}
{{--                                            {{ form::label('subject','Subject')}}--}}
{{--                                            {{form::text('subject',null,['class'=>'form-control','placeholder'=>'Subject'])}}--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
{{--                                <div class="row">--}}
{{--                                    <div class="col-sm-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            {{ form::label('message','Message')}}--}}
{{--                                            --}}{{--                                        {{form::textarea('message',null,['class'=>'form-control','placeholder'=>'Message'])}}--}}
{{--                                            <textarea class="ckeditor form-control" name="message"--}}
{{--                                                      style="width: 100%"></textarea>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                        </div>
{{--                        <div>--}}
{{--                            <button type="button" class="btn btn-block btn-default mb-2"--}}
{{--                                    onclick="$('#datetime').toggle()">Schedule--}}
{{--                            </button>--}}
{{--                        </div>--}}

{{--                        <div class="form-group" id="datetime" style="display:none">--}}
{{--                            <label>Date and time Schedule Mail:</label>--}}
{{--                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">--}}
{{--                                <input type="text" name="datetime" class="form-control datetimepicker-input"--}}
{{--                                       data-target="#reservationdatetime">--}}
{{--                                <div class="input-group-append" data-target="#reservationdatetime"--}}
{{--                                     data-toggle="datetimepicker">--}}
{{--                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <button type="submit" class="btn btn-block btn-success" onclick="$('#import').submit()">
                            Submit
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>




    <script>
        $(function () {
            $('.ckeditor').ckeditor();
        })

        function download() {
            // e.preventDefault();  //stop the browser from following
            window.location.href = '/templates/mails.xlsx';
            $('#modal-sm').modal('hide');
        }
    </script>
@endsection


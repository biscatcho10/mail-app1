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
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="file" class="custom-file-input"
                                                       id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                    file</label>
                                            </div>
                                        </div>

                                        <br>
                                    </div>
                                </div>
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
            window.location.href = '/templates/mails.xlsx';
            $('#modal-sm').modal('hide');
        }
    </script>
@endsection


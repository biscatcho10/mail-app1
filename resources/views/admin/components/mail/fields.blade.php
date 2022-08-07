{{--@dd($mail->sent_time)--}}
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Emails</label>
            <select class="select2 justify-content-xl-center" id="emailSelect" name="emails[]" multiple="multiple"
                    data-placeholder="Select category" style="width: 100%;">
                @foreach($emails as $email)
                    @if(Route::getCurrentRoute()->getActionMethod() != "edit")
                        <option data-select2-id="{{$email}}">{{ $email }}</option>
                    @else
                        <option
                            data-select2-id="{{$email}}" {{in_array($email, json_decode($mail->receiver)) ? "selected" : ""}}>{{ $email }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Categories</label>
            <select class="select2 justify-content-xl-center" id="categorySelect" name="categories[]"
                    multiple="multiple" data-placeholder="Select category" style="width: 100%;">
                @foreach($categories as $category)
                    <option class="categoryOption" onclick="selectEmails($(this))"
                            data-select2-id="{{$category}}">{{ $category }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            {{ form::label('subject','Subject')}}
            {{form::text('subject',$mail->subject,['class'=>'form-control','placeholder'=>'Subject'])}}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            {{ form::label('message','Message')}}
            <textarea class="ckeditor form-control" name="message"
                      style="width: 100%">{{$mail->message}}</textarea>
        </div>
    </div>
</div>

<div>
    <button type="button" class="btn btn-block btn-default mb-2 schedule-panel">
        Schedule
        <input type="hidden" name="is_schedule" value="{{$mail->scheduled ?  "1" : "0"}}">
    </button>
</div>


<div class="form-group" id="datetime" style="{{!$mail->scheduled ?  "display:none" : ""}}">
    <label>Date and time Schedule Mail:</label>
    {{$mail->sent_time ? \Carbon\Carbon::parse($mail->sent_time)->format("m/d/Y g:i A") : null}}
    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
        <input type="text" name="datetime" class="form-control datetimepicker-input"
               value="{{$mail->sent_time ? \Carbon\Carbon::parse($mail->sent_time)->format("m/d/Y g:i A") : null}}"
               data-target="#reservationdatetime">
        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        $(".schedule-panel").click(function () {
            $("#datetime").toggle();
            $("input[name='is_schedule']").attr("value", parseInt($("input[name='is_schedule']").attr("value")) ? 0 : 1)
        })

        $('#categorySelect').on('select2:select', function (e) {
            var name = e.params.data.id;
            $.ajax({
                data: {"_token": "{{csrf_token()}}", name},
                type: 'GET',
                url: '{{route("fetch-emails")}}',
                success: function (data) {
                    if (data !== []) {
                        console.log(data)
                        var emails = $('#emailSelect').val();
                        for (var i = 0; i < data.length; i++) {
                            emails.push(data[i])
                        }
                        $('#emailSelect').val(emails).trigger('change')
                    }
                }
            });
        });
        $('.select2').select2({
            theme: 'bootstrap4',
            multiple: true,
            allowClear: true,
            tags: true,
        })

    });
</script>

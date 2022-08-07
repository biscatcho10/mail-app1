<div class="row">
    <div class="col-sm-6">
        <!-- textarea -->
        <div class="form-group">
            {{ form::label('name','Name')}}
            {{form::text('name',$email->name,['class'=>'form-control','placeholder'=>'Name'])}}
        </div>
    </div>
    <div class="col-sm-6">
        <!-- textarea -->
        <div class="form-group">
            {{ form::label('email','Email')}}
            {{form::text('email',$email->email,['class'=>'form-control','placeholder'=>'Email'])}}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Category</label>
            {{Form::select("category_id[]", $categories, $selectedCategories , ['class' => 'select2 form-control justify-content-xl-center', "multiple"=>"multiple"])}}
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.select2').select2({
            theme: 'bootstrap4',
            multiple: true,
            allowClear: true,
            tags: true,
        })
    })
</script>

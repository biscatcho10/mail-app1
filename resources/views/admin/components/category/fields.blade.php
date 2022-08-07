<div class="row">
    <div class="col-sm-12">
        <!-- textarea -->
        <div class="form-group">
            {{ form::label('name','Name')}}
            {{form::text('name',$category->name,['class'=>'form-control','placeholder'=>'Name'])}}
        </div>
    </div>
</div>



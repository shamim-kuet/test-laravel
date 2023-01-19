{!! BootForm::open(['model' => $model, 'store' => 'board.store', 'update' => 'board.update','class'=>'form-horizontal']);
!!}
<div class="form-row">
    <div class="col-md-6 col-12">
        {!! BootForm::text('board_name', 'Board Name', null,
        ['placeholder'=>'Enter name','required'=>'required'] ) !!}

    </div>
    <div class="col-md-6 col-12">
        {!! BootForm::text('board_code', 'Board Code', null,
        ['placeholder'=>'Enter Code','required'=>'required'] ) !!}

    </div>
</div>
{!! BootForm::submit('Submit',['class'=>'btn btn-primary waves-effect waves-float waves-light']) !!}
<!-- <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button> -->
{!! Bootform::close() !!}
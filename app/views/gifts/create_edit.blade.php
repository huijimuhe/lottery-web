@extends('layout.default')
@section('title')
@if (isset($gift))
编辑奖品
@else
新建奖品
@endif   
@stop

@section('content')

<div class="row "> 
    @if (isset($gift))
    {{ Form::model($gift, ['route' => ['gifts.update', $gift->id], 'method' => 'patch']) }}
    @else
    {{ Form::open(['route' => 'gifts.store', 'method' => 'post', 'files' => true]) }}
    @endif  

    <div class="col-lg-12">    
        <div class="box">
            <div class="box-header"> 
                <h3 class="box-title">编辑内容</h3> 
            </div><!-- /.box-header -->
            <div class="box-body pad">   
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">名称</label> 
                        {{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'请输入名称' )) }}
                    </div>
                </div> 
                <div class="box-body">
                    <div class="form-group">
                        <label for="grade">等级</label> 
                        {{ Form::text('grade',null,array('class' => 'form-control','placeholder'=>'请输入等级' )) }}
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="rate">中奖率</label> 
                        {{ Form::text('rate',null,array('class' => 'form-control','placeholder'=>'请输入中奖率' )) }}
                    </div>
                </div> 
            </div>
            <div class="box-footer">
                {{ Form::submit('确定', array('class' => 'btn btn-lg btn-primary btn-block')) }} 
            </div>
        </div>
        <!-- general form elements --> 
        {{Form::close()}} 
    </div>
</div>
@stop
@section('scripts') 
<script type="text/javascript">
    $(function() {
//bootstrap WYSIHTML5 - text editor
// $(".textarea").wysihtml5(); 
</script>
@stop
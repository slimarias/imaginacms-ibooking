@php
	$op = array('required' => 'required');
@endphp

{!! Form::i18nInput('title',trans('ibooking::common.table.title'), $errors,$lang,null,$op) !!}

{!! Form::i18nInput('slug','Slug', $errors,$lang,null) !!}

{!! Form::i18nTextarea('summary', trans('ibooking::common.table.summary'),$errors,$lang,null,array('class'=>'form-control','rows'=>4)) !!} 

{!! Form::i18nTextarea('description', trans('ibooking::common.table.description'),$errors,$lang,null) !!} 
{{--


    {!! Form::open(['route' => [$entity['url'].'.update-destroy', $id], 'method' => 'delete', 'data-model' => $entity['targetModel'], 'id' => "{$entity['targetModel']}_$id"]) !!}
    {!! Form::hidden('process', 'delete') !!}
    <div class="btn-group link_type_btn" role="group">
        <button type="button" class="">{{$label}}</button>
        <button type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            @if (!in_array($state, ['deleted']))

            <a class="dropdown-item" href="{!! route('job-detail', $model->employerJob->slug) !!}" title="Show Job">
                 Show
            </a>

            @endif

            <div role="separator" class="dropdown-divider"></div>
            @include('components.state_ajax_link', ['id' => $id, 'entity' => $entity, 'state' => $state])

        </div>
    </div>
{!! Form::close() !!}
 --}}

 {!! Form::open(['route' => [$entity['url'].'.update-destroy', $id], 'method' => 'delete', 'data-model' => $entity['targetModel'], 'id' => "{$entity['targetModel']}_$id", 'button-type' => 'button']) !!}
 {!! Form::hidden('process', 'delete') !!}
 @include('favorite_jobs.front_delete_link', ['class' => 'text-danger pr-3', 'entity' => $entity, 'id' => $id, 'msg' =>'Do you want to delete this job?'])
{!! Form::close() !!}




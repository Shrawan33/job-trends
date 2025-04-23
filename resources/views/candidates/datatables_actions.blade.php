
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-{{$color}} btn-sm">{{$label}}</button>
        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            @include('components.show_link', ['class' => 'dropdown-item', 'entity' => $entity, 'id' => $id, 'text' => '<i class="fa fa-eye"></i> Show'])


        </div>
    </div>



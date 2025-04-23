<div class="btn-group" role="group">
    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Action
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        @include('components.show_link', [
            'class' => 'dropdown-item',
            'entity' => $entity,
            'id' => $id,
            'text' => '<i class="fa fa-eye"></i> Show',
        ])
        @php
            $isApproved = $model->isApproved();

        @endphp

        @if (!$isApproved)
            @include('components.approve_disapprove', [
                'class' => 'dropdown-item',
                'entity' => $entity,
                'id' => $id,
                'text' => '<i class="fa fa-check"></i> Approve',
                'action' => 'approve',
            ])
        @else
            @include('components.approve_disapprove', [
                'class' => 'dropdown-item',
                'entity' => $entity,
                'id' => $id,
                'text' => '<i class="fa fa-times"></i> Disapprove',
                'action' => 'disapprove',
            ])
        @endif

        <a class="dropdown-item" href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to permanently delete ID {{$id}}?')) { document.getElementById('permanentDeleteForm{{$id}}').submit(); }" title="Permanent Delete {!! $entity['singular'] ?? null !!}">
            <i class="fa fa-trash"></i> Permanent Delete
        </a>

        <form id="permanentDeleteForm{{$id}}" action="{{ route('ReviewUser.permenentDelete', ['id' => $id]) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{$id}}">
        </form>

    </div>
</div>

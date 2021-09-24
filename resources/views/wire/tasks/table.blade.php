<a href="#" onclick = "$('#create_task').modal();" class="float-right">[<span class="icon-plus">Crear tarea<span>]</a>
    <br/>
    <select wire:model = "show_archived" class="form-control">
        <option value>Se muestran todas las tareas</option>
        <option value="NO">Mostrar solo tareas activas</option>
        <option value="SI">Mostrar solo tareas archivadas</option>
    </select>
    <br/>
    @include('wire.partials.search')
    @if(count($tasks) <= 0)
    @include('layouts.no_records')
    @else
    {{ $tasks->links('pagination-links') }}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="2%" scope="col"><span class="icon-floppy-disk"></span></th>
                <th width="2%" scope="col"></th>
                <th width="2%" scope="col"></th>
                <th width="20%" scope="col">Autor</th>
                <th width="15%" scope="col">Cliente</th>
                <th width="15%" scope="col">Proyecto</th>
                <th width="25%" scope="col">Tarea</th>
                <th width="25%" scope="col">Descripción</th>
                <th width="20%" scope="col">Usuario</th>
                <th width="10%" scope="col">DeadLine</th>
                <th width="5%" scope="col">Comm</th>
                <th width="10%" scope="col">Estatus</th>
                <th width="5%" scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->archived }}</td>
                <td>
                    @php
                    $context = "";
                    switch ($task->context) {
                        case 'Trabajo':
                            $context = '<span style="display:none">' . $task->context . '</span>' . '<span title="' . $task->context . '" class="icon icon-office" style="color:#9B59B6"></span>';
                            break;
                        case 'Reunión':
                            $context = '<span style="display:none">' . $task->context . '</span>' . '<span title="' . $task->context . '" class="icon icon-users" style="color:#2980B9"></span>';
                            break;
                        case 'Documento':
                            $context = '<span style="display:none">' . $task->context . '</span>' . '<span title="' . $task->context . '" class="icon icon-file-pdf" style="color:#EC7063"></span>';
                            break;
                        case 'Internet':
                            $context = '<span style="display:none">' . $task->context . '</span>' . '<span title="' . $task->context . '" class="icon icon-chrome" style="color:#27AE60"></span>';
                            break;
                        case 'Teléfono':
                            $context = '<span style="display:none">' . $task->context . '</span>' . '<span title="' . $task->context . '" class="icon icon-phone" style="color:#2874A6"></span>';
                            break;
                        case 'Email':
                            $context = '<span style="display:none">' . $task->context . '</span>' . '<span title="' . $task->context . '" class="icon icon-envelop" style="color:#F7DC6F"></span>';
                            break;
                        case 'Hogar':
                            $context = '<span style="display:none">' . $task->context . '</span>' . '<span title="' . $task->context . '" class="icon icon-home" style="color:#5DADE2"></span>';
                            break;
                        case 'Otro':
                            $context = '<span style="display:none">' . $task->context . '</span>' . '<span title="' . $task->context . '" class="icon icon-file-empty" style="color:#D35400"></span>';
                            break;
                        default:
                            $context = $task->context;
                    }
                    echo $context;
                    @endphp
                </td>
                <td>
                    @php
                    $visibility = "";
                    switch ($task->visibility) {
                        case 'Público':
                            $visibility = '<span style="display:none">' . $task->visibility . '</span>' . '<span title="' . $task->visibility . '" class="icon icon-unlocked" style="color:#229954"></span>';
                            break;
                        case 'Privado':
                            $visibility = '<span style="display:none">' . $task->visibility . '</span>' . '<span title="' . $task->visibility . '" class="icon icon-lock" style="color:#C0392B"></span>';
                            break;
                        default:
                            $visibility = $task->visibility;
                    }
                    echo $visibility;
                    @endphp
                </td>
                <td>{{ $task->author['name'] }} {{ $task->author['middle_name'] }} {{ $task->author['last_name'] }}</td>
                <td>
                    @if(!empty($task->company_id))
                    {{ $task->company['name'] }}
                    @else
                    No asignado
                    @endif
                </td>
                <td>
                    @if(!empty($task->sale_id))
                    {{ $task->sale['description'] }}
                    @else
                    No asignado
                    @endif
                </td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->user['name'] }} {{ $task->user['middle_name'] }} {{ $task->user['last_name'] }}</td>
                <td>{{ $task->deadline }}</td>
                <td>
                    <a href="javascript:void(0)" onclick="showTaskCommentsModal({{ $task->id }})"><span id="tbl_count_comments_task_' . $task->id . '">{{ count(\App\TaskComment::where('task_id', $task->id)->get()) }}</span> <span class="icon icon-bubble" style="color:#3498DB;"></span></a>
                </td>
                <td>
                    {{ $task->status }}
                </td>
                <td>
                    @php
                        $btnEdit = "";
                        $btnDelete = "";
                        $btnArchive = '<span onclick="archiveTaskModal(' . $task->id . ');"  title="Archivar..." class="icon icon-share" style="color:#3498DB;cursor:pointer;"></span>';
                        
                        if (Auth::user()->rol_user_id == 1 || Auth::user()->rol_user_id == 2) {
                            $btnEdit = '<span wire:click="edit('.$task->id.')" title="Editar..." class="icon icon-pencil" style="color:#F1C40F;cursor:pointer;"></span>';
                        }

                        if (Auth::user()->rol_user_id == 1) {
                            $btnDelete = '<span onclick="deleteTask(' . $task->id . ');"  title="Eliminar..." class="icon icon-bin" style="color:#C0392B;cursor:pointer;"></span>';
                        }

                        echo $btnEdit .  "&nbsp;&nbsp;" . $btnDelete;
                    @endphp
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @include('comments.index_task_comment_modal')
    @endif
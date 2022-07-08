@foreach($companyUser as $item)
    <tr class="odd wow fadeInUp" id="user-company-{{ $item->id }}">
        <td class="dtr-control sorting_1"
            tabindex="0">{{ $item->id }}</td>
        <td class="name">{{ $item->name }}</td>
        <td>{{ $item->email }}</td>
        <td>{{ $item->status == 1 ? 'enable' : 'disable' }}</td>
        <td>{{ $item->created_at }}</td>
        <td class="d-flex justify-content-center">
            <a href="#" class="btn btn-edit btn-edit-user" data-toggle="modal"
               data-target="#register" data-name="{{ $item->name }}"
               data-email="{{ $item->email }}" data-id="{{ $item->id }}"
               data-status="{{ $item->status }}">
                <i class="fas fa-pen"></i>
            </a>
            <button class="btn btn-delete btn-delete-user ml-2" data-toggle="modal"
               data-target="#modal_confirm_delete_user" data-id="{{ $item->id }}">
                <i class="far fa-trash-alt"></i></button>
            </button>
        </td>
    </tr>
@endforeach
<script>

    // varialbe check use ajax create or update user company
    $(".open-model-user").click(function(){
        $('#form-create-user_company').trigger("reset");
        $('#form-create-user_company').find('.error').hide();
        $('.btn-model-user').html('SAVE');
        $('#form-create-user_company input[name="checkAjax"]').val('create');
    });

    $(".btn-edit-user").click(function(){
        let form = $('#form-create-user_company');
        $('.btn-model-user').html('UPDATE');
        $('#form-create-user_company input[name="checkAjax"]').val('update');
        form.find('.error').hide();
        let id = $(this).data('id');
        let name = $(this).data('name');
        let email = $(this).data('email');
        let status = $(this).data('status');
        form.find('input[name="name"]').val(name);
        form.find('input[name="email"]').val(email);
        form.find('input[name="userId"]').val(id);
        form.find('input[name="password"]').val('');

        let radios = form.find('input[name="status"]');
        if(radios.filter('[value=1]').val() == status) {
            radios.filter('[value=1]').prop('checked', true);
        }else {
            radios.filter('[value=0]').prop('checked', true);
        }
    });


</script>





$(document).ready(function () {
    $('#addSkill').click(function () {
        $('#dynamic_filed').append('' +
            '                                                <tr>\n' +
            '                                                    <td>\n' +
            '                                                        <input type="text" value="" name="skill_required[]" class="form-control">\n' +
            '                                                       <small style="color: red" class="error error_skill_required"></small>\n' +
            '                                                    </td>\n' +
            '                                                    <td id="1">\n' +
            '                                                        <div class="form-control remoteSkill" style="border: none">\n' +
            '                                                            <a class="btn-remote mt-4">\n' +
            '                                                                <i class="fa fa-times" aria-hidden="true"></i>\n' +
            '                                                            </a>\n' +
            '                                                        </div>\n' +
            '\n' +
            '                                                    </td>\n' +
            '                                                </tr>');
    });
    $(document).on('click', '.remoteSkill', function () {
        $(this).parent().parent().remove()
    })
});
//handle upload images priview
let imageArray = [];
let count = -1;
let idImageRemove = [];
let imagePath = [];
$(document).ready(function (){
    $(".remoteImage").hide();
    let placeimagePreview = document.getElementsByClassName("images");

    function fileValidate(file) {
        if (file === 'image/png' || file === 'image/jpg' || file === 'image/gif' || file === 'image/jpeg') {
            return true;
        } else {
            console.log('Image has jpg, gif, jpeg, pdf');
            return false;
        }
    }
    var imagesPreview = function(input, placeimagePreview) {

        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        if (fileValidate(input.files[0].type) === true) {
            reader.onload = function (event) {
                let image;
                image = new Image();
                image.src = event.target.result;
                image.onload = function () {
                    var height = this.height;
                    var width = this.width;
                    if (width / height === (16 / 9)) {
                        imagePath.push(input.files[0]);
                        $(".remoteImage").show();
                        if (input.files) {
                            var filesAmount = input.files.length;
                            for (i = 0; i < filesAmount; i++) {
                                var reader = new FileReader();
                                reader.onload = function(event) {
                                    const  html= '<div class="image-item col-3">\n' +
                                    '                                                <div class="image-show-item">\n' +
                                    '                                                    <img\n' +
                                    '                                                        src="'+image.src+'">\n' +
                                    '                                                </div>\n' +
                                    '                                                <div class="delete-image" data-remove="'+count+'">\n' +
                                    '                                                    <i class="fas fa-solid fa-trash" ></i>\n' +
                                    '                                                </div>\n' +
                                    '                                            </div>';
                                    $('.images').append(html);
                                }
                                reader.readAsDataURL(input.files[i]);
                                imageArray.push(image.src);
                            }
                        }
                    } else {
                        toastr.warning('Image with ratio is 16:9');
                    }
                }
            }
        }else{
            toastr.error('Incorrect image format');
        }
        count++;
    };

    $('#input-image').on('change', function() {
        imagesPreview(this, 'div.images');
    });
    
    $(document).on('click', '.delete-image', function () {
        idRemove = $(this).data('remove');
        idImageRemove.push($('#imageEdit'+idRemove).data('image'));
        $(this).parent().remove()
        imagePath[idRemove] = '';
        imageArray[idRemove] = '';
        console.log(imagePath);
    })
    $(document).on('click', '.btn-remote-image', function () {
        $('.image-item').remove();
        // $('.remoteImage').remove();
    })
});

$(document).ready(function (){
    $(".select2_init").select2({
        placeholder: "Chọn Danh mục",
        allowClear: true
    });
});

<!-- Modal -->
<div class="modal fade" id="exampleModalArea" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Select Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="" id="js-select2" multiple="multiple">
                <div class="modal-body">
                    <form action="#">
                        <div class="modal-body select-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-check-all">
                                        <div class="form-check mb-4">
                                            <input type="checkbox" id="selectAllArea" value=" " class="check-all"
                                                   name="check-all[]">
                                            <label for="check-all-area">Select all</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="check-item">
                                <div class="row">
                                    @foreach($cities as $city)
                                        <div class="item col-6">
                                            <div class="form-check">
                                                <input type="checkbox" id="Osaka" class="item-area"
                                                       name="item-area[]"
                                                       value="{{ $city->name }}"
                                                    @if(old('area'))
                                                        @for( $i =0; $i < count(old('area')); $i++)
                                                            @if($city->name == old('area.'.$i) )
                                                                {{ 'checked' }}
                                                            @endif
                                                        @endfor
                                                    @elseif(isset($company) && in_array($city->name,explode('|',$company->area_intends_to_recuit)))
                                                        {{ 'checked' }}
                                                    @endif
                                                >
                                                <label for="{{ $city->name }}">{{ $city->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="selectArea">Select</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
@push('scripts')
    <script>
        //handler show value checkbox
        document.getElementById('selectArea').onclick = function () {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            let area = [];
            for (var checkbox of checkboxes) {
                area.push(checkbox.value);
            }
            $('.js-select2').val(area).trigger('change');
        }

        //handler check all check box Area
        $(function () {
            //handler for selectall change
            $('#selectAllArea').change(function () {
                $("input[name='item-area[]']").prop('checked', $(this).prop('checked'))
            })
            //handler for all checkboxes to refect selectAll status
            $("input[name='item-area[]']").change(function () {
                $("#selectAllArea").prop('checked', true)
                $("input[name='item-area[]']").each(function () {
                    if (!$(this).prop('checked')) {
                        $("#selectAllArea").prop('checked', $(this).prop('checked'));
                        return;
                    }
                })
            })
        })
        $("#selectArea").click(function () {
            $("#exampleModalArea").modal('hide');
        });

    </script>
@endpush
<script src="{{asset('js/admin/company.js')}}"></script>


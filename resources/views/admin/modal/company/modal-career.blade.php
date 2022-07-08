<!-- Modal -->
<div class="modal fade" id="exampleModalCenterCareer" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Select Career</h5>
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
                                            <input type="checkbox" id="selectAll" value=" " class="check-all"
                                                   name="check-all[]">
                                            <label for="check-all-career">Select all</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="check-item">
                                <div class="row">
                                    @foreach($categories as $category)
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input type="checkbox" id="Sale" name="item-career[]" class="item-career"
                                                   value="{{ $category->name }}"
                                                @if(old('career'))
                                                    @for( $i =0; $i < count(old('career')); $i++)
                                                        @if($category->name == old('career.'.$i) )
                                                            {{ 'checked' }}
                                                        @endif
                                                    @endfor
                                                @elseif(isset($company) && in_array($category->name,explode('|',$company->career)))
                                                    {{ 'checked' }}
                                                @endif
                                            >
                                            <label for="{{ $category->name }}">{{ $category->name }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="select">Select</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="{{asset('js/admin/company.js')}}"></script>


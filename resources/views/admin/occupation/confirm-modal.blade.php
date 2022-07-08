<!-- Modal -->
<div class="modal fade" id="model_confirm_occupation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="padding: 2rem">
                <div class="row">
                    <div class="col-md-5 col-sm-auto">
                        <h3 class="modal-title">Confirmation</h3>
                    </div>
                </div><br>
                <div class="row confirm-image-occupation">

                </div>

                <div class="job-content mt-3">
                    <div class="d-flex">
                        <p class="label-column">Job category</p>
                        <p class="detail-category"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Title</p>
                        <p class="detail-title" style="overflow: hidden"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Desciption</p>
                        <p class="detail-description" style="overflow: hidden"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Speciality</p>
                        <p class="detail-speciality" style="overflow: hidden"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Note</p>
                        <p class="detail-note" style="overflow: hidden"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Bring items</p>
                        <p class="detail-Bring-items" style="overflow: hidden"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Skill required</p>
                        <p class="detail-skill-required" style="overflow: hidden"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Status</p>
                        <p class="detail-status"></p>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary btn-action-view ml-3 .btn-action-view .btn-action-view" data-dismiss="modal">CANCEL</button>
                        <button type="button" class="btn btn-primary btn-save btn-save-job ml-3 .btn-action-view" id="btn-save-occupation" data-dismiss="modal">SAVE</button>
                        <button type="button" class="btn btn-warning btn-save-job ml-3" id="btn-add-update-job" data-dismiss="modal" style="color: white">CREATE JOB NOW</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-title{
        color: #000000;
    }
    .btn-action-view{
        padding: 4px 38px;
    }
    .label-column{
        min-width: 8rem;
    }
    img.view-detail-img {
        width: 100%;
    }
    .wrap-detail-img{
        border: 8px solid #ccc;
    }
    @media (min-width: 900px){
        .modal-dialog {
            max-width: 750px;
            margin: 1.75rem auto;
        }
    }
</style>
@push('scripts')
@endpush

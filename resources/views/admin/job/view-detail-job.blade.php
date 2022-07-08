<!-- Modal -->
<div class="modal fade" id="model_view_detail_job" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="padding: 2rem">
                <div class="row">
                    <div class="col-md-5 col-sm-auto">
                        <h3 class="modal-title">Detail job</h3>
                    </div>
                    <div class="col-md-7 col-sm-auto d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary btn-action-view" data-dismiss="modal">CANCEL</button>
                        <form action="{{ route('job.duplicate') }}" method="post">
                            @csrf
                            <input type="hidden" value="" name="id">
                            <button type="submit" class="btn border border-dark btn-action-view h-100">
                                <i class="fal fa-copy mr-1"></i> COPY</button>
                        </form>

                        <a href="javacript:void(0)" type="button" class="btn btn-primary btn-action-view btn-edit-job d-flex align-items-center" >
                            EDIT</a>
                    </div>
                </div>

                <div class="job-content mt-3">
                    <div class="d-flex">
                        <p class="label-column">Status</p>
                        <p class="detail-status">Hiring</p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Title</p>
                        <p class="detail-title"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Work time</p>
                        <p class="detail-work-time"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Deadline</p>
                        <p class="detail-deadline"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">People</p>
                        <p class="detail-people"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Salary/hours</p>
                        <p class="detail-salary-hours"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Travel fees</p>
                        <p class="detail-travel-fees"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Total amount</p>
                        <p class="detail-total-amount"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Description</p>
                        <p class="detail-description">/p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Work address</p>
                        <p class="detail-work-address"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Access address</p>
                        <p class="detail-access-address"></p>
                    </div>
                    <div class="d-flex">
                        <p class="label-column">Photos</p>
                        <div class="block-view-image row">
                        </div>
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

<script>

</script>

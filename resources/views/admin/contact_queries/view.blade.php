
    <div class="modal-header white bg-primary">
        <h5 class="modal-title bold text-white" id="crudModalLabel" style="margin-top: -15px ; padding: 20px; 10px"> Message</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="margin-top: -1%">
                        <div class="card-header">
                            <h2 class="text-center">{{ $contact->subject }}</h2>
                        </div>
                        <div class="card-body">
                            <h4 class="text-center">
                                {{ $contact->comment }}
                            </h4>
                        </div>

                    </div>
                    <div class="container text-right">
                        <a href="mailto: {{ $contact->email }}" class="btn btn-primary">Reply</a>
                    </div>
                </div>

            </div>
        </div>
    </div>



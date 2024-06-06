<div class="modal" id="detailModal" tabindex="-1">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-status bg-success"></div>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-body text-center py-4 card mt-1">
        <div class="card-header text-center">
          <div class="datagrid mx-auto">
            <div class="datagrid-item">
              <img id="profile_picture" src="" alt="Profile Picture" class="img-fluid rounded mb-3" width="100" height="100">
              <h3 class="card-title" id="job_seeker_name"></h3>
            </div>
          </div>
          <div class="card-footer">
            <div class="">
              <div class="datagrid-item">
                {{-- <h3 class="text-secondary"><u>Resume</u></h3> --}}
                <div class="datagrid-content text-start" id="job_seeker_resume"></div>
                <div class="pt-3 row justify-content-center">
                  <div class="col-6">
                    <a href="#" target="_blank" class="btn btn-outline-info col-12">
                      CV
                    </a>
                  </div>
                  <div class="col-6">
                    <a href="#" target="_blank" class="btn btn-outline-info col-12">
                      Certificate
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="card-body">
          <div class="datagrid">
            <div class="datagrid-item">
              <div class="datagrid-title">Address</div>
              <div class="datagrid-content" id="job_seeker_address"></div>
            </div>
            <div class="datagrid-item">
              <div class="datagrid-title">Phone</div>
              <div class="datagrid-content" id="job_seeker_phone">Third Party</div>
            </div>
          </div>
          
        </div>
      </div>
      <div class="modal-footer">
        <div class="w-100">
          <div class="row">
            <div class="col">
              <button type="button" class="btn w-100 btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

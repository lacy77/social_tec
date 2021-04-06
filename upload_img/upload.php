<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'><script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'><script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      

      <div class="item-wrapper one">
        <div class="item">
            <form data-validation="true" action="#" method="post" enctype="multipart/form-data">
                <div class="item-inner">
                    <div class="item-content">
                        <div class="image-upload"> <label style="cursor: pointer;" for="file_upload"> <img src="" alt="" class="uploaded-image">
                                <div class="h-100">
                                    <div class="dplay-tbl">
                                        <div class="dplay-tbl-cell"> <i class="fa fa-cloud-upload"></i>
                                            <h5><b>Choose Your Image to Upload</b></h5>
                                            <h6 class="mt-10 mb-70">Or Drop Your Image Here</h6>
                                        </div>
                                    </div>
                                </div>
                                <!--upload-content--> <input data-required="image" type="file" name="image_name" id="file_upload" class="image-input" data-traget-resolution="image_resolution" value="">
                            </label> </div>
                    </div>
                    <!--item-content-->
                </div>
                <!--item-inner-->
            </form>
        </div>
        <!--item-->
    </div>








      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<style>

.item .item-content {
    padding: 30px 35px
}

.image-upload {
    width: 100%;
    height: 300px;
    border: 1px dashed #ddd;
    border-radius: 5px;
    margin-bottom: 20px;
    position: relative;
    text-align: center;
    background: #f8f8f9;
    color: #666;
    overflow: hidden
}

.item-wrapper form img {
    margin-bottom: 20px;
    width: auto;
    height: auto;
    max-height: 400px;
    width: auto;
    border-radius: 5px;
    overflow: hidden
}

.image-upload img {
    height: 100% !important;
    width: auto !important;
    border-radius: 0px;
    margin: 0 auto
}

.image-upload i {
    font-size: 6em;
    color: #ccc
}

.image-upload input {
    cursor: pointer;
    opacity: 0;
    height: 100%;
    width: 100%;
    z-index: 10;
    position: absolute;
    top: 0;
    left: 0
}

.item-wrapper input {
    height: 43px;
    line-height: 43px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 20px
}
</style>
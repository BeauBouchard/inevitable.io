<h2>Upload</h2>
 <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="<?php   echo URL; ?>upload/upload/" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="<?php   echo URL; ?>/noscript/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="input-group">
		  <input type="text" class="form-control" placeholder="Title" name="title" >
		</div>
		<div class="input-group">
		  <input type="text" class="form-control" placeholder="Description of Blueprint" name="desc">
		</div>
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                	<i class="icon fa fa-plus fa-lg"></i>
               		<span>Add files...</span>
                    <input type="file" name="fileupload" />
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="icon fa fa-cloud-upload fa-lg"></i>
                    <span>Start upload</span>
                </button>
                
                <?php 
                
                /*
                 *
                <button type="reset" class="btn btn-warning cancel">
                    <i class="icon fa fa-ban fa-lg"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="icon fa fa-trash fa-lg"></i>
                    <span>Delete</span>
                </button>
                 * 
                 */
                ?>

                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>
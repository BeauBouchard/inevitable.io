	<h2>Upload</h2>
	<p>A Blueprint is a unique plan for 1 layer. A blueprint can be added to a collection you made using the drop down menu below. 
	Collections must first be created <a href='' >at the collection page</a> from the <a href='<?php echo URL."dashboard/"; ?>'>dashboard.</a></p>
 	<!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="<?php   echo URL; ?>upload/upload/" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="<?php   echo URL; ?>/noscript/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="input-group">
		  <input type="text" class="form-control" placeholder="Title" name="title" >
		</div>
		<div class="input-group">
		  <textarea rows="10" cols="50" type="text" class="form-control" placeholder="Description of Blueprint" name="desc" ></textarea>
		</div>
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
            <h4>Upload the .CSV blueprint for the file: </h4>
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
	        	<span class="dropdown">
				  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
				    Not Part of a Collection
				    <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu" role="menu" >
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Collection 1</a></li>
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Collection 2</a></li>
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Collection 3</a></li>
				  </ul>
				</span >
                
                <?php 
                
                /*
                 * This is shit i may need when you are able to add more files all at once
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
            </div><!-- /col-lg-7 -->
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
            
        </div><!-- /row -->
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
        
        
    </form>
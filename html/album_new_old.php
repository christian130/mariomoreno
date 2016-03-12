<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />        
        <link rel="stylesheet" href="css/marcel.css" type="text/css" />        
        <link type="text/css" href="js/scroll/jquery.jscrollpane.css" rel="stylesheet" media="all" />
        <script type="text/javascript" src="js/scroll/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <!-- the jScrollPane script -->
        <script type="text/javascript" src="js/scroll/mwheelIntent.js"></script>            
        <script type="text/javascript" src="js/scroll/jquery.jscrollpane.min.js"></script>            
        <link rel="stylesheet" href="js/fileupload/css/blueimp-gallery.css">
            <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
            <link rel="stylesheet" href="js/fileupload/css/jquery.css">
                <link rel="stylesheet" href="js/fileupload/css/jquery-ui.css">
                    <link rel="stylesheet" href="js/fileupload/css/jquery.fileupload.css">
                        <link rel="stylesheet" href="js/fileupload/css/jquery.fileupload-ui.css">
                            <!-- CSS adjustments for browsers with JavaScript disabled -->
                            <noscript><link rel="stylesheet" href="js/fileupload/css/jquery.fileupload-noscript.css"></noscript>
                            <noscript><link rel="stylesheet" href="js/fileupload/css/jquery.fileupload-ui-noscript.css"></noscript>
                            </head>

                            <body  class="nobg ">                
                                <?php //theses styles its to grow up the image and give a margin ?>
                                <style>
                                    canvas{
                                        margin-top: 3px;
                                        margin-bottom: 3px;
                                        height: 200px;
                                        width: 200px;
                                        border-radius: 4px;
                                        border-color: 4px;
                                    }
                                </style>
                                <script type="text/javascript" src="js/albums_header.js"></script>

                                    <div class="album_header" style="padding-top: 20px;">
                                    <label class="labelTitle">Title: <input class="inputTitle" name="title" value="<?php echo $album->getTitle(); ?>" ></input></label>
                                    <input class="postbutton" type="button" name="post" value="Save" onclick="titleAlbum();"></input>
                                    </div>
                                    <?php if ($session->getSession('other')) { ?>                                        
                                        <div class="album_form" >
                                            <!-- blueimp Gallery styles -->
<?php //this a part of plugin callled JQuery FileUpload  ?>

                                            <form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" >
                                                <!-- Redirect browsers with JavaScript disabled to the origin page -->
                                                <noscript><input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/"></noscript>
                                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                                <div class="fileupload-buttonbar">
                                                    <div class="fileupload-buttons">
                                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                                        <span class="fileinput-button">
                                                            <span>Add files...</span>
                                                            <input type="file" name="files[]" multiple accept="image/*" />
                                                        </span>
                                                        <button type="submit" class="start">Start upload</button>
                                                        <!--<button type="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" style="padding: 6px;" onclick="triggerClick();">Start upload</button>-->
                                                        <button type="reset" class="cancel">Cancel upload</button>
                                                        <button type="button" class="delete">Delete</button>
                                                        <input type="checkbox" class="toggle">
                                                            <!-- The global file processing state -->
                                                            <span class="fileupload-process"></span>
                                                    </div>
                                                    <!-- The global progress state -->
                                                    <div class="fileupload-progress fade" style="display:none">
                                                        <!-- The global progress bar -->
                                                        <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                                        <!-- The extended global progress state -->
                                                        <div class="progress-extended">&nbsp;</div>
                                                    </div>
                                                </div>
                                                <!-- The table listing the files available for upload/download -->
                                                <div role="presentation" class="files"><div class="files"></div></div>
                                            </form>
                                            <br>                                                
                                                <!-- The blueimp Gallery widget -->
                                                
                                                <!-- The template to display files available for upload -->
                                                <script id="template-upload" type="text/x-tmpl">
                                                    {% for (var i=0, file; file=o.files[i]; i++) { %}                                                    
                                                        <div class="divHolder template-upload fade">
                                                            <span class="preview"></span>
                                                                                                                
                                                            <p class="name">{%=file.name%}</p>
                                                            <p class="size">Processing...</p>
                                                            <strong class="error"></strong>
                                                        
                                                            <div class="progress"></div>
                                                        
                                                        <br>
                                                            {% if (!i && !o.options.autoUpload) { %}
                                                            <button class="start">Start</button>
                                                            {% } %}
                                                            {% if (!i) { %}
                                                            <button class="cancel">Cancel</button>
                                                            {% } %}
                                                        
                                                        </div>                                                    
                                                    {% } %}
                                                </script>
                                                <!-- The template to display files available for download -->
                                                <script id="template-download" type="text/x-tmpl">
                                                    {% for (var i=0, file; file=o.files[i]; i++) { %}
                                                    <tr class="template-download fade">
                                                        <td>
                                                            <span class="preview">
                                                                {% if (file.thumbnailUrl) { %}
                                                                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                                                                {% } %}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <p class="name">
                                                                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                                                            </p>
                                                            {% if (file.error) { %}
                                                            <div><span class="error">Error</span> {%=file.error%}</div>
                                                            {% } %}
                                                        </td>
                                                        <td>
                                                            <span class="size">{%=o.formatFileSize(file.size)%}</span>
                                                        </td>
                                                        <td>
                                                            <button class="delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>Delete</button>
                                                            <input type="checkbox" name="delete" value="1" class="toggle">
                                                        </td>
                                                    </tr>
                                                    {% } %}
                                                </script>
                                                <script src="js/jquery-1.9.1.js"></script>
                                                <script src="js/fileupload/js/jquery-ui.min.js"></script>
                                                <!-- The Templates plugin is included to render the upload/download listings -->
                                                <script src="js/fileupload/js/tmpl.js"></script>
                                                <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
                                                <script src="js/fileupload/js/load-image.js"></script>
                                                <!-- The Canvas to Blob plugin is included for image resizing functionality -->
                                                <script src="js/fileupload/js/canvas-to-blob.js"></script>
                                                <!-- blueimp Gallery script -->
                                                <script src="js/fileupload/js/jquery.blueimp-gallery.min.js"></script>
                                                <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
                                                <script src="js/fileupload/js/jquery.iframe-transport.js"></script>
                                                <!-- The basic File Upload plugin -->
                                                <script src="js/fileupload/js/jquery.fileupload.js"></script>
                                                <!-- The File Upload processing plugin -->
                                                <script src="js/fileupload/js/jquery.fileupload-process.js"></script>
                                                <!-- The File Upload image preview & resize plugin -->
                                                <script src="js/fileupload/js/jquery.fileupload-image.js"></script>                                                       
                                                <!-- The File Upload validation plugin -->
                                                <script src="js/fileupload/js/jquery.fileupload-validate.js"></script>
                                                <!-- The File Upload user interface plugin -->
                                                <script src="js/fileupload/js/jquery.fileupload-ui.js"></script>
                                                <!-- The File Upload jQuery UI plugin -->
                                                <script src="js/fileupload/js/jquery.fileupload-jquery-ui.js"></script>
                                                <!-- The main application script -->
                                                <script src="js/fileupload/js/main.js"></script>
                                        </div>
                                    <?php } ?>                                   
                                <?php //theses to initiate the script to style the scroolbar ?>
                                <script>
                                    $(document).ready(function(){
                                        $('body').jScrollPane(); 
                                    });
                                </script>
                            </body>
                            </html>

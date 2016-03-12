<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <link href="css/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.Jcrop.min.js"></script>
        <script type="text/javascript" src="js/crop.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){

                $('.step3').click(function() {
                    $("#multiform").submit();

                    //                    var formdata =  new FormData($(this)[0]);
                    //
                    //                    $.ajax({
                    //                        type: "POST",
                    //                        url: "upload.php",
                    //                        mimeType:"multipart/form-data",
                    //                        data: formdata,
                    //                        contentType: false,
                    //                        cache: false,
                    //                        processData:false,
                    //
                    //                        success: function(){alert('success');}
                    //                    });
                });

            });
        </script>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div id="logincontainer">
            <div class="signup2">
                <form id="upload_form" enctype="multipart/form-data" method="post" action="upload.php" onsubmit="return validateForm();" >
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="h" name="h" />
                    <input type="hidden" id="x1" name="x1" />
                    <input type="hidden" id="y1" name="y1" />
                    <input type="hidden" id="x2" name="x2" />
                    <input type="hidden" id="y2" name="y2" />
                    <div class="file_field">
                        <strong>Select An Image: </strong>
                        <input type="file" style="width:220px;" id="image_file" name="image_file">
                            <input type="submit" value="Upload"/>
                    </div>
                    <div id="image_div" style="display:none;text-align: center;">
                        <center>
                          <img src="" id="load_img"/>
                        </center>

                    </div>
                </form>

            </div>
        </div>
    </body>
</html>